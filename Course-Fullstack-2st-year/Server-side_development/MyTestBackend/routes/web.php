<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//Маршруты, как будут открываться странички на нашем сайте

use App\Http\Controllers\AuthUserController;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/register', [AuthUserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthUserController::class, 'register']);

Route::get('/login', [AuthUserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthUserController::class, 'login']);

Route::get('/dashboard', [AuthUserController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::post('/logout', [AuthUserController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return redirect()->route('dashboard'); // или return view('dashboard');
})->name('home');


/*
Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

