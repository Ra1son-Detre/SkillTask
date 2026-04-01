<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResponseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
            'executor' => [
                'id' => $this->executor->id,
                'name' => $this->executor->name,
                'email' => $this->executor->email,
            ],
            'responded_at' => $this->created_at,
        ];
    }
}
