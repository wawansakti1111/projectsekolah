<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Project;       // Ditambahkan untuk statistik Proyek
use App\Models\Sdg;           // Ditambahkan untuk statistik SDG
use App\Models\Kelas;         // Ditambahkan untuk statistik Kelas
use App\Models\Subject;       // Ditambahkan untuk statistik Mata Pelajaran
use App\Models\LmsMaterial;   // Ditambahkan untuk statistik LMS
use App\Models\Quiz;          // Ditambahkan untuk statistik Kuis
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Carbon\Carbon;            // Ditambahkan untuk manipulasi tanggal Proyek

class KepsekController extends Controller
{
    /**
     * Menampilkan dashboard utama untuk Kepala Sekolah dengan ringkasan data.
     */
    public function index()
    {
        // Mendapatkan tanggal hari ini
        $today = Carbon::now()->toDateString();
        
        // --- 1. Ambil Data Total ---

        // Total Siswa (Asumsi: role name 'siswa')
        $totalSiswa = User::whereHas('role', function ($query) {
            $query->where('name', 'siswa');
        })->count();
        
        // Total Guru (Asumsi: role name 'guru')
        $totalGuru = User::whereHas('role', function ($query) {
            $query->where('name', 'guru');
        })->count();
        
        // Total Proyek Keseluruhan
        $totalProyekKeseluruhan = Project::count(); 
        
        // Proyek Berjalan (deadline HARI INI atau MASIH DI MASA DEPAN)
        $totalProyekBerjalan = Project::where('deadline', '>=', $today)->count();
        
        // Proyek Selesai (deadline sudah LEWAT)
        $totalProyekSelesai = Project::where('deadline', '<', $today)->count();
        
        // Ambil total data lain
        $totalSdg = Sdg::count(); 
        $totalKelas = Kelas::count(); 
        $totalMapel = Subject::count(); 
        $totalLms = LmsMaterial::count(); 
        $totalQuiz = Quiz::count(); 
        
        // --- 2. Kumpulkan Data ---
        $totalCounts = [
            'Siswa' => $totalSiswa,
            'Guru' => $totalGuru,
            'Proyek Berjalan' => $totalProyekBerjalan, 
            'Proyek Selesai' => $totalProyekSelesai,   
            'Total Proyek' => $totalProyekKeseluruhan, 
            'SDG' => $totalSdg,
            'Kelas' => $totalKelas,
            'Mata Pelajaran' => $totalMapel,
            'Materi LMS' => $totalLms,
            'Kuis' => $totalQuiz,
        ];

        // --- 3. Kirim data ke view dashboard kepsek ---
        // Kita alihkan ke view 'admin.kepsek.dashboard' yang kita bahas sebelumnya
        return view('admin.kepsek.dashboard', compact('totalCounts'));
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