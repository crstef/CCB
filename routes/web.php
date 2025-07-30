<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Wave\Facades\Wave;
use App\Http\Controllers\GalleryController;

// Gallery routes
Route::get('/galerie-foto', [GalleryController::class, 'photoGallery'])->name('galerie-foto');
Route::get('/galerie-video', [GalleryController::class, 'videoGallery'])->name('galerie-video');

// Wave routes
Wave::routes();
