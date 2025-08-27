<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MasonicWork; // Importar el modelo
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        // $works = MasonicWork::all(); // Comentado temporalmente para evitar errores
        return view('admin.dashboard', compact('users'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'degree' => 'required|integer|in:1,2,3',
            'role' => 'required|string|in:usuario,administrador',
        ]);

        $user->degree = $request->degree;
        $user->role = $request->role;

        // Si se asigna como administrador, el grado por defecto es Maestro (3)
        if ($user->role == 'administrador') {
            $user->degree = 3;
        }

        $user->save();

        return back()->with('success', 'Usuario actualizado correctamente.');
    }
}
