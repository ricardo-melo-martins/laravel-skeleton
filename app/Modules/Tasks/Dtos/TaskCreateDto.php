<?php

namespace App\Modules\Tasks\Dtos;

use App\Modules\Tasks\Enums\TaskStatusEnum;
use Carbon\Carbon;
use Spatie\LaravelData\Data;

class TaskCreateDto extends Data
{
    public function __construct(
        public string         $name,
        public string         $description,
        public ?Carbon        $delivery_date,
        public TaskStatusEnum $status,
    )
    {
    }
}
