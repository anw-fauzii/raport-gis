<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiK3 extends Model
{
    use HasFactory;
    protected $table = 'nilai_k3';
    protected $fillable = [
        'rencana_nilai_k3_id',
        'anggota_kelas_id',
        'nilai_ph',
        'nilai_pts',
        'nilai_pas',
    ];

    public function rencana_mapel()
    {
        return $this->belongsTo(RencanaNilaiK3::class,'rencana_nilai_k3_id','id');
    }
}
