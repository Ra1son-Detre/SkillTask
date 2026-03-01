<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="{{ route('tasks.index') }}">
            SkillTask
        </a>

        @auth
            <div class="ms-auto d-flex align-items-center gap-3">

                <a href="{{ route('user.profile') }}" class="btn btn-outline-light btn-sm">
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
