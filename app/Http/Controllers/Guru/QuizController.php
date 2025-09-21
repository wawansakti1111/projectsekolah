<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\LmsMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Tambahkan ini
use Illuminate\Support\Facades\Storage; // Pastikan use statement ini ada
use App\Models\Question; // <-- TAMBAHKAN BARIS INI


class QuizController extends Controller
{
    /**
     * Menampilkan daftar kuis yang dibuat oleh guru.
     */
    public function index()
    {
        $quizzes = Quiz::where('user_id', Auth::id())
        ->with('lmsMaterial')
        ->withCount('questions') // Menghitung jumlah pertanyaan secara efisien
        ->latest()
        ->paginate(10);

        return view('guru.quiz.index', compact('quizzes'));
    }

    /**
     * Menampilkan form untuk membuat kuis baru.
     */
    public function create(Request $request)
    {
        // Variabel yang dikirim bernama $materials
        $materials = LmsMaterial::where('user_id', Auth::id())->orderBy('title')->get();

        $preselectedMaterialId = $request->input('lms_material_id');

        return view('guru.quiz.create', compact('materials', 'preselectedMaterialId'));
    }

    /**
     * Menyimpan kuis baru ke database.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'lms_material_id' => ['nullable', 'exists:lms_materials,id'],
            'status' => ['required', 'in:draft,active'], // Tambahkan validasi untuk status
            'duration' => ['nullable', 'integer', 'min:1'],
            'shuffle_questions' => ['nullable', 'boolean'],
            'show_correct_answers' => ['nullable', 'boolean'],
            'allow_multiple_attempts' => ['nullable', 'boolean'],
        ]);

        $quiz = Quiz::create([
            'user_id' => Auth::id(),
                             'title' => $validated['title'],
                             'description' => $validated['description'],
                             'lms_material_id' => $validated['lms_material_id'],
                             'status' => $validated['status'], // <-- PERBAIKAN: Ambil status dari form
                             'duration' => $validated['duration'] ?? null,
                             'shuffle_questions' => $request->boolean('shuffle_questions'),
                             'show_correct_answers' => $request->boolean('show_correct_answers'),
                             'allow_multiple_attempts' => $request->boolean('allow_multiple_attempts'),
        ]);

        // Cek jika request datang dari modal
        if ($request->input('view') === 'modal') {
            $newQuizData = json_encode(['id' => $quiz->id, 'title' => $quiz->title]);
            return response("<script>window.parent.addQuizAndCloseModal($newQuizData);</script>");
        }

        return redirect()->route('guru.quiz.show', $quiz)->with('status', 'Informasi kuis berhasil disimpan. Silakan tambahkan pertanyaan.');
    }
    /**
     * Menampilkan detail sebuah kuis (halaman untuk manage pertanyaan).
     */
    public function show(Quiz $quiz)
    {
        // Otorisasi
        if ($quiz->user_id !== Auth::id()) {
            abort(403);
        }

        // Eager load pertanyaan dan pilihan jawabannya
        $quiz->load('questions.options');

        // Ambil materi LMS untuk dropdown di form pengaturan
        $materials = LmsMaterial::where('user_id', Auth::id())->orderBy('title')->get();

        return view('guru.quiz.show', compact('quiz', 'materials'));
    }

    /**
     * Menyimpan pertanyaan baru untuk sebuah kuis.
     */
    // app/Http/Controllers/Guru/QuizController.php

    public function storeQuestion(Request $request, Quiz $quiz)
    {
        // Otorisasi
        if ($quiz->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'question_text' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'], // Validasi untuk gambar
            'options' => ['required', 'array', 'min:2'],
            'options.*.option_text' => ['required', 'string'],
            'options.*.is_correct' => ['required', 'boolean'],
        ]);

        // Memastikan hanya ada satu jawaban yang benar
        $correctAnswersCount = collect($validated['options'])->where('is_correct', true)->count();
        if ($correctAnswersCount !== 1) {
            return back()->withErrors(['options' => 'Harus ada tepat satu jawaban yang benar.'])->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan gambar dan dapatkan path-nya
            $imagePath = $request->file('image')->store('question_images', 'public');
        }

