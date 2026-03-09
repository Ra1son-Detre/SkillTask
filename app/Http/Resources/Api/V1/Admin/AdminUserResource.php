<?php

namespace App\Http\Resources\Api\V1\Admin;

use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminUserResource extends JsonResource
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
            'email' => $this->email,
            'role' => $this->role->label(),
            'tasks' => $this->role === UserRole::CLIENT ? AdminUserTasksResource::collection($this->whenLoaded('clientTasks')) :  AdminUserTasksResource::collection($this->whenLoaded('executorTasks')),
            'is_blocked' => $this->is_blocked ? 'Заблокирован' : 'Активен',
            'balance' => $this->balance,
            'created_at' => $this->created_at,

        ];
    }
}
