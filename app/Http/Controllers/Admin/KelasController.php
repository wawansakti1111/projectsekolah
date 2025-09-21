<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Menampilkan daftar semua kelas.
     */
    /**
     * Mengarahkan ke halaman manajemen utama.
     */
    public function index()
    {
        // Langsung arahkan ke halaman manajemen yang baru
        return redirect()->route('admin.manajemen.index');
    }

    /**
     * Menampilkan form untuk membuat kelas baru.
     */
    public function create()
    {
        $gurus = User::whereHas('role', function ($query) {
            $query->where('name', 'guru');
        })->get();

        return view('admin.kelas.create', compact('gurus'));
    }

    /**
     * Menyimpan kelas baru ke dalam database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:classes'],
            'user_id' => ['nullable', 'exists:users,id'],
        ]);

        Kelas::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
        ]);

        // Arahkan kembali ke halaman manajemen yang benar
        return redirect()->route('admin.manajemen.index')->with('status', 'Kelas berhasil ditambahkan!');
    }
    /**
     * Display the specified resource.
     * (Akan kita gunakan nanti)
     */
    public function show(Kelas $kela)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * (Akan kita gunakan nanti)
     */
    // ... (di dalam KelasController)

    public function edit(Kelas $kela) // Laravel akan otomatis mencari kelas berdasarkan ID
    {
        $gurus = User::whereHas('role', function ($query) {
            $query->where('name', 'guru');
        })->get();

        return view('admin.kelas.edit', [
            'kelas' => $kela,
            'gurus' => $gurus
        ]);
    }
    /**
     * Update the specified resource in storage.
     * (Akan kita gunakan nanti)
     */
    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', \Illuminate\Validation\Rule::unique('classes')->ignore($kela->id)],
                           'user_id' => ['nullable', 'exists:users,id'],
        ]);

        $kela->update([
            'name' => $request->name,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('admin.manajemen.index')->with('status', 'Kelas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * (Akan kita gunakan nanti)
     */
    public function destroy(Kelas $kela)
    {
        $kela->delete();

        return redirect()->route('admin.manajemen.index')->with('status', 'Kelas berhasil dihapus!');
    }

}
