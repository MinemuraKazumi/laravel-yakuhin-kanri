<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reagent extends Model
{
    use HasFactory;
    
    public function user() { //1対多の「１」側なので単数系
        return $this->belongsTo('App\Models\User');
    }
}


