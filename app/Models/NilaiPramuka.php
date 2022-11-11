<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPramuka extends Model
{
    use HasFactory;
    protected $table = 'nilai_pramuka';
    protected $fillable = [
        'anggota_kelas_id',
        'nilai',
        'deskripsi',
    ];
}
