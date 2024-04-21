<?php

namespace App\Modules\Authentication\Services;

use App\Modules\Authentication\Resources\LoginResource;
use App\Modules\Users\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function user()
    {
        $id = auth()->id();
        return User::findOrFail($id);
    }

    public function userId()
    {
        return auth()->id();
    }

    /**
     * @throws ValidationException
     */
    public function login($email, $password): LoginResource
    {

        $user = User::whereEmail($email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => [Lang::get('auth.failed')]
            ]);
        }

        $tokenBearer = auth()->login($user, $password);

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
