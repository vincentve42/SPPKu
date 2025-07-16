<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutentikasiController extends Controller
{
    public function RegisterUI()
    {
        return view('register');
    }
}
