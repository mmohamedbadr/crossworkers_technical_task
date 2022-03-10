<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

     /**
     * Get the cars belongs to the category.
     */
    public function cars()
    {
         return $this->hasMany(Car::class);
    }
}
