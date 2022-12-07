<?php

namespace App\Http\Controllers;

use App\Models\NilaiKokulikuler;
use App\Models\NilaiRapotKokulikuler;
use App\Models\AnggotaKelas;
use App\Models\Guru;
use App\Models\KKM;
use App\Models\RencanaKokulikuler;
use App\Exports\NilaiKokulikulerExport;
use App\Imports\NilaiKokulikulerImport;
use Excel;
use App\Models\Kelas;
use App\Models\Pembelajaran;
use App\Models\Tapel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class NilaiKokulikulerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','revalidate']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasAnyRole('wali|mapel')){
            $title = 'Nilai Kokulikuler';
            $tapel = Tapel::findorfail(5);

            $guru = Guru::where('user_id', Auth::user()->id)->first();
            $id_kelas = Kelas::where('tapel_id', $tapel->id)->get('id');

            $data_penilaian = Pembelajaran::select('kategori_mapel_id','pembelajaran.*')->join('mapel','pembelajaran.mapel_id','=','mapel.id')->where('kategori_mapel_id',5)->where('guru_id', $guru->id)->whereIn('kelas_id', $id_kelas)->where('status', 1)->orderBy('mapel_id', 'ASC')->orderBy('kelas_id', 'ASC')->get();

            foreach ($data_penilaian as $penilaian) {
                $data_rencana_nilai = RencanaKokulikuler::where('pembelajaran_id', $penilaian->id)->get();
                $id_rencana_nilai = RencanaKokulikuler::where('pembelajaran_id', $penilaian->id)->get('id');
                $telah_dinilai = NilaiKokulikuler::whereIn('rencana_kokulikuler_id', $id_rencana_nilai)->groupBy('rencana_kokulikuler_id')->get();

                $penilaian->jumlah_rencana_penilaian = count($data_rencana_nilai);
                $penilaian->jumlah_telah_dinilai = count($telah_dinilai);
                $penilaian->data_rencana_nilai = $data_rencana_nilai;
            }
            return view('guru.penilaian-kokulikuler.index', compact('title', 'data_penilaian'));
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
        if(Auth::user()->hasAnyRole('wali|mapel')){
            if (is_null($request->anggota_kelas_id)) {
                return back()->with('toast_error', 'Data siswa tidak ditemukan');
            } else {
                for ($cound_siswa = 0; $cound_siswa < count($request->anggota_kelas_id); $cound_siswa++) {
                    for ($count_penilaian = 0; $count_penilaian < count($request->rencana_kokulikuler_id); $count_penilaian++) {
                        if ($request->nilai_ph[$count_penilaian][$cound_siswa] >= 0 && $request->nilai_ph[$count_penilaian][$cound_siswa] <= 100) {
                            if($request->nilai_npts[$count_penilaian][$cound_siswa]){
                                $rumus = (($request->nilai_ph[$count_penilaian][$cound_siswa] * 2) + $request->nilai_npts[$count_penilaian][$cound_siswa]+$request->nilai_npas[$count_penilaian][$cound_siswa])/4;
                            }else{
                                $rumus = (($request->nilai_ph[$count_penilaian][$cound_siswa] * 2) + $request->nilai_npas[$count_penilaian][$cound_siswa])/3;
                            }
                            $data_nilai = array(
                                'anggota_kelas_id'  => $request->anggota_kelas_id[$cound_siswa],
                                'rencana_kokulikuler_id' => $request->rencana_kokulikuler_id[$count_penilaian],
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
                NilaiKokulikuler::insert($store_data_penilaian);
                $pembelajaran= Pembelajaran::find($request->pembelajaran_id);
                for ($cound_siswa = 0; $cound_siswa < count($request->anggota_kelas_id); $cound_siswa++) {
                    $nilai_kd = round((NilaiKokulikuler::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->sum('nilai_kd'))/count($request->rencana_kokulikuler_id),0);
                    $rapot = array(
                        'anggota_kelas_id'  => $request->anggota_kelas_id[$cound_siswa],
                        'pembelajaran_id' => $request->pembelajaran_id,
                        'nilai_raport' => $nilai_kd,
                        'predikat_a' => 92,
                        'predikat_b' => 83,
                        'predikat_c' => 75,
                        'created_at'  => Carbon::now(),
                        'updated_at'  => Carbon::now(),
                    );
                    $data_rapot[] = $rapot;
                }
                NilaiRapotKokulikuler::insert($data_rapot);
                return redirect('penilaian-kokulikuler')->with('success', 'Data nilai pengetahuan berhasil disimpan.');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiKokulikuler  $nilaiKokulikuler
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiKokulikuler $nilaiKokulikuler)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiKokulikuler  $nilaiKokulikuler
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasAnyRole('wali|mapel')){
            $decrypted = Crypt::decrypt($id);
            $pembelajaran = Pembelajaran::findorfail($decrypted);
            $data_anggota_kelas = AnggotaKelas::where('kelas_id', $pembelajaran->kelas_id)->get();
            $id_data_rencana_penilaian = RencanaKokulikuler::where('pembelajaran_id', $decrypted)->orderBy('kd_mapel_id', 'DESC')->get('id');
            $data_kd_nilai = NilaiKokulikuler::whereIn('rencana_kokulikuler_id', $id_data_rencana_penilaian)->groupBy('rencana_kokulikuler_id')->get();
            $count_kd_nilai = count($data_kd_nilai);
            $data_kode_penilaian = RencanaKokulikuler::where('pembelajaran_id', $decrypted)->get();
            $count_kd = count($data_kode_penilaian);
            if ($count_kd_nilai == 0) {
                $data_rencana_penilaian = RencanaKokulikuler::where('pembelajaran_id', $decrypted)->get();
                $title = 'Input Nilai KI-3 '.$pembelajaran->mapel->nama_mapel;
                return view('guru.penilaian-kokulikuler.create', compact('title', 'pembelajaran', 'data_anggota_kelas', 'data_rencana_penilaian', 'data_kode_penilaian', 'count_kd'));
            } else {
                foreach ($data_anggota_kelas as $anggota_kelas) {
                    $data_nilai = NilaiKokulikuler::where('anggota_kelas_id', $anggota_kelas->id)->whereIn('rencana_kokulikuler_id', $id_data_rencana_penilaian)->get();
                    $anggota_kelas->data_nilai = $data_nilai;
                }
                $nilai_rapot = NilaiRapotKokulikuler::where('pembelajaran_id', $decrypted)->get();
                $title = 'Edit Nilai Kokulikuler '.$pembelajaran->mapel->nama_mapel;
                return view('guru.penilaian-kokulikuler.edit', compact('nilai_rapot','title', 'pembelajaran', 'data_anggota_kelas', 'data_kode_penilaian','count_kd', 'count_kd_nilai', 'data_kd_nilai',));
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiKokulikuler  $nilaiKokulikuler
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->hasAnyRole('wali|mapel')){
            for ($cound_siswa = 0; $cound_siswa < count($request->anggota_kelas_id); $cound_siswa++) {
                for ($count_penilaian = 0; $count_penilaian < count($request->rencana_kokulikuler_id); $count_penilaian++) {
                    if ($request->nilai_ph[$count_penilaian][$cound_siswa] >= 0 && $request->nilai_ph[$count_penilaian][$cound_siswa] <= 100) {
                        $nilai = NilaiKokulikuler::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->where('rencana_kokulikuler_id', $request->rencana_kokulikuler_id[$count_penilaian])->first();
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
            $pembelajaran = Pembelajaran::find($request->pembelajaran_id);
            for ($cound_siswa = 0; $cound_siswa < count($request->anggota_kelas_id); $cound_siswa++) {
                $cek = NilaiRapotKokulikuler::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->where('pembelajaran_id', $request->pembelajaran_id)->count();
                if($cek == 0){
                    for ($cound_siswa = 0; $cound_siswa < count($request->anggota_kelas_id); $cound_siswa++) {
                        $nilai_kd = round((NilaiKokulikuler::join('rencana_kokulikuler','rencana_kokulikuler.id','=','nilai_kokulikuler.rencana_kokulikuler_id')->where('pembelajaran_id',$request->pembelajaran_id)->where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->avg('nilai_kd')),0);
                        $rapot = array(
                            'anggota_kelas_id'  => $request->anggota_kelas_id[$cound_siswa],
                            'pembelajaran_id' => $request->pembelajaran_id,
                            'nilai_raport' => $nilai_kd,
                            'predikat_a' => 92,
                            'predikat_b' => 83,
                            'predikat_c' => 75,
                            'created_at'  => Carbon::now(),
                            'updated_at'  => Carbon::now(),
                        );
                        $data_rapot[] = $rapot;
                    }
                    NilaiRapotKokulikuler::insert($data_rapot);
                }else{
                    $nilai_raport = round((NilaiKokulikuler::join('rencana_kokulikuler','rencana_kokulikuler.id','=','nilai_kokulikuler.rencana_kokulikuler_id')->where('pembelajaran_id',$request->pembelajaran_id)->where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->avg('nilai_kd')),0);
                    $nilai_edit = NilaiRapotKokulikuler::where('anggota_kelas_id', $request->anggota_kelas_id[$cound_siswa])->where('pembelajaran_id', $request->pembelajaran_id)->update([
                        'nilai_raport' => $nilai_raport,
                        'updated_at'  => Carbon::now(),
                    ]);
                }
            }
            return redirect('penilaian-kokulikuler')->with('success', 'Data nilai pengetahuan berhasil diedit.');
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiKokulikuler  $nilaiKokulikuler
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiKokulikuler $nilaiKokulikuler)
    {
        //
    }

    public function eksport($id)
    {
        if(Auth::user()->hasRole('wali|mapel')){
            $filename = 'format_import_Nilai_KI3 ' . date('Y-m-d H_i_s') . '.xls';
            return Excel::download(new NilaiKokulikulerExport($id), $filename);
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    public function import(Request $request)
    {
        if(Auth::user()->hasRole('wali|mapel')){
            try {
                Excel::import(new NilaiKokulikulerImport, $request->file('file_import'));
                return back()->with('success', 'Data Nilai berhasil diimport');
            } catch (Exception $e) {
                return back()->with('error', 'Maaf, format data tidak sesuai');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }
}
