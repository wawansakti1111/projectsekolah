<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectRubric;
use App\Models\Sdg;
use App\Models\SdgRubric;
use Illuminate\Http\Request;
use App\Models\ProjectRubricItem;
use App\Models\SdgRubricItem;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException; // Pastikan use statement ini ada di atas

class RubricController extends Controller
{
    public function index()
    {
        $projectRubrics = ProjectRubric::whereHas('project', function ($query) {
            $query->where('user_id', auth()->id());
        })->with('project')->get();

        $sdgRubrics = SdgRubric::whereHas('project', function ($query) {
            $query->where('user_id', auth()->id());
        })->with(['project', 'sdg'])
        ->get()
        ->groupBy('project_id');

        return view('guru.rubrik.index', compact('projectRubrics', 'sdgRubrics'));
    }

    public function createProjectRubric()
    {
        $projects = Project::where('user_id', auth()->id())
        ->whereDoesntHave('projectRubric')
        ->orderBy('title')
        ->get();

        return view('guru.rubrik.proyek.create', compact('projects'));
    }

    public function storeProjectRubric(Request $request)
    {
        $validated = $request->validate([
            'project_id' => ['required', 'exists:projects,id', Rule::unique('project_rubrics', 'project_id')],
                                        'items' => ['required', 'array', 'min:1'],
                                        'items.*.name' => ['required', 'string', 'max:255'],
                                        'items.*.weight' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        // ▼▼▼ VALIDASI BOBOT 100% ▼▼▼
        $totalWeight = collect($validated['items'])->sum('weight');

        if ($totalWeight !== 100) {
            return redirect()->back()
            ->withInput() // Mengembalikan input lama ke form
            ->with('toast_error', 'Total bobot harus tepat 100%. Saat ini totalnya adalah ' . $totalWeight . '%.');
        }

        // ▲▲▲ VALIDASI SELESAI ▲▲▲

        $projectRubric = ProjectRubric::create(['project_id' => $validated['project_id']]);

        foreach ($validated['items'] as $item) {
            $projectRubric->items()->create($item);
        }

        return redirect()->route('guru.rubrik.index')->with('status', 'Rubrik proyek berhasil dibuat!');
    }

    public function editProjectRubric(ProjectRubric $rubric)
    {
        if ($rubric->project->user_id !== auth()->id()) {
            abort(403);
        }

        $projects = Project::where('user_id', auth()->id())->orderBy('title')->get();
        $rubric->load('items');

        return view('guru.rubrik.proyek.edit', compact('rubric', 'projects'));
    }

    public function updateProjectRubric(Request $request, ProjectRubric $rubric)
    {
        if ($rubric->project->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'project_id' => ['required', 'exists:projects,id', Rule::unique('project_rubrics', 'project_id')->ignore($rubric->id)],
                                        'items' => ['required', 'array', 'min:1'],
                                        'items.*.name' => ['required', 'string', 'max:255'],
                                        'items.*.weight' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        // ▼▼▼ VALIDASI BOBOT 100% ▼▼▼
        $totalWeight = collect($validated['items'])->sum('weight');

        if ($totalWeight !== 100) {
            return redirect()->back()
            ->withInput()
            ->with('toast_error', 'Total bobot harus tepat 100%. Saat ini totalnya adalah ' . $totalWeight . '%.');
        }
        // ▲▲▲ VALIDASI SELESAI ▲▲▲

        $rubric->update(['project_id' => $validated['project_id']]);

        $rubric->items()->delete();
        foreach ($validated['items'] as $item) {
            $rubric->items()->create($item);
        }

        return redirect()->route('guru.rubrik.index')->with('status', 'Rubrik proyek berhasil diperbarui!');
    }

    public function destroyProjectRubric(ProjectRubric $rubric)
    {
        if ($rubric->project->user_id !== auth()->id()) {
            abort(403);
        }

        $rubric->delete();

        return redirect()->route('guru.rubrik.index')->with('status', 'Rubrik proyek berhasil dihapus!');
    }


    // app/Http/Controllers/Guru/RubricController.php

    public function createSdgRubric()
    {
        $projects = Project::where('user_id', auth()->id())
        ->has('sdgs') // 1. Proyek harus punya kaitan SDG
        ->whereDoesntHave('sdgRubrics') // 2. DAN proyek belum pernah dibuatkan rubrik SDG sebelumnya
        ->with('sdgs')
        ->orderBy('title')
        ->get();

        return view('guru.rubrik.sdg.create', compact('projects'));
    }
    public function storeSdgRubric(Request $request)
    {
        $validated = $request->validate([
            'project_id' => ['required', 'exists:projects,id'],
            'sdgRubrics' => ['required', 'array', 'min:1'],
            'sdgRubrics.*.sdg_id' => ['required', 'exists:sdgs,id', Rule::unique('sdg_rubrics')->where(function ($query) use ($request) {
                return $query->where('project_id', $request->project_id);
            })],
            'sdgRubrics.*.items' => ['required', 'array', 'min:1'],
            'sdgRubrics.*.items.*.name' => ['required', 'string', 'max:255'],
            'sdgRubrics.*.items.*.weight' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        // ▼▼▼ VALIDASI BOBOT 100% PER SDG ▼▼▼
        foreach ($validated['sdgRubrics'] as $index => $sdgRubricData) {
            $totalWeight = collect($sdgRubricData['items'])->sum('weight');
            if ($totalWeight !== 100) {
                return redirect()->back()
                ->withInput()
                ->with('toast_error', 'Total bobot untuk SDG ' . ($index + 1) . ' harus tepat 100%. Saat ini totalnya: ' . $totalWeight . '%.');
            }
        }
        // ▲▲▲ VALIDASI SELESAI ▲▲▲

        foreach ($validated['sdgRubrics'] as $sdgRubricData) {
            $sdgRubric = SdgRubric::create([
                'project_id' => $validated['project_id'],
                'sdg_id' => $sdgRubricData['sdg_id'],
            ]);
            $sdgRubric->items()->createMany($sdgRubricData['items']);
        }

        return redirect()->route('guru.rubrik.index')->with('status', 'Rubrik SDG berhasil dibuat!');
    }


    public function editSdgRubric(Project $project)
    {
        // Otorisasi
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        $projects = Project::where('user_id', auth()->id())
        ->has('sdgs')->with('sdgs')->orderBy('title')->get();

        $project->load('sdgRubrics.items');

        return view('guru.rubrik.sdg.edit', [
            'projects' => $projects,
            'project' => $project,
            'sdgRubrics' => $project->sdgRubrics
        ]);
    }


    public function updateSdgRubric(Request $request, Project $project) // Asumsikan kita menggunakan update massal per proyek
    {
        // Otorisasi ...
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'sdgRubrics' => ['required', 'array', 'min:1'],
            'sdgRubrics.*.sdg_id' => ['required', 'exists:sdgs,id'],
            'sdgRubrics.*.items' => ['required', 'array', 'min:1'],
            'sdgRubrics.*.items.*.name' => ['required', 'string', 'max:255'],
            'sdgRubrics.*.items.*.weight' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        // ▼▼▼ VALIDASI BOBOT 100% PER SDG ▼▼▼
        foreach ($validated['sdgRubrics'] as $index => $sdgRubricData) {
            $totalWeight = collect($sdgRubricData['items'])->sum('weight');
            if ($totalWeight !== 100) {
                return redirect()->back()
                ->withInput()
                ->with('toast_error', 'Total bobot untuk SDG ' . ($index + 1) . ' harus tepat 100%. Saat ini totalnya: ' . $totalWeight . '%.');
            }
        }
        // ▲▲▲ VALIDASI SELESAI ▲▲▲

        // Logika "Delete and Recreate"
        $project->sdgRubrics()->delete();
        foreach ($validated['sdgRubrics'] as $sdgRubricData) {
            $sdgRubric = SdgRubric::create([
                'project_id' => $project->id,
                'sdg_id' => $sdgRubricData['sdg_id'],
            ]);
            $sdgRubric->items()->createMany($sdgRubricData['items']);
        }

        return redirect()->route('guru.rubrik.index')->with('status', 'Rubrik SDG berhasil diperbarui!');
    }

    public function destroySdgRubricsByProject(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        // Hapus semua SdgRubric yang terkait dengan project ini
        $project->sdgRubrics()->delete();

        return redirect()->route('guru.rubrik.index')->with('status', 'Semua rubrik SDG untuk proyek tersebut berhasil dihapus!');
    }


    public function destroySdgRubric(SdgRubric $rubric)
    {
        if ($rubric->project->user_id !== auth()->id()) {
            abort(403);
        }

        $rubric->delete();

        return redirect()->route('guru.rubrik.index')->with('status', 'Rubrik SDG berhasil dihapus!');
    }
}
