<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function inicio()
    {
        return view('inicio');
    }

    public function salir()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
