<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Futami extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function futami_sampel_kimia()
    {
        return $this->hasMany(Futami_sampel_kimia::class, 'id_analisa_kimia');
    }
}

