<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NilaiHarian extends Model
{
    protected $table = "nilai";

    protected $fillable = ['nis','nama_siswa','mata_pelajaran','kelas_siswa','user_id','siswa_id','mata_id','nilai','absen_siswa'];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function Siswa() : BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }
}
