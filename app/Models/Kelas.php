<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    protected $fillable = [
        'harga','nama','user_id'
    ];
    public function Siswa() : HasMany
    {
        return $this->hasMany(Siswa::class);
    }
    public function User() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    
    
}
