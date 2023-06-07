<?php

namespace App\Http\Controllers;

use App\Models\AnggotaT2Q;
use App\Models\AnggotaKelas;
use App\Models\Guru;
use App\Models\Tapel;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Anggotat2qController extends Controller
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
        if(Auth::user()->hasRole('admin')){
            $tapel = Tapel::latest()->first();
            $title = 'Data Guru T2Q';
            $data_guru = Guru::where('jabatan', '2')->get();
            foreach ($data_guru as $guru) {
                $jumlah_anggota = AnggotaT2Q::where('guru_id', $guru->id)->where('tapel_id',$tapel->id)->count();
                $guru->jumlah_anggota = $jumlah_anggota;
            }
            return view('admin.t2q.index', compact('title', 'data_guru', 'tapel', 'data_guru'));
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
        if(Auth::user()->hasRole('admin')){
            $validator = Validator::make($request->all(), [
                'siswa_id' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->with('warning', 'Tidak ada siswa yang dipilih');
            } else {
                $siswa_id = $request->input('siswa_id');
                foreach ($siswa_id as $id){
                    $anggota = AnggotaKelas::find($id);
                    $sis = Siswa::where('id', $anggota->siswa_id)->update(['guru_id' => $request->guru_id]);
                }
                $tapel = Tapel::latest()->first();
                for ($count = 0; $count < count($siswa_id); $count++) {
                    $data = array(
                        'tingkat'=> $request->tingkat,
                        'anggota_kelas_id' => $siswa_id[$count],
                        'guru_id'  => $request->guru_id,
                        'tapel_id' => $tapel->id,
                        'created_at'  => Carbon::now(),
                        'updated_at'  => Carbon::now(),
                    );
                    $insert_data[] = $data;
                }
                AnggotaT2Q::insert($insert_data);
                return back()->with('success', 'Anggota kelas berhasil ditambahkan');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnggotaT2Q  $anggotaT2Q
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->hasRole('admin')){
            $title = 'Kelompok T2Q';
            $tapel = Tapel::latest()->first();
            $guru = Guru::findorfail($id);
            $anggota_t2q = AnggotaT2Q::where('guru_id',$id)->where('tapel_id',$tapel->id)->get();
            $siswa_belum_masuk_kelas = Siswa::where('status', 1)->where('guru_id', null)->get();
            foreach ($siswa_belum_masuk_kelas as $belum_masuk_kelas) {
                $kelas_sebelumhya = AnggotaKelas::where('siswa_id', $belum_masuk_kelas->id)->where('tapel_id', $tapel->id)->orderBy('id', 'ASC')->first();
                if (is_null($kelas_sebelumhya)) {
                    $belum_masuk_kelas->kelas_sebelumhya = null;
                    $belum_masuk_kelas->anggota_kelas = null;
                } else {
                    $belum_masuk_kelas->kelas_sebelumhya = $kelas_sebelumhya->kelas->nama_kelas;
                    $belum_masuk_kelas->anggota_kelas = $kelas_sebelumhya->id;
                }
            }
            return view('admin.t2q.show', compact('title', 'guru', 'anggota_t2q', 'siswa_belum_masuk_kelas'));
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnggotaT2Q  $anggotaT2Q
     * @return \Illuminate\Http\Response
     */
    public function edit(AnggotaT2Q $anggotaT2Q)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnggotaT2Q  $anggotaT2Q
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnggotaT2Q $anggotaT2Q)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnggotaT2Q  $anggotaT2Q
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->hasRole('admin')){
            try {
                $anggota_kelas = AnggotaT2Q::where('anggota_kelas_id',$id)->first();
                $siswa = Siswa::findorfail($id);
                $update_guru_id = [
                    'guru_id' => null,
                ];

                $anggota_kelas->delete();
                $siswa->update($update_guru_id);
                return back()->with('success', 'Anggota kelas berhasil dihapus');
            } catch (\Exception $e) {
                return back()->with('error', 'Anggota kelas tidak dapat dihapus');
            }
        }else{
            return response()->view('errors.403', [abort(403), 403]);
        }
    }
}
