<nav class="navbar navbar-expand-lg navbar-dark bg-dark position-relative shadow-sm">
    <div class="container-fluid">

        {{-- Центрированный логотип --}}
        <a class="navbar-brand position-absolute start-50 translate-middle-x"
           href="{{ route('tasks.index') }}">
            SkillTask
        </a>

        {{-- Контейнер справа --}}
        <div class="ms-auto d-flex align-items-center gap-2">

            @auth

                @php
                    $notifications = auth()->user()->unreadNotifications;
                    $count = $notifications->count();
                @endphp

                {{-- Колокольчик --}}
                <div class="dropdown">

                    <button class="btn btn-outline-light btn-sm position-relative"
                            data-bs-toggle="dropdown">

                        🔔

                        @if($count > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $count }}
                            </span>
                        @endif

                    </button>

                    {{-- Dropdown уведомлений --}}
                    <ul class="dropdown-menu dropdown-menu-end shadow">

                        <li class="dropdown-header">
                            Уведомления
                        </li>

                        @forelse($notifications as $notification)

                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('tasks.show', [
                                        'task' => $notification->data['task_id'],
                                        'notification' => $notification->id
                                   ]) }}">

                                    {{ $notification->data['message'] }}

                                </a>
                            </li>

                        @empty

                            <li>
                                <span class="dropdown-item text-muted">
                                    Нет уведомлений
                                </span>
                            </li>

                        @endforelse

                    </ul>

                </div>

                {{-- Профиль --}}
                <a href="{{ route('user.profile') }}" class="d-flex align-items-center text-decoration-none">

                    <img
                        src="{{ auth()->user()->avatar
            ? asset('storage/' . auth()->user()->avatar)
            : asset('storage/avatars/default-avatar.png') }}"
                        alt="avatar"
                        class="rounded-circle border border-light"
                        width="38"
                        height="38"
                        style="object-fit: cover;"
                    >

                </a>

                {{-- Logout --}}
                <form action="{{ route('user.logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        Выйти
                    </button>
                </form>

            @endauth


            @guest

                @if(Route::currentRouteName() == 'login')

                    <a href="{{ route('register.create') }}" class="btn btn-light btn-sm text-dark">
                        Регистрация
                    </a>

                @elseif(Route::currentRouteName() == 'register.create')

                    <a href="{{ route('login.try') }}" class="btn btn-light btn-sm text-dark">
                        Войти
                    </a>

                @else

                    <a href="{{ route('login') }}" class="btn btn-light btn-sm text-dark">
                        Войти
                    </a>

                    <a href="{{ route('register.create') }}" class="btn btn-outline-light btn-sm">
                        Регистрация
                    </a>

                @endif

            @endguest

        </div>

    </div>
</nav>
