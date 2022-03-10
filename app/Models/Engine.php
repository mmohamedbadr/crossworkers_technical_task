<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Engine extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function cars(){
       return  $this->hasMany(Car::class);
    }
}
