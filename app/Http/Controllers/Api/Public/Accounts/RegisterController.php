<?php

namespace App\Http\Controllers\Api\Public\Accounts;

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

        $result = ['message' => config('i18n.messages.USER_CREATED')];

        if(config('app.debug')){
            $result['debug'] = $user;
        }

        return response()->json($result, 201);
    }
}
