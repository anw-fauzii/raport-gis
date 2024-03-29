<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatLogin;
use App\Models\Sekolah;
use App\Models\AnggotaKelas;
use App\Models\Kelas;
use App\Models\Pengumuman;
use App\Models\Pembelajaran;
use App\Models\NilaiRapotK4;
use App\Models\NilaiRapotK3;
use App\Models\NilaiRapotKokulikuler;
use App\Models\NilaiHafalan;
use App\Models\NilaiSholat;
use App\Models\NilaiT2Q;
use App\Models\NilaiTahfidz;
use App\Models\CatatanT2Q;
use App\Models\CatatanUmum;
use App\Models\NilaiK1;
use App\Models\NilaiK2;
use App\Models\NilaiK3;
use App\Models\NilaiK4;
use App\Models\NilaiKokulikuler;
use App\Models\NilaiPrima\NilaiProactive;
use App\Models\NilaiPrima\NilaiInnovative;
use App\Models\NilaiPrima\NilaiModest;
use App\Models\NilaiPrima\NilaiResponsible;
use App\Models\NilaiPrima\NilaiAchievement;
use App\Models\User;
use App\Models\Tapel;
use App\Models\NilaiRapotMulok;
use App\Models\NilaiMulok;
use App\Models\Guru;
use App\Models\Komentar;
use App\Models\Kehadiran;
use App\Models\NilaiPramuka;
use App\Models\Ekstrakulikuler;
use App\Models\NilaiEkstrakulikuler;
use App\Models\AnggotaEkstrakulikuler;
use App\Exports\LegerExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Cache;
use PDF;
use Excel;

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
        $tapel = Tapel::latest()->first();
        $data_pengumuman = Pengumuman::all();
        $kelas = Kelas::where('tapel_id',$tapel->id)->count();
        $siswa = AnggotaKelas::where('tapel_id', $tapel->id)->count();
        $guru = Guru::all()->count();
        return view('home',compact('title','data_pengumuman','sekolah','tapel','kelas','siswa','guru'));
    }
    
    public function show(Request $request, $id)
    {
        $tapel = Tapel::latest()->first();
        $decrypted = Crypt::decrypt($id);
        $sekolah = Sekolah::first();
        $guru = Guru::where('user_id', Auth::user()->id)->first();
        $kelas = Kelas::where('tapel_id', $tapel->id)->where('guru_id', $guru->id)->orWhere('pendamping_id', $guru->id)->first();
        $anggota_kelas = AnggotaKelas::findorfail($decrypted);
        $des_ki1=NilaiK1::where('anggota_kelas_id', $decrypted)->get();
        $des_ki2=NilaiK2::where('anggota_kelas_id', $decrypted)->get();
        $des_ki3=NilaiK3::join('rencana_nilai_k3','rencana_nilai_k3.id','=','nilai_k3.rencana_nilai_k3_id')->where('anggota_kelas_id', $decrypted)->get();
        $des_ki4=NilaiK4::join('rencana_nilai_k4','rencana_nilai_k4.id','=','nilai_k4.rencana_nilai_k4_id')->where('anggota_kelas_id', $decrypted)->get();
        $des_kokulikuler=NilaiKokulikuler::join('rencana_kokulikuler','rencana_kokulikuler.id','=','nilai_kokulikuler.rencana_kokulikuler_id')->where('anggota_kelas_id', $decrypted)->get();
        $des_mulok=NilaiMulok::join('rencana_mulok','rencana_mulok.id','=','nilai_mulok.rencana_mulok_id')->where('anggota_kelas_id', $decrypted)->get();
        $proactive=NilaiProactive::where('anggota_kelas_id', $decrypted)->get();
        $responsible=NilaiResponsible::where('anggota_kelas_id', $decrypted)->get();
        $innovative=NilaiInnovative::where('anggota_kelas_id', $decrypted)->get();
        $modest=NilaiModest::where('anggota_kelas_id', $decrypted)->get();
        $achievement=NilaiAchievement::where('anggota_kelas_id', $decrypted)->get();
        $nilai_ki3 = NilaiRapotK3::where('anggota_kelas_id', $decrypted)->join('pembelajaran','pembelajaran.id','=','nilai_rapot_k3.pembelajaran_id')->orderBy('mapel_id', 'ASC')->get();
        $nilai_ki4 = NilaiRapotK4::where('anggota_kelas_id', $decrypted)->join('pembelajaran','pembelajaran.id','=','nilai_rapot_k4.pembelajaran_id')->orderBy('mapel_id', 'ASC')->get();
        $nilai_mulok = NilaiRapotMulok::where('anggota_kelas_id', $decrypted)->get();
        if($kelas->tingkatan_kelas == 3){
        $nilai_kokulikuler = NilaiRapotKokulikuler::where('anggota_kelas_id', $decrypted)->get();
        }
        else{
            $nilai_kokulikuler = NilaiRapotKokulikuler::where('anggota_kelas_id', $decrypted)->join('pembelajaran','pembelajaran.id','=','nilai_rapot_kokulikuler.pembelajaran_id')->orderBy('mapel_id', 'ASC')->get();
        }
        $nilai_hafalan = NilaiHafalan::where('anggota_kelas_id', $decrypted)->first();
        $nilai_sholat = NilaiSholat::where('anggota_kelas_id', $decrypted)->first();
        $nilai_t2q = NilaiT2Q::where('anggota_kelas_id', $decrypted)->first();
        $nilai_tahfidz = NilaiTahfidz::where('anggota_kelas_id', $decrypted)->first();
        $catatan_t2q = CatatanT2Q::where('anggota_kelas_id', $decrypted)->first();
        $catatan_umum = CatatanUmum::where('anggota_kelas_id', $decrypted)->first();
        $kehadiran = Kehadiran::where('anggota_kelas_id', $decrypted)->first();
        $pramuka = NilaiPramuka::where('anggota_kelas_id', $decrypted)->first();

        $data_id_ekstrakulikuler = Ekstrakulikuler::where('tapel_id', $tapel->id)->get('id');
        $ekstrakulikuler = AnggotaEkstrakulikuler::whereIn('ekstrakulikuler_id', $data_id_ekstrakulikuler)->where('anggota_kelas_id', $decrypted)->get();
            foreach ($ekstrakulikuler as $anggota) {
                $cek_nilai_ekstra = NilaiEkstrakulikuler::where('anggota_ekstrakulikuler_id', $anggota->id)->first();
                if (is_null($cek_nilai_ekstra)) {
                    $anggota->nilai = null;
                    $anggota->deskripsi = null;
                } else {
                    $anggota->nilai = $cek_nilai_ekstra->nilai;
                    $anggota->deskripsi = $cek_nilai_ekstra->deskripsi;
                }
            }
        $title = 'Raport';
        
        if($kelas->tingkatan_kelas == 2){
                 $kelengkapan_raport = PDF::loadview('walikelas.raport.kelas2', 
        compact('guru','des_ki1','des_ki2','des_ki3','des_ki4','des_mulok','des_kokulikuler',
        'proactive','responsible','innovative','modest','achievement','pramuka','ekstrakulikuler',
        'title','nilai_hafalan','nilai_tahfidz','catatan_t2q','catatan_umum','kehadiran','nilai_t2q','nilai_sholat', 'sekolah',
        'anggota_kelas','nilai_ki3','nilai_ki4','nilai_mulok','nilai_kokulikuler','tapel'))->setPaper('A4','potrait');   
        }else if($kelas->tingkatan_kelas == 3){
                    $kelengkapan_raport = PDF::loadview('walikelas.raport.kelas3', 
        compact('guru','des_ki1','des_ki2','des_ki3','des_ki4','des_mulok','des_kokulikuler',
        'proactive','responsible','innovative','modest','achievement','pramuka','ekstrakulikuler',
        'title','nilai_hafalan','nilai_tahfidz','catatan_t2q','catatan_umum','kehadiran','nilai_t2q','nilai_sholat', 'sekolah',
        'anggota_kelas','nilai_ki3','nilai_ki4','nilai_mulok','nilai_kokulikuler','tapel'))->setPaper('A4','potrait');
        }else if($kelas->tingkatan_kelas == 6){
                    $kelengkapan_raport = PDF::loadview('walikelas.raport.kelas6', 
        compact('guru','des_ki1','des_ki2','des_ki3','des_ki4','des_mulok','des_kokulikuler',
        'proactive','responsible','innovative','modest','achievement','pramuka','ekstrakulikuler',
        'title','nilai_hafalan','nilai_tahfidz','catatan_t2q','catatan_umum','kehadiran','nilai_t2q','nilai_sholat', 'sekolah',
        'anggota_kelas','nilai_ki3','nilai_ki4','nilai_mulok','nilai_kokulikuler','tapel'))->setPaper('A4','potrait');
        }else if($kelas->tingkatan_kelas == 5){
                    $kelengkapan_raport = PDF::loadview('walikelas.raport.kelas5', 
        compact('guru','des_ki1','des_ki2','des_ki3','des_ki4','des_mulok','des_kokulikuler',
        'proactive','responsible','innovative','modest','achievement','pramuka','ekstrakulikuler',
        'title','nilai_hafalan','nilai_tahfidz','catatan_t2q','catatan_umum','kehadiran','nilai_t2q','nilai_sholat', 'sekolah',
        'anggota_kelas','nilai_ki3','nilai_ki4','nilai_mulok','nilai_kokulikuler','tapel'))->setPaper('A4','potrait');
        }else{
            $kelengkapan_raport = PDF::loadview('walikelas.raport.kelas5', 
        compact('guru','des_ki1','des_ki2','des_ki3','des_ki4','des_mulok','des_kokulikuler',
        'proactive','responsible','innovative','modest','achievement','pramuka','ekstrakulikuler',
        'title','nilai_hafalan','nilai_tahfidz','catatan_t2q','catatan_umum','kehadiran','nilai_t2q','nilai_sholat', 'sekolah',
        'anggota_kelas','nilai_ki3','nilai_ki4','nilai_mulok','nilai_kokulikuler','tapel'))->setPaper('A4','potrait');
        }
        return $kelengkapan_raport->stream('RAPORT ' . $anggota_kelas->kelas->nama_kelas . '_' . $anggota_kelas->siswa->nama_lengkap . '.pdf');
    }

    public function leger()
    {
        $tapel = Tapel::latest()->first();
        $title = 'Leger Nilai Siswa '.$tapel->tahun_pelajaran.'-'.$tapel->semester;
        return $this->isiLeger($tapel,$title);
    }

    public function legerShow($id)
    {
        $tapel = Tapel::findorfail($id);
        $title = 'Leger Nilai Siswa '.$tapel->tahun_pelajaran.'-'.$tapel->semester;
        return $this->isiLeger($tapel,$title);
    }

    public function legerDownload($id)
    {
        if(Auth::user()->hasRole('wali')){
            $tapel = Tapel::findorfail($id);
            $filename = 'Leger Nilai Siswa.xlsx';
            return Excel::download(new LegerExport($id), $filename);
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
        
        return $this->isiLeger($tapel,$title);
    }

    public function isiLeger($tapel,$title)
    {
        $guru = Guru::where('user_id', Auth::user()->id)->first();
        $id_kelas_diampu = Kelas::where('tapel_id', $tapel->id)->where('guru_id', $guru->id)->get('id');
        $data_id_pembelajaran = Pembelajaran::whereIn('kelas_id', $id_kelas_diampu)->get('id');
        $mapel_k3 = Pembelajaran::select('kategori_mapel_id','pembelajaran.*')->join('mapel','pembelajaran.mapel_id','=','mapel.id')->where('kategori_mapel_id',3)->whereIn('kelas_id', $id_kelas_diampu)->where('status', 1)->orderBy('mapel_id', 'ASC')->orderBy('kelas_id', 'ASC')->get();
        $mapel_kokulikuler = Pembelajaran::select('kategori_mapel_id','pembelajaran.*')->join('mapel','pembelajaran.mapel_id','=','mapel.id')->where('kategori_mapel_id',5)->whereIn('kelas_id', $id_kelas_diampu)->where('status', 1)->orderBy('mapel_id', 'ASC')->orderBy('kelas_id', 'ASC')->get();
        $mapel_mulok = Pembelajaran::select('kategori_mapel_id','pembelajaran.*')->join('mapel','pembelajaran.mapel_id','=','mapel.id')->where('kategori_mapel_id',6)->whereIn('kelas_id', $id_kelas_diampu)->where('status', 1)->orderBy('mapel_id', 'ASC')->orderBy('kelas_id', 'ASC')->get();
        $data_anggota_kelas = AnggotaKelas::whereIn('kelas_id', $id_kelas_diampu)->get();
        foreach ($data_anggota_kelas as $anggota_kelas) {
            $data_nilai_ki_1 = NilaiK1::where('anggota_kelas_id', $anggota_kelas->id)->avg('nilai');
            $anggota_kelas->data_nilai_ki_1 = round($data_nilai_ki_1, 1);
            $data_nilai_ki_2 = NilaiK2::where('anggota_kelas_id', $anggota_kelas->id)->avg('nilai');
            $anggota_kelas->data_nilai_ki_2 = round($data_nilai_ki_2, 1);
            $data_nilai_ki_3 = NilaiRapotK3::where('anggota_kelas_id', $anggota_kelas->id)->get();
            $anggota_kelas->data_nilai_ki_3 = $data_nilai_ki_3;
            $data_nilai_ki_4 = NilaiRapotK4::where('anggota_kelas_id', $anggota_kelas->id)->get();
            $anggota_kelas->data_nilai_ki_4 = $data_nilai_ki_4;
            $data_nilai_pramuka = NilaiPramuka::where('anggota_kelas_id', $anggota_kelas->id)->first();
            $anggota_kelas->data_nilai_pramuka = $data_nilai_pramuka;
            $data_nilai_sholat = NilaiSholat::where('anggota_kelas_id', $anggota_kelas->id)->first();
            $anggota_kelas->data_nilai_sholat = $data_nilai_sholat;
            $data_nilai_t2q = NilaiT2Q::where('anggota_kelas_id', $anggota_kelas->id)->first();
            $anggota_kelas->data_nilai_t2q = $data_nilai_t2q;
            $data_nilai_tahfidz = NilaiTahfidz::where('anggota_kelas_id', $anggota_kelas->id)->first();
            $anggota_kelas->data_nilai_tahfidz = $data_nilai_tahfidz;
            $data_nilai_ekskul = NilaiEkstrakulikuler::join('anggota_ekstrakulikuler','nilai_ekstrakulikuler.anggota_ekstrakulikuler_id','=','anggota_ekstrakulikuler.id')->where('anggota_kelas_id', $anggota_kelas->id)->first();
            $anggota_kelas->data_nilai_ekskul = $data_nilai_ekskul;
            $data_nilai_hafalan = NilaiHafalan::where('anggota_kelas_id', $anggota_kelas->id)->first();
            $anggota_kelas->data_nilai_hafalan = $data_nilai_hafalan;
            $data_nilai_kokulikuler = NilaiRapotKokulikuler::where('anggota_kelas_id', $anggota_kelas->id)->get();
            $anggota_kelas->data_nilai_kokulikuler = $data_nilai_kokulikuler;
            $data_nilai_mulok = NilaiRapotMulok::where('anggota_kelas_id', $anggota_kelas->id)->get();
            $anggota_kelas->data_nilai_mulok = $data_nilai_mulok;
            $data_nilai_proactive = NilaiProactive::where('anggota_kelas_id', $anggota_kelas->id)->avg('nilai');
            $anggota_kelas->data_nilai_proactive = round($data_nilai_proactive, 1);
            $data_nilai_responsible = NilaiResponsible::where('anggota_kelas_id', $anggota_kelas->id)->avg('nilai');
            $anggota_kelas->data_nilai_responsible = round($data_nilai_responsible, 1);
            $data_nilai_innovative = NilaiInnovative::where('anggota_kelas_id', $anggota_kelas->id)->avg('nilai');
            $anggota_kelas->data_nilai_innovative = round($data_nilai_innovative, 1);
            $data_nilai_modest = NilaiModest::where('anggota_kelas_id', $anggota_kelas->id)->avg('nilai');
            $anggota_kelas->data_nilai_modest = round($data_nilai_modest, 1);
            $data_nilai_achievement = NilaiAchievement::where('anggota_kelas_id', $anggota_kelas->id)->avg('nilai');
            $anggota_kelas->data_nilai_achievement = round($data_nilai_achievement, 1);
            $kehadiran = Kehadiran::where('anggota_kelas_id', $anggota_kelas->id)->first();
            $anggota_kelas->kehadiran = $kehadiran;
            $catatan_wali = CatatanUmum::where('anggota_kelas_id', $anggota_kelas->id)->first();
            $anggota_kelas->catatan_wali = $catatan_wali;
            $catatan_t2q = CatatanT2Q::where('anggota_kelas_id', $anggota_kelas->id)->first();
            $anggota_kelas->catatan_t2q = $catatan_t2q;
            $anggota_kelas->jumlah_nilai = $data_nilai_ki_3->sum('nilai_raport') + $data_nilai_ki_4->sum('nilai_raport') + $data_nilai_kokulikuler->sum('nilai_raport') + $data_nilai_mulok->sum('nilai_raport');
        }
        if($mapel_k3->count() != 0 && $mapel_kokulikuler->count() != 0 && $mapel_mulok->count() != 0){
           return view('walikelas.raport.leger',compact('title','data_anggota_kelas','mapel_k3','mapel_kokulikuler','mapel_mulok','tapel')); 
        }else{
            return back()->with('warning', 'Belum ada data pembelajaran silahkan hubungi administrator');
        }
    }
}
