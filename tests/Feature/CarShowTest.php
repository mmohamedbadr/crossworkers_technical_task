<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarShowTest extends TestCase
{
    /**
     * A basic feature test show Car Success .
     *
     * @return void
     */
    public function test_show_car_success()
    {
        $id =1;
        $response = $this->get('/api/v1/cars/'.$id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'ok',
            'message',
            'errors',
            'items' => [
                '*' => [
                    "id",
                    "name",
                    "brand",
                    "category",
                    "model",
                    "engine_name",
                    "engine_horsepower",
                    "engine_capacity",
                    "engine_cylinder",
                    "color",
                    "details",
                    "has_gas_economy",
                    "has_abs",
                    "doors_no",
                    "max_speed",
                    "transimation",
                ],
            ],
        ]);
    }

     /**
     * A basic feature test show Car Fail .
     *
     * @return void
     */
    public function test_show_car_fail()
    {
        $id =rand(1000,10000);
        $response = $this->get('/api/v1/cars/'.$id);
        $response->assertStatus(400);
    }
}
