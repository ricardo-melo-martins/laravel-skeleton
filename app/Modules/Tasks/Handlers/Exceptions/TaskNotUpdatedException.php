<?php

namespace App\Modules\Tasks\Handlers\Exceptions;


use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class TaskNotUpdatedException extends Exception
{
    public function render(Request $request)
    {
        return response()->json([
            'errors' => [
                [
                    'title' => Lang::get('tasks.exceptions.task-not-update'),
                    'detail' => $this->getMessage(),
                    'status' => '204'
                ]
            ]
        ], 204);
    }
}


