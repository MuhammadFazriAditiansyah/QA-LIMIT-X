<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportedFile extends Model
{
    use HasFactory;

    protected $fillable = ['filename', 'type', 'path', 'created_at'];
}
