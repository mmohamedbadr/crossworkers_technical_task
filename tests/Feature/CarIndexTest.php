<?php

namespace Tests\Feature;

use Illuminate\Support\Arr;
use Tests\TestCase;

class CarIndexTest extends TestCase
{
    /**
     * A basic feature test get Cars .
     *
     * @return void
     */
    public function test_get_all_cars()
    {
        $response = $this->get('/api/v1/cars');
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
     * A basic feature test get Cars with paginate .
     *
     * @return void
     */
    public function test_get_cars_with_paginate()
    {
        $data = ['per_page' => 10, 'current_page' => 1];
        $response = $this->get('/api/v1/cars?' . Arr::query($data));
        $response->assertStatus(200);
    }

    /**
     * A basic feature test get Cars with filter by doors number .
     *
     * @return void
     */
    public function test_get_cars_with_filter_by_doors_number()
    {
        $data = ['doors[]' => 2];
        $response = $this->get('/api/v1/cars?' . Arr::query($data));
        $response->assertStatus(200);
        $res_array = json_decode($response->content());
        if (!empty($res_array->items)) {
            $res_array_filter = Arr::where($res_array->items, function ($value, $key) {
                return $value->doors_no != 2;
            });
        }
        $response->assertStatus((empty($res_array_filter)) ? 200 : 400);
    }

      /**
     * A basic feature test get Cars with filter by doors number .
     *
     * @return void
     */
    public function test_get_cars_with_filter_by_engine_horsepower()
    {
        $data = ['engine[horsepower]' => 115];
        $response = $this->get('/api/v1/cars?' . Arr::query($data));
        $res_array = json_decode($response->content());
        $response->assertStatus(200);
        $res_array = json_decode($response->content());
        if (!empty($res_array->items)) {
            $res_array_filter = Arr::where($res_array->items, function ($value, $key) {
                return $value->engine_horsepower != 115;
            });
        }
        $response->assertStatus((empty($res_array_filter)) ? 200 : 400);
    }
}
