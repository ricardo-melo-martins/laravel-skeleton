<?php
namespace App\Modules\Authentication\Interfaces;

use App\Modules\Authentication\Handlers\Requests\LoginRequest;
use Illuminate\Http\Resources\Json\JsonResource;

interface ILogin
{
    public function login(LoginRequest $request): JsonResource;
}
