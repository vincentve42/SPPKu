<?php

namespace App\Http\Controllers;

use App\Models\User;

use Exception;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OtherController extends Controller
{
    public function Search(Request $request)
    {   
        try{
            $user = User::findOrFail($request->sekolah);

            try
            {
                $infoasli = $user->Pembayaran->where('nama_siswa',$request->nama)->First();

               
                session()->put('info', "SPP Siswa Bernama ". $infoasli->nama_siswa . " " . $infoasli->dibayar);
                return redirect()->back();
            }
            catch(Exception $e)
            {
                session()->put('info',"Nama Siswa tidak ditemukan");
                return redirect()->back();
            }
        }
        catch(Exception $e){
            session()->put('info',"ID Sekolah anda tidak ditemukan");
            return redirect()->back();
        }
    }
    public function AjukanPembayaran(Request $request)
    {
                request()->validate(['file' => 'mimes:png,jpeg,jpg']);
                    $user = User::findOrFail($request->sekolah);
           
                    $infoasli = $user->Pembayaran->where('nama_siswa',$request->nama)->first();

                   
                    
                    if($infoasli->dibayar == "Belum dibayar")
                    {
                       
                        Storage::disk('public')->delete($infoasli->image);
                        

                        $file = $request->file('file');

                         $infoasli->dibayar = "Tidak ditanggungkan";

                        $nama_unik = uniqid() . time() . '.' . $file->getClientOriginalExtension();

                        $path = $file->storeAs('',$nama_unik,'public');

                        $infoasli->image = $nama_unik;

                        
                        session()->put('info_bayar',"Berhasil mengirim permintaan");

                        $infoasli->save();

                        return redirect()->back();
                    }
                    else
                    {
                        session()->put('info_bayar',"Tagihan tidak ada / lunas");
                        return redirect()->back();
                    }
                    
                
                

              
             /*$infoasli = $user->Pembayaran->where('nama_siswa',$request->nama);
                
               
                }*/
        
        }
        
}
