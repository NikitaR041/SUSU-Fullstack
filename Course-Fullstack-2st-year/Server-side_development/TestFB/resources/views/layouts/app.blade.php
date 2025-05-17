<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My App')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>Мой сайт</h1>
        <nav>
            <a href="/">Главная</a>
            <a href="/register">Регистрация</a>
            <a href="/users">Пользователи</a>
        </nav>
    </header>

    <main>
        @yield('content') {{-- Здесь будет отображаться содержимое каждой страницы --}}
    </main>
</body>
</html>

