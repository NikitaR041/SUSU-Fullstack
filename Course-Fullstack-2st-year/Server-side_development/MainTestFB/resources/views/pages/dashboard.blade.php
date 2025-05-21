{{-- @extends('layouts.app')
@section('title', 'Рабочий стол')

@section('content')
    <h2>Добро пожаловать, {{ auth()->user()->name }}!</h2>
    <p>Здесь будет ваш рабочий стол.</p>
    <a href="{{ route('logout.form') }}" class="btn btn-secondary">Выход</a>
@endsection --}}

{{-- @extends('layouts.app')

@section('content')
<div class="dashboard-header">
    <div class="user-info">
        <strong>👤 Зашёл: {{ Auth::user()->name }}</strong>
    </div>
    <div class="user-actions">
        <a href="{{ route('register.form') }}" class="btn btn-primary">Регистрация</a>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <a href="{{ route('cover') }}" class="btn btn-primary">Выйти</a>
        </form>
    </div>
</div>

<div class="container">
    <!-- Ваш основной контент здесь -->
</div>
@endsection --}}

                {{-- <a href="{{ route('register.form') }}" class="btn btn-primary">Регистрация</a> --}}
                {{-- <a href="{{ route('login.form') }}" class="btn btn-secondary">Вход</a> --}}

@extends('layouts.app')

@section('content')
<div class="header">
    <div>
        <span>👤 Зашел: {{ Auth::user()->name }}</span>
    </div>
    <div>
        <a href="{{ route('logout') }}" class="sidebar-button">Выход</a>
    </div>
</div>

<div class="dashboard-container">
    <div class="sidebar">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createTaskModal">
            Создать задачу
        </button>
        <form method="GET" action="{{ route('dashboard') }}">
            <select name="category" class="category-filter" onchange="this.form.submit()">
                <option value="">Все категории</option>
                @foreach($tasks as $task)
                    <div class="task-card">
                        <div>{{ $task->title }}</div>
                        <div style="font-size: 0.8em; margin-top: 5px;">
                            Категория: {{ $task->category->name ?? 'Без категории' }}
                        </div>
                    </div>
                @endforeach
            </select>
        </form>
        <a href="#">Табло</a>
    </div>

    <div class="main-content">
        <div class="task-board">
            @forelse ($tasks as $task)
                <div class="task-card">
                    {{ $task->title }}
                </div>
            @empty
                <p style="padding: 20px;">Нет задач</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Модальное окно -->
<div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="createTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTaskModalLabel">Новая задача</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Название</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="category" class="form-label">Категория (необязательно)</label>
                        <input type="text" class="form-control" name="category" placeholder="Например: учёба, спорт, покупки">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Создать</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
            </div>
        </div>
    </form>
  </div>
</div>

@endsection
