<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $fillable = [
        'user_id',
        'kelas_id',
        'guru_id',
        'ekstrakulikuler_id',
        'jenis_pendaftaran',
        'nis',
        'nisn',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'status_dalam_keluarga',
        'anak_ke',
        'alamat',
        'nomor_hp',
        'nama_ayah',
        'nama_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'pendidikan_ayah',
        'pendidikan_ibu',
        'nama_wali',
        'pekerjaan_wali',
        'pendidikan_wali',
        'avatar',
        'status'
    ];
    protected $dates = ['tanggal_lahir'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function anggota_kelas()
    {
        return $this->hasMany(AnggotaKelas::class);
    }
}
