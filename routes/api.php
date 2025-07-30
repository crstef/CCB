<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return auth()->user();
});

Wave::api();

// Posts Example API Route
Route::middleware('auth:api')->group(function () {
    Route::get('/posts', [\App\Http\Controllers\Api\ApiController::class, 'posts']);
});

// Media API Routes - Public access for frontend display
Route::prefix('media')->group(function () {
    Route::get('/carousel', [\App\Http\Controllers\Api\MediaApiController::class, 'carousel']);
    Route::get('/photos', [\App\Http\Controllers\Api\MediaApiController::class, 'photos']);
    Route::get('/videos', [\App\Http\Controllers\Api\MediaApiController::class, 'videos']);
    Route::get('/featured', [\App\Http\Controllers\Api\MediaApiController::class, 'featured']);
});
