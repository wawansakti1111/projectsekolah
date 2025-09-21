<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sdg;
use Illuminate\Http\Request;

class SdgController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.proyek.index');
    }

    public function create()
    {
        return view('admin.sdg.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        Sdg::create($request->all());

        return redirect()->route('admin.proyek.index')->with('status', 'Data SDG berhasil ditambahkan!');
    }

    public function show(Sdg $sdg)
    {
        // Tidak digunakan
    }

    public function edit(Sdg $sdg)
    {
        return view('admin.sdg.edit', compact('sdg'));
    }

    public function update(Request $request, Sdg $sdg)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $sdg->update($request->all());

        return redirect()->route('admin.proyek.index')->with('status', 'Data SDG berhasil diperbarui!');
    }

    public function destroy(Sdg $sdg)
    {
        $sdg->delete();
        return redirect()->route('admin.proyek.index')->with('status', 'Data SDG berhasil dihapus!');
    }
}
