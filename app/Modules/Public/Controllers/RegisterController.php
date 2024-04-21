<?php

namespace App\Modules\Public\Controllers;

use App\Http\Controllers\ControllerAbstract;
use App\Modules\Authentication\Handlers\Requests\RegisterRequest;
use App\Modules\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class RegisterController extends ControllerAbstract
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

        return $this->responseCreateOk(['message' => config('i18n.messages.USER_CREATED')]);
    }
}
