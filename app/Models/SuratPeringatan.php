<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratPeringatan extends Model
{
    protected $table = "sp";

     protected $fillable = [ 'user_id','siswa_id','keterangan','nama_siswa','kelas_siswa','image','surat','nis'
    ];

    public function siswa() : BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }
}
