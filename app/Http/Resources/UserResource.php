<?php

namespace App\Http\Resources;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $jwt = JWT::encode($this->resource->toArray(), env("APP_KEY"), 'HS256');
        return [
            'data' => $jwt
        ];
    }
}
