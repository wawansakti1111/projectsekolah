<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\ProjectEnrollment; // Gunakan model ini

class DashboardController extends Controller
{
    /**
     * Tampilkan dasbor guru.
     */
    public function index()
    {
        $user = Auth::user();

        // Mengambil proyek yang dibuat oleh guru, dengan jumlah pendaftaran dan pengajuan baru
        $activeProjects = Project::where('user_id', $user->id)
            ->withCount('enrollments')
            // Ubah relasi untuk menghitung pengajuan baru
            ->withCount(['enrollments as new_submissions_count' => function ($query) {
                // Bergabung (join) dengan tabel submissions
                $query->whereHas('submissions', function ($subQuery) {
                    $subQuery->where('status', 'submitted');
                });
            }])
            ->get();

        return view('guru.dashboard', compact('activeProjects'));
    }
}