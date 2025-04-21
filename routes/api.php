<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminProfile;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PengumumanController;
use App\Http\Controllers\Api\KeluhanController;


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

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    // Route::get('/profile', [AdminProfile::class, 'show']);
    // Route::put('/profile', [AdminProfile::class, 'update']);
    // Route::post('/logout', [AdminProfile::class, 'logout']);

});

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/pengumuman', [pengumumanController::class, 'show']);
//     Route::put('/pengumuman', [pengumumanController::class, 'update']);

// });

Route::get('/pengumuman', [\App\Http\Controllers\Api\AuthController::class, 'pengumuman']);
Route::get('/departemen', [\App\Http\Controllers\Api\AuthController::class, 'departemen']);
Route::get('user/keluhan', [\App\Http\Controllers\Api\AuthController::class, 'keluhan']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});
