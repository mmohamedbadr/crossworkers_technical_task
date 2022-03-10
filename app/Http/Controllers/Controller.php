<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function response($data = [])
    {
        $statusCode = Response::HTTP_OK;
        if (isset($data['statusCode'])) {
            $statusCode = $data['statusCode'];
            unset($data['statusCode']);
        } else if (isset($data['ok']) && $data['ok'] == false) {
            $statusCode = Response::HTTP_BAD_REQUEST;
        }
        $dataOut = $data;
        return response($dataOut, $statusCode);
    }
}
