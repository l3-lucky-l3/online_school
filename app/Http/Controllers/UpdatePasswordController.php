<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UpdatePasswordController extends Controller
{
    public function index()
    {
        return view('update_password');
    }


    public function update_password(Request $request)
    {
        $user = Auth::user();
        $currentPassword = $request->input('current_password');
        $newPassword = $request->input('new_password');
    
        if (Hash::check($currentPassword, $user->password)) {
            $user->password = Hash::make($newPassword);
            $user->save();
    
            return redirect()->back()->with('success', 'Пароль изменён успешно.');
        }
    
        return redirect()->back()->with('error', 'Не удалось изменить пароль.');
    }
}
