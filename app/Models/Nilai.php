<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai extends Model
{

    protected $table = "mapel";
    protected $fillable = ['user_id','nama'];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
