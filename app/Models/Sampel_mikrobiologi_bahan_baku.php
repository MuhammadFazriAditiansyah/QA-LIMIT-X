<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampel_mikrobiologi_bahan_baku extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function Mikrobiologi_bahan_baku()
    {
        return $this->belongsTo(Mikrobiologi_bahan_baku::class); 
    }

}
