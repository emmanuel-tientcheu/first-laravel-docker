<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendResponse($data, $message = null, $code = 200)

    {
        $response = [
            'success' => true,
            'message' => $message,
            'data'    => $data,
            'code' => $code,
        ];


        return response()->json($response, );
    }

    public function sendError($errorMessage, $errorMessages = [], $code = 403)
    {
        $response = [
            'success' => false,
            'message' => $errorMessage,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
