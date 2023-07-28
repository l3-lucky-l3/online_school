<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudentMinutes;
use App\Models\Permission;
use App\Models\AdditionalInformation;
use App\Models\TeacherAccountConfirmation;
use App\Models\TeacherBalance;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class RegisterController extends Controller
{
    public function save(Request $request)
    {
        if (Auth::check()) {
            return redirect('profile');
        }

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'max:50', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:7', 'max:50'],
            'role' => ['required', 'string', 'max:13'],
        ]);

        if ($validated['password'] != $request->toArray()['confirm-password']) {
            return redirect('register')->withErrors([
                'confirm-password' => 'Введёные пароли не совпадают',
            ]);
        }

        if(User::where('username', $validated['username'])->exists()) {
            return redirect('register')->withErrors([
                'username' => 'Пользователь с таким username уже существует',
            ]);
        }
        
        if(User::where('email', $validated['email'])->exists()) {
            return redirect('register')->withErrors([
                'email' => 'Пользователь с таким email уже существует',
            ]);
        }


        $user = User::create(
            array_merge($validated, [
                'password' => bcrypt($validated['password']),
            ])
        );


        Permission::create(['user_id' => $user->id]);

        if ($validated['role'] == 'ученик') {
            StudentMinutes::create(['user_id' => $user->id]);
        }

        if ($validated['role'] == 'преподаватель') {
            AdditionalInformation::create(['user_id' => $user->id]);
            TeacherAccountConfirmation::create(['user_id' => $user->id]);
            TeacherBalance::create(['user_id' => $user->id]);
        }


        if($user) {
            Auth::login($user);
            return redirect('login');
        }

        return redirect('register')->withErrors([
            'formError' => 'Произошла ошибка сохранения пользователя',
        ]);
    }
}
