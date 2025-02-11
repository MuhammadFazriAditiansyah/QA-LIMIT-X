<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mikrobiologi_bahan_kemas extends Model
{
    use HasFactory, SoftDeletes;

    // Kolom yang dilindungi agar tidak dapat diisi massal
    protected $guarded = ['id'];

    // Kolom yang digunakan untuk Soft Deletes
    protected $dates = ['deleted_at'];

    public function sampel_mikrobiologi_bahan_kemas()
    {
        return $this->hasMany(Sampel_mikrobiologi_bahan_kemas::class, 'id_bahan_kemas');
    }
}
