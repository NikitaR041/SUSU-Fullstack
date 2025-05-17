{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')

@section('title', 'Регистрация')

{{-- @section('content')
    <h2>Регистрация</h2>

    <form method="POST" action="{{ route('register') }}">
    <form method="POST" action="{{ url('/register') }}">
        @csrf

        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>

        <label for="password_confirmation">Подтверждение пароля:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        <button type="submit">Зарегистрироваться</button>
    </form>
@endsection --}}

{{-- @section('content')
    <section class="view_register">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>

            <label for="password_confirmation">Подтверждение пароля:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>

            <button type="submit">Зарегистрироваться</button>
        </form>
    </section>
@endsection --}}

@section('content')
    <section class="view_register">
        <div class="register-container">
            <img src="/images/logo.png" alt="Логотип TaskDino" class="register-logo">
            <h1 class="register-title">Регистрация</h1>

            <form method="POST" action="{{ route('register') }}" class="register-form">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">Имя</label>
                    <input type="text" id="name" name="name" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
                </div>

                <button type="submit" class="register-button">Зарегистрироваться</button>
            </form>
        </div>
    </section>
@endsection
