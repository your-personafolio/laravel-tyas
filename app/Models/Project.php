<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan nama model
    protected $table = 'projects';

    // Tentukan atribut yang dapat diisi secara massal
    protected $fillable = [
        'name',
        'description',
        'link',
        'issued_at',
        'image',
    ];
}
