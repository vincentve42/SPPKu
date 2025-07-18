<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiSemester extends Model
{
    protected $table = "nilai_semester";
    protected $fillable = ['nis','nama_siswa','mata_pelajaran','kelas_siswa','user_id','siswa_id','mata_id'];
}
