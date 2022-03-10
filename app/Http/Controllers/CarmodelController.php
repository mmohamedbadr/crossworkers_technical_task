<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarmodelRequest;
use App\Http\Requests\UpdateCarmodelRequest;
use App\Models\Carmodel;

class CarmodelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarmodelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarmodelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carmodel  $carmodel
     * @return \Illuminate\Http\Response
     */
    public function show(Carmodel $carmodel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carmodel  $carmodel
     * @return \Illuminate\Http\Response
     */
    public function edit(Carmodel $carmodel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarmodelRequest  $request
     * @param  \App\Models\Carmodel  $carmodel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarmodelRequest $request, Carmodel $carmodel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carmodel  $carmodel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carmodel $carmodel)
    {
        //
    }
}
