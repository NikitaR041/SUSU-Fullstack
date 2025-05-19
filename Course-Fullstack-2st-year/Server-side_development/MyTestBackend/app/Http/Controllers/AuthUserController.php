<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthUserController extends Controller
{
    //Функция-регистрации нового пользователя в таблицу User
    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // важно!
            //'password' => $request->password,
        ]);

        //redirect - перенаправление с одной страницы на другое
        return redirect()->route('login')->with('success', 'Вы зарегистрированы!');
    }

    //Функция-логин - повторный вход пользователя по логину и паролю
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        //Здесь Ларавель проверяет на логин и пароль
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }
        //back - хелпер - обратно вернуться 
        return back()->withErrors(['email' => 'Неверный email или пароль']);
    }

    //Функция-выход - выход с аккаунта
    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

    //Отображения
    public function showRegisterForm() {
        return view('authorization.register');
    }

    public function showLoginForm() {
        return view('authorization.login');
    }

    public function dashboard() {
        return view('dashboard');
    }
}
