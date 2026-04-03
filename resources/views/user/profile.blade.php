@extends('layouts.app')

@section('content')
    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-lg-7">

                {{-- PROFILE CARD --}}
                <div class="card shadow-sm border-0">

                    <div class="card-body p-4">

                        {{-- HEADER --}}
                        <div class="text-center mb-4">

                            <img
                                src="{{ $user->avatar
                                ? asset('storage/' . $user->avatar)
                                : asset('storage/avatars/default-avatar.png') }}"
                                class="rounded-circle shadow-sm border"
                                width="110"
                                height="110"
                                style="object-fit: cover;"
                            >

                            <h4 class="mt-3 mb-0">{{ $user->name }}</h4>
                            <small class="text-muted">{{ $user->email }}</small>

                        </div>

                        {{-- INFO GRID --}}
                        <div class="row text-center mb-4">

                            <div class="col">
                                <div class="p-3 bg-light rounded">
                                    <div class="text-muted small">Роль</div>
                                    <div class="fw-bold">
                                        {{ $user->role?->label() ?? '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="p-3 bg-light rounded">
                                    <div class="text-muted small">Баланс</div>
                                    <div class="fw-bold text-success">
                                        {{ $user->getBalance() }} €
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- ACTIONS --}}
                        <div class="d-flex justify-content-between mb-4">

                            <a href="{{ route('user.profile.edit') }}"
                               class="btn btn-primary w-50 me-2">
                                Редактировать
                            </a>

                            <form method="POST" action="{{ route('user.logout') }}" class="w-50">
                                @csrf
                                <button class="btn btn-outline-danger w-100">
                                    Выйти
                                </button>
                            </form>

                        </div>

                        {{-- DEPOSIT --}}
                        @if (auth()->user()->isClient())
                        <div class="border rounded p-3 mb-4">

                            <h6 class="mb-3">Пополнить баланс</h6>

                            <form method="POST" action="{{ route('user.deposit') }}" class="d-flex gap-2">
                                @csrf

                                <input
                                    type="number"
                                    name="amount"
                                    class="form-control"
                                    placeholder="Сумма"
                                    min="1"
                                    required
                                >

                                <button class="btn btn-success">
                                    Пополнить
                                </button>

                            </form>

                        </div>
                        @endif

                        {{-- NOTIFICATIONS --}}
                        <div class="border-top pt-3">

                            <h6 class="mb-3">Уведомления</h6>

                            @include('partials._notifications')

                        </div>

                        {{-- BACK --}}
                        <div class="text-center mt-3">
                            <a href="{{ route('tasks.index') }}" class="text-muted">
                                ← На главную
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

