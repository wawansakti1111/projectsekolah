<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LmsMaterial;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class LmsController extends Controller
{
    public function index()
    {
        $materials = LmsMaterial::with(['uploader', 'subject', 'contents'])->latest()->paginate(10);
        return view('admin.lms.index', compact('materials'));
    }

    public function create()
    {
        $gurus = User::whereHas('role', fn($q) => $q->where('name', 'guru'))->orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        return view('admin.lms.create', compact('gurus', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'exists:users,id'],
            'subject_id' => ['nullable', 'exists:subjects,id'],
            'contents' => ['required', 'array', 'min:1'],
            'contents.*.title' => ['required', 'string', 'max:255'],
            'contents.*.description' => ['nullable', 'string'],
            'contents.*.type' => ['required', 'in:file,video_link'],
            'contents.*.file' => ['required_if:contents.*.type,file', 'nullable', 'file', 'max:20480'],
            'contents.*.url' => ['required_if:contents.*.type,video_link', 'nullable', 'url'],
        ]);

        $material = LmsMaterial::create($request->only('title', 'description', 'user_id', 'subject_id'));

        foreach ($request->contents as $index => $contentData) {
            $pathOrUrl = '';
            if ($contentData['type'] === 'file') {
                $file = $request->file("contents.{$index}.file");
                if(!$file) continue;
                $pathOrUrl = $file->store('lms_contents', 'public');
            } else {
                $pathOrUrl = $contentData['url'];
            }

            $material->contents()->create([
                'order_column' => (int) $index, // <-- Perbaikan di sini: cast ke integer
                                          'title' => $contentData['title'],
                                          'description' => $contentData['description'],
                                          'type' => $contentData['type'],
                                          'path_or_url' => $pathOrUrl,
            ]);
        }

        return redirect()->route('admin.lms.index')->with('status', 'Materi baru berhasil dibuat!');
    }


    public function show(LmsMaterial $lm)
    {
        $material = $lm->load(['subject', 'contents', 'uploader']);
        $gurus = User::whereHas('role', fn($q) => $q->where('name', 'guru'))->orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        return view('admin.lms.show', compact('material', 'gurus', 'subjects'));
    }

    public function edit(LmsMaterial $lm)
    {
        // Biasanya kita gabungkan edit ke halaman show/manage
        return redirect()->route('admin.lms.show', $lm->id);
    }

    public function update(Request $request, LmsMaterial $lm)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'exists:users,id'],
            'subject_id' => ['nullable', 'exists:subjects,id'],
            'description' => ['nullable', 'string'],
        ]);

        $lm->update($request->only('title', 'description', 'user_id', 'subject_id'));

        return redirect()->back()->with('status', 'Detail materi berhasil diperbarui!');
    }

    public function destroy(LmsMaterial $lm)
    {
        foreach ($lm->contents as $content) {
            if ($content->type === 'file') {
                Storage::disk('public')->delete($content->path_or_url);
            }
        }
        $lm->delete();
        return redirect()->route('admin.lms.index')->with('status', 'Materi berhasil dihapus!');
    }
}
