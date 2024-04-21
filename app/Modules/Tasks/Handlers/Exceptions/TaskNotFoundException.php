<?php

namespace App\Modules\Tasks\Handlers\Exceptions;

use Exception;
use Illuminate\Http\Request;

class TaskNotFoundException extends Exception
{
    public function render(Request $request)
    {
        return response()->json([
            'errors' => [
                [
                    'title' => config('i18n.messages.TASK_NOT_FOUND'),
                    'detail' => $this->getMessage(),
                    'status' => '204'
                ]
            ]
        ], 204);
    }
}
