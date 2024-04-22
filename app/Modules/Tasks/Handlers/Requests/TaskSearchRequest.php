<?php

namespace App\Modules\Tasks\Handlers\Requests;

use App\Modules\Tasks\Enums\TaskStatusEnum;
use Illuminate\Validation\Rule;

class TaskSearchRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [],
            'description' => [],
            'status' => [Rule::enum(TaskStatusEnum::class)],
            'delivery_date' => [],
            'finished_at' => []
        ];
    }
}
