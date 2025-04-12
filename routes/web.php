<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Session;


Route::get('/', action: function () {
    return view('userhome');
});


// 🔹 ROUTE UNTUK MENAMPILKAN PENGUMUMAN DI USER
Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
Route::get('/pengumuman/{id}', [PengumumanController::class, 'show'])->name('detail_pengumuman');
Route::get('/departemen', [departemenController::class, 'index'])->name('departemen.index');
Route::get('/departemen/{id}', [departemenController::class, 'show'])->name('detail_departemen');
Route::get('/keluhan', [KeluhanController::class, 'index'])->name('user.keluhan.index');          // Halaman daftar keluhan
Route::get('/keluhan/create', [KeluhanController::class, 'create'])->name('user.keluhan.create'); // Form tambah keluhan
Route::get('/user/keluhan/{id}/edit', [KeluhanController::class, 'edit'])->name('user.keluhan.edit');
Route::put('/user/keluhan/{id}', [KeluhanController::class, 'update'])->name('user.keluhan.update');
Route::delete('/user/keluhan/{id}', [KeluhanController::class, 'destroy'])->name('user.keluhan.destroy');
Route::get('/keluhan/{id}', [KeluhanController::class, 'show'])->name('user.keluhan.show');       // Halaman detail keluhan
Route::post('/keluhan/{id}/status', [KeluhanController::class, 'updateStatus'])->name('backend.keluhan.updateStatus');
Route::post('/keluhan/{id}/like', [KeluhanController::class, 'like'])->name('keluhan.like');
Route::post('/keluhan/{id}/dislike', [KeluhanController::class, 'dislike'])->name('keluhan.dislike');
// Route untuk Notifikasi (Dapat diakses oleh pengguna yang sudah login)
// Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifikasi');
// Route::get('/notifikasi/sukses', [NotificationController::class, 'sukses']);
// Route::get('/notifikasi/gagal', [NotificationController::class, 'gagal']);
Route::get('/notification', function () {
    Session::flash('notification', 'Ini adalah pesan notifikasi!');
    return redirect('/notification');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('backend')->name('backend.')->middleware('auth')->group(function () {
    Route::resource('pengumuman', App\Http\Controllers\PengumumanController::class);
    Route::resource('kategori', App\Http\Controllers\KategoriController::class);
    Route::resource('departemen', App\Http\Controllers\DepartemenController::class);
    Route::resource('priority', App\Http\Controllers\PriorityControllers::class);
    Route::resource('keluhan', App\Http\Controllers\KeluhanController::class);
    Route::post('/keluhan/{id}/update-status', [KeluhanController::class, 'updateStatus'])->name('keluhan.updateStatus');

    // Route untuk menyimpan tanggapan dari admin langsung di halaman index keluhan
    Route::post('/keluhan/tanggapan', [App\Http\Controllers\KeluhanController::class, 'addTanggapan'])
        ->name('keluhan.tanggapan.store');
});



// Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
//     Route::resource('keluhanuser', App\Http\Controllers\KeluhanController::class)->nama('keluhanuser');
// });




