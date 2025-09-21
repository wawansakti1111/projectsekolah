<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.manajemen.index');
    }

    public function create()
    {
        $kelas = Kelas::orderBy('name')->get();
        return view('admin.siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'class_id' => ['nullable', 'exists:classes,id'],
        ]);

        $role = Role::where('name', 'siswa')->firstOrFail();

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
                     'role_id' => $role->id,
                     'class_id' => $request->class_id,
        ]);

        return redirect()->route('admin.manajemen.index')->with('status', 'Akun siswa berhasil ditambahkan!');
    }

    public function edit(User $siswa)
    {
        $kelas = Kelas::orderBy('name')->get();
        return view('admin.siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, User $siswa)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($siswa->id)],
                           'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore($siswa->id)],
                           'password' => ['nullable', 'string', 'min:8'],
                           'class_id' => ['nullable', 'exists:classes,id'],
        ]);

        $siswa->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'class_id' => $request->class_id,
        ]);

        if ($request->filled('password')) {
            $siswa->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.manajemen.index')->with('status', 'Akun siswa berhasil diperbarui!');
    }

    public function destroy(User $siswa)
    {
        $siswa->delete();
        return redirect()->route('admin.manajemen.index')->with('status', 'Akun siswa berhasil dihapus!');
    }
    public function resetAllKelas()
    {
        // Cari ID untuk peran 'siswa'
        $role = Role::where('name', 'siswa')->firstOrFail();

        // Update semua user dengan peran siswa, set class_id menjadi null
        User::where('role_id', $role->id)->update(['class_id' => null]);

        return redirect()->route('admin.manajemen.index')->with('status', 'Kelas untuk semua siswa berhasil di-reset!');
    }
    public function toggleStatus(User $user) // <-- UBAH $siswa MENJADI $user
    {
        $newStatus = $user->status === 'active' ? 'inactive' : 'active';
        $user->update(['status' => $newStatus]);

        return redirect()->back()->with('status', 'Status siswa berhasil diubah.');
    }

}
