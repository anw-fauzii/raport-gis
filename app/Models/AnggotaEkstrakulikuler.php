<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaEkstrakulikuler extends Model
{
    use HasFactory;
    protected $table = 'anggota_ekstrakulikuler';
    protected $fillable = [
        'anggota_kelas_id',
        'ekstrakulikuler_id',
        'tapel'
    ];

    public function anggota_kelas()
    {
        return $this->belongsTo(AnggotaKelas::class);
    }

    public function ekstrakulikuler()
    {
        return $this->belongsTo(Ekstrakulikuler::class);
    }

    public function nilai_ekstrakulikuler()
    {
        return $this->hasOne(NilaiEkstrakulikuler::class);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
