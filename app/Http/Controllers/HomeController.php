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
use App\Models\CatatanT2Q;
use App\Models\CatatanUmum;
use App\Models\NilaiK1;
use App\Models\NilaiK2;
use App\Models\NilaiK3;
use App\Models\NilaiK4;
use App\Models\NilaiKokulikuler;
use App\Models\NIlaiPrima\NilaiProactive;
use App\Models\NIlaiPrima\NilaiInnovative;
use App\Models\NIlaiPrima\NilaiModest;
use App\Models\NIlaiPrima\NilaiResponsible;
use App\Models\NIlaiPrima\NilaiAchievement;
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
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Cache;
use PDF;
use Dompdf\Options;

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
        $options = new Options();
        $options->set('enable_html5_parser', true);
        $options->set('chroot', 'path-to-test-html-files');

        $sekolah = Sekolah::first();
        $anggota_kelas = AnggotaKelas::findorfail($id);
        $des_ki1=NilaiK1::where('anggota_kelas_id', $id)->get();
        $des_ki2=NilaiK2::where('anggota_kelas_id', $id)->get();
        $des_ki3=NilaiK3::where('anggota_kelas_id', $id)->get();
        $des_ki4=NilaiK4::where('anggota_kelas_id', $id)->get();
        $des_kokulikuler=NilaiKokulikuler::where('anggota_kelas_id', $id)->get();
        $des_mulok=NilaiMulok::where('anggota_kelas_id', $id)->get();
        $proactive=NilaiProactive::where('anggota_kelas_id', $id)->get();
        $responsible=NilaiResponsible::where('anggota_kelas_id', $id)->get();
        $innovative=NilaiInnovative::where('anggota_kelas_id', $id)->get();
        $modest=NilaiModest::where('anggota_kelas_id', $id)->get();
        $achievement=NilaiAchievement::where('anggota_kelas_id', $id)->get();
        $nilai_ki3 = NilaiRapotK3::where('anggota_kelas_id', $id)->get();
        $nilai_ki4 = NilaiRapotK4::where('anggota_kelas_id', $id)->get();
        $nilai_mulok = NilaiRapotMulok::where('anggota_kelas_id', $id)->get();
        $nilai_kokulikuler = NilaiRapotKokulikuler::where('anggota_kelas_id', $id)->get();
        $nilai_hafalan = NilaiHafalan::where('anggota_kelas_id', $id)->first();
        $nilai_sholat = NilaiSholat::where('anggota_kelas_id', $id)->first();
        $nilai_t2q = NilaiT2Q::where('anggota_kelas_id', $id)->first();
        $catatan_t2q = CatatanT2Q::where('anggota_kelas_id', $id)->first();
        $catatan_umum = CatatanUmum::where('anggota_kelas_id', $id)->first();
        $kehadiran = Kehadiran::where('anggota_kelas_id', $id)->first();
        $pramuka = NilaiPramuka::where('anggota_kelas_id', $id)->first();

        $data_id_ekstrakulikuler = Ekstrakulikuler::where('tapel_id', 5)->get('id');
        $ekstrakulikuler = AnggotaEkstrakulikuler::whereIn('ekstrakulikuler_id', $data_id_ekstrakulikuler)->where('anggota_kelas_id', $id)->get();
            foreach ($ekstrakulikuler as $anggota) {
                $cek_nilai_ekstra = NilaiEkstrakulikuler::where('anggota_ekstrakulikuler_id', $anggota->id)->first();
                if (is_null($cek_nilai_ekstra)) {
                    $anggota->nilai = null;
                } else {
                    $anggota->nilai = $cek_nilai_ekstra->nilai;
                }
            }
        $title = 'Raport';
        $kelengkapan_raport = PDF::loadview('walikelas.raport.kelengkapanraport', 
        compact('des_ki1','des_ki2','des_ki3','des_ki4','des_mulok','des_kokulikuler',
        'proactive','responsible','innovative','modest','achievement','pramuka','ekstrakulikuler',
        'title','nilai_hafalan','catatan_t2q','catatan_umum','kehadiran','nilai_t2q','nilai_sholat', 'sekolah',
        'anggota_kelas','nilai_ki3','nilai_ki4','nilai_mulok','nilai_kokulikuler'))->setPaper('A4','potrait');
        return $kelengkapan_raport->stream('RAPORT ' . $anggota_kelas->siswa->nama_lengkap . ' (' . $anggota_kelas->kelas->nama_kelas . ').pdf');
    }

    public function leger()
    {
        $title = 'Leger Nilai Siswa';
        $tapel = Tapel::findorfail(5);
        $guru = Guru::where('user_id', Auth::user()->id)->first();
        $id_kelas_diampu = Kelas::where('tapel_id', $tapel->id)->where('guru_id', $guru->id)->get('id');
        $data_id_pembelajaran = Pembelajaran::whereIn('kelas_id', $id_kelas_diampu)->get('id');
        $data_pembelajaran = Pembelajaran::whereIn('kelas_id', $id_kelas_diampu)->where('status',1)->get();
        $data_anggota_kelas = AnggotaKelas::whereIn('kelas_id', $id_kelas_diampu)->get();
        $data_mapel_ki_3 = NilaiRapotK3::whereIn('pembelajaran_id', $data_id_pembelajaran)->groupBy('pembelajaran_id')->get();
        foreach ($data_anggota_kelas as $anggota_kelas) {
            $data_nilai_ki_1 = NilaiK1::where('anggota_kelas_id', $anggota_kelas->id)->avg('nilai');
            $anggota_kelas->data_nilai_ki_1 = round($data_nilai_ki_1, 1);
            $data_nilai_ki_2 = NilaiK2::where('anggota_kelas_id', $anggota_kelas->id)->avg('nilai');
            $anggota_kelas->data_nilai_ki_2 = round($data_nilai_ki_2, 1);
            $data_nilai_ki_3 = NilaiRapotK3::where('anggota_kelas_id', $anggota_kelas->id)->first();
            $anggota_kelas->data_nilai_ki_3 = $data_nilai_ki_3;
            $kehadiran = Kehadiran::where('anggota_kelas_id', $anggota_kelas->id)->first();
            $anggota_kelas->kehadiran = $kehadiran;
        }
        return view('walikelas.raport.leger',compact('title','data_mapel_ki_3','data_anggota_kelas','data_pembelajaran'));
    }
}
