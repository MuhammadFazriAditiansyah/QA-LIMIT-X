<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampel_mikrobiologi_produk_percobaan extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function Mikrobiologi_produk_percobaan()
    {
        return $this->belongsTo(Mikrobiologi_produk_percobaan::class);
    }
}
