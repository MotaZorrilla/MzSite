<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TetrisController;
use App\Http\Controllers\PlumberController;
use App\Http\Controllers\ProfileController; // Aunque no se use, lo mantenemos por si acaso

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Ruta principal del portafolio
Route::get('/', function () {
    return view('site');
});

// Rutas de juegos estáticos
Route::get('/dash', function () {
    return view('dash');
});

Route::get('/ray', function () {
    return view('ray');
});

Route::get('/finance', function () {
    return view('finance');
});

// Rutas para Tetris (con su controlador)
Route::get('/tetris', [TetrisController::class, 'index']);
Route::post('/tetris/score', [TetrisController::class, 'store']);

// Rutas para Plumber (con su controlador)
Route::get('/plumber', [PlumberController::class, 'index']);
Route::post('/plumber/score', [PlumberController::class, 'store']);

