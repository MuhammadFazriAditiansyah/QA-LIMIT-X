<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampel_mikrobiologi_bahan_kemas extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function Mikrobiologi_bahan_kemas()
    {
        return $this->belongsTo(Mikrobiologi_bahan_kemas::class);
    }
}
