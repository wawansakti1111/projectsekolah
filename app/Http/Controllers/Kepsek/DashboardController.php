<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Kelas;
use App\Models\Sdg;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // === STATISTIK PENGGUNA & PROYEK DASAR ===
        $totalSiswa = User::whereHas('role', fn ($q) => $q->where('name', 'siswa'))->count();
        $totalGuru = User::whereHas('role', fn ($q) => $q->where('name', 'guru'))->count();
        $totalProyek = Project::count();

        // === PROYEK TERBARU ===
        $latestProjects = Project::with(['teacher', 'sdgs'])
            ->latest()
            ->take(5)
            ->get();

        // === KELAS TERAKTIF ===
        $activeClasses = DB::table('classes as sc')
            ->join('users as u', 'sc.id', '=', 'u.class_id')
            ->join('project_enrollments as pe', 'u.id', '=', 'pe.user_id')
            ->join('project_submissions as ps', 'pe.id', '=', 'ps.project_enrollment_id')
            ->select('sc.name', DB::raw('COUNT(ps.id) as submission_count'))
            ->groupBy('sc.id', 'sc.name')
            ->orderByDesc('submission_count')
            ->take(5)
            ->get();

        // === SKOR RATA-RATA SDG PER KELAS ===
        $classSdgScores = DB::table('classes as sc')
            ->join('users as u', 'sc.id', '=', 'u.class_id')
            ->join('project_enrollments as pe', 'u.id', '=', 'pe.user_id')
            ->join('project_grades as pg', 'pe.id', '=', 'pg.project_enrollment_id')
            ->select('sc.name', DB::raw('AVG(pg.score) as average_score'))
            ->whereNotNull('pg.score')
            ->groupBy('sc.id', 'sc.name')
            ->orderByDesc('average_score')
            ->take(5)
            ->get();

        // === ANALITIK PENYELESAIAN PROYEK ===
        $proyekSelesai = Project::where('deadline', '<', now())->count();
        $proyekBerjalan = $totalProyek - $proyekSelesai;
        $completionPercentage = ($totalProyek > 0) ? round(($proyekSelesai / $totalProyek) * 100) : 0;
        $projectStatusData = [$proyekSelesai, $proyekBerjalan];

        // === WARNA RESMI SDG MENURUT PBB ===
        $officialSdgColors = [
            1 => '#E5243B', 2 => '#DDA63A', 3 => '#4C9F38',
            4 => '#C5192D', 5 => '#FF3A21', 6 => '#26BDE2',
            7 => '#FCC30B', 8 => '#A21942', 9 => '#FD6925',
            10 => '#DD1367', 11 => '#FD9D24', 12 => '#BF8B2E',
            13 => '#3F7E44', 14 => '#0A97D9', 15 => '#56C02B',
            16 => '#00689D', 17 => '#19486A',
        ];

        // === DATA UNTUK GRAFIK BATANG PROYEK PER SDG ===
        // Pastikan semua SDG diurutkan berdasarkan ID (1-17)
        $sdgProjectCounts = Sdg::withCount('projects')->orderBy('id')->get();

        $sdgChartLabels = $sdgProjectCounts->pluck('name');
        $sdgChartData = $sdgProjectCounts->pluck('projects_count');
        $sdgColors = $sdgProjectCounts->map(fn ($sdg) => $officialSdgColors[$sdg->id] ?? '#6B7280')->toArray();

        // Ikon SDG (untuk card)
        $sdgIcons = [
            1 => 'home', 2 => 'academic-cap', 3 => 'heart', 4 => 'academic-cap', 5 => 'user-group',
            6 => 'beaker', 7 => 'bolt', 8 => 'briefcase', 9 => 'cpu-chip', 10 => 'scale',
            11 => 'building-office-2', 12 => 'recycle', 13 => 'cloud', 14 => 'water',
            15 => 'tree', 16 => 'shield-check', 17 => 'globe-alt'
        ];

        return view('kepsek.dashboard', compact(
            'totalSiswa', 'totalGuru', 'totalProyek', 'proyekBerjalan', 'latestProjects',
            'activeClasses', 'classSdgScores', 'completionPercentage', 'projectStatusData',
            'sdgChartLabels', 'sdgChartData', 'sdgColors', 'sdgProjectCounts', 'sdgIcons',
            'officialSdgColors' // kirim juga untuk keperluan card di view
        ));
    }
}