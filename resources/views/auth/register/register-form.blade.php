@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm mt-5">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Регистрация в SkillTask</h2>

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.store') }}">
                        @csrf

                        {{-- Имя --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Имя</label>
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required autofocus>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Роль --}}
                        <div class="mb-3">
                            <label for="role" class="form-label">Роль</label>
                            <select id="role" name="role"
                                    class="form-select @error('role') is-invalid @enderror"
                                    required>
                                <option value="" disabled selected hidden>--Выберите значение--</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->value }}"
                                        {{ old('role') == $role->value ? 'selected' : '' }}>
                                        {{ $role->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Пароль --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Подтверждение пароля --}}
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
                            <input id="password_confirmation" type="password"
                                   class="form-control"
                                   name="password_confirmation" required>
                        </div>

                        {{-- Кнопка регистрации --}}
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">
                                Зарегистрироваться
                            </button>
                        </div>
                    </form>

                    {{-- Ссылки --}}
                    <div class="text-center mt-3">
                        <span>Уже есть аккаунт?</span>
                        <a href="{{ route('login') }}">Войти</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
