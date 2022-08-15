<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaNilaiK3 extends Model
{
    use HasFactory;
    protected $table = 'rencana_nilai_k3';
    protected $fillable = [
        'pembelajaran_id',
        'kd_mapel_id',
    ];
}
