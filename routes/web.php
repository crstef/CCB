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
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ContactController;

// Gallery routes
Route::get('/galerie-foto', [GalleryController::class, 'photoGallery'])->name('galerie-foto');
Route::get('/galerie-video', [GalleryController::class, 'videoGallery'])->name('galerie-video');

// Documents route
Route::get('/documente', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/documente/{document}', [DocumentController::class, 'show'])->name('documents.show');

// Contact routes handled by Folio
// Route::get('/contact', function () {
//     return view('contact');
// })->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Pagini statice pentru meniuri și footer - ÎNAINTE de Wave routes
Route::view('/misiunea', 'themes.anchor.pages.misiunea')->name('page.misiunea');
Route::view('/rescue', 'themes.anchor.pages.rescue')->name('page.rescue');
Route::view('/despre-noi', 'themes.anchor.pages.despre-noi')->name('page.despre-noi');

// Wave routes
Wave::routes();
