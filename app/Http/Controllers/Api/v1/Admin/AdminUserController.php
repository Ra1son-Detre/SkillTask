<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Admin\AdminUserResource;
use App\Models\User;
use App\Queries\AdminUserQuery;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request, AdminUserQuery $query)
    {
        $users = $query->get($request);

        return AdminUserResource::collection($users);
    }

    public function toggleBlock(User $user)
    {
        $user->update([
            'is_blocked' => ! $user->is_blocked,
        ]);

        return response()->json('Успешно');
    }

    public function showUserInfo(User $user)
    {
        if ($user->role === UserRole::CLIENT) {
            $user->load('clientTasks');
        } elseif ($user->role === UserRole::EXECUTOR) {
            $user->load('executorTasks');
        }

        return new AdminUserResource($user);
    }
}
