<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengeluaran extends Model
{
    protected $fillable = [
        'user_id','harga','nama','image'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
