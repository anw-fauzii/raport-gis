<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatLogin;
use App\Models\Sekolah;
use App\Models\Pengumuman;
use App\Models\User;
use App\Models\Tapel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        $jumlah_guru = "0";
        $jumlah_siswa = "0";
        $jumlah_kelas = "0";
        $jumlah_ekstrakulikuler = "0";
        $data_riwayat_login = User::all();
        return view('home',compact('title',
        'data_pengumuman',
        'data_riwayat_login',
        'sekolah',
        'tapel','jumlah_guru',
        'jumlah_siswa',
        'jumlah_kelas',
        'jumlah_ekstrakulikuler'));
    }
}
