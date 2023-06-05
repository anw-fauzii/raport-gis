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
    return redirect()->route('login');
});

Auth::routes([
  'register' => false,
  'reset' => false,
  'verify' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('getCourse/{id}', function ($id) {
    $course = App\Models\Komentar::where('jenis',$id)->get();
    return response()->json($course);
});
Route::get('/pdf/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('show');
Route::get('/leger-nilai', [App\Http\Controllers\HomeController::class, 'leger'])->name('leger');
Route::get('/leger-nilai/{id}', [App\Http\Controllers\HomeController::class, 'legerShow'])->name('leger.show');
Route::get('/download/{id}', [App\Http\Controllers\HomeController::class, 'LegerDownload'])->name('leger.download');
Route::get('/interval-nilai', [App\Http\Controllers\IntervalController::class, 'index'])->name('interval');
Route::resource('/pengumuman',App\Http\Controllers\PengumumanController::class);
Route::resource('/sekolah',App\Http\Controllers\SekolahController::class);
Route::resource('/rencana-k1',App\Http\Controllers\RencanaNilaiK1Controller::class);
Route::resource('/rencana-k2',App\Http\Controllers\RencanaNilaiK2Controller::class);
Route::resource('/rencana-k3',App\Http\Controllers\RencanaNilaiK3Controller::class);
Route::resource('/rencana-k4',App\Http\Controllers\RencanaNilaiK4Controller::class);
Route::resource('/penilaian-k1',App\Http\Controllers\NilaiK1Controller::class);
Route::get('nilai-k1/eksport', [App\Http\Controllers\NilaiK1Controller::class,'eksport'])->name('nilai-k1.eksport');
Route::get('nilai-k3/eksport/{id}', [App\Http\Controllers\NilaiK3Controller::class,'eksport'])->name('nilai-k3.eksport');
Route::post('nilai-k3/import', [App\Http\Controllers\NilaiK3Controller::class,'import'])->name('nilai-k3.import');
Route::resource('/penilaian-k2',App\Http\Controllers\NilaiK2Controller::class);
Route::resource('/penilaian-k3',App\Http\Controllers\NilaiK3Controller::class);
Route::get('nilai-k4/eksport/{id}', [App\Http\Controllers\NilaiK4Controller::class,'eksport'])->name('nilai-k4.eksport');
Route::post('nilai-k4/import', [App\Http\Controllers\NilaiK4Controller::class,'import'])->name('nilai-k4.import');
Route::resource('/penilaian-k4',App\Http\Controllers\NilaiK4Controller::class);
Route::resource('/guru',App\Http\Controllers\GuruController::class);
Route::resource('/kkm',App\Http\Controllers\KkmController::class);
Route::post('kkm/import', [App\Http\Controllers\KkmController::class,'import'])->name('kkm.import');
Route::post('guru/import', [App\Http\Controllers\GuruController::class,'import'])->name('guru.import');
Route::resource('/siswa',App\Http\Controllers\SiswaController::class);
Route::resource('/kelas',App\Http\Controllers\KelasController::class);
Route::resource('/mapel',App\Http\Controllers\MapelController::class);
Route::resource('/tanggal-raport',App\Http\Controllers\TanggalRaportController::class);
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
Route::resource('/butir-sikap',App\Http\Controllers\ButirSikapController::class);
Route::post('butir-sikap/import', [App\Http\Controllers\ButirSikapController::class,'import'])->name('butir-sikap.import');
Route::resource('/kd-mapel',App\Http\Controllers\KdMapelController::class);
Route::post('kd-mapel/import', [App\Http\Controllers\KdMapelController::class,'import'])->name('kd-mapel.import');
Route::resource('/catatan-umum',App\Http\Controllers\CatatanUmumController::class);
Route::resource('/catatan-t2q',App\Http\Controllers\CatatanT2QController::class);

//Rencana Prima
Route::resource('/rencana-responsible',App\Http\Controllers\RencanaPrima\RencanaResponsibleController::class);
Route::resource('/rencana-proactive',App\Http\Controllers\RencanaPrima\RencanaProactiveController::class);
Route::resource('/rencana-innovative',App\Http\Controllers\RencanaPrima\RencanaInnovativeController::class);
Route::resource('/rencana-modest',App\Http\Controllers\RencanaPrima\RencanaModestController::class);
Route::resource('/rencana-achievement',App\Http\Controllers\RencanaPrima\RencanaAchievementController::class);

//Nilai Prima
Route::resource('/penilaian-responsible',App\Http\Controllers\NilaiPrima\NilaiResponsibleController::class);
Route::resource('/penilaian-proactive',App\Http\Controllers\NilaiPrima\NilaiProactiveController::class);
Route::resource('/penilaian-innovative',App\Http\Controllers\NilaiPrima\NilaiInnovativeController::class);
Route::resource('/penilaian-modest',App\Http\Controllers\NilaiPrima\NilaiModestController::class);
Route::resource('/penilaian-achievement',App\Http\Controllers\NilaiPrima\NilaiAchievementController::class);

//Mulok
Route::resource('/rencana-mulok',App\Http\Controllers\RencanaMulokController::class);
Route::resource('/penilaian-mulok',App\Http\Controllers\NilaiMulokController::class);
Route::get('mulok/eksport/{id}', [App\Http\Controllers\NilaiMulokController::class,'eksport'])->name('mulok.eksport');
Route::post('mulok/import', [App\Http\Controllers\NilaiMulokController::class,'import'])->name('mulok.import');

Route::resource('/rencana-pelajaran-sholat',App\Http\Controllers\RencanaPelajaranSholatController::class);
Route::resource('/penilaian-sholat',App\Http\Controllers\NilaiSholatController::class);
Route::resource('/penilaian-hafalan',App\Http\Controllers\NilaiHafalanController::class);
Route::resource('/penilaian-t2q',App\Http\Controllers\NilaiT2QController::class);
Route::resource('/penilaian-tahsin',App\Http\Controllers\NilaiTahsinController::class);

Route::get('data-siswa', [App\Http\Controllers\SiswaKelasController::class,'wali'])->name('data-siswa-wali');
Route::get('detail-siswa/{id}', [App\Http\Controllers\SiswaKelasController::class,'detail'])->name('detail-siswa');

Route::resource('/rencana-kokulikuler',App\Http\Controllers\RencanaKokulikulerController::class);
Route::resource('/penilaian-kokulikuler',App\Http\Controllers\NilaiKokulikulerController::class);
Route::get('nilai-kokulikuler/eksport/{id}', [App\Http\Controllers\NilaiKokulikulerController::class,'eksport'])->name('kokulikuler.eksport');
Route::post('nilai-kokulikuler/import', [App\Http\Controllers\NilaiKokulikulerController::class,'import'])->name('kokulikuler.import');

Route::resource('/ekstrakulikuler',App\Http\Controllers\EkstrakulikulerController::class);
Route::post('ekstrakulikuler/anggota', [App\Http\Controllers\AnggotaEkstrakulikulerController::class,'store_anggota'])->name('ekstrakulikuler.anggota');
Route::delete('ekstrakulikuler/anggota/{id}', [App\Http\Controllers\AnggotaEkstrakulikulerController::class,'delete_anggota'])->name('ekstrakulikuler.anggota.delete');

Route::resource('/penilaian-pramuka',App\Http\Controllers\NilaiPramukaController::class);
Route::resource('/penilaian-ekstrakulikuler',App\Http\Controllers\NilaiEkstrakulikulerController::class);

Route::resource('/kenaikan-siswa',App\Http\Controllers\KenaikanSiswaController::class);

Route::resource('/user',App\Http\Controllers\UserController::class);
Route::get('user-reset/{id}', [App\Http\Controllers\UserController::class,'reset'])->name('user-reset');
Route::get('user-aktivasi/{id}', [App\Http\Controllers\UserController::class,'aktivasi'])->name('user-aktivasi');

//Optimize
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Clear Config cleared</h1>';
});
Route::get('/foo', function () {
    Artisan::call('vendor:publish --tag=flare-config');
    return '<h1>Clear Config cleared</h1>';
});