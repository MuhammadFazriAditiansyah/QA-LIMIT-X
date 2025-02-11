<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengujian_database extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function laporan_analisa_air()
    {
        return $this->belongsTo(Laporan_analisa_air::class);
    }
}
