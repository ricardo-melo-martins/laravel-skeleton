<?php

namespace App\Http\Controllers\Api\Public\Auth;

use App\Http\Handlers\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(LoginRequest $request): JsonResource
    {

        $user = User::whereEmail($request['email'])->first();

        if (!$user || !Hash::check($request['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => [config('i18n.messages.AUTH_FAILED')]
            ]);
        }

        $tokenBearer = auth()->login($user, $request['password']);

        // TODO: adicionar o dispositivo
        // $deviceInfo = $request->header('User-Agent', 'Unknown');
        // $tokenResult = $user->createToken($deviceInfo);
        // $tokenText = $tokenResult->plainTextToken;

        $expires_at = Carbon::now()->addWeeks(1);
        
        $dataResponse = (object)[
            'user' => $user,
            'token' => $tokenBearer,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($expires_at)->toDateTimeString(),
        ];

        return LoginResource::make($dataResponse);
    }
}
