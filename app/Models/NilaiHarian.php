<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiHarian extends Model
{
    protected $table = "nilai";

    protected $fillable = ['nis','nama_siswa','mata_pelajaran','kelas_siswa','user_id','siswa_id','mata_id'];
}
