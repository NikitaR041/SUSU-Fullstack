<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My Project')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/view-register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/view-dashboard.css') }}">
</head>
<body>
    {{-- Голова --}}
    {{-- <header>
    </header> --}}

    {{-- Основа --}}
    <main>
        @yield('content')
    </main>

    {{-- Подвал --}}
    <footer class="site-footer">
            <div class="container">
                {{-- Необязательно такое прописывать --}}
                {{-- &copy; 2025 MyProject --}}
            </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
