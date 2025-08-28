<?php

namespace App\Http\Controllers;

use App\Models\ImageCategory;
use Illuminate\Http\Request;

class ImageCategoryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:image_categories',
        ]);

        ImageCategory::create($request->only('name'));

        return back()->with('success', 'Categoría de imagen creada correctamente.')->withFragment('gallery');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImageCategory $imageCategory)
    {
        return view('admin.image_categories.edit', compact('imageCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImageCategory $imageCategory)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:image_categories,name,' . $imageCategory->id],
        ]);

        $imageCategory->update($request->only('name'));

        return back()->with('success', 'Categoría de imagen actualizada correctamente.')->withFragment('gallery');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImageCategory $imageCategory)
    {
        $imageCategory->delete();

        return back()->with('success', 'Categoría de imagen eliminada correctamente.')->withFragment('gallery');
    }
}