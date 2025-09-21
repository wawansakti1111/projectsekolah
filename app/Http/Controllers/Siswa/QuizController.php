<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuestionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\QuizAnswer; // <-- TAMBAHKAN BARIS INI

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::where('status', 'active')
        ->withCount('questions')
        ->with('lmsMaterial.subject')
        ->latest()
        ->paginate(15);

        return view('siswa.quiz.index', compact('quizzes'));
    }


    /**
     * Menampilkan halaman konfirmasi sebelum memulai kuis.
     */
    public function start(Quiz $quiz)
    {
        if ($quiz->status !== 'active') {
            abort(404, 'Kuis tidak ditemukan.');
        }

        $attemptCount = QuizAttempt::where('user_id', Auth::id())
        ->where('quiz_id', $quiz->id)
        ->count();

        $canAttempt = $quiz->allow_multiple_attempts || $attemptCount === 0;

        return view('siswa.quiz.start', compact('quiz', 'canAttempt', 'attemptCount'));
    }

    /**
     * Memproses start kuis: membuat attempt baru dan mengarahkan ke halaman pengerjaan.
     */
    public function processStart(Request $request, Quiz $quiz)
    {
        $user = Auth::user();

        // Cek lagi otorisasi pengerjaan berulang
        if (!$quiz->allow_multiple_attempts) {
            $existingAttempt = QuizAttempt::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->exists();
            if ($existingAttempt) {
                return redirect()->route('siswa.quiz.index')->withErrors('Anda hanya diizinkan mengerjakan kuis ini satu kali.');
            }
        }

        $attempt = QuizAttempt::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'started_at' => now(), // Catat waktu mulai
                                       'score' => 0,
                                       'total_questions' => $quiz->questions()->count(),
                                       'correct_answers' => 0,
        ]);

        return redirect()->route('siswa.quiz.take', $attempt);
    }

    /**
     * Menampilkan halaman pengerjaan kuis.
     */
    public function take(QuizAttempt $attempt)
    {
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        // Cek apakah kuis sudah disubmit (misalnya user menekan tombol back)
        if ($attempt->score > 0) {
            return redirect()->route('siswa.quiz.result', $attempt);
        }

        $quiz = $attempt->quiz;
        $questions = $quiz->questions()->with('options')->get();

        if ($quiz->shuffle_questions) {
            $questions = $questions->shuffle();
        }

        // Hitung sisa waktu berdasarkan waktu mulai yang tersimpan di database
        $remainingSeconds = null;
        if ($quiz->duration > 0) {
            $startTime = $attempt->started_at;
            $elapsedSeconds = now()->diffInSeconds($startTime);
            $remainingSeconds = ($quiz->duration * 60) - $elapsedSeconds;

            if ($remainingSeconds <= 0) {
                // Jika waktu sudah habis saat halaman di-load, paksa submit
                $this->submit(new Request(), $attempt); // Panggil method submit internal
                return redirect()->route('siswa.quiz.result', $attempt);
            }
        }

        return view('siswa.quiz.take', compact('attempt', 'quiz', 'questions', 'remainingSeconds'));
    }

    /**
     * Menyimpan jawaban siswa dan menghitung skor.
     */
    public function submit(Request $request, QuizAttempt $attempt)
    {
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }
        if ($attempt->score !== null) {
            return redirect()->route('siswa.quiz.result', $attempt);
        }

        $validatedAnswers = $request->validate([
            'answers' => ['nullable', 'array'],
            'answers.*' => ['integer', 'exists:question_options,id'],
        ])['answers'] ?? [];

        $quiz = $attempt->quiz;
        $questionIds = $quiz->questions->pluck('id');
        $correctAnswersMap = QuestionOption::whereIn('question_id', $questionIds)
        ->where('is_correct', true)
        ->pluck('id', 'question_id');

        $scoreCounter = 0;
        $answersToSave = [];
        $totalQuestions = $questionIds->count();

        foreach ($questionIds as $questionId) {
            $submittedOptionId = $validatedAnswers[$questionId] ?? null;
            $isCorrect = false;

            if ($submittedOptionId && isset($correctAnswersMap[$questionId]) && $correctAnswersMap[$questionId] == $submittedOptionId) {
                $scoreCounter++;
                $isCorrect = true;
            }

            $answersToSave[] = [
                'quiz_attempt_id' => $attempt->id,
                'question_id' => $questionId,
                'question_option_id' => $submittedOptionId,
                'is_correct' => $isCorrect,
                'created_at' => now(), 'updated_at' => now(),
            ];
        }

        DB::transaction(function () use ($attempt, $quiz, $answersToSave, $scoreCounter, $totalQuestions) {
            $attempt->answers()->delete();
            QuizAnswer::insert($answersToSave);
            $finalScore = ($totalQuestions > 0) ? round(($scoreCounter / $totalQuestions) * 100) : 0;
            $attempt->update(['score' => $finalScore, 'correct_answers' => $scoreCounter]);

            if ($quiz->lmsContent) {
                Auth::user()->lmsCompletions()->syncWithoutDetaching($quiz->lmsContent->id);
            }
        });

        // ▼▼▼ PERUBAHAN UTAMA DI SINI ▼▼▼
        // Selalu kembalikan ke halaman 'player' konten LMS
        return redirect()->route('siswa.lms.content.show', $attempt->quiz->lmsContent);
    }
    /**
     * Menampilkan halaman hasil akhir kuis.
     */
    // app/Http/Controllers/Siswa/QuizController.php

    public function result(QuizAttempt $attempt)
    {
        // Pastikan siswa hanya bisa melihat hasilnya sendiri
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        // Load semua relasi yang diperlukan untuk menampilkan ulasan kuis
        $attempt->load([
            'quiz.questions.options', // Soal dan semua pilihan jawabannya
            'answers.option'          // Jawaban spesifik yang dipilih siswa
        ]);

        return view('siswa.quiz.result', compact('attempt'));
    }

}
