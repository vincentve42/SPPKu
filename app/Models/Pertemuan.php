<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    protected $table = "pertemuan";

    protected $fillable = [ 'user_id','siswa_id','keterangan','nama_siswa','kelas_siswa','image','nis'
    ];
    
}
