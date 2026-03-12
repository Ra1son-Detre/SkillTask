@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm mt-5">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Профиль пользователя</h2>

                    <p><strong>Имя:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Роль:</strong> {{ $user->role?->label() ?? '-' }}</p>
                    <p><strong>Баланс:</strong> {{ $user->balance }}</p>

                    <div class="d-flex justify-content-between mb-3">
                        <a href="{{ route('user.profile.edit') }}" class="btn btn-primary">
                            Редактировать профиль
                        </a>

                        <form method="POST" action="{{ route('user.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Выйти</button>
                        </form>
                    </div>

                    @include('partials._notifications')

                    <div class="text-center mt-3">
                        <a href="{{ route('tasks.index') }}">На главную</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

