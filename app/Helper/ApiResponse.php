<?php

namespace App\Helper;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class Response
 *
 * @package \App\Helper
 */
class ApiResponse
{
    public static function instance()
    {
        return new ApiResponse();
    }

    function success($data, $message){
        $response = new Collection();
        $response->success = true;
        $response->message = $message;
        $response->data = $data;

        return response()->json($response);
    }
}