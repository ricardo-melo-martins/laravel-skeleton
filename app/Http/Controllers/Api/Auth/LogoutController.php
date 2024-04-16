<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
 
    public function logout(Request $request): JsonResponse
    {
        Auth::logout();
        
        return response()->json(['message' => config('i18n.messages.USER_LOGOUT_SUCCESS')]);
    }

}

