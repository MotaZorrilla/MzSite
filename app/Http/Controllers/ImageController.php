<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function storeGalleryImage(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:5120', // Max 5MB
            'category' => 'required|string|max:255',
        ]);

        $path = $request->file('image')->store('gallery_images', 'public');

        // TODO: Create a GalleryImage model and save metadata to database
        // GalleryImage::create([
        //     'title' => $request->title,
        //     'file_path' => $path,
        //     'category' => $request->category,
        // ]);

        return back()->with('success', 'Imagen subida con éxito.');
    }
}
