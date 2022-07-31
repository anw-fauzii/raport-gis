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

    public function tapel()
    {
        return $this->belongsTo(Tapel::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function pendamping(){
        return $this->belongsTo(Guru::class,'pendamping_id','id');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
    
}
