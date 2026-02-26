<nav class="navbar navbar-expand-lg navbar-dark bg-transparent py-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            SkillTask
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto align-items-center gap-3">

                @auth
                    <li class="nav-item">
                        <a href="#" class="nav-link">Мои задачи</a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="btn btn-light btn-sm px-4 rounded-pill">
                            Профиль
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-light px-4 rounded-pill">
                            Войти
                        </a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
