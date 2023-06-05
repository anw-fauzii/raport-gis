<?php

namespace App\Http\Controllers;

use App\Models\AnggotaEkstrakulikuler;
use App\Models\AnggotaKelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class AnggotaEkstrakulikulerController extends Controller
{
    public function store_anggota(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('toast_warning', 'Tidak ada siswa yang dipilih');
        } else {
            $siswa_id = $request->input('siswa_id');
            foreach ($siswa_id as $id){
                $anggota = AnggotaKelas::find($id);
                Siswa::where('id', $anggota->siswa_id)->update(['ekstrakulikuler_id' => $request->input('ekstrakulikuler_id')]);
            }
            for ($count = 0; $count < count($siswa_id); $count++) {
                $data = array(
                    'anggota_kelas_id' => $siswa_id[$count],
                    'ekstrakulikuler_id'  => $request->ekstrakulikuler_id,
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                );
                $insert_data[] = $data;
            }
            AnggotaEkstrakulikuler::insert($insert_data);
            return back()->with('success', 'Anggota Ekstrakulikuler berhasil ditambahkan');
        }
    }

    public function delete_anggota($id)
    {
        try {
            $anggota_ekstrakulikuler = AnggotaEkstrakulikuler::where('anggota_kelas_id',$id)->first();
                $siswa = Siswa::findorfail($id);
                $update_ekstrakulikuler_id = [
                    'ekstrakulikuler_id' => null,
                ];
                $anggota_ekstrakulikuler->delete();
                $siswa->update($update_ekstrakulikuler_id);
                return back()->with('success', 'Anggota kelas berhasil dihapus');
            return back()->with('success', 'Anggota Ekstrakulikuler berhasil dihapus');
        } catch (Exception $e) {
            return back()->with('error', 'Anggota Ekstrakulikuler tidak dapat dihapus');
        }
    }
}
