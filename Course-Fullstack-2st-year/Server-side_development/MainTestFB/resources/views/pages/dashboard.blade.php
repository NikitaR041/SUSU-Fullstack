@extends('layouts.app')

@section('content')
<div class="header">
    <div>
        <span>👤 Зашел: {{ Auth::user()->name }}</span>
    </div>
    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Редактировать аккаунт</a>
    <a href="{{ route('logout') }}" class="btn btn-secondary">Выход</a>
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
    </div>

    <div class="main-content">
        <div class="task-board">
            @forelse ($tasks as $task)
            {{-- <div class="task-card"
                style="cursor: pointer;"
                data-id="{{ $task->id }}"
                data-title="{{ $task->title }}"
                data-description="{{ $task->description }}"
                data-category="{{ $task->category->name ?? 'Без категории' }}"
                data-bs-toggle="modal"
                data-bs-target="#viewTaskModal">
                <h5>{{ $task->title }}</h5>
                @if($task->description)
                    <p style="font-size: 0.9em; color: #555;">{{ $task->description }}</p>
                @endif
                <div style="font-size: 0.8em; margin-top: 5px;">
                    Категория: {{ $task->category->name ?? 'Без категории' }}
                </div>
            </div> --}}
            <div class="task-card"
                style="cursor: pointer;"
                onclick="window.location.href='{{ route('tasks.show', $task->id) }}'">
                <h5>{{ $task->title }}</h5>
                @if($task->description)
                    <p style="font-size: 0.9em; color: #555;">{{ $task->description }}</p>
                @endif
                <div style="font-size: 0.8em; margin-top: 5px;">
                    Категория: {{ $task->category->name ?? 'Без категории' }}
                </div>
            </div>

            @empty
                <p style="padding: 20px;">Нет задач</p>
            @endforelse
        </div>
    </div>
</div>

<!-- 1 Модальное окно - создание карточки -->
<div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="createTaskModalLabel">
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

<!-- Модальное окно просмотра задачи -->
{{-- <div class="modal fade" id="viewTaskModal" tabindex="-1" aria-labelledby="viewTaskModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="viewTaskModalLabel">Просмотр задачи</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>
        <div class="modal-body">
            <h5 id="taskTitle"></h5>
            <p id="taskDescription" style="margin-top: 10px;"></p>
            <p><strong>Категория:</strong> <span id="taskCategory"></span></p>

            <input type="hidden" id="taskId">
            <div class="mb-3">
                <label for="taskTitleInput" class="form-label">Название</label>
                <input type="text" class="form-control" id="taskTitleInput">
            </div>
            <div class="mb-3">
                <label for="taskDescriptionInput" class="form-label">Описание</label>
                <textarea class="form-control" id="taskDescriptionInput"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button id="deleteTaskBtn" data-url="{{ route('tasks.destroy', $task->id) }}" class="btn btn-danger">Удалить</button>
            <button id="saveTaskBtn" data-url="{{ route('tasks.update', $task->id) }}" class="btn btn-primary">Сохранить изменения</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        </div>
    </div>
  </div>
</div>

document.addEventListener('DOMContentLoaded', function () {
    const viewTaskModal = document.getElementById('viewTaskModal');

    // При открытии модального окна
    viewTaskModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const title = button.getAttribute('data-title');
        const description = button.getAttribute('data-description');
        const category = button.getAttribute('data-category');

        // Заполняем скрытое поле ID
        document.getElementById('taskId').value = id;

        // Заполняем поля редактирования
        document.getElementById('taskTitleInput').value = title;
        document.getElementById('taskDescriptionInput').value = description;

        // Обновляем URL у кнопок
        document.getElementById('deleteTaskBtn').setAttribute('data-url', `/tasks/${id}`);
        document.getElementById('saveTaskBtn').setAttribute('data-url', `/tasks/${id}`);

        // Для отображения текста (если используется)
        document.getElementById('taskTitle').textContent = title;
        document.getElementById('taskDescription').textContent = description;
        document.getElementById('taskCategory').textContent = category;
    });


    // Удаление задачи
    document.body.addEventListener('click', function (event) {
        if (event.target.id === 'deleteTaskBtn') {
            const url = event.target.getAttribute('data-url');

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      alert('Задача удалена!');
                      window.location.reload();
                  } else {
                      alert('Ошибка при удалении');
                  }
              });
        }

        // Сохранение изменений
        if (event.target.id === 'saveTaskBtn') {
            const url = event.target.getAttribute('data-url');
            const title = document.getElementById('taskTitleInput').value;
            const description = document.getElementById('taskDescriptionInput').value;

            fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ title, description })
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      alert('Задача обновлена!');
                      window.location.reload();
                  } else {
                      alert('Ошибка при сохранении');
                  }
              });
        }
    });
}); --}}

{{-- <script src="{{ asset('resources/js/app.js') }}"></script> --}}
