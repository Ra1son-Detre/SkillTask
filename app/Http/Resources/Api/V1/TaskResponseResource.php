<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResponseResource extends JsonResource
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
            'message' => $this->message,
            'executor' => [
                'id' => $this->executor->id,
                'name' => $this->executor->name,
                'email' => $this->executor->email,
            ],
            'resposnse_at' => $this->created_at,
        ];
    }
}
