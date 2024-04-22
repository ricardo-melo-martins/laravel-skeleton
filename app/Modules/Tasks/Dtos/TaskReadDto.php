<?php

namespace App\Modules\Tasks\Dtos;

use App\Modules\Tasks\Enums\TaskStatusEnum;
use Carbon\Carbon;
use Spatie\LaravelData\Data;

class TaskReadDto extends Data
{
    public function __construct(
        public int                                     $id,
        public string                                  $name,
        public string                                  $description,
        public ?Carbon                                 $delivery_date,
        public ?Carbon                                 $finished_at,
        public TaskStatusEnum                          $status,
        public ?Carbon                                 $created_at,
        public ?Carbon                                 $modified_at,
    ) {
    }
}
