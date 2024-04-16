<?php 

namespace App\Http\Controllers\Api\Tasks\Exceptions;

use Exception;
use Illuminate\Http\Request;

class TaskNotCreateException extends Exception
{
    public function render(Request $request)
    {
        return response()->json([
            'errors' => [
                [
                    'title' => config('i18n.messages.TASK_CREATE_FAILED'),
                    'detail' => $this->getMessage(),
                    'status' => '204'
                ]
            ]
        ], 204);
    }
}