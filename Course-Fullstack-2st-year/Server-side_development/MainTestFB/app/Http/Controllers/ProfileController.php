<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// class ProfileController extends Controller
// {
//     public function edit()
//     {
//         return view('profile.edit', ['user' => Auth::user()]); // ???
//     }

//     public function update(Request $request)
//     {
//         $user = Auth::user();

//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|unique:users,email,'.$user->id,
//             'password' => 'nullable|string|min:4|confirmed',
//         ]);

//         $user->name = $request->name;
//         $user->email = $request->email;

//         if ($request->filled('password')) {
//             $user->password = Hash::make($request->password);
//         }

//         $user = Auth::user();


//         return redirect()->route('profile.edit')->with('success', 'Профиль обновлён'); // ?????
//     }
// }
class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit'); // Загружаем страницу редактирования профиля
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:4'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('dashboard')->with('success', 'Аккаунт обновлён!');
    }

    public function delete()
    {
        $user = Auth::user();
        $user->delete();

        return redirect('/')->with('success', 'Аккаунт удалён!');
    }
}
