<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function index()
    {
        // Redirect ke halaman utama manajemen proyek
        return redirect()->route('admin.proyek.index');
    }

    public function create()
    {
        return view('admin.subject.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:subjects'],
        ]);

        Subject::create($request->only('name'));

        return redirect()->route('admin.proyek.index')->with('status', 'Mata pelajaran berhasil ditambahkan!');
    }

    public function show(Subject $subject)
    {
        // Tidak digunakan
    }

    public function edit(Subject $subject)
    {
        return view('admin.subject.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('subjects')->ignore($subject->id)],
        ]);

        $subject->update($request->only('name'));

        return redirect()->route('admin.proyek.index')->with('status', 'Mata pelajaran berhasil diperbarui!');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('admin.proyek.index')->with('status', 'Mata pelajaran berhasil dihapus!');
    }
}
