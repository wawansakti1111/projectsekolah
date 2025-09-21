<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class KepsekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Method ini tidak kita gunakan lagi, arahkan ke halaman manajemen
        return redirect()->route('admin.manajemen.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kepsek.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        // Cari ID untuk peran 'kepsek'
        $role = Role::where('name', 'kepsek')->firstOrFail();

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
                     'role_id' => $role->id,
        ]);

        return redirect()->route('admin.manajemen.index')->with('status', 'Akun kepala sekolah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $kepsek)
    {
        return view('admin.kepsek.edit', compact('kepsek'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $kepsek)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($kepsek->id)],
                           'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore($kepsek->id)],
                           'password' => ['nullable', 'string', 'min:8'], // Password opsional saat update
        ]);

        $kepsek->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ]);

        // Hanya update password jika diisi
        if ($request->filled('password')) {
            $kepsek->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.manajemen.index')->with('status', 'Akun kepala sekolah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $kepsek)
    {
        $kepsek->delete();
        return redirect()->route('admin.manajemen.index')->with('status', 'Akun kepala sekolah berhasil dihapus!');
    }
}
