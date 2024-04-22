<?php

namespace App\Modules\Tasks\Handlers\Requests;

use App\Modules\Tasks\Enums\TaskStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskCreateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'description' => ['required'],
            'status' => ['required', Rule::enum(TaskStatusEnum::class)],
        ];
    }

}
