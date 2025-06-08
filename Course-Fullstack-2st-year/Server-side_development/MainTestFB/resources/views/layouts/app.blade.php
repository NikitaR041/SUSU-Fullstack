<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My Project')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- JavaScript (AJAX) для редактирования и удаления задач --}}

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

    @if(app()->environment('local'))
        @vite(['resources/js/app.js']) <!-- Для разработки -->
    @else
        <script src="{{ asset('js/app.js') }}"></script> <!-- Для продакшена -->
    @endif
    @stack('scripts')
    {{-- <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts') --}}
</body>
</html>
