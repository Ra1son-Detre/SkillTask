<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\web\User\ProfileEditRequest;
use App\Services\DepositService;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct(
        protected ProfileService $profileService,
        protected DepositService $balanceService,
    ) {
    }

    public function show()
    {
        $user = auth()->user();

        $tasks = $user->tasks;

        $notifications = $user->unreadNotifications;

        return view('user.profile', compact('user', 'notifications', 'tasks'));
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function edit()
    {
        $user = auth()->user();

        return view('user.profile-edit', compact('user'));
    }

    public function update(ProfileEditRequest $request)
    {
        $this->profileService->editingProfile($request->user(), $request->validated(), $request->file('avatar'));

        return redirect('profile')->with('success', 'Профиль обновлён');
    }

    public function deposit(Request $request)
    {
        $data = $request->validate([
            'amount' => [
                'required',
                'numeric',
                'min:1',
            ],
        ]);

        $this->balanceService->deposit($request->user(), $data['amount']);

        return redirect()
            ->route('user.profile')
            ->with('success', 'Баланс пополнен');
    }
}
