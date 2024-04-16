<?php

namespace App\Http\Controllers\Api\Auth\Services;

use App\Models\User;

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

}
