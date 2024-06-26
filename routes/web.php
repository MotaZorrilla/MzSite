<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/tetris', function () {
    return view('tetris');
});
Route::get('/dash', function () {
    return view('dash');
});
Route::get('/ray', function () {
    return view('ray');
});
