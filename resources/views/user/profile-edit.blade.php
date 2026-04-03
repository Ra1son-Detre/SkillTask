@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm mt-5">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Редактирование профиля</h2>

                    <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        {{-- Текущий аватар --}}
                        @if($user->avatar)
                            <div class="mb-3 text-center">
                                <img src="{{ asset('storage/' . $user->avatar) }}" width="120" class="rounded">
                            </div>
                        @endif

                        {{-- Имя --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Имя</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}"
                                required
                            >
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Аватар --}}
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Аватар</label>
                            <input
                                type="file"
                                name="avatar"
                                id="avatar"
                                class="form-control @error('avatar') is-invalid @enderror"
                            >
                            @error('avatar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Старый пароль --}}
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Старый пароль</label>
                            <input
                                type="password"
                                name="old_password"
                                id="old_password"
                                class="form-control @error('old_password') is-invalid @enderror"
                                placeholder="Введите текущий пароль, если хотите сменить"
                            >
                            @error('old_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Новый пароль --}}
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Новый пароль</label>
                            <input
                                type="password"
                                name="new_password"
                                id="new_password"
                                class="form-control @error('new_password') is-invalid @enderror"
                                placeholder="Оставьте пустым, если не хотите менять"
                            >
                            @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Сохранить изменения</button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('user.profile') }}">Назад к профилю</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
