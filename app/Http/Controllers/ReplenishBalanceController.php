<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StudentMinutes;
use App\Models\Alert;
use Illuminate\Support\Facades\Auth;


class ReplenishBalanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $alert_exist = Alert::where('user_id', $user->id)->where('seen', false)->exists();
        $minutes_balance = StudentMinutes::where('user_id', $user->id)->value('minutes');
        $hrefs_icons_texts = config('app.student_hrefs_icons_texts');
        
        return view('replenish_balance', compact('user', 'alert_exist', 'minutes_balance', 'hrefs_icons_texts'));
    }


    public function replenish(Request $request)
    {
        $validated = $request->validate([
            'amount' => ['integer', 'min:1'],
        ]);

        DB::table('student_minutes')
            ->where('user_id', Auth::user()->id)
            ->increment('minutes', $validated['amount']);

        return redirect()->back()->with('success', "Баланс пополнен успешно на {$validated['amount']} мин.");
    }
}
