<?php

namespace App\Exports;

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
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LegerExport implements FromView, ShouldAutoSize
{
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }
    
    public function view(): View
    {
        $tapel = Tapel::findorfail($this->id);
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
        }
        return view('exports.leger',compact('data_anggota_kelas','mapel_k3','mapel_kokulikuler','mapel_mulok','tapel')); 
    }
}
