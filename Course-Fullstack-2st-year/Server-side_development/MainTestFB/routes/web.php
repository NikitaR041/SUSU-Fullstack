<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController; //?
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('pages.cover');
})->name('cover');

// Регистрация и вход

// доступно только НЕавторизованным
Route::get('/login',  [UserController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/register',  [UserController::class, 'create'])->name('register.form');
Route::post('/register', [UserController::class, 'store'])->name('register');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route::resource('tasks', TaskController::class)->except(['index', 'show']);
    Route::resource('categories', CategoryController::class)->only(['create', 'store', 'destroy']);

    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store'); // Создать задачу
    // Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    // Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');


    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Открыть страницу редактирования
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update'); // Обновить данные
    Route::delete('/profile/delete', [ProfileController::class, 'delete'])->name('profile.delete'); // Удалить аккаунт

    Route::get('/logout', [UserController::class, 'logout'])->name('logout.form');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
