@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <h2>Регистрация</h2>

    <form method="POST" action="{{ route('register') }}">
    {{-- <form method="POST" action="{{ url('/register') }}"> --}}
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
@endsection
