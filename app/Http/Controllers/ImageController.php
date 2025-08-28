<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use App\Models\ImageCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image_category_id' => 'required|exists:image_categories,id',
            'image' => 'required|image|max:5120', // Max 5MB
        ]);

        $path = $request->file('image')->store('gallery_images', 'public');

        GalleryImage::create([
            'title' => $request->title,
            'image_category_id' => $request->image_category_id,
            'file_path' => $path,
        ]);

        return back()->with('success', 'Imagen subida con éxito.')->withFragment('gallery');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GalleryImage $galleryImage)
    {
        $imageCategories = ImageCategory::all();
        return view('admin.gallery.edit', compact('galleryImage', 'imageCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GalleryImage $galleryImage)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image_category_id' => 'required|exists:image_categories,id',
        ]);

        $galleryImage->update($request->only('title', 'image_category_id'));

        return redirect()->route('admin.dashboard')->with('success', 'Imagen actualizada con éxito.')->withFragment('gallery');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalleryImage $galleryImage)
    {
        // Delete the file from storage
        if (Storage::disk('public')->exists($galleryImage->file_path)) {
            Storage::disk('public')->delete($galleryImage->file_path);
        }

        $galleryImage->delete();

        return back()->with('success', 'Imagen eliminada con éxito.')->withFragment('gallery');
    }
}