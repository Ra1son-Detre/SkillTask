@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm mt-5">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Редактирование профиля</h2>

                    <form method="POST" action="{{ route('user.profile.update') }}">
                        @csrf
                        @method('PATCH')

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

                        {{-- Старый пароль --}}
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Старый пароль</label>
                            <input
                                type="password"
                                name="current_password"
                                id="current_password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                placeholder="Введите текущий пароль, если хотите сменить"
                            >
                            @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Новый пароль --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Новый пароль</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Оставьте пустым, если не хотите менять"
                            >
                            @error('password')
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
