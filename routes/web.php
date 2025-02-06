<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('backend')->name('backend.')->middleware('auth')->group(function () {
    Route::resource('pengumuman', App\Http\Controllers\PengumumanController::class);
});
Route::prefix('backend')->name('backend.')->middleware('auth')->group(function () {
    Route::resource('kategori', App\Http\Controllers\KategoriController::class);
});
Route::prefix('backend')->name('backend.')->middleware('auth')->group(function () {
    Route::resource('departemen', App\Http\Controllers\DepartemenController::class);
});
Route::prefix('backend')->name('backend.')->middleware('auth')->group(function () {
    Route::resource('priority', App\Http\Controllers\PriorityControllers::class);
});
Route::prefix('backend')->name('backend.')->middleware('auth')->group(function () {
    Route::resource('keluhan', App\Http\Controllers\KeluhanController::class);
});



