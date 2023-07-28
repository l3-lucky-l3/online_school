<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChangeUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('change_user', compact('user'));
    }


    public function change(Request $request)
    {
        $user = Auth::user();
    
        $validated = $request->validate([
            'new_first_name' => 'required|string|max:255',
            'new_last_name' => 'required|string|max:255',
            'new_username' => 'required|string|max:255',
            'new_email' => 'required|email|string|max:255',
        ]);

        $user->first_name = $validated['new_first_name'];
        $user->last_name = $validated['new_last_name'];
        $user->username = $validated['new_username'];
        $user->email = $validated['new_email'];
        $user->save();
    
        return redirect()->back()->with('success', 'Данные изменены успешно!');
    }
}
