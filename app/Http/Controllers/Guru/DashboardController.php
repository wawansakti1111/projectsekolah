<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\ProjectSubmission; // Tambahkan ini

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
            ->withCount(['submissions as new_submissions_count' => function ($query) {
                $query->where('status', 'submitted'); // Menghitung hanya pengajuan yang belum dinilai
            }])
            ->get();

        return view('guru.dashboard', compact('activeProjects'));
    }
}
