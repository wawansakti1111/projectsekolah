<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\LmsContent;
use App\Models\LmsMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class LmsContentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lms_material_id' => ['required', 'exists:lms_materials,id'],
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:file,video_link,quiz'], // Pastikan 'quiz' ada
            'attachment' => ['required_if:type,file', 'nullable', 'file', 'max:20480'],
            'path_or_url' => ['required_if:type,video_link', 'nullable', 'url'],
            'quiz_id' => ['required_if:type,quiz', 'nullable', 'exists:quizzes,id'], // Validasi untuk quiz_id
            'description' => ['nullable', 'string'],
        ]);

        $material = LmsMaterial::findOrFail($request->lms_material_id);

        if ($material->user_id !== Auth::id()) {
            abort(403);
        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'path_or_url' => null, // Default ke null
            'quiz_id' => null,     // Default ke null
        ];

        if ($request->type === 'file' && $request->hasFile('attachment')) {
            $data['path_or_url'] = $request->file('attachment')->store('lms_contents', 'public');
        } elseif ($request->type === 'video_link') {
            $data['path_or_url'] = $request->path_or_url;
        } elseif ($request->type === 'quiz') {
            $data['quiz_id'] = $request->quiz_id;
        }

        $material->contents()->create($data);

        return redirect()->back()->with('status', 'Konten baru berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LmsContent $lmsContent)
    {
        // Authorization: Ensure the teacher owns the material this content belongs to
        if ($lmsContent->material->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $lmsContent->update($request->only('title', 'description'));

        return redirect()->route('guru.lms.show', $lmsContent->lms_material_id)
        ->with('status', 'Sub-konten berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LmsContent $lmsContent)
    {
        // Authorization
        if ($lmsContent->material->user_id !== Auth::id()) {
            abort(403);
        }

        $materialId = $lmsContent->lms_material_id;

        if ($lmsContent->type === 'file') {
            Storage::disk('public')->delete($lmsContent->path_or_url);
        }

        $lmsContent->delete();

        return redirect()->route('guru.lms.show', $materialId)
        ->with('status', 'Sub-konten berhasil dihapus!');
    }

    /**
     * Update the order of the contents.
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'content_ids' => ['required', 'array'],
            'material_id' => ['required', 'exists:lms_materials,id'],
        ]);

        $material = LmsMaterial::findOrFail($request->material_id);

        // Authorization
        if ($material->user_id !== Auth::id()) {
            abort(403);
        }

        foreach ($request->content_ids as $index => $contentId) {
            LmsContent::where('id', $contentId)
            ->where('lms_material_id', $material->id) // Extra security check
            ->update(['order_column' => $index]);
        }

        return redirect()->back()->with('status', 'Urutan konten berhasil diperbarui!');
    }
}
