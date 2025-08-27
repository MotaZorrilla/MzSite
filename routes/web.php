<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\MasonicWork;
use App\Http\Controllers\MasonicWorkController;

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

Route::get('/masonry', function () {
    $works = MasonicWork::all();
    return view('masonry', compact('works'));
})->name('masonry.index');

Route::post('/masonry', [MasonicWorkController::class, 'store'])->name('masonry.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route for image uploads
    Route::post('/images', [App\Http\Controllers\ImageController::class, 'storeGalleryImage'])->name('images.store');
});

require __DIR__.'/auth.php';
