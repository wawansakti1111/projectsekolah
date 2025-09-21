<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectEnrollment;
use App\Models\LmsMaterial;
use App\Models\LmsContent;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Ambil data proyek aktif (tetap sama)
        $activeProjects = ProjectEnrollment::where('user_id', $user->id)
            ->whereNotIn('status', ['graded', 'rejected', 'pending'])
            ->with('project.teacher')
            ->latest('updated_at')
            ->take(3)
            ->get();

        // Ambil data untuk grafik (tetap sama)
        $selectedMonth = $request->input('month', Carbon::now()->month);
        $selectedYear = $request->input('year', Carbon::now()->year);
        $daysInMonth = Carbon::createFromDate($selectedYear, $selectedMonth, 1)->daysInMonth;
        $dailyProjects = ProjectEnrollment::where('user_id', $user->id)
            ->where('status', 'graded')
            ->whereYear('updated_at', $selectedYear)
            ->whereMonth('updated_at', $selectedMonth)
            ->selectRaw('DATE(updated_at) as date, count(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date');
        $labels = [];
        $data = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = Carbon::createFromDate($selectedYear, $selectedMonth, $i)->format('Y-m-d');
            $labels[] = $i;
            $data[] = $dailyProjects[$date] ?? 0;
        }
        $monthsList = [];
        for ($i = 0; $i < 6; $i++) {
            $monthsList[] = [
                'month' => Carbon::now()->subMonths($i)->month,
                'year' => Carbon::now()->subMonths($i)->year,
                'name' => Carbon::now()->subMonths($i)->format('F Y')
            ];
        }

        // ▼▼▼ PERBARUI KODE UNTUK MENGHITUNG PROGRES LMS ▼▼▼
        $userLmsProgress = LmsMaterial::withCount('contents')
            ->whereHas('contents.progress', function ($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->where('is_completed', false);
            })
            ->get()
            ->map(function ($material) use ($user) {
                $completedCount = $user->lmsCompletions()->whereIn('lms_content_id', $material->contents->pluck('id'))->count();
                $totalCount = $material->contents_count;

                $percentage = $totalCount > 0 ? ($completedCount / $totalCount) * 100 : 0;

                return (object) [
                    'id' => $material->id,
                    'title' => $material->title,
                    'percentage' => round($percentage),
                    'completed_count' => $completedCount,
                    'total_count' => $totalCount,
                ];
            });

        return view('siswa.dashboard', compact('user', 'activeProjects', 'labels', 'data', 'monthsList', 'selectedMonth', 'selectedYear', 'userLmsProgress'));
    }
}
