<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('home', ['title' => 'Home Page'], compact('user'));
    }
}

