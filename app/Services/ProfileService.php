<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
class ProfileService
{
    // Комментарий вынести в константу текст ошибки (ошибку, валидации или изменения)
    public function editingProfile(User $user, array $data, ?UploadedFile $avatar = null)
    {
        if (!blank($data['new_password'])){
            if (!Hash::check($data['old_password'], $user->password)){
                throw ValidationException::withMessages(['old_password' => ['Старое значение пароля не свопадает.']]);
            }

            $user->update(['password' => Hash::make($data['new_password'])]);
        }


        if ($avatar) {

            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // сделать единым методом удаление и запись
            $data['avatar'] = $avatar->store('avatars', 'public');
        }

        $user->update($data);

        return $user;
    }

}
