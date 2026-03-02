<nav class="navbar navbar-expand-lg navbar-dark bg-dark position-relative">
    <div class="container-fluid">

        {{-- Центрированный логотип --}}
        <a class="navbar-brand position-absolute start-50 translate-middle-x"
           href="{{ route('tasks.index') }}">
            SkillTask
        </a>

        @auth
            {{-- Блок справа --}}
            <div class="ms-auto d-flex align-items-center gap-3">

                <a href="{{ route('user.profile') }}"
                   class="btn btn-outline-light btn-sm">
                    Профиль
                </a>

                <form action="{{ route('user.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        Выйти
                    </button>
                </form>

            </div>
        @endauth

    </div>
</nav>
