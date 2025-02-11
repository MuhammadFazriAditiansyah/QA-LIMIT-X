<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mikrobiologi_produk_percobaan extends Model
{
    use HasFactory, SoftDeletes;

    // Kolom yang dilindungi agar tidak dapat diisi massal
    protected $guarded = ['id'];

    // Kolom yang digunakan untuk Soft Deletes
    protected $dates = ['deleted_at'];

    public function sampel_mikrobiologi_produk_percobaan()
    {
        return $this->hasMany(Sampel_mikrobiologi_produk_percobaan::class, 'id_produk_percobaan');
    }
}
