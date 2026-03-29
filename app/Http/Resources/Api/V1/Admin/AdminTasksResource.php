<?php

namespace App\Http\Resources\Api\V1\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminTasksResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'status' => $this->status->label(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'client' => [
                'id' => $this->client->id,
                'name' => $this->client->name,
            ],

            'executor' => $this->executor ? [
                'id' => $this->executor->id,
                'name' => $this->executor->name,
            ] : null,
        ];
    }
}
