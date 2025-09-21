<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Sdg;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use App\Models\ProjectEnrollment;
use Illuminate\Support\Facades\DB;
use App\Models\ProjectGrade;
use App\Models\ProjectRubricItem;
use App\Models\SdgRubricItem;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', auth()->id())
        ->with(['sdgs', 'subject'])
        ->latest()
        ->paginate(10);

        return view('guru.proyek.index', compact('projects'));
    }

    public function create()
    {
        $sdgs = Sdg::all();
        $subjects = Subject::orderBy('name')->get();
        return view('guru.proyek.create', compact('sdgs', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'description' => ['required', 'string'],
            'deadline' => ['nullable', 'date'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,jpg,png,mp4,ppt,pptx', 'max:10240'],
            'sdgs' => ['nullable', 'array'],
            'sdgs.*' => ['exists:sdgs,id'],
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('project_attachments', 'public');
        }

        $project = Project::create([
            'user_id' => auth()->id(),
                                   'title' => $request->title,
                                   'subject_id' => $request->subject_id,
                                   'description' => $request->description,
                                   'deadline' => $request->deadline,
                                   'attachment_path' => $attachmentPath,
        ]);

        if ($request->has('sdgs')) {
            $project->sdgs()->attach($request->sdgs);
        }

        return redirect()->route('guru.proyek.index')->with('status', 'Proyek baru berhasil dibuat!');
    }

    public function edit(Project $proyek)
    {
        // Pastikan guru hanya bisa mengedit proyek miliknya sendiri
        if (auth()->id() !== $proyek->user_id) {
            abort(403);
        }

        $sdgs = Sdg::all();
        $subjects = Subject::orderBy('name')->get();
        $projectSdgIds = $proyek->sdgs->pluck('id')->toArray();

        return view('guru.proyek.edit', compact('proyek', 'sdgs', 'subjects', 'projectSdgIds'));
    }

    public function update(Request $request, Project $proyek)
    {
        if (auth()->id() !== $proyek->user_id) {
            abort(403);
        }

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'description' => ['required', 'string'],
            'deadline' => ['nullable', 'date'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,jpg,png,mp4,ppt,pptx', 'max:10240'],
            'sdgs' => ['nullable', 'array'],
            'sdgs.*' => ['exists:sdgs,id'],
        ]);

        $attachmentPath = $proyek->attachment_path;
        if ($request->hasFile('attachment')) {
            if ($attachmentPath) {
                Storage::disk('public')->delete($attachmentPath);
            }
            $attachmentPath = $request->file('attachment')->store('project_attachments', 'public');
        }

        $proyek->update([
            'user_id' => auth()->id(),
                        'title' => $request->title,
                        'subject_id' => $request->subject_id,
                        'description' => $request->description,
                        'deadline' => $request->deadline,
                        'attachment_path' => $attachmentPath,
        ]);

        $proyek->sdgs()->sync($request->sdgs ?? []);

        return redirect()->route('guru.proyek.index')->with('status', 'Proyek berhasil diperbarui!');
    }

    public function destroy(Project $proyek)
    {
        if (auth()->id() !== $proyek->user_id) {
            abort(403);
        }

        if ($proyek->attachment_path) {
            Storage::disk('public')->delete($proyek->attachment_path);
        }
        $proyek->delete();

        return redirect()->route('guru.proyek.index')->with('status', 'Proyek berhasil dihapus!');
    }

    public function show(Project $proyek)
    {
        // Authorization check is good!
        if (auth()->id() !== $proyek->user_id) {
            abort(403);
        }

        // This query is perfect. It eagerly loads students, members, and submissions.
        $enrollments = ProjectEnrollment::where('project_id', $proyek->id)
        ->with(['student', 'members.user', 'submissions'])
        ->latest()
        ->paginate(10);

        // This is also great.
        $hasProjectRubric = $proyek->projectRubric()->exists();
        $hasSdgRubric = $proyek->sdgRubrics()->exists();

        // The view already receives all the data it needs. No changes needed here!
        return view('guru.proyek.show', compact('proyek', 'enrollments', 'hasProjectRubric', 'hasSdgRubric'));
    }


    public function showGradingForm(Project $proyek, ProjectEnrollment $enrollment)
    {
        // Otorisasi
        if ($proyek->user_id !== auth()->id()) { // Pastikan menggunakan $proyek di sini
            abort(403);
        }

        // Validasi Kritis: Cek apakah rubrik sudah dibuat
        if (!$proyek->projectRubric || $proyek->sdgRubrics->isEmpty()) { // Pastikan menggunakan $proyek di sini
            return redirect()->route('guru.proyek.show', $proyek)
            ->with('status', 'Error: Anda harus membuat Rubrik Proyek dan Rubrik SDG terlebih dahulu sebelum menilai.');
        }

        // Load semua data yang dibutuhkan secara efisien
        $enrollment->load(['student', 'members.user', 'submissions']);
        $proyek->load(['projectRubric.items', 'sdgRubrics.items', 'sdgRubrics.sdg']); // Pastikan menggunakan $proyek di sini

        return view('guru.proyek.grading', compact('proyek', 'enrollment')); // Pastikan menggunakan $proyek di sini
    }
    // ▼▼▼ METHOD 2: MENYIMPAN NILAI ▼▼▼
    public function storeGrades(Request $request, Project $proyek, ProjectEnrollment $enrollment)
    {
        if ($proyek->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'grades' => ['required', 'array'],
            'grades.*.score' => ['required', 'integer', 'min:0', 'max:100'],
            'grades.*.gradable_type' => ['required', 'string'],
            'grades.*.gradable_id' => ['required', 'integer'],
            'final_feedback' => ['nullable', 'string'],
        ]);

        // --- Kalkulasi Skor ---
        $totalScore = 0;

        // 1. Ambil bobot untuk Project Rubric Items
        $projectItemIds = collect($validated['grades'])->filter(function ($grade) {
            return $grade['gradable_type'] === 'App\Models\ProjectRubricItem';
        })->pluck('gradable_id');

        $projectItemWeights = ProjectRubricItem::whereIn('id', $projectItemIds)->pluck('weight', 'id');

        // 2. Ambil bobot untuk SDG Rubric Items
        $sdgItemIds = collect($validated['grades'])->filter(function ($grade) {
            return $grade['gradable_type'] === 'App\Models\SdgRubricItem';
        })->pluck('gradable_id');

        $sdgItemWeights = SdgRubricItem::whereIn('id', $sdgItemIds)->pluck('weight', 'id');

        // 3. Hitung skor
        foreach ($validated['grades'] as $key => $gradeData) {
            $score = $gradeData['score'];
            $type = $gradeData['gradable_type'];
            $id = $gradeData['gradable_id'];

            if ($type === 'App\Models\ProjectRubricItem' && isset($projectItemWeights[$id])) {
                $weight = $projectItemWeights[$id];
                $totalScore += ($score * $weight) / 100;
            } elseif ($type === 'App\Models\SdgRubricItem' && isset($sdgItemWeights[$id])) {
                $weight = $sdgItemWeights[$id];
                // Asumsi bobot SDG per item. Jika bobot SDG adalah per grup SDG, logikanya perlu diubah.
                $totalScore += ($score * $weight) / 100;
            }
        }
        // --- Akhir Kalkulasi Skor ---

        DB::transaction(function () use ($validated, $enrollment, $totalScore) {
            // Hapus nilai lama jika ada, untuk menghindari duplikat saat menilai ulang
            ProjectGrade::where('project_enrollment_id', $enrollment->id)->delete();

            // 1. Buat entri utama untuk nilai akhir
            $mainGrade = ProjectGrade::create([
                'project_enrollment_id' => $enrollment->id,
                'feedback' => $validated['final_feedback'],
                'score' => round($totalScore)
            ]);

            // 2. Siapkan data rincian nilai untuk disimpan
            $answersToSave = [];
            foreach ($validated['grades'] as $gradeData) {
                $answersToSave[] = [
                    'project_grade_id' => $mainGrade->id,
                    'gradable_type' => $gradeData['gradable_type'],
                    'gradable_id'   => $gradeData['gradable_id'],
                    'score'         => $gradeData['score'],
                    'created_at'    => now(),
                        'updated_at'    => now(),
                ];
            }

            // Simpan rincian nilai menggunakan Query Builder untuk efisiensi massal
            DB::table('rubric_item_grades')->insert($answersToSave);

            // Update status enrollment menjadi 'graded' (dinilai)
            $enrollment->update(['status' => 'graded']);
        });

        return redirect()->route('guru.proyek.show', $proyek)->with('status', 'Nilai berhasil disimpan!');
    }

    // ▼▼▼ METHOD 3: MEMINTA REVISI ▼▼▼
    public function requestRevision(Request $request, ProjectEnrollment $enrollment)
    {
        if ($enrollment->project->user_id !== auth()->id()) {
            abort(403);
        }

        // Cukup ubah status enrollment
        $enrollment->update(['status' => 'revision_needed']);

        // Hapus submission yang ada agar siswa bisa submit ulang (opsional, tapi disarankan)
        $enrollment->submissions()->delete();

        return redirect()->route('guru.proyek.show', $enrollment->project)
        ->with('status', 'Permintaan revisi telah dikirim ke kelompok.');
    }
    public function showGrades(Project $proyek, ProjectEnrollment $enrollment)
    {
        // Otorisasi
        if ($proyek->user_id !== auth()->id() || $enrollment->project_id !== $proyek->id) {
            abort(403);
        }

        // Ambil data nilai utama (feedback)
        $grade = ProjectGrade::where('project_enrollment_id', $enrollment->id)->firstOrFail();

        // Ambil nilai per-item rubrik
        $itemGrades = \App\Models\RubricItemGrade::where('project_grade_id', $grade->id)->get();

        // Load relasi proyek untuk ditampilkan di view
        $proyek->load(['projectRubric.items', 'sdgRubrics.items', 'sdgRubrics.sdg']);

        return view('guru.proyek.grading-show', compact('proyek', 'enrollment', 'grade', 'itemGrades'));
    }

}
