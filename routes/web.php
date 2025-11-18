<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KunjunganController;

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
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

// Halaman Mulai Kunjungan Baru
Route::get('/kunjungan/create', function () {
    return view('kunjungan.create');
})->name('kunjungan.create');

Route::get('/produk/ditawarkan', function () {
    return view('kunjungan.opsi');
})->name('kunjungan.opsi');

Route::get('/produk/kamera', function () {
    return view('kunjungan.kamera');
})->name('kunjungan.kamera');

// Halaman Riwayat Kunjungan
Route::get('/riwayat-kunjungan', function () {
    return view('kunjungan.riwayat');
})->name('riwayat.kunjungan');

Route::get('/peta', function () {
    return view('peta.index');
})->name('peta.index');

Route::get('/pengaturan', function () {
    return view('pengaturan');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/profil/edit', function () {
    return view('profiledit');  // pastikan file bernama profiledit.blade.php
})->name('profil.edit');



Route::get('/kunjungan/{id}', [KunjunganController::class, 'show'])->name('kunjungan.show');
