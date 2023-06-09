<?php

namespace App\Models\p5;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\p5\P5Deskripsi;

class P5 extends Model
{
    use HasFactory;
    protected $table = 'p5';
    protected $fillable = [
        'no',
        'kelas_id',
        'judul',
        'deskripsi',
    ];

    public function kelas()
    {
        return $this->belongsTo(kelas::class,'kelas_id','id');
    }

    public function p5_deskripsi()
    {
        return $this->hasMany(P5Deskripsi::class);
    }
}
