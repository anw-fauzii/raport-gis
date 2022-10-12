<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiRapotK3 extends Model
{
    use HasFactory;
    protected $table = 'nilai_rapot_k3';
    protected $fillable = [
        'pembelajaran_id',
        'anggota_kelas_id',
        'nilai_rapot',
        'kkm',
        'deskripsi',
    ];

    public function pembelajaran()
    {
        return $this->belongsTo(Pembelajaran::class);
    }
}
