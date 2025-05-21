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

// выход (только для авторизованных)
Route::get('/logout', [UserController::class, 'logout'])->name('logout.form');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// рабочий стол (только после входа)
Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('tasks', TaskController::class)->except(['index', 'show']);
    Route::resource('categories', CategoryController::class)->only(['create', 'store', 'destroy']);

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
