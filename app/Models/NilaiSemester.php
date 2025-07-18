<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NilaiSemester extends Model
{
    protected $table = "nilai_semester";
    protected $fillable = ['nis','nama_siswa','mata_pelajaran','kelas_siswa','user_id','siswa_id','mata_id','nilai'];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
