<?php

namespace App\Modules\Public\Controllers;

use App\Http\Controllers\ControllerAbstract;
use App\Modules\Authentication\Resources\LoginResource;
use App\Modules\Authentication\Handlers\Requests\LoginRequest;
use App\Modules\Authentication\Interfaces\ILogin;
use App\Modules\Authentication\Services\AuthService;
use Illuminate\Validation\ValidationException;

class LoginController extends ControllerAbstract implements ILogin
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request): LoginResource
    {
        return $this->authService->login($request['email'], $request['password']);
    }
}
