<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriButirSikap extends Model
{
    use HasFactory;
    protected $table = 'kategori_butir';
    protected $fillable = [
        'kategori_butir_sikap',
    ];
}
