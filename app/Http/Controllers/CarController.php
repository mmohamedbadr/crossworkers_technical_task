<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarIndexRequest;
use App\Http\Requests\CarShowRequest;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Interfaces\CarRepositoryInterface;
use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request as FacadesRequest;

class CarController extends Controller
{

    /**
     * carRepository
     *
     * @var mixed
     */
    private $carRepository;
    protected $failResponse;
    protected $successResponse;

    public function __construct(CarRepositoryInterface $carReopsitory)
    {
        $this->carRepository = $carReopsitory;
        $this->failResponse = [
            'ok' => false,
            'message' => __('Fail'),
            'errors' => [],
            'statusCode' => Response::HTTP_BAD_REQUEST,
        ];
        $this->successResponse = [
            'ok' => true,
            'message' => __('Success'),
            'errors' => [],
            'statusCode' => Response::HTTP_OK,
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CarIndexRequest $request)
    {
        $sort = FacadesRequest::only('sort_by','sort_order');
        $paginate = FacadesRequest::only('per_page', 'current_page');
        $filtersWithRelation = FacadesRequest::only('engine.horsepower', 'engine.capacity');
        $filters = FacadesRequest::only('brand_id', 'category_id', 'engine_id', 'carmodel_id', 'has_gas_economy', 'has_abs', 'doors', 'transimation');
        $cars = $this->carRepository->all(['*'], ['brand','category','engine','carmodel'], $paginate, $filters, $filtersWithRelation,$sort);
        $cars = $this->carRepository->transform($cars);
        $response = $this->successResponse;
        $response['items'] = $cars;
        return $this->response($response);
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
     * @param  \App\Http\Requests\StoreCarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(CarShowRequest $request,Car $car)
    {
        $cars = $this->carRepository->findById($request->id,['*'] ,['brand','category','engine','carmodel']);
        $cars = $this->carRepository->transform(collect([$cars]));
        $response = $this->successResponse;
        $response['items'] = $cars;
        return $this->response($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarRequest  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //
    }
}
