<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\DocumentCategory;
use App\Models\MasonicWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MasonicWorkController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'required_degree' => 'required|integer|min:0|max:33',
            'document_category_id' => 'required|exists:document_categories,id',
            'file' => 'required|file|mimes:pdf|max:20480', // 20MB Max
        ]);

        $path = $request->file('file')->store('masonic_works', 'local');

        MasonicWork::create([
            'title' => $request->title,
            'description' => $request->description,
            'required_degree' => $request->required_degree,
            'document_category_id' => $request->document_category_id,
            'file_path' => $path,
            'is_public' => $request->required_degree == 0,
        ]);

        return back()->with('success', 'Documento subido con éxito.')->withFragment('documents');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasonicWork $work)
    {
        $degrees = Degree::all();
        $documentCategories = DocumentCategory::all();
        return view('admin.masonic_works.edit', compact('work', 'degrees', 'documentCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasonicWork $work)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'required_degree' => 'required|integer|min:0|max:33',
            'document_category_id' => 'required|exists:document_categories,id',
        ]);

        $work->update($request->only('title', 'description', 'required_degree', 'document_category_id'));
        
        // Update is_public flag based on degree
        $work->is_public = $request->required_degree == 0;
        $work->save();

        return redirect()->route('admin.dashboard')->with('success', 'Documento actualizado con éxito.')->withFragment('documents');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasonicWork $work)
    {
        // Delete the file from storage
        if (Storage::disk('local')->exists($work->file_path)) {
            Storage::disk('local')->delete($work->file_path);
        }

        $work->delete();

        return back()->with('success', 'Documento eliminado con éxito.')->withFragment('documents');
    }
}