<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kelas; // <-- Tambahkan ini
use Illuminate\Http\Request;


class ManajemenController extends Controller
{
    public function index()
    {
        // Ambil semua ID peran terlebih dahulu
        $roles = \App\Models\Role::whereIn('name', ['kepsek', 'guru', 'siswa'])->pluck('id', 'name');

        // Ambil data pengguna dengan pagination untuk setiap peran
        $kepseks = \App\Models\User::where('role_id', $roles['kepsek'] ?? 0)->latest()->paginate(5, ['*'], 'kepsek_page');
        $gurus = \App\Models\User::where('role_id', $roles['guru'] ?? 0)->latest()->paginate(5, ['*'], 'guru_page');
        $siswas = \App\Models\User::where('role_id', $roles['siswa'] ?? 0)->with('kelas')->latest()->paginate(5, ['*'], 'siswa_page');

        // Data kelas tetap sama, tidak perlu pagination
        $kelasList = \App\Models\Kelas::with('homeroomTeacher')->latest()->paginate(10, ['*'], 'kelas_page');
        return view('admin.manajemen.index', compact('kepseks', 'gurus', 'siswas', 'kelasList'));
    }
}
