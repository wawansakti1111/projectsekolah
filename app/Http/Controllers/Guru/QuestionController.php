<?php
namespace App\Http\Controllers\Guru;

// app/Http/Controllers/Guru/QuestionController.php

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuestionOption; // PASTIKAN SUDAH ADA
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    // ... (Metode index, show, dan destroy lainnya)

    public function create(Quiz $quiz)
    {
        return view('guru.quiz.edit-question', [
            'quiz' => $quiz,
            'question' => new Question(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question' => 'required|string|max:1000',
            'image' => 'nullable|image|max:2048', // Max 2MB
            // Validasi untuk pilihan jawaban
            'options' => 'required|array|min:4|max:4', // Harus ada 4 pilihan
            'options.*.text' => 'required|string|max:500', // Setiap pilihan harus punya teks
            'correct_option_index' => 'required|integer|min:0|max:3', // Index 0-3
        ], [
            'correct_option_index.required' => 'Anda harus memilih salah satu jawaban yang benar.',
            'options.required' => 'Anda harus mengisi 4 pilihan jawaban (A, B, C, D).',
            'options.*.text.required' => 'Setiap pilihan jawaban harus diisi.',
        ]);

        // 2. Unggah Gambar (jika ada)
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('quiz_images', 'public');
        }

        // 3. Simpan Pertanyaan
        $question = Question::create([
            'quiz_id' => $request->quiz_id,
            'question' => $request->question,
            'image' => $imagePath,
        ]);

        // 4. Simpan Pilihan Jawaban
        $correctIndex = (int) $request->correct_option_index;
        
        foreach ($request->options as $index => $optionData) {
            $isCorrect = ($index == $correctIndex);

            QuestionOption::create([
                'question_id' => $question->id,
                'option_text' => $optionData['text'],
                'is_correct' => $isCorrect,
            ]);
        }

        return redirect()->route('guru.quizzes.show', $request->quiz_id)
                         ->with('success', 'Soal baru berhasil ditambahkan! 📝');
    }

    public function edit(Question $question)
    {
        $quiz = $question->quiz;
        // Load options for the view
        $question->load('options'); 
        
        return view('guru.quiz.edit-question', compact('question', 'quiz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        // 1. Validasi Input
        $request->validate([
            'question' => 'required|string|max:1000',
            'image' => 'nullable|image|max:2048', 
            // Validasi untuk pilihan jawaban
            'options' => 'required|array|min:4|max:4',
            'options.*.text' => 'required|string|max:500', 
            'correct_option_index' => 'required|integer|min:0|max:3',
        ], [
            'correct_option_index.required' => 'Anda harus memilih salah satu jawaban yang benar.',
            'options.required' => 'Anda harus mengisi 4 pilihan jawaban (A, B, C, D).',
            'options.*.text.required' => 'Setiap pilihan jawaban harus diisi.',
        ]);

        // 2. Unggah Gambar Baru dan Hapus Gambar Lama (jika ada)
        $imagePath = $question->image;
        if ($request->hasFile('image')) {
            if ($question->image) {
                Storage::disk('public')->delete($question->image);
            }
            $imagePath = $request->file('image')->store('quiz_images', 'public');
        }

        // 3. Update Pertanyaan
        $question->update([
            'question' => $request->question,
            'image' => $imagePath,
        ]);

        // 4. Update Pilihan Jawaban (Hapus yang lama dan buat yang baru)
        // Hapus semua opsi lama
        $question->options()->delete(); 
        
        $correctIndex = (int) $request->correct_option_index;

        foreach ($request->options as $index => $optionData) {
            $isCorrect = ($index == $correctIndex);

            QuestionOption::create([
                'question_id' => $question->id,
                'option_text' => $optionData['text'],
                'is_correct' => $isCorrect,
            ]);
        }

        return redirect()->route('guru.quizzes.show', $question->quiz_id)
                         ->with('success', 'Soal berhasil diperbarui! ✅');
    }
}