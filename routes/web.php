<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\DokumenLainnyaController;

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

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::get('/profil', [ProfilController::class, 'index'])->middleware('auth');
Route::resource('/user', UserController::class)->middleware('auth');
Route::get('/surat-masuk/checkSlug', [SuratMasukController::class, 'checkSlug'])->middleware('auth');
Route::resource('/surat-masuk', SuratMasukController::class)->middleware('auth');
Route::resource('/lainnya', DokumenLainnyaController::class)->middleware('auth');
Route::resource('/surat-keluar', SuratKeluarController::class)->middleware('auth');
Route::get('/surat-keluar/{id}/print', [SuratKeluarController::class, 'print']);
Route::resource('/agenda', TaskController::class)->middleware('auth');
Route::resource('/absensi', AbsensiController::class)->middleware('auth');
Route::get('/absensi/{id}/print', [AbsensiController::class, 'print']);
Route::resource('/tasks', TaskController::class)->middleware('auth');
Route::resource('/pengajuan', PengajuanController::class)->middleware('auth');
Route::get('/arsip', [ArsipController::class, 'index'])->middleware('auth');
Route::get('/surat-keluar/tambah/{id}', [SuratKeluarController::class, 'tambah'])->middleware('auth');
Route::post('/surat-keluar/tambah', [SuratKeluarController::class, 'simpan'])->middleware('auth');
Route::resource('/riwayat', RiwayatController::class)->middleware('auth');
