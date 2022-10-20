<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiRapotK1 extends Model
{
    use HasFactory;
    protected $table = 'nilai_rapot_k1';
    protected $fillable = [
        'anggota_kelas_id',
        'nilai_rapot',
        'deskripsi',
    ];
}
