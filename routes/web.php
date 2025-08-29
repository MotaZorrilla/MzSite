<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TetrisController;
use App\Http\Controllers\PlumberController;
use App\Models\MasonicWork;
use App\Http\Controllers\MasonicWorkController;
use App\Http\Controllers\ImageController;

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

// Masonic Repository Routes
Route::get('/masonry', [MasonicWorkController::class, 'index'])->name('masonry.index');
Route::get('/masonry/works/{work}', [MasonicWorkController::class, 'show'])->name('masonic_works.show')->middleware('auth');
Route::get('/api/gallery-images', [MasonicWorkController::class, 'fetchMoreGalleryImages'])->name('gallery.fetch');

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

    // Admin Routes
    Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
        Route::get('documents', [App\Http\Controllers\AdminController::class, 'documents'])->name('documents');
        Route::get('gallery', [App\Http\Controllers\AdminController::class, 'gallery'])->name('gallery');
        Route::get('users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
        
        // User Management
        Route::post('/users', [App\Http\Controllers\AdminController::class, 'storeUser'])->name('users.store');
        Route::patch('/users/{user}', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}', [App\Http\Controllers\AdminController::class, 'destroyUser'])->name('users.destroy');

        // Document Management
        Route::post('/documents', [App\Http\Controllers\MasonicWorkController::class, 'store'])->name('documents.store');
        Route::patch('/documents/{work}', [App\Http\Controllers\MasonicWorkController::class, 'update'])->name('documents.update');
        Route::delete('/documents/{work}', [App\Http\Controllers\MasonicWorkController::class, 'destroy'])->name('documents.destroy');
        Route::get('/documents/{work}/edit', [App\Http\Controllers\MasonicWorkController::class, 'edit'])->name('documents.edit');
        Route::patch('/documents/{work}', [App\Http\Controllers\MasonicWorkController::class, 'update'])->name('documents.update');

        // Gallery Management
        Route::post('/gallery', [App\Http\Controllers\ImageController::class, 'store'])->name('gallery.store');
        Route::delete('/gallery/{galleryImage}', [App\Http\Controllers\ImageController::class, 'destroy'])->name('gallery.destroy');
        Route::get('/gallery/{galleryImage}/edit', [App\Http\Controllers\ImageController::class, 'edit'])->name('gallery.edit');
        Route::patch('/gallery/{galleryImage}', [App\Http\Controllers\ImageController::class, 'update'])->name('gallery.update');

        // Image Category Management
        Route::resource('image_categories', App\Http\Controllers\ImageCategoryController::class)->except(['show', 'create']);

        // Document Category Management
        Route::resource('document_categories', App\Http\Controllers\DocumentCategoryController::class)->except(['show', 'create']);
    });
});

require __DIR__.'/auth.php';
