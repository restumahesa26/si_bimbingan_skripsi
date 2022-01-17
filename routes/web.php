<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function(){
    return view('pages.home');
})->name('home');

Route::middleware(['auth'])
    ->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });

Route::middleware(['auth','admin'])
    ->group(function() {
        Route::get('/dashboard/filter-berdasarkan-bulan-', [DashboardController::class, 'filter_dashboard'])->name('filter-dashboard');

        Route::resource('data-mahasiswa', MahasiswaController::class);

        Route::resource('data-dosen', DosenController::class);

        Route::resource('data-admin', AdminController::class);

        Route::get('/monitoring-bimbingan', [BimbinganController::class, 'monitoring_bimbingan'])->name('bimbingan.monitoring-bimbingan');

        Route::get('/monitoring-bimbingan/detail/{id}', [BimbinganController::class, 'show_monitoring_bimbingan'])->name('bimbingan.show-monitoring-bimbingan');

        Route::get('/monitoring-bimbingan/detail/{id}/show', [BimbinganController::class, 'detail_monitoring_bimbingan'])->name('bimbingan.detail-monitoring-bimbingan');

        Route::get('/monitoring-bimbingan/detail/{id}/selesaikan-bimbingan', [BimbinganController::class, 'selesaikan_bimbingan'])->name('bimbingan.selesaikan-bimbingan');
    });

Route::middleware(['auth','dosen'])
    ->group(function() {
        Route::get('/show-konfirmasi-bimbingan', [BimbinganController::class, 'show_konfirmasi_persetujuan'])->name('bimbingan.show_konfirmasi_persetujuan');

        Route::put('/konfirmasi-bimbingan/{id}/{tipe}', [BimbinganController::class, 'konfirmasi_persetujuan'])->name('bimbingan.konfirmasi_persetujuan');

        Route::get('/bimbingan-mahasiswa', [BimbinganController::class, 'index_bimbingan'])->name('bimbingan.index_bimbingan');

        Route::get('/bimbingan-mahasiswa/detail/{id}', [BimbinganController::class, 'detail_bimbingan'])->name('bimbingan.detail_bimbingan');

        Route::put('/bimbingan-mahasiswa/detail/{id}/update-bimbingan', [BimbinganController::class, 'update_bimbingan'])->name('bimbingan.update_bimbingan');

        Route::get('/riwayat-bimbingan/dosen', [BimbinganController::class, 'riwayat_bimbingan_dosen'])->name('bimbingan.riwayat-bimbingan-dosen');
    });

Route::middleware(['auth','mahasiswa'])
    ->group(function() {
        Route::post('/set-bimbingan', [BimbinganController::class, 'set_pembimbing'])->name('bimbingan.set-pembimbing');

        Route::get('/pembimbing-utama/show', [BimbinganController::class, 'show_pembimbing_1'])->name('bimbingan.show_pembimbing_utama');

        Route::get('/pembimbing-pendamping/show', [BimbinganController::class, 'show_pembimbing_2'])->name('bimbingan.show_pembimbing_pendamping');

        Route::post('/pembimbing-utama/store', [BimbinganController::class, 'store_pembimbing_1'])->name('bimbingan.store_pembimbing_utama');

        Route::post('/pembimbing-pendamping/store', [BimbinganController::class, 'store_pembimbing_2'])->name('bimbingan.store_pembimbing_pendamping');

        Route::get('/riwayat-bimbingan/mahasiswa', [BimbinganController::class, 'riwayat_bimbingan'])->name('bimbingan.riwayat-bimbingan');

        Route::get('/riwayat-bimbingan/mahasiswa/detail-{id}', [BimbinganController::class, 'detail_riwayat_bimbingan'])->name('bimbingan.detail-riwayat-bimbingan');

        Route::get('/kartu-bimbingan', [BimbinganController::class, 'kartu_bimbingan'])->name('bimbingan.kartu-bimbingan');

        Route::get('/kartu-bimbingan/show/{dosen}', [BimbinganController::class, 'show_kartu_bimbingan'])->name('bimbingan.show-kartu-bimbingan');

        Route::get('/cetak-bimbingan/{dosen}', [BimbinganController::class, 'cetak_kartu'])->name('bimbingan.cetak-kartu-bimbingan');
    });

require __DIR__.'/auth.php';
