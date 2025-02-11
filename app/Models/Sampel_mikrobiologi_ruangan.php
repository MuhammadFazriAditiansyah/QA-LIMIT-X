<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampel_mikrobiologi_ruangan extends Model
{
    use HasFactory;
     protected $guarded = [
        'id',
    ];

    public function Mikrobiologi_ruangan()
    {
        return $this->belongsTo(Mikrobiologi_ruangan::class);
    }
}
