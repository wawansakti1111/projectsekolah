<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class GuruController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.manajemen.index');
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $role = Role::where('name', 'guru')->firstOrFail();

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
                     'role_id' => $role->id,
        ]);

        return redirect()->route('admin.manajemen.index')->with('status', 'Akun guru berhasil ditambahkan!');
    }

    public function edit(User $guru)
    {
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, User $guru)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($guru->id)],
                           'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore($guru->id)],
                           'password' => ['nullable', 'string', 'min:8'],
        ]);

        $guru->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $guru->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.manajemen.index')->with('status', 'Akun guru berhasil diperbarui!');
    }

    public function destroy(User $guru)
    {
        $guru->delete();
        return redirect()->route('admin.manajemen.index')->with('status', 'Akun guru berhasil dihapus!');
    }
}
