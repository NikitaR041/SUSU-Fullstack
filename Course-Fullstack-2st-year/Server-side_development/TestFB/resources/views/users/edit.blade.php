@extends('layouts.app')

@section('title', 'Обновление пароля')

@section('content')
    <h2>Редактирование пользователя</h2>

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <label for="name">Имя:</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

        <label for="password">Новый пароль (если нужно):</label>
        <input type="password" name="password">

        <label for="password_confirmation">Подтверждение пароля:</label>
        <input type="password" name="password_confirmation">

        <button type="submit">Сохранить</button>
    </form>
@endsection
