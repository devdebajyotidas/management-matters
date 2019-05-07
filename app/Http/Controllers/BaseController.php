<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected function success($data, $message, $code = 200){
        $response['success'] = true;
        $response['message'] = $message;
        $response['data']= $data;

        return response()->json($response, $code);
    }

    protected function error($message){
        $response['success'] = false;
        $response['message'] = $message;
        $response['data'] = [];

        return response()->json($response, 400);
    }
}
