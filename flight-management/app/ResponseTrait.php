<?php

namespace App;

trait ResponseTrait
{
    public function successResponse($data = [], $message = 'Operation successful', $status = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'errors' => null,
        ], $status);
    }

    public function errorResponse($message = 'Something went wrong', $errors = [], $status = 400): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => null,
            'errors' => $errors,
        ], $status);
    }
}
