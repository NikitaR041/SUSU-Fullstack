<!DOCTYPE html>
<html>
<head>
    <title>Вход</title>
</head>
<body>
    <h1>Вход</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Пароль:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Войти</button>
    </form>

    @if ($errors->any())
        <div>
            <p style="color: red;">{{ $errors->first() }}</p>
        </div>
    @endif

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
</body>
</html>
