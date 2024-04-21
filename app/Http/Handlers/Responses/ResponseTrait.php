<?php

declare(strict_types=1);

namespace App\Http\Handlers\Responses;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    private mixed $_data;

    public function responseOk(array | string $data, int $statusCode = 200): JsonResponse
    {
        $data = $this->evaluateData($data);
        return response()->json($data, $statusCode);
    }

    public function responseCreateOk(array | string $data, int $statusCode = 201): JsonResponse
    {
        $data = $this->evaluateData($data);
        return response()->json($data, $statusCode);
    }

    public function responseUpdateOk(array | string $data, int $statusCode = 200): JsonResponse
    {
        $data = $this->evaluateData($data);
        return response()->json($data, $statusCode);
    }

    public function responseDeleteOk(array | string $data, int $statusCode = 200): JsonResponse
    {
        $data = $this->evaluateData($data);
        return response()->json($data, $statusCode);
    }

    private function evaluateData(array | string $data): array
    {
        if(gettype($data) === 'string')
        {
            $data = ['message' => $data];

        }

        if(!config('app.debug'))
        {
            if(array_key_exists('debug', $data)){
                unset($data['debug']);
            }
        }

        return $data;
    }

}
