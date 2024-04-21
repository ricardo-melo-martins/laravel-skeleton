<?php

namespace App\Modules\Tasks\Handlers\Exceptions;

use Exception;
use Illuminate\Http\Request;

class TaskNotDeleteException extends Exception
{
    public function render(Request $request)
    {
        return response()->json([
            'errors' => [
                [
                    'title' => config('i18n.messages.TASK_DELETE_FAILED'),
                    'detail' => $this->getMessage(),
                    'status' => '204'
                ]
            ]
        ], 204);
    }
}
