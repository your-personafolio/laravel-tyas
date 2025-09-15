<?php
namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\About; // Jika ada model About
use App\Models\Project;
use App\Models\Home;
use App\Models\certificate;
use App\Models\Contact;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Ambil data skill dan about
        $skills = Skill::all();
        $projects = Project::all();
        $abouts = About::first();
        $homes = Home::first();
        $certificates = Certificate::all();
        $instagram = Contact::where('sosmed', 'instagram')->first();
        $whatsapp = Contact::where('sosmed', 'whatsapp', 'name')->first();
        $facebook = Contact::where('sosmed', 'facebook')->first();
        $lokasi = Contact::where('sosmed', 'lokasi','name')->first();
        $mail = Contact::where('sosmed', 'mail','name')->first();

        // Kirim data ke view landing page
        return view('home', compact('skills', 'abouts', 'projects', 'homes','certificates','instagram', 'whatsapp', 'facebook','lokasi','mail'));
    }
}
