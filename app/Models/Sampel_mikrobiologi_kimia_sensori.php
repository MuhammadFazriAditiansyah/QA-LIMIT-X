<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampel_mikrobiologi_kimia_sensori extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function Mikrobiologi_kimia_sensori()
    {
        return $this->belongsTo(Mikrobiologi_kimia_sensori::class);
    }
}
