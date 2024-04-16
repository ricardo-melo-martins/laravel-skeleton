<?php

namespace App\Http\Controllers\Api\Public\Accounts;

use App\Http\Handlers\Requests\RegisterRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        $result = ['message' => config('i18n.messages.USER_CREATED')];

        if(config('app.debug')){
            $result['debug'] = $user;
        }

        return response()->json($result, 201);
    }
}
