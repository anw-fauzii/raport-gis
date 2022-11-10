<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiEkstrakulikuler extends Model
{
    use HasFactory;
    protected $table = 'nilai_ekstrakulikuler';
    protected $fillable = [
        'ekstrakulikuler_id',
        'anggota_ekstrakulikuler_id',
        'nilai',
        'deskripsi'
    ];

    public function ekstrakulikuler()
    {
        return $this->belongsTo(Ekstrakulikuler::class);
    }

    public function anggota_ekstrakulikuler()
    {
        return $this->belongsTo(AnggotaEkstrakulikuler::class);
    }
}
