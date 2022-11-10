<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiKokulikuler extends Model
{
    use HasFactory;
    protected $table = 'nilai_kokulikuler';
    protected $fillable = [
        'rencana_kokulikuler_id',
        'anggota_kelas_id',
        'nilai_ph',
        'nilai_pts',
        'nilai_pas',
        'nilai_kd',
    ];

    public function rencana_mapel()
    {
        return $this->belongsTo(RencanaKokulikuler::class,'rencana_kokulikuler_id','id');
    }
}
