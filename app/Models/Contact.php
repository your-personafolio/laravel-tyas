<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang benar
    protected $table = 'contacts';

    // Tentukan atribut yang dapat diisi secara massal
    protected $fillable = [
        'sosmed',
        'name',
        'link',
        'issued_at',
    ];
}
