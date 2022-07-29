<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $fillable = [
        'tapel_id',
        'guru_id',
        'pendamping_id',
        'tingkatan_kelas',
        'nama_kelas',
    ];
}
