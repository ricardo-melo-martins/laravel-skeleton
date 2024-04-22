<?php

namespace App\Commons\Dtos;

use Illuminate\Contracts\Support\Arrayable;

abstract class DtoAbstract implements Arrayable
{
    public function toArray(): array
    {
        return collect($this)
            ->map(fn ($value) => $value instanceof Arrayable ? $value->toArray() : $value)
            ->all();
    }

}
