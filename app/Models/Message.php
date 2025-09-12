<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    // Tentukan kolom mana yang boleh diisi (mass assignable)
    protected $fillable = [
        'name',
        'email',
        'message',
    ];
}
