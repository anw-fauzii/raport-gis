<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaKelas;
use App\Models\Siswa;
use App\Models\Tapel;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AnggotaKelasController extends Controller
{
    public function store_anggota(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('warning', 'Tidak ada siswa yang dipilih');
        } else {
            $siswa_id = $request->input('siswa_id');
            $tapel = Tapel::latest()->first();
            for ($count = 0; $count < count($siswa_id); $count++) {
                $data = array(
                    'siswa_id' => $siswa_id[$count],
                    'kelas_id'  => $request->kelas_id,
                    'pendaftaran'  => $request->pendaftaran,
                    'tapel_id' => $tapel->id,
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                );
                $insert_data[] = $data;
            }

            AnggotaKelas::insert($insert_data);
            Siswa::whereIn('id', $siswa_id)->update(['kelas_id' => $request->input('kelas_id')]);
            return back()->with('success', 'Anggota kelas berhasil ditambahkan');
        }
    }

    public function delete_anggota($id)
    {
        try {
            $anggota_kelas = AnggotaKelas::findorfail($id);
            $siswa = Siswa::findorfail($anggota_kelas->siswa_id);

            $update_kelas_id = [
                'kelas_id' => null,
            ];
            $anggota_kelas->delete();
            $siswa->update($update_kelas_id);
            return back()->with('success', 'Anggota kelas berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Anggota kelas tidak dapat dihapus');
        }
    }
}
