<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Profile\ProfileRequest;
use App\Http\Resources\Api\V1\ProfileResource;
use App\Services\DepositService;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct(
        protected DepositService $depositService,
        protected ProfileService $profileService,
    ){

    }
    public function show(Request $request)
    {
        $this->authorize('view', $request->user());

        return new ProfileResource($request->user());
    }

    public function update(ProfileRequest $request)
    {
        $user = $request->user();

        $this->profileService->editingProfile($user, $request->validated(), $request->file('avatar'));

        return new ProfileResource($user);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Вы вышли из системы!']);
    }

    public function deposit(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:1']
        ]);

        $this->depositService->deposit($user, $data['amount']);

        return response()->json(['message' => "Вы пополнили баланс на: $data[amount] р. "]);

    }
}
