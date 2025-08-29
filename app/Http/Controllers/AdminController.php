<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Degree;
use App\Models\MasonicWork;
use App\Models\DocumentCategory;
use App\Models\GalleryImage;
use App\Models\ImageCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with all users and degrees.
     */
    public function index()
    {
        return $this->documents();
    }

    /**
     * Display the documents management page.
     */
    public function documents()
    {
        $degrees = Degree::orderBy('id')->get();
        $documentCategories = DocumentCategory::orderBy('name')->get();
        return view('admin.documents', compact('degrees', 'documentCategories'));
    }

    /**
     * Display the gallery management page.
     */
    public function gallery()
    {
        $imageCategories = ImageCategory::orderBy('name')->get();
        return view('admin.gallery', compact('imageCategories'));
    }

    /**
     * Display the users management page.
     */
    public function users()
    {
        $degrees = Degree::orderBy('id')->get();
        return view('admin.users', compact('degrees'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', Rule::in(['usuario', 'administrador'])],
            'degree_id' => ['nullable', 'required_if:role,usuario', 'exists:degrees,id'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'degree_id' => $request->role === 'usuario' ? $request->degree_id : null,
        ]);

        return back()->with('success', 'Usuario creado correctamente.')->withFragment('users');
    }

    /**
     * Update the specified user in storage.
     */
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'string', Rule::in(['usuario', 'administrador'])],
            'degree_id' => ['nullable', 'required_if:role,usuario', 'exists:degrees,id'],
        ]);

        $user->role = $request->role;
        $user->degree_id = $request->input('degree_id');
        $user->save();

        return back()->with('success', 'Usuario actualizado correctamente.')->withFragment('users');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroyUser(User $user)
    {
        // Optional: Add policy check to prevent deleting oneself or other admins.
        // For now, we will just delete the user.
        $user->delete();

        return back()->with('success', 'Usuario eliminado correctamente.')->withFragment('users');
    }
}
