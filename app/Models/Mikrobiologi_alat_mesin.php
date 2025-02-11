<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mikrobiologi_alat_mesin extends Model
{
    use HasFactory, SoftDeletes;

    // Kolom yang dilindungi agar tidak dapat diisi massal
    protected $guarded = ['id'];

    // Kolom yang digunakan untuk Soft Deletes
    protected $dates = ['deleted_at'];
    public function sampel_mikrobiologi_alat_mesin()
    {
        return $this->hasMany(Sampel_mikrobiologi_alat_mesin::class, 'id_alat_mesin');
    }
}
