<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Хэшируем пароль
        ]);

        // return redirect('/login'); // Перенаправляем на страницу входа
        // Перенаправление (например, на главную)
        return redirect('/')->with('success', 'Регистрация прошла успешно!');
    }
}
