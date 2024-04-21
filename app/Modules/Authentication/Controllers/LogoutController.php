<?php

namespace App\Modules\Authentication\Controllers;

use App\Http\Controllers\ControllerAbstract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends ControllerAbstract
{

    public function logout(Request $request): JsonResponse
    {
        Auth::logout();

        return response()->json(['message' => config('i18n.messages.USER_LOGOUT_SUCCESS')]);
    }

}

