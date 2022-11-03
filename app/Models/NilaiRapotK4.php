<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiRapotK4 extends Model
{
    use HasFactory;
    protected $table = 'nilai_rapot_k4';
    protected $fillable = [
        'pembelajaran_id',
        'anggota_kelas_id',
        'nilai_rapot',
        'predikat_c',
        'predikat_b',
        'predikat_a',
        'deskripsi',
    ];

    public function pembelajaran()
    {
        return $this->belongsTo(Pembelajaran::class);
    }
}
