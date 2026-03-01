<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>SkillTask</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .app-bg {
            min-height: 100vh;
            background: linear-gradient(135deg, #eef2f3, #d9e2ec);
        }

        .card-hover:hover {
            transform: translateY(-3px);
            transition: 0.2s;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body class="app-bg">
<header>
    @include('partials.navbar')
</header>


<main class="container mt-4">
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
