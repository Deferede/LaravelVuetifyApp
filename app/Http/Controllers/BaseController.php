<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @param $data
     * @param string $message
     * @return JsonResource|JsonResponse
     */
    public function sendResponse($data, string $message = '')
    {
        if ($data instanceof JsonResource) {
            return $data->additional([
                'success' => true,
                'message' => $message,
            ]);
        }

        $response = [
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @param $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError(string $error, array $errorMessages = [], int $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
