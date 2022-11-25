<?php

namespace App\Http\Controllers;

use App\Models\NilaiMulok;
use App\Models\AnggotaKelas;
use App\Models\Guru;
use App\Models\RencanaMulok;
use App\Models\Kelas;
use App\Models\Pembelajaran;
use App\Models\Tapel;
use App\Models\KKM;
use App\Models\NilaiRapotMulok;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NilaiMulokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('wali')){
            $title = 'Nilai Mulok Khas PI';
            $tapel = Tapel::findorfail(5);

            $guru = Guru::where('user_id', Auth::user()->id)->first();
            $id_kelas = Kelas::where('tapel_id', $tapel->id)->get('id');

            $data_penilaian = Pembelajaran::select('kategori_mapel_id','pembelajaran.*')->join('mapel','pembelajaran.mapel_id','=','mapel.id')->where('kategori_mapel_id',6)->where('guru_id', $guru->id)->whereIn('kelas_id', $id_kelas)->where('status', 1)->orderBy('mapel_id', 'ASC')->orderBy('kelas_id', 'ASC')->get();

            foreach ($data_penilaian as $penilaian) {
                $data_rencana_nilai = RencanaMulok::where('pembelajaran_id', $penilaian->id)->get();
                $id_rencana_nilai = RencanaMulok::where('pembelajaran_id', $penilaian->id)->get('id');
                $telah_dinilai = NilaiMulok::whereIn('rencana_mulok_id', $id_rencana_nilai)->groupBy('rencana_mulok_id')->get();

                $penilaian->jumlah_rencana_penilaian = count($data_rencana_nilai);
                $penilaian->jumlah_telah_dinilai = count($telah_dinilai);
                $penilaian->data_rencana_nilai = $data_rencana_nilai;
            }

            return view('guru.penilaian-mulok.index', compact('title', 'data_penilaian'));
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasRole('wali')){
            if (is_null($request->anggota_kelas_id)) {
                return back()->with('toast_error', 'Data siswa tidak ditemukan');
            } else {
                for ($cound_siswa = 0; $cound_siswa < count($request->anggota_kelas_id); $cound_siswa++) {
                    for ($count_penilaian = 0; $count_penilaian < count($request->rencana_mulok_id); $count_penilaian++) {
                        if ($request->nilai_ph[$count_penilaian][$cound_siswa] >= 0 && $request->nilai_ph[$count_penilaian][$cound_siswa] <= 100) {
                            if($request->nilai_npts[$count_penilaian][$cound_siswa]){
                                $rumus = (($request->nilai_ph[$count_penilaian][$cound_siswa] * 2) + $request->nilai_npts[$count_penilaian][$cound_siswa]+$request->nilai_npas[$count_penilaian][$cound_siswa])/4;
                            }else{
                                $rumus = (($request->nilai_ph[$count_penilaian][$cound_siswa] * 2) + $request->nilai_npas[$count_penilaian][$cound_siswa])/3;
                            }
                            $data_nilai = array(
                                'anggota_kelas_id'  => $request->anggota_kelas_id[$cound_siswa],
                                'rencana_mulok_id' => $request->rencana_mulok_id[$count_penilaian],
                                'nilai_ph'  => ltrim($request->nilai_ph[$count_penilaian][$cound_siswa]),
                                'nilai_pts'  => ltrim($request->nilai_npts[$count_penilaian][$cound_siswa]),
                                'nilai_pas'  => ltrim($request->nilai_npas[$count_penilaian][$cound_siswa]),
                                'nilai_kd' => round($rumus,0),
                                'created_at'  => Carbon::now(),
                                'updated_at'  => Carbon::now(),
                            );
                            $data_penilaian_siswa[] = $data_nilai;
                        } else {
                            return back()->with('toast_error', 'Nilai harus berisi antara 0 s/d 100');
                        }
                    }
                    $store_data_penilaian = $data_penilaian_siswa;
                }
                NilaiMulok::insert($store_data_penilaian);
                $pembelajaran= Pembelajaran::find($request->pembelajaran_id);
                $tapel = Tapel::findorfail(5);
                $guru = Guru::where('user_id', Auth::user()->id)->first();
                $kelas = Kelas::where('tapel_id', $tapel->id)->where('guru_id',$guru->id)->first();
                $kkm = KKM::where('mapel_id', $pembelajaran->mapel_id)->where('tingkat',$kelas->tingkatan_kelas)->first();
                $range = (100 - $kkm->kkm) / 3;
                $predikat_c = round($kkm->kkm, 0);
                $predikat_b = round($kkm->kkm + $range, 0);
                $predikat_a = round($kkm->kkm + ($range * 2), 0);
                for ($cound_siswa = 0; $cound_siswa < count($request->anggota_kelas_id); $cound_siswa++) {
                    $nilai_kd = round((NilaiMulok::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->sum('nilai_kd'))/count($request->rencana_mulok_id),0);
                    $rapot = array(
                        'anggota_kelas_id'  => $request->anggota_kelas_id[$cound_siswa],
                        'pembelajaran_id' => $request->pembelajaran_id,
                        'nilai_raport' => $nilai_kd,
                        'predikat_a' => $predikat_a,
                        'predikat_b' => $predikat_b,
                        'predikat_c' => $predikat_c,
                        'created_at'  => Carbon::now(),
                        'updated_at'  => Carbon::now(),
                    );
                    $data_rapot[] = $rapot;
                }
                NilaiRapotMulok::insert($data_rapot);
                return redirect('penilaian-mulok')->with('success', 'Data nilai mulok berhasil disimpan.');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiMulok  $nilaiMulok
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiMulok $nilaiMulok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiMulok  $nilaiMulok
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasRole('wali')){
            $pembelajaran = Pembelajaran::findorfail($id);
            $data_anggota_kelas = AnggotaKelas::where('kelas_id', $pembelajaran->kelas_id)->get();

            $id_data_rencana_penilaian = RencanaMulok::where('pembelajaran_id', $id)->orderBy('kd_mapel_id', 'DESC')->get('id');

            $data_kd_nilai = NilaiMulok::whereIn('rencana_mulok_id', $id_data_rencana_penilaian)->groupBy('rencana_mulok_id')->get();
            $count_kd_nilai = count($data_kd_nilai);

            $data_kode_penilaian = RencanaMulok::where('pembelajaran_id', $id)->get();
            $count_kd = count($data_kode_penilaian);
            if ($count_kd_nilai == 0) {
                $data_rencana_penilaian = RencanaMulok::where('pembelajaran_id', $id)->get();
                $title = 'Input Nilai '.$pembelajaran->mapel->nama_mapel;
                return view('guru.penilaian-mulok.create', compact('title', 'pembelajaran', 'data_anggota_kelas', 'data_rencana_penilaian', 'data_kode_penilaian', 'count_kd'));
            } else {
                foreach ($data_anggota_kelas as $anggota_kelas) {
                    $data_nilai = NilaiMulok::where('anggota_kelas_id', $anggota_kelas->id)->whereIn('rencana_mulok_id', $id_data_rencana_penilaian)->get();
                    $anggota_kelas->data_nilai = $data_nilai;
                }
                $nilai_rapot = NilaiRapotMulok::where('pembelajaran_id', $id)->get();
                $title = 'Edit Nilai '.$pembelajaran->mapel->nama_mapel;
                return view('guru.penilaian-mulok.edit', compact('title','nilai_rapot', 'pembelajaran', 'data_anggota_kelas', 'data_kode_penilaian','count_kd', 'count_kd_nilai', 'data_kd_nilai',));
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiMulok  $nilaiMulok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->hasRole('wali')){
            for ($cound_siswa = 0; $cound_siswa < count($request->anggota_kelas_id); $cound_siswa++) {
                for ($count_penilaian = 0; $count_penilaian < count($request->rencana_mulok_id); $count_penilaian++) {
                    if ($request->nilai_ph[$count_penilaian][$cound_siswa] >= 0 && $request->nilai_ph[$count_penilaian][$cound_siswa] <= 100) {
                        $nilai = NilaiMulok::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->where('rencana_mulok_id', $request->rencana_mulok_id[$count_penilaian])->first();
                        if($request->nilai_npts[$count_penilaian][$cound_siswa]){
                            $rumus = (($request->nilai_ph[$count_penilaian][$cound_siswa] * 2) + $request->nilai_npts[$count_penilaian][$cound_siswa]+$request->nilai_npas[$count_penilaian][$cound_siswa])/4;
                        }else{
                            $rumus = (($request->nilai_ph[$count_penilaian][$cound_siswa] * 2) + $request->nilai_npas[$count_penilaian][$cound_siswa])/3;
                        }
                        $data_nilai = [
                            'nilai_ph'  => ltrim($request->nilai_ph[$count_penilaian][$cound_siswa]),
                            'nilai_pts'  => ltrim($request->nilai_npts[$count_penilaian][$cound_siswa]),
                            'nilai_pas'  => ltrim($request->nilai_npas[$count_penilaian][$cound_siswa]),
                            'nilai_kd' => round($rumus,0),
                            'updated_at'  => Carbon::now(),
                        ];
                        $nilai->update($data_nilai);
                    } else {
                        return back()->with('error', 'Nilai harus berisi antara 0 s/d 100');
                    }
                }
            }
            $pembelajaran= Pembelajaran::find($request->pembelajaran_id);
            $tapel = Tapel::findorfail(5);
            $guru = Guru::where('user_id', Auth::user()->id)->first();
            $kelas = Kelas::where('tapel_id', $tapel->id)->where('guru_id',$guru->id)->first();
            for ($cound_siswa = 0; $cound_siswa < count($request->anggota_kelas_id); $cound_siswa++) {
                $nilai_raport = round((NilaiMulok::join('rencana_mulok','rencana_mulok.id','=','nilai_mulok.rencana_mulok_id')->where('pembelajaran_id',$request->pembelajaran_id)->where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->avg('nilai_kd')),0);
                $nilai_edit = NilaiRapotMulok::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->where('pembelajaran_id', $request->pembelajaran_id)->update([
                    'nilai_raport' => $nilai_raport,
                    'updated_at'  => Carbon::now(),
                ]);
            }
            return redirect('penilaian-mulok')->with('success', 'Data nilai mulok berhasil diedit.');
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiMulok  $nilaiMulok
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiMulok $nilaiMulok)
    {
        //
    }
}
