<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatLogin;
use App\Models\Sekolah;
use App\Models\AnggotaKelas;
use App\Models\Kelas;
use App\Models\Pengumuman;
use App\Models\NilaiRapotK3;
use App\Models\User;
use App\Models\Tapel;
use App\Models\Guru;
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
        $nilai_k3 = NilaiRapotK3::where('anggota_kelas_id', $id)->get();
        $title = 'Raport';
        $kelengkapan_raport = PDF::loadview('walikelas.raport.kelengkapanraport', compact('title', 'sekolah', 'anggota_kelas','nilai_k3'))->setPaper('A4','potrait');
        return $kelengkapan_raport->stream('RAPORT ' . $anggota_kelas->siswa->nama_lengkap . ' (' . $anggota_kelas->kelas->nama_kelas . ').pdf');
    }
}
