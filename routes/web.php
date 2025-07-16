<?php

use App\Http\Controllers\AutentikasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return dd(Auth::user()->Kelas);
});

Route::get('/admin/register',[AutentikasiController::class,'RegisterUi'])->name('RegisterUI');
