<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampel_mikrobiologi_alat_mesin extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function Mikrobiologi_alat_mesin()
    {
        return $this->belongsTo(Mikrobiologi_alat_mesin::class); 
    }
}
