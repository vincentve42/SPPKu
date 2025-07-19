<?php

use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\OtherController;
use App\Http\Middleware\GuestChecker;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $nama_sekolah = User::all();
    return view('welcome',compact('nama_sekolah'));
})->middleware([GuestChecker::class]);;;
Route::get('/pembayaran', function () {
    $nama_sekolah = User::all();
    return view('ajukan-pembayaran',compact('nama_sekolah'));
})->middleware([GuestChecker::class]);;;

//Route::get('/admin/register',[AutentikasiController::class,'RegisterUi'])->name('RegisterUI')->middleware([GuestChecker::class]);
//Route::post('/admin/register',[AutentikasiController::class,'Register'])->name('Register')->middleware([GuestChecker::class]);;
Route::post('/',[OtherController::class,'Search'])->name('Search')->middleware([GuestChecker::class]);;;
Route::post('/pembayaran',[OtherController::class,'AjukanPembayaran'])->name('AjukanPembayaran')->middleware([GuestChecker::class]);;
