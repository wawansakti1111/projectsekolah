<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\LmsMaterial;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Important for getting the logged-in user
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Quiz; // <-- Tambahkan 'use' statement ini di atas


class LmsController extends Controller
{
    /**
     * Display a listing of the teacher's own materials.
     */
    public function index()
    {
        $materials = LmsMaterial::where('user_id', Auth::id()) // <-- Only get materials for the logged-in teacher
        ->with(['subject', 'contents'])
        ->latest()
        ->paginate(10);

        return view('guru.lms.index', compact('materials'));
    }

    /**
     * Show the form for creating a new material.
     */
    public function create()
    {
        $subjects = Subject::orderBy('name')->get();
        return view('guru.lms.create', compact('subjects'));
    }

    /**
     * Store a newly created material in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subject_id' => ['nullable', 'exists:subjects,id'],
            'description' => ['nullable', 'string'],
        ]);

        $material = LmsMaterial::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'subject_id' => $validated['subject_id'],
            'user_id' => Auth::id(),
        ]);

        // Redirect langsung ke halaman 'show' untuk materi yang baru dibuat
        return redirect()->route('guru.lms.show', $material)->with('status', 'Materi baru berhasil dibuat! Sekarang Anda bisa menambahkan konten.');
    }

    /**
     * Display the specified material.
     */
    public function show(LmsMaterial $lm)
    {
        // Otorisasi: Pastikan guru memiliki akses
        if ($lm->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses materi ini.');
        }

        // 1. Load data utama materi dan kontennya
        $material = $lm->load(['subject', 'contents']);

        // 2. Ambil data analitik
        $totalContents = $material->contents->count();
        $progressBySiswa = [];

        if ($totalContents > 0) {
            $material->load('contents.completions');
            foreach ($material->contents as $content) {
                foreach ($content->completions as $siswa) {
                    if (!isset($progressBySiswa[$siswa->id])) {
                        $progressBySiswa[$siswa->id] = [
                            'completed_count' => 0,
                            'name' => $siswa->name,
                        ];
                    }
                    $progressBySiswa[$siswa->id]['completed_count']++;
                }
            }
        }

        // 3. Ambil daftar kuis yang tersedia (belum terpakai) untuk form "Tambah Konten"
        $availableQuizzes = Quiz::where('user_id', Auth::id())
        ->whereDoesntHave('lmsContent')
        ->orderBy('title')
        ->get();

        // 4. Kirim semua data ke satu view
        return view('guru.lms.show', compact(
            'material',
            'totalContents',
            'progressBySiswa',
            'availableQuizzes' // <-- Data baru untuk dropdown kuis
        ));
    }

    /**
     * Show the form for editing the specified material.
     */
    public function edit(LmsMaterial $lm)
    {
        // Authorization check
        if ($lm->user_id !== Auth::id()) {
            abort(403);
        }

        // We will just reuse the 'show' view which also contains the edit form
        return redirect()->route('guru.lms.show', $lm);
    }

    /**
     * Update the specified material in storage.
     */
    public function update(Request $request, LmsMaterial $lm)
    {
        // Authorization check
        if ($lm->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subject_id' => ['nullable', 'exists:subjects,id'],
            'description' => ['nullable', 'string'],
        ]);

        $lm->update($request->only('title', 'description', 'subject_id'));

        return redirect()->back()->with('status', 'Detail materi berhasil diperbarui!');
    }

    /**
     * Remove the specified material from storage.
     */
    public function destroy(LmsMaterial $lm)
    {
        // Authorization check
        if ($lm->user_id !== Auth::id()) {
            abort(403);
        }

        // Delete associated files from storage
        foreach ($lm->contents as $content) {
            if ($content->type === 'file') {
                Storage::disk('public')->delete($content->path_or_url);
            }
        }

        $lm->delete();

        return redirect()->route('guru.lms.index')->with('status', 'Materi berhasil dihapus!');
    }

}
