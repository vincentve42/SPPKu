<?php

use App\Http\Controllers\AutentikasiController;
use App\Http\Middleware\GuestChecker;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return dd(Auth::user()->Kelas);
});

Route::get('/admin/register',[AutentikasiController::class,'RegisterUi'])->name('RegisterUI')->middleware([GuestChecker::class]);
Route::post('/admin/register',[AutentikasiController::class,'Register'])->name('Register')->middleware([GuestChecker::class]);;
