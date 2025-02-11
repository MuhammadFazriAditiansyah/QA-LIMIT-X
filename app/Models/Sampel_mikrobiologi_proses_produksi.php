<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampel_mikrobiologi_proses_produksi extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function Mikrobiologi_proses_produksi()
    {
        return $this->belongsTo(Mikrobiologi_proses_produksi::class);
    }

}
