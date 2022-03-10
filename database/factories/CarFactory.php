<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Carmodel;
use App\Models\Category;
use App\Models\Engine;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $brand = Brand::inRandomOrder()->first();
        $carModel = Carmodel::where('brand_id', $brand->id)->inRandomOrder()->first();
        $category = Category::inRandomOrder()->first();
        $engine = Engine::inRandomOrder()->first();
        return [
            'brand_id' => $brand->id,
            'carmodel_id' => $carModel->id,
            'category_id' => $category->id,
            'engine_id'=>$engine->id,
            'color' => $this->faker->hexColor(),
            'details' => $this->faker->text(200),
            'has_gas_economy' => $this->faker->boolean,
            'has_abs' => $this->faker->boolean,
            'doors' =>  $this->faker->randomElement(['2', '4']),
            'max_speed' => (int) $this->faker->randomElement([160, 180, 200, 220, 240]),
            'transimation' => $this->faker->randomElement(['manual', 'auto', 'cvt']),
        ];
    }
}
