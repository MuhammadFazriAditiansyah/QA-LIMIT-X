<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mikrobiologi_proses_produksi extends Model
{
    use HasFactory, SoftDeletes;

    // Kolom yang dilindungi agar tidak dapat diisi massal
    protected $guarded = ['id'];

    // Kolom yang digunakan untuk Soft Deletes
    protected $dates = ['deleted_at'];


    public function Sampel_mikrobiologi_proses_produksi()
    {
        return $this->hasMany(Sampel_mikrobiologi_proses_produksi::class, 'id_proses_produksi');
    }

}
