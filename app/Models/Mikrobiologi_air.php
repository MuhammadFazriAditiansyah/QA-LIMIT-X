<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mikrobiologi_air extends Model
{
    use HasFactory, SoftDeletes;

    // Kolom yang dilindungi agar tidak dapat diisi massal
    protected $guarded = ['id'];

    // Kolom yang digunakan untuk Soft Deletes
    protected $dates = ['deleted_at'];

    // Relasi ke model `Sampel_mikrobiologi_air`
    public function sampel_mikrobiologi_air()
    {
        return $this->hasMany(Sampel_mikrobiologi_air::class, 'id_mikrobiologi');
    }
}
