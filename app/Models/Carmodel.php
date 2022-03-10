<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carmodel extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * Get the brand for carmodel.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the cars belongs to the carmodel.
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
