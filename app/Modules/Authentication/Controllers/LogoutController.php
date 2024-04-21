<?php

namespace App\Modules\Authentication\Controllers;

use App\Http\Controllers\ControllerAbstract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class LogoutController extends ControllerAbstract
{

    public function logout(Request $request): JsonResponse
    {
        Auth::logout();

        return $this->responseOk(Lang::get('auth.logout'));
    }

}

