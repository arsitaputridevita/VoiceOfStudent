<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::group(['prefix' => 'admin', 'middleware' => ['auth', IsAdmin::class]], function () {
//     // Dashboard Admin
//     Route::get('/', function () {
//         return view('admin.index');
//     });

// Semua resource dalam prefix "backend"
Route::prefix('backend')->name('backend.')->group(function () {
    Route::resource('pengumuman', App\Http\Controllers\PengumumanController::class);
    Route::resource('kategori', App\Http\Controllers\KategoriController::class);
    Route::resource('departemen', App\Http\Controllers\DepartemenController::class);
    Route::resource('priority', App\Http\Controllers\PriorityControllers::class);
    Route::resource('keluhan', App\Http\Controllers\KeluhanController::class);
});
