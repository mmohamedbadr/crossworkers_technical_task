<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Get the carmodels for the brand.
     */
    public function carmodels()
    {
        return $this->hasMany(Carmodel::class);
    }

    /**
     * Get the cars for the brand.
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
