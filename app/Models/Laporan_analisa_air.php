<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan_analisa_air extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function pengujian_laporan_analisa_air()
    {
        return $this->hasMany(Pengujian_laporan_analisa_air::class, 'id_analisa_air');
    }
    public function pengujian_laporan_analisa_air_sampel()
    {
        return $this->hasMany(Pengujian_laporan_analisa_air::class, 'sampel_id');
    }

    public function sampel_laporan_analisa_air()
    {
        return $this->hasMany(Sampel_laporan_analisa_air::class, 'id_dokumen');
    }


}
