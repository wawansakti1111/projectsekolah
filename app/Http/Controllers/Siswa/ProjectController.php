<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\EnrollmentMember;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; // <-- Tambahkan ini
use App\Models\ProjectSubmission; // <-- Tambahkan model ini
use App\Models\Subject; // <-- Tambahkan ini
use Carbon\Carbon; // <-- Pastikan Carbon sudah di-import


class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::all();

        $searchTerm = $request->input('search');
        $subjectId = $request->input('subject_id');

        $query = Project::with(['teacher', 'subject', 'sdgs'])
        // ▼▼▼ PERBAIKI LOGIKA FILTER DI SINI ▼▼▼
        ->where(function ($q) {
            $q->where('deadline', '>=', Carbon::now())
            ->orWhereNull('deadline');
        });
        // ▲▲▲ AKHIR PERBAIKAN ▼▼▼

        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($subjectId) {
            $query->where('subject_id', $subjectId);
        }

        $projects = $query->paginate(9);

        return view('siswa.proyek.index', compact('projects', 'subjects'));
    }


    public function show(Project $project)
    {
        // Ambil proyek lain untuk sidebar
        $otherProjects = Project::where('id', '!=', $project->id)
        ->latest()
        ->take(5)
        ->get();

        // Ambil semua siswa yang aktif, kecuali yang sedang login
        $activeStudents = User::where('role_id', 3)
        ->where('status', 'active')
        ->where('id', '!=', Auth::id())
        ->orderBy('name', 'asc')
        ->get(['id', 'name']);

        // START: TAMBAHAN KODE BARU
        // Cek status pendaftaran siswa yang sedang login untuk proyek ini
        $enrollmentStatus = ProjectEnrollment::where('user_id', Auth::id())
        ->where('project_id', $project->id)
        ->first();
        // END: TAMBAHAN KODE BARU

        // Kirim data ke view
        return view('siswa.proyek.show', [
            'project' => $project,
            'otherProjects' => $otherProjects,
            'activeStudents' => $activeStudents,
            'enrollmentStatus' => $enrollmentStatus, // Kirim status ke view
        ]);
    }

    public function enroll(Request $request, Project $project)
    {
        $validated = $request->validate([
            'group_name' => 'required|string|max:255',
            'members' => 'nullable|array',
            'members.*' => ['nullable', 'exists:users,id', 'distinct', Rule::notIn([Auth::id()])],
            'reason_to_join' => 'nullable|string',
        ]);

        try {
            DB::transaction(function () use ($validated, $project) {
                $userIds = array_merge([Auth::id()], $validated['members'] ?? []);

                // ▼▼▼ TAMBAHKAN LOGIKA VALIDASI BARU DI SINI ▼▼▼
                $existingSubmission = ProjectSubmission::whereIn('user_id', $userIds)
                    ->where('project_id', $project->id)
                    ->first();

                if ($existingSubmission) {
                    throw new \Exception('Salah satu anggota kelompok sudah mengumpulkan proyek ini.');
                }
                // ▲▲▲ AKHIR LOGIKA VALIDASI BARU ▲▲▲

                // Periksa apakah pengguna sudah terdaftar dalam proyek ini
                if (ProjectEnrollment::whereIn('user_id', $userIds)->where('project_id', $project->id)->exists()) {
                    throw new \Exception('Anda atau anggota kelompok sudah terdaftar untuk proyek ini.');
                }

                // Buat pendaftaran baru
                $enrollment = ProjectEnrollment::create([
                    'user_id' => Auth::id(),
                    'project_id' => $project->id,
                    'group_name' => $validated['group_name'],
                    'status' => 'pending',
                    'reason_to_join' => $validated['reason_to_join'] ?? null,
                ]);

                // Tambahkan anggota kelompok
                if (!empty($validated['members'])) {
                    $members = collect($validated['members'])->map(function ($memberId) {
                        return ['user_id' => $memberId];
                    });
                    $enrollment->members()->createMany($members);
                }
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }

        return redirect()->route('siswa.proyek.myProjects')->with('status', 'Pendaftaran berhasil dikirim! Harap tunggu persetujuan guru.');
    }

    public function myProjects()
    {
        // Ambil semua pendaftaran milik siswa yang sedang login
        $enrollments = ProjectEnrollment::where('user_id', auth()->id())
        ->with(['project.teacher', 'project.subject', 'members.user', 'submissions']) // <-- Tambahkan 'submissions'
        ->latest()
        ->paginate(10);

        return view('siswa.proyek.my-projects', compact('enrollments'));
    }

    public function submitFinalProject(ProjectEnrollment $enrollment)
    {
        // Pastikan hanya siswa yang terdaftar dan statusnya approved yang bisa submit
        $allowedStatuses = ['approved', 'revision_needed'];
        if ($enrollment->user_id !== auth()->id() || !in_array($enrollment->status, $allowedStatuses)) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        // Cek apakah sudah ada submission yang dibuat sebelumnya
        // Ini untuk mencegah siswa membuat submission ganda
        $hasSubmitted = ProjectSubmission::where('project_enrollment_id', $enrollment->id)->exists();
        if ($hasSubmitted) {
            return redirect()->route('siswa.proyek.myProjects')->with('status', 'Error: Anda sudah mengirimkan proyek. Silakan lihat detailnya.');
        }

        return view('siswa.proyek.submit', compact('enrollment'));
    }


    public function storeFinalProject(Request $request, ProjectEnrollment $enrollment)
    {
        // PERBAIKAN: Izinkan jika status 'approved' ATAU 'revision_needed'
        $allowedStatuses = ['approved', 'revision_needed'];
        if ($enrollment->user_id !== auth()->id() || !in_array($enrollment->status, $allowedStatuses)) {
            abort(403, 'Anda tidak memiliki izin untuk melakukan aksi ini.');
        }

        $validated = $request->validate([
            'final_submission_file' => ['required_without:final_submission_link', 'nullable', 'file', 'max:20480'],
            'final_submission_link' => ['required_without:final_submission_file', 'nullable', 'url', 'max:255'],
        ]);

        // Hapus submission lama jika ada (untuk kasus revisi)
        $enrollment->submissions()->delete();

        $submissionData = [
            'project_enrollment_id' => $enrollment->id,
            'final_submission_link' => $validated['final_submission_link'] ?? null,
        ];

        if ($request->hasFile('final_submission_file')) {
            $submissionData['final_submission_file'] = $request->file('final_submission_file')->store('final_submissions', 'public');
        }

        // Buat entri baru di tabel submissions
        $enrollment->submissions()->create($submissionData);

        // Update status pendaftaran kembali menjadi 'submitted'
        $enrollment->update(['status' => 'submitted']);

        return redirect()->route('siswa.proyek.myProjects')->with('status', 'Proyek berhasil dikirim ulang dan menunggu penilaian!');
    }

}
