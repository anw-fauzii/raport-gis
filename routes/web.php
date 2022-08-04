<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/pengumuman',App\Http\Controllers\PengumumanController::class);
Route::resource('/sekolah',App\Http\Controllers\SekolahController::class);
Route::resource('/guru',App\Http\Controllers\GuruController::class);
Route::post('guru/import', [App\Http\Controllers\GuruController::class,'import'])->name('guru.import');
Route::resource('/siswa',App\Http\Controllers\SiswaController::class);
Route::resource('/kelas',App\Http\Controllers\KelasController::class);
Route::resource('/mapel',App\Http\Controllers\MapelController::class);
Route::post('mapel/import', [App\Http\Controllers\MapelController::class,'import'])->name('mapel.import');
Route::resource('/pembelajaran',App\Http\Controllers\PembelajaranController::class);
Route::resource('/t2q',App\Http\Controllers\Anggotat2qController::class);
Route::resource('/kehadiran',App\Http\Controllers\KehadiranController::class);
Route::post('kelas/anggota', [App\Http\Controllers\AnggotaKelasController::class,'store_anggota'])->name('kelas.anggota');
Route::delete('kelas/anggota/{id}', [App\Http\Controllers\AnggotaKelasController::class,'delete_anggota'])->name('kelas.anggota.delete');
Route::resource('/tahun-pelajaran',App\Http\Controllers\TapelController::class);
Route::post('siswa/import', [App\Http\Controllers\SiswaController::class,'import'])->name('siswa.import');
Route::post('siswa/registrasi', [App\Http\Controllers\SiswaController::class,'registrasi'])->name('siswa.registrasi');
Route::post('pembelajaran/setting', [App\Http\Controllers\PembelajaranController::class,'setting'])->name('pembelajaran.setting');