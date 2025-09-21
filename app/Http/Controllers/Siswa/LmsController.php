<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\LmsContent;
use App\Models\LmsMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\QuizAttempt; // <-- TAMBAHKAN BARIS INI
use App\Models\LmsProgress; // <-- TAMBAHKAN BARIS INI


class LmsController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Mengambil ID materi yang di-bookmark oleh user menggunakan nama relasi yang benar
        $bookmarkedIds = $user->bookmarkedLmsMaterials()->pluck('lms_material_id')->toArray();

        $searchTerm = $request->input('search');

        $query = LmsMaterial::with('uploader', 'subject');

        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        $materials = $query->paginate(9);

        return view('siswa.lms.index', compact('materials', 'bookmarkedIds'));
    }

    public function show(LmsMaterial $lmsMaterial)
    {
        // Eager load semua relasi yang dibutuhkan, termasuk relasi quiz pada content
        $lmsMaterial->load(['uploader', 'subject', 'contents.quiz']); // <-- Perubahan di sini

        // Ambil ID dari semua konten yang sudah diselesaikan oleh siswa
        $completedContentIds = Auth::user()->lmsCompletions()
        ->whereIn('lms_content_id', $lmsMaterial->contents->pluck('id'))
        ->pluck('lms_content_id')
        ->toArray();

        return view('siswa.lms.show', compact('lmsMaterial', 'completedContentIds'));
    }

    // Method baru untuk menandai konten sebagai selesai
    public function markAsComplete(LmsContent $lmsContent)
    {
        // KODE YANG BENAR (aman diklik berkali-kali)
        LmsProgress::firstOrCreate([
            'user_id' => auth()->id(),
                                   'lms_content_id' => $lmsContent->id
        ]);

        return back()->with('success', 'Materi ditandai selesai.');
    }
    // app/Http/Controllers/Siswa/LmsController.php

    public function showContent(Request $request, LmsContent $lmsContent)
    {
        $lmsContent->load('material.contents.quiz');
        if (!$lmsContent->material) { abort(404); }

        $data = [
            'lmsContent' => $lmsContent, 'embedUrl' => null, 'quiz' => null, 'attempt' => null,
            'questions' => null, 'remainingSeconds' => null, 'previousContent' => null,
            'nextContent' => null, 'view_mode' => 'embed',
        ];

        $orderedContents = $lmsContent->material->contents;
        $currentIndex = $orderedContents->search(fn($item) => $item->id === $lmsContent->id);
        if ($currentIndex !== false) {
            $data['previousContent'] = $orderedContents->get($currentIndex - 1);
            $data['nextContent'] = $orderedContents->get($currentIndex + 1);
        }

        if ($lmsContent->type === 'quiz') {
            $quiz = $lmsContent->quiz;
            if (!$quiz || $quiz->status == 'draft') { abort(404); }

            $data['quiz'] = $quiz;
            $attempt = QuizAttempt::where('user_id', Auth::id())->where('quiz_id', $quiz->id)->first();
            $action = $request->input('action');

            // ▼▼▼ PERBAIKAN LOGIKA UTAMA DI SINI ▼▼▼
            if ($action === 'take' && ($quiz->allow_multiple_attempts || !$attempt)) {
                // Kondisi ini hanya terpenuhi jika siswa secara eksplisit mengklik "Mulai" atau "Kerjakan Ulang"
                $attempt = QuizAttempt::updateOrCreate(
                    ['user_id' => Auth::id(), 'quiz_id' => $quiz->id],
                                                       ['started_at' => now(), 'score' => null, 'total_questions' => $quiz->questions()->count(), 'correct_answers' => 0]
                );
                $attempt->answers()->delete();
                $data['view_mode'] = 'take';

            } elseif ($attempt && $attempt->score !== null) {
                // JIKA SUDAH ADA NILAI, SELALU TAMPILKAN HASIL TERLEBIH DAHULU
                $attempt->load('answers.option');
                $data['view_mode'] = 'result';
            } else {
                // Jika belum ada nilai, tampilkan halaman mulai
                $data['view_mode'] = 'start';
            }

            $data['attempt'] = $attempt;
            $data['canAttempt'] = $quiz->allow_multiple_attempts || !$attempt;
            $data['attemptCount'] = $attempt ? 1 : 0;

            if ($data['view_mode'] === 'take') {
                $quiz->load('questions.options');
                $questions = $quiz->shuffle_questions ? $quiz->questions->shuffle() : $quiz->questions;
                $data['questions'] = $questions;

                if ($quiz->duration > 0) {
                    $elapsedSeconds = now()->diffInSeconds($attempt->started_at);
                    $data['remainingSeconds'] = ($quiz->duration * 60) - $elapsedSeconds;
                }
            }

        } else {
            $path = $lmsContent->path_or_url;
            if (str_contains($path, 'youtube.com') || str_contains($path, 'youtu.be')) {
                if (preg_match('/(youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $path, $matches)) {
                    $data['embedUrl'] = "https://www.youtube.com/embed/{$matches[2]}";
                }
            } else {
                $data['embedUrl'] = asset('storage/' . $path);
            }
        }

        return view('siswa.lms.content-show', $data);
    }
    public function completeAndNext(LmsContent $lmsContent)
    {
        // 1. Tandai konten saat ini sebagai selesai
        Auth::user()->lmsCompletions()->syncWithoutDetaching([$lmsContent->id]);

        // 2. Cari konten berikutnya
        $lmsContent->load('material.contents');
        $orderedContents = $lmsContent->material->contents;
        $currentIndex = $orderedContents->search(fn($item) => $item->id === $lmsContent->id);
        $nextContent = $orderedContents->get($currentIndex + 1);

        // 3. Arahkan ke halaman yang sesuai
        if ($nextContent) {
            // Jika ada konten berikutnya, arahkan ke sana
            return redirect()->route('siswa.lms.content.show', $nextContent);
        } else {
            // Jika ini adalah konten terakhir, kembalikan ke daftar konten
            return redirect()->route('siswa.lms.show', $lmsContent->material)->with('status', 'Selamat! Anda telah menyelesaikan semua materi.');
        }
    }
    public function showBookmarks(Request $request)
    {
        $user = Auth::user();
        $searchTerm = $request->input('search');

        // Ambil ID materi yang di-bookmark oleh user
        $bookmarkedIds = $user->bookmarkedLmsMaterials()->pluck('lms_material_id')->toArray();

        $query = LmsMaterial::whereIn('id', $bookmarkedIds)
        ->with('uploader', 'subject');

        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        $materials = $query->paginate(9);

        return view('siswa.lms.bookmarks', compact('materials', 'bookmarkedIds'));
    }

    public function toggleBookmark(LmsMaterial $lmsMaterial)
    {
        // 'toggle' akan secara otomatis attach jika belum ada, dan detach jika sudah ada.
        Auth::user()->bookmarkedLmsMaterials()->toggle([$lmsMaterial->id]);

        return back();
    }


}
