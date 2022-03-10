<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Get the car category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the car model.
     */
    public function carmodel()
    {
        return $this->belongsTo(Carmodel::class);
    }
    /**
     * Get the car brand.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the car engine.
     */
    public function engine()
    {
        return $this->belongsTo(Engine::class);
    }

}
