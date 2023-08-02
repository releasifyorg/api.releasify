<?php

namespace App\Support\Parents;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ParentController extends Controller
{
    protected function created($data = null, $message = 'Created', $code = 201): JsonResponse
    {
        return response()->json($data, $code);
    }

    protected function success($data = null, $message = 'Success', $code = 200): JsonResponse
    {
        return response()->json($data, $code);
    }

    protected function noContent($data = null, $message = 'Deleted', $code = 204): JsonResponse
    {
        return response()->json($data, $code);
    }

    protected function error(mixed $data = [], $message = 'Server error', $code = 500): JsonResponse
    {
        return response()->json(
            [
                'message' => $message,
                'data' => $data,
            ],
            $code
        );
    }

    protected function validation(string $message): JsonResponse
    {
        return response()->json(
            [
                'success' => false,
                'message' => 'Validation errors',
                'data' => [
                    'error_messages' => [
                        $message,
                    ],
                ],
            ],
            422
        );
    }
}
