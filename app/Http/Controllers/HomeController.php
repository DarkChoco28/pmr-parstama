<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Tampilkan landing page publik.
     */
    public function index()
    {
        return view('home');
    }
}
