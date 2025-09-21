<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Sdg;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['teacher', 'sdgs', 'subject'])->latest()->paginate(10, ['*'], 'proyek_page');
        $sdgs = Sdg::latest()->paginate(10, ['*'], 'sdg_page');
        $subjects = Subject::latest()->paginate(10, ['*'], 'subject_page');

        return view('admin.proyek.index', compact('projects', 'sdgs', 'subjects'));
    }

    public function create()
    {
        $gurus = User::whereHas('role', function ($query) {
            $query->where('name', 'guru');
        })->get();
        $subjects = Subject::orderBy('name')->get();
        $sdgs = Sdg::all();

        return view('admin.proyek.create', compact('gurus', 'subjects', 'sdgs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'title' => ['required', 'string', 'max:255'],
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
            'user_id' => $request->user_id,
            'subject_id' => $request->subject_id,
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline, // <-- Perbaikan di sini
            'attachment_path' => $attachmentPath,
        ]);

        if ($request->has('sdgs')) {
            $project->sdgs()->attach($request->sdgs);
        }

        return redirect()->route('admin.proyek.index')->with('status', 'Proyek baru berhasil ditambahkan!');
    }

    public function edit(Project $proyek)
    {
        $gurus = User::whereHas('role', function ($query) {
            $query->where('name', 'guru');
        })->get();
        $sdgs = Sdg::all();
        $subjects = Subject::orderBy('name')->get();
        $projectSdgIds = $proyek->sdgs->pluck('id')->toArray();

        return view('admin.proyek.edit', compact('proyek', 'gurus', 'sdgs', 'subjects', 'projectSdgIds'));
    }

    public function update(Request $request, Project $proyek)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
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
            'user_id' => $request->user_id,
            'title' => $request->title,
            'subject_id' => $request->subject_id,
            'description' => $request->description,
            'deadline' => $request->deadline, // <-- Perbaikan di sini
            'attachment_path' => $attachmentPath,
        ]);

        $proyek->sdgs()->sync($request->sdgs ?? []);

        return redirect()->route('admin.proyek.index')->with('status', 'Proyek berhasil diperbarui!');
    }

    public function destroy(Project $proyek)
    {
        if ($proyek->attachment_path) {
            Storage::disk('public')->delete($proyek->attachment_path);
        }
        $proyek->delete();
        return redirect()->route('admin.proyek.index')->with('status', 'Proyek berhasil dihapus!');
    }

    public function show(Project $project)
    {
        $students = \App\Models\User::whereHas('role', fn($q) => $q->where('name', 'siswa'))
        ->where('status', 'active')
        ->where('id', '!=', auth()->id())
        ->orderBy('name')
        ->get();

        return view('siswa.proyek.show', compact('project', 'otherProjects', 'students'));
    }
}
