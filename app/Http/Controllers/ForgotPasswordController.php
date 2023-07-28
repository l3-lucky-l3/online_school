<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;


class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    // Показать форму для запроса сброса пароля
    public function showLinkRequestForm()
    {
        return view('passwords.email');
    }

    // Отправить письмо с ссылкой на сброс пароля
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? back()->with(['status' => trans($response), 'success' => 'Мы отправили вам по электронной почте инструкции по установке вашего пароля, если существует учетная запись с указанным вами адресом электронной почты. Вы должны получить их в ближайшее время. Если вы не получили электронное письмо, пожалуйста, убедитесь, что вы ввели адрес, с которым зарегистрировались, и проверьте папку со спамом.'])
            : back()->withErrors(['email' => trans($response)]);
    }

    // Брокер для сброса пароля
    protected function broker()
    {
        return Password::broker();
    }
}

