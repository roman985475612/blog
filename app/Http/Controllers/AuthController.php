<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = User::add($request->all());
        $user->generatePassword($request->input('password'));

        Auth::attempt([
            'email'    => $request->get('email'),
            'password' => $request->get('password'),
        ]);

        return redirect()->route('home');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $login = Auth::attempt([
            'email'    => $request->get('email'),
            'password' => $request->get('password'),
        ]);

        if (!$login) {
            return redirect()->back()->with('error', 'Неправельный логин или пароль');
        }

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function profile()
    {
        return view('auth.profile');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'avatar' => 'nullable|image',
        ]);

        $user = Auth::user();
        $user->edit($request->all());
        $user->generatePassword($request->input('password'));
        $user->uploadAvatar($request->file('avatar'));

        return redirect()->route('profile')->with('success', 'Ваш профиль обновлен!');

    }
}
