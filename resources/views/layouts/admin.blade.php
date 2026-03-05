<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container-fluid">

    <div class="row">

        {{-- Sidebar --}}
        <div class="col-2 bg-dark text-white min-vh-100 p-3">

            <h4 class="mb-4">Admin</h4>

            <ul class="nav flex-column">

                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.users') }}">
                        Users
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.tasks') }}">
                        Tasks
                    </a>
                </li>

            </ul>

        </div>

        {{-- Content --}}
        <div class="col-10 p-4">

            @yield('content')

        </div>

    </div>

</div>

</body>
</html>
