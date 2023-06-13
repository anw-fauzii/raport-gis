<?php

namespace App\Models\p5;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\p5\P5Deskripsi;

class NilaiP5 extends Model
{
    use HasFactory;
    protected $table = 'nilai_p5';
    protected $fillable = [
        'p5_deskripsi_id',
        'anggota_kelas_id',
        'nilai',
    ];

    public function p5_deskripsi()
    {
        return $this->belongsTo(P5Deskripsi::class);
    }
}
