<?php

namespace App\Http\Resources;

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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'user_name' => $this->user_name,
            'type' => $this->type,
            'is_active' => $this->is_active,
            'avatar' => $this->avatar,
            'token' => $this->token,
            'created_at' => $this->created_at,
        ];
    }
}
