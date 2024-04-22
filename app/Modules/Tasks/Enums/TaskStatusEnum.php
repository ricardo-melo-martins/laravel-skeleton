<?php

namespace App\Modules\Tasks\Enums;

enum TaskStatusEnum: string
{
    case UNDEFINED = 'indefinido';
    case PENDING = 'pendente';
    case IN_PROGRESS = 'em_progresso';
    case FINISHED = 'finalizada';
}
