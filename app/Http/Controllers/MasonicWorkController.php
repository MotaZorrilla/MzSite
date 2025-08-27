<?php

namespace App\Http\Controllers;

use App\Models\MasonicWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MasonicWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $works = MasonicWork::orderBy('created_at', 'desc')->get();
        return view('masonry', ['works' => $works]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf|max:10240', // PDF de hasta 10MB
            'is_public' => 'nullable|boolean',
        ]);

        $path = $request->file('file')->store('masonic_works', 'local');

        MasonicWork::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
            'is_public' => $request->has('is_public'),
            'required_degree' => $request->required_degree,
        ]);

        return back()->with('success', 'Trabajo subido con éxito.');
    }

    /**
     * Handle a download request for a masonic work.
     */
    public function download(MasonicWork $work)
    {
        // A futur, afegir la lògica d'autorització aquí
        // if (!$work->is_public) {
        //     $this->authorize('view', $work);
        // }

        return Storage::disk('local')->download($work->file_path, $work->title . '.pdf');
    }
}