@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Редактирование аккаунта</h2>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Имя пользователя</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Почта</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Новый пароль</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Введите новый пароль">
        </div>
        <button type="submit" class="btn btn-success">Сохранить изменения</button>
    </form>

    <form action="{{ route('profile.delete') }}" method="POST" style="margin-top: 20px;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Удалить аккаунт</button>
    </form>
</div>
