<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController
{
    //Показывать форму регистрации
    public function create(){
        return view('pages.auth.register');
    }

    // Сохраняем нового пользователя в базе
    public function store(Request $request){
        // Валидация данных
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:4|confirmed', // Пароль и подтверждение
        ]);

        // Создаем нового пользователя
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Хэшируем пароль
        ]);

        // return redirect('/login'); // Перенаправляем на страницу входа
        // Перенаправление (например, на главную)
        Auth::login($user);
        return redirect()->route('dashboard');
    }

    //Показывать форму входа
    public function showLoginForm(){
        return view('pages.auth.login');
    }

    //Вход пользователя - логика
    public function login(Request $request)
    {
        // Валидация данных формы
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // Попытка авторизации
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();          // защита от фиксации сессии - меняем ID
            return redirect()->route('dashboard');      // на рабочий стол
        }

        // Ошибка: возвращаемся назад с сообщением
        return back()->withErrors([
            'email' => 'Неверный email или пароль.',
        ])->onlyInput('email');
    }

    /** Выход */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); //Обнуляем сессию - защита от кражи
        $request->session()->regenerateToken(); //Новый CSRF-токен
        return redirect()->route('cover');
    }

}


