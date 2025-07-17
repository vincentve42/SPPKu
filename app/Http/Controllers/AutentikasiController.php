<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
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
    public function Search(Request $request)
    {
        
        try{
            $user = User::findOrFail($request->id);

            try
            {
                $infoasli = $user->Pembayaran->where('nama_siswa',$request->nama)->first();
                session()->put('info', "SPP Siswa Bernama ". $infoasli->nama_siswa . " " . $infoasli->dibayar);
                return redirect()->back();
            }
            catch(Exception $e)
            {
                session()->put('info',"Nama Siswa tidak ditemukan");
                return dd($infoasli);
            }
        }
        catch(Exception $e){
            session()->put('info',"ID Sekolah anda tidak ditemukan");
            return redirect()->back();
        }
    }
}