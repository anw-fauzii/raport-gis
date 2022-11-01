<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiHafalan extends Model
{
    use HasFactory;
    protected $table = 'nilai_hafalan';
    protected $fillable = [
        'anggota_kelas_id',
        'tingkat',
        'hadis',
        'doa',
        'hikmah',
        'deskripsi_hadis',
        'deskripsi_doa',
        'deskripsi_hikmah'
    ];
}
