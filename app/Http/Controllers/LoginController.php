<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect('profile');
        }
        
        $validated = $request->only(['email', 'password']);

        if(Auth::attempt($validated)) {
            return redirect('profile');
        }

        return redirect('login')->withErrors([
            'email' => 'Не удалось авторизоваться',
        ]);
    }
}
