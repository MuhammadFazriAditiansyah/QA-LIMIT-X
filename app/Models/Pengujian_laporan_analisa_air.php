<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengujian_laporan_analisa_air extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function laporan_analisa_air()
    {
        return $this->belongsTo(Laporan_analisa_air::class);
    }

    public function sampel_laporan_analisa_air()
    {
        return $this->belongsTo(Sampel_laporan_analisa_air::class, 'sampel_id');
    }
}
