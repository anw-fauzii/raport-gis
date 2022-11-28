<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiMulok extends Model
{
    use HasFactory;
    protected $table = 'nilai_mulok';
    protected $fillable = [
        'rencana_mulok_id',
        'anggota_kelas_id',
        'nilai_ph',
        'nilai_pts',
        'nilai_pas',
        'nilai_kd',
    ];

    public function rencana_mulok()
    {
        return $this->belongsTo(RencanaMulok::class,'rencana_mulok_id','id');
    }
}