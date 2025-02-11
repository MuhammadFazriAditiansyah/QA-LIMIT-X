<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import SoftDeletes

class Mikrobiologi_produk extends Model
{
    use HasFactory, SoftDeletes; // Gunakan trait SoftDeletes

    // Kolom yang dilindungi agar tidak dapat diisi massal
    protected $guarded = ['id'];

    // Kolom yang digunakan untuk Soft Deletes
    protected $dates = ['deleted_at'];

    public function sampel_mikrobiologi_produk()
    {
        return $this->hasMany(Sampel_mikrobiologi_produk::class, 'id_produk');
    }
}
