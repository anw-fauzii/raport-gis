<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatLogin;
use App\Models\Sekolah;
use App\Models\AnggotaKelas;
use App\Models\Kelas;
use App\Models\Pengumuman;
use App\Models\NilaiRapotK4;
use App\Models\NilaiRapotK3;
use App\Models\NilaiHafalan;
use App\Models\NilaiSholat;
use App\Models\NilaiT2Q;
use App\Models\CatatanT2Q;
use App\Models\NilaiK1;
use App\Models\NilaiK2;
use App\Models\NilaiK3;
use App\Models\NilaiK4;
use App\Models\User;
use App\Models\Tapel;
use App\Models\Guru;
use App\Models\Komentar;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Cache;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','revalidate']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = 'Dashboard';
        $sekolah = Sekolah::first();
        $tapel = Tapel::findorfail(5);
        $data_pengumuman = Pengumuman::all();
        $kelas = Kelas::where('tapel_id',$tapel->id)->count();
        $siswa = AnggotaKelas::where('tapel', $tapel->tahun_pelajaran)->count();
        $guru = Guru::all()->count();
        return view('home',compact('title','data_pengumuman','sekolah','tapel','kelas','siswa','guru'));
    }
    
    public function show(Request $request, $id)
    {
        $sekolah = Sekolah::first();
        $anggota_kelas = AnggotaKelas::findorfail($id);
        $des_ki1=NilaiK1::where('anggota_kelas_id', $id)->get();
        $des_ki2=NilaiK2::where('anggota_kelas_id', $id)->get();
        $des_ki3=NilaiK3::where('anggota_kelas_id', $id)->get();
        $des_ki4=NilaiK4::where('anggota_kelas_id', $id)->get();
        $nilai_ki3 = NilaiRapotK3::where('anggota_kelas_id', $id)->get();
        $nilai_ki4 = NilaiRapotK4::where('anggota_kelas_id', $id)->get();
        $nilai_hafalan = NilaiHafalan::where('anggota_kelas_id', $id)->first();
        $nilai_sholat = NilaiSholat::where('anggota_kelas_id', $id)->first();
        $nilai_t2q = NilaiT2Q::where('anggota_kelas_id', $id)->first();
        $catatan_t2q = CatatanT2Q::where('anggota_kelas_id', $id)->first();
        $title = 'Raport';
        $kelengkapan_raport = PDF::loadview('walikelas.raport.kelengkapanraport', 
        compact('des_ki1','des_ki2','des_ki3','des_ki4','title','nilai_hafalan','catatan_t2q','nilai_t2q','nilai_sholat', 'sekolah', 'anggota_kelas','nilai_ki3','nilai_ki4'))->setPaper('A4','potrait');
        return $kelengkapan_raport->stream('RAPORT ' . $anggota_kelas->siswa->nama_lengkap . ' (' . $anggota_kelas->kelas->nama_kelas . ').pdf');
    }
}
