<?php
namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Ambil data pertama dari tabel Skill
        $skill = Skill::first();  // Ganti dengan $skill agar konsisten

        // Kirim data ke view dengan nama variabel 'skill'
        return view('home', compact('skill'));  // Pastikan nama variabel sesuai dengan compact
    }
}

