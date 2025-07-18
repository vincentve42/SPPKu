<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{

    protected $table = "mapel";
    protected $fillable = ['user_id','nama'];
}
