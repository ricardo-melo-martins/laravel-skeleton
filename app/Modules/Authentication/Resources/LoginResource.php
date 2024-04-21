<?php

namespace App\Modules\Authentication\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'type' => 'users',
            'id' => (string) $this->resource->user->getRouteKey(),
            'attributes' => [
                'user' => [
                    'first_name' => $this->resource->user->first_name,
                    'last_name' => $this->resource->user->last_name,
                    'username' => $this->resource->user->username,
                    'email' => $this->resource->user->email,
                ],
                'token' => $this->resource->token,
                'token_type' => $this->resource->token_type,
                'expires_at' => $this->resource->expires_at,
            ]
        ];
    }
}
