@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Редактирование задачи</h2>
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Название</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" id="description" name="description">{{ $task->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Категория</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ $task->category->name ?? 'Без категории' }}">
        </div>

        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>

    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="margin-top: 10px;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Удалить задачу</button>
    </form>
</div>
@endsection
