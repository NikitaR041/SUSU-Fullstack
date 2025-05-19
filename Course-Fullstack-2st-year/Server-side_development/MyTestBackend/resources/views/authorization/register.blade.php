<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
</head>
<body>
    <h1>Регистрация</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label>Имя:</label>
        <input type="text" name="name" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Пароль:</label>
        <input type="password" name="password" required><br>

        <label>Подтвердите пароль:</label>
        <input type="password" name="password_confirmation" required><br>

        <button type="submit">Зарегистрироваться</button>
    </form>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color: red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
