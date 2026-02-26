<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SkillTask')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ====== БАЗА ====== */
        body {
            background: linear-gradient(135deg, #1f3558, #2b4a73);
            min-height: 100vh;
            color: #f1f5f9;
            font-family: 'Inter', sans-serif;
        }

        /* ====== GLASS ====== */
        .glass {
            background: rgba(40, 65, 105, 0.65);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
        }

        /* ====== КАРТОЧКИ ====== */
        .card {
            background: #355a8a;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            color: #ffffff;
            transition: all 0.25s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
        }

        /* ====== КНОПКИ ====== */
        .btn-primary {
            background: #60a5fa;
            border: none;
            border-radius: 50px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.2s ease;
            color: #0f172a;
        }

        .btn-primary:hover {
            background: #3b82f6;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
        }

        /* ====== NAVBAR ====== */
        .navbar {
            background: rgba(30, 50, 85, 0.85);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* ====== ТЕКСТ ====== */
        h1, h2, h3, h4, h5 {
            font-weight: 600;
        }

        .text-muted {
            color: #d1d5db !important;
        }
    </style>
</head>
<body>

@include('partials.header')

<div class="container py-5">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
