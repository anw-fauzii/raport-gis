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
use Illuminate\Support\Facades\Crypt;

class SiswaKelasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','revalidate']);
    }

    public function wali(){
        if(Auth::user()->hasRole('wali')){
            $title = 'Data Siswa';
            $tapel = Tapel::latest()->first();
            $guru = Guru::where('user_id', Auth::user()->id)->first();
            $kelas = Kelas::where('tapel_id', $tapel->id)->where('guru_id', $guru->id)->first();
            if($kelas){
                $data_siswa = AnggotaKelas::where('kelas_id',$kelas->id)->get();
                return view('walikelas.siswa.index', compact('title', 'data_siswa'));
            }else{
                return back()->with('warning', 'Belum Ada Kelas Yang Dibuat');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    public function detail($id){
        if(Auth::user()->hasAnyRole('wali|t2q|mapel|admin')){
            $decrypted = Crypt::decrypt($id);
            $siswa = Siswa::findOrFail($decrypted);
            $title = 'Detail Siswa';
            return view('walikelas.siswa.show', compact('title', 'siswa'));
        }
    }
    
}
