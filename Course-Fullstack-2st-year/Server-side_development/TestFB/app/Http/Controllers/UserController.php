<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //Показывать форму регистрации
    public function create(){
        return view('auth.register');
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

    // Отображение всех пользователей
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Обновление данных пользователя
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Пользователь обновлён');
    }

    public function edit($id)
    {
    $user = User::findOrFail($id); // Найти пользователя или выдать 404
    return view('users.edit', compact('user')); // Отдать форму с данными
    }


    // Удаление пользователя
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Пользователь удалён');
    }
}
