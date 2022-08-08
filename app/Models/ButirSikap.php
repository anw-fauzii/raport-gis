<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ButirSikap extends Model
{
    use HasFactory;
    protected $table = 'butir_sikap';
    protected $fillable = [
        'jenis_kompetensi',
        'kode',
        'butir_sikap',
    ];
}
