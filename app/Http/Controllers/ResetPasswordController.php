<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;


class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    // Показать форму сброса пароля
    public function showResetForm(Request $request, $token = null)
    {
        return view('passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // Сбросить пароль
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        $response = $this->broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $response == Password::PASSWORD_RESET
            ? redirect()->route('login')->with(['status' => trans($response), 'success' => 'Ваш пароль был установлен успешно! Вы можете войти в систему прямо сейчас.'])
            : back()->withErrors(['email' => [trans($response)]]);
    }

    // Брокер для сброса пароля
    protected function broker()
    {
        return Password::broker();
    }
}

