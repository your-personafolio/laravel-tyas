<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $table = 'abouts';

    // Tentukan atribut yang dapat diisi secara massal
    protected $fillable = [
        'title',
        'description', // Menambahkan kolom description ke dalam $fillable
    ];
}
