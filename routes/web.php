<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TetrisController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('site');
});
Route::get('/tetris', [TetrisController::class, 'index']);
Route::post('/tetris/score', [TetrisController::class, 'store'])->name('tetris.store');
Route::get('/dash', function () {
    return view('dash');
});
Route::get('/ray', function () {
    return view('ray');
});

Route::get('/presentation', function () {
    return view('presentation');
});