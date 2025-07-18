<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    protected $fillable = [
        'nama', 'kelas', 'absen', 'kelas','user_id','kelas_id','kategori','harga','nis'
    ];
    public function User() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function Kelas() : BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }
    public function Pembayaran() : BelongsTo
    {
        return $this->belongsTo(Pembayaran::class);
    }
    public function NilaiHarian() : HasMany
    {
        return $this->hasMany(NilaiHarian::class);
    }
    public function NilaiSemester() : HasMany
    {
        return $this->hasMany(NilaiSemester::class);
    }
}
