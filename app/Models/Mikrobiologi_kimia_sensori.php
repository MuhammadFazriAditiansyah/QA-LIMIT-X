<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mikrobiologi_kimia_sensori extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function sampel_mikrobiologi_kimia_sensori()
    {
        return $this->hasMany(Sampel_mikrobiologi_kimia_sensori::class, 'id_kimia_sensori');
    }
}
