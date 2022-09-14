<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Tapel;
use App\Models\Guru;
use App\Models\User;
use App\Models\AnggotaKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaKelasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','revalidate']);
    }

    public function wali(){
        if(Auth::user()->hasRole('wali')){
            $title = 'Data Siswa';
            $tapel = Tapel::findorfail(5);
            $guru = Guru::where('user_id', Auth::user()->id)->first();
            $kelas = Kelas::where('guru_id', $guru->id)->first();
            $data_siswa = Siswa::where('kelas_id',$kelas->id)->orderBy('nis', 'ASC')->get();
            return view('walikelas.siswa.index', compact('title', 'data_siswa'));
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    public function detail($id){
        if(Auth::user()->hasAnyRole('wali|t2q|mapel|admin')){
            $siswa = Siswa::findOrFail($id);
            $title = 'Detail Siswa';
            return view('walikelas.siswa.show', compact('title', 'siswa'));
        }
    }
    
}
