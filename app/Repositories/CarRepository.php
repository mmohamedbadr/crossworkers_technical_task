<?php

namespace App\Repositories;

use App\Interfaces\CarRepositoryInterface;
use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;

class CarRepository extends BaseRepository implements CarRepositoryInterface{

    /**
     * model
     *
     * @var mixed
     */
    protected $model;

    /**
     * __construct
     *
     * @param  mixed $model
     * @return void
     */
    public function __construct(Car $model)
    {
        $this->model = $model;
    }

    public function transform($cars): array
    {
        $cars->transform(function ($car) {
            return [
                'id'=>$car->id,
                'name' => sprintf('%s %s', $car->brand->name, $car->carmodel->name),
                'brand'=> $car->brand->name,
                'category'=> $car->category->name,
                'model'=> $car->carmodel->name,
                'engine_name'=> $car->engine->name,
                'engine_horsepower'=> $car->engine->horsepower,
                'engine_capacity'=> $car->engine->capacity,
                'engine_cylinder'=> $car->engine->cylinder,
                'color'=> $car->color,
                'details'=> $car->details,
                'has_gas_economy'=> $car->has_gas_economy,
                'has_abs'=> $car->has_abs,
                'doors_no'=> $car->doors,
                'max_speed'=>$car->max_speed,
                'transimation'=>$car->transimation
            ];
        });
        return $cars->toArray();
    }

}
