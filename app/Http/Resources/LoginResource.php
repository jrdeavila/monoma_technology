<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $token = Auth::login($this->resource);
        return [
            'meta' => [
                'success' => true,
                'errors' => [],
            ],
            'data' => [
                'token' => $token,
                'minutes_to_expire' => env('JWT_TTL'),
            ],
        ];
    }
}
