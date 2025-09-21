<?php
namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\ProjectEnrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function approve(ProjectEnrollment $enrollment)
    {
        // Pastikan guru hanya bisa menyetujui pendaftaran di proyek miliknya
        if ($enrollment->project->user_id !== auth()->id()) {
            abort(403);
        }
        $enrollment->update(['status' => 'approved']);
        return redirect()->back()->with('status', 'Pendaftaran berhasil disetujui.');
    }

    public function reject(ProjectEnrollment $enrollment)
    {
        if ($enrollment->project->user_id !== auth()->id()) {
            abort(403);
        }
        $enrollment->update(['status' => 'rejected']);
        return redirect()->back()->with('status', 'Pendaftaran berhasil ditolak.');
    }
    public function destroy(ProjectEnrollment $enrollment)
    {
        // Pastikan guru hanya bisa menghapus pendaftaran di proyek miliknya
        if ($enrollment->project->user_id !== auth()->id()) {
            abort(403);
        }

        $enrollment->delete();

        return redirect()->back()->with('status', 'Pendaftaran yang ditolak berhasil dihapus. Siswa dapat mendaftar ulang.');
    }

}