        DB::transaction(function () use ($quiz, $validated, $imagePath) {
            // 1. Buat pertanyaan baru, sekarang dengan path gambar
            $question = $quiz->questions()->create([
                'question_text' => $validated['question_text'],
                'image' => $imagePath,
            ]);

            // 2. Simpan pilihan jawabannya
            $question->options()->createMany($validated['options']);
        });

        return back()->with('status', 'Pertanyaan baru berhasil ditambahkan!');
    }
    /**
     * Menghapus sebuah pertanyaan.
     */
    public function destroyQuestion(Question $question)
    {
        // Otorisasi: cek kepemilikan melalui relasi kuis
        if ($question->quiz->user_id !== Auth::id()) {
            abort(403);
        }

        $question->delete();

        return back()->with('status', 'Pertanyaan berhasil dihapus.');
    }

    public function edit(Quiz $quiz)
    {
        // Otorisasi
        if ($quiz->user_id !== Auth::id()) {
            abort(403);
        }

        $materials = LmsMaterial::where('user_id', Auth::id())->orderBy('title')->get();
        return view('guru.quiz.edit', compact('quiz', 'materials'));
    }

    /**
     * Memperbarui informasi utama kuis di database.
     */
    public function update(Request $request, Quiz $quiz)
    {
        // Otorisasi
        if ($quiz->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'lms_material_id' => ['nullable', 'exists:lms_materials,id'],
            'duration' => ['nullable', 'integer', 'min:1'],
            // Validasi untuk checkbox settings
            'status' => ['required', 'in:draft,active'],
            'shuffle_questions' => ['nullable', 'boolean'],
            'show_correct_answers' => ['nullable', 'boolean'],
            'allow_multiple_attempts' => ['nullable', 'boolean'],
        ]);

        $quiz->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'lms_material_id' => $validated['lms_material_id'],
            'duration' => $validated['duration'] ?? null,
            'status' => $validated['status'],
            'shuffle_questions' => $request->boolean('shuffle_questions'),
                      'show_correct_answers' => $request->boolean('show_correct_answers'),
                      'allow_multiple_attempts' => $request->boolean('allow_multiple_attempts'),
        ]);

        return redirect()->route('guru.quiz.index')->with('status', 'Kuis berhasil diperbarui.');
    }

    /**
     * Menghapus seluruh kuis beserta pertanyaannya.
     */
    public function destroy(Quiz $quiz)
    {
        // Otorisasi
        if ($quiz->user_id !== Auth::id()) {
            abort(403);
        }

        $quiz->delete();

        return redirect()->route('guru.quiz.index')->with('status', 'Kuis berhasil dihapus.');
    }
    /**
     * Menampilkan form untuk mengedit pertanyaan.
     */
    public function editQuestion(Question $question)
    {
        // Otorisasi: pastikan guru hanya bisa mengedit pertanyaan di kuis miliknya
        if ($question->quiz->user_id !== Auth::id()) {
            abort(403);
        }

        $question->load('options'); // Memuat pilihan jawaban terkait

        return view('guru.quiz.edit-question', compact('question'));
    }

    /**
     * Memperbarui pertanyaan di database.
     */
    public function updateQuestion(Request $request, Question $question)
    {
        // Otorisasi
        if ($question->quiz->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'question_text' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'options' => ['required', 'array', 'min:2'],
            'options.*.option_text' => ['required', 'string'],
            'options.*.is_correct' => ['required', 'boolean'],
        ]);

        // Memastikan hanya ada satu jawaban yang benar
        $correctAnswersCount = collect($validated['options'])->where('is_correct', true)->count();
        if ($correctAnswersCount !== 1) {
            return back()->withErrors(['options' => 'Harus ada tepat satu jawaban yang benar.'])->withInput();
        }

        DB::transaction(function () use ($request, $question, $validated) {
            $imagePath = $question->image; // Ambil path gambar lama

            // Cek jika ada gambar baru diupload
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
                // Simpan gambar baru
                $imagePath = $request->file('image')->store('question_images', 'public');
            }

            // 1. Update pertanyaan utama
            $question->update([
                'question_text' => $validated['question_text'],
                'image' => $imagePath,
            ]);

            // 2. Hapus opsi lama dan buat yang baru (strategi "Delete and Recreate")
            $question->options()->delete();
            $question->options()->createMany($validated['options']);
        });

        return redirect()->route('guru.quiz.show', $question->quiz_id)->with('status', 'Pertanyaan berhasil diperbarui!');
    }

}
