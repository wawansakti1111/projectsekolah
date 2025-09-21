<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\LmsContent;

class LmsContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // app/Http/Controllers/Admin/LmsContentController.php

    public function store(Request $request)
    {

        $request->validate([
            'lms_material_id' => ['required', 'exists:lms_materials,id'],
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:file,video_link'],
            'attachment' => ['required_if:type,file', 'nullable', 'file', 'max:20480'],
            'path_or_url' => ['required_if:type,video_link', 'nullable', 'url'],
        ]);

        $pathOrUrl = '';
        if ($request->type === 'file') {
            $file = $request->file('attachment');
            $pathOrUrl = $file->store('lms_contents', 'public');
        } else {
            $pathOrUrl = $request->path_or_url;
        }

        LmsContent::create([
            'lms_material_id' => $request->lms_material_id,
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'path_or_url' => $pathOrUrl,
            // Logika untuk order_column bisa ditambahkan di sini jika perlu
        ]);

        return redirect()->back()->with('status', 'Konten baru berhasil ditambahkan!');
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
    public function edit(LmsContent $lmsContent)
    {
        return view('admin.lms.content.edit', ['content' => $lmsContent]);
    }

    public function update(Request $request, LmsContent $lmsContent)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $lmsContent->update($request->only('title', 'description'));

        return redirect()->route('admin.lms.show', $lmsContent->lms_material_id)
        ->with('status', 'Sub-konten berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(LmsContent $lmsContent)
    {
        // Simpan dulu ID materi induknya untuk redirect
        $materialId = $lmsContent->lms_material_id;

        // Hapus file dari storage jika tipenya file
        if ($lmsContent->type === 'file') {
            Storage::disk('public')->delete($lmsContent->path_or_url);
        }

        $lmsContent->delete();

        return redirect()->route('admin.lms.show', $materialId)
        ->with('status', 'Sub-konten berhasil dihapus!');
    }
    public function updateOrder(Request $request)
    {
        $request->validate([
            'content_ids' => ['required', 'array'],
        ]);

        foreach ($request->content_ids as $index => $contentId) {
            LmsContent::where('id', $contentId)->update(['order_column' => $index]);
        }

        return redirect()->back()->with('status', 'Urutan konten berhasil diperbarui!');
    }


}
