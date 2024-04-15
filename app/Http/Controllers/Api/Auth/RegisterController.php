<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Handlers\Requests\RegisterRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::create($data);

        $result = [
            'message' => 'Usuário criado com sucesso',
            'usuario' => $user
        ];

        return response()->json($result, 201);
    }
}
