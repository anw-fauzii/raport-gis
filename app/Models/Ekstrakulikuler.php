<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakulikuler extends Model
{
    use HasFactory;
    protected $table = 'ekstrakulikuler';
    protected $fillable = [
        'tapel_id',
        'guru_id',
        'nama_ekstrakulikuler'
    ];

    public function tapel()
    {
        return $this->belongsTo(Tapel::class);
    }
    
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function anggota_ekstrakulikuler()
    {
        return $this->hasMany(AnggotaEkstrakulikuler::class);
    }

    public function nilai_ekstrakulikuler()
    {
        return $this->hasMany(NilaiEkstrakulikuler::class);
    }
}
