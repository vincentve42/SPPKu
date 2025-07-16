<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AutentikasiController extends Controller
{
    public function RegisterUI()
    {
        return view('register');
    }
    public function Register(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'name' => 'required|min:4',
            'password' => 'required|min:8',
        ]);
        
        $new_user = new User;
        $new_user->email = $request->email;
        $new_user->name = $request->name;
        $new_user->password = bcrypt($request->password);
        $new_user->save();  
        return redirect('/admin/login');

    }
}