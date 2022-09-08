<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaPelajaranSholat extends Model
{
    use HasFactory;
    protected $table = 'rencana_nilai_sholat';
    protected $fillable = [
        'kelas_id',
        'kategori',
        'tingkat',
        'butir_sikap_id',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function butir_sikap()
    {
        return $this->belongsTo(ButirSikap::class,'butir_sikap_id','id');
    }

    public function kategori_id()
    {
        return $this->belongsTo(KategoriButirSikap::class,'kategori','id');
    } 
}
