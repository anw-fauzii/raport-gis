<?php

namespace App\Models\p5;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanP5 extends Model
{
    use HasFactory;
    protected $table = 'catatan_p5';
    protected $fillable = [
        'p5_id',
        'anggota_kelas_id',
        'catatan',
    ];
}
