<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My Project')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/view-register.css') }}">
</head>
<body>
    {{-- Голова --}}
    <header>
        {{--  --}}
    </header>

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

</body>
</html>
