<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'countMe' => 'required|numeric|min:3',
        ]);

        $honeypot = $request->get('honeypot');
        if (!empty($honeypot)) {
            return redirect()->back()->withErrors(['Error: HPF']);
        }

        $user = User::add($request->all());
        $user->generatePassword($request->get('password'));

        return redirect('/login')->with('status', 'Successful register. Now try to login:');
    }

    public function loginForm()
    {
        return view('pages.login');
    }

    /**
     *   1. Проверить и залогинить пользователя на основе емайл и проля
     * 2. Если человек ввел неправильный логин или пароль выводим сообщение
     * 3. иначе редиректим его на главную.
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ])) {
            $user = Auth::user();

            if ($user && $user->is_admin) {
                // пользователь администратор
                return redirect('/admin/posts');
            }

            // пользователь не администратор
            return redirect('/profile');
        }

        return redirect()->back()->with('status', 'Неправильный логин или пароль');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login')->with('status', 'Successful logout');
    }
}
