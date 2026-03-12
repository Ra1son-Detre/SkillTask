<nav class="navbar navbar-dark bg-dark shadow-sm position-relative">
    <div class="container-fluid">

        <a class="navbar-brand position-absolute start-50 translate-middle-x"
           href="{{ route('admin.dashboard') }}">
            SkillTask Admin
        </a>

        <div class="ms-auto d-flex align-items-center gap-2">

            @auth
                <form action="{{ route('user.logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        Выйти
                    </button>
                </form>

            @endauth

        </div>

    </div>
</nav>
