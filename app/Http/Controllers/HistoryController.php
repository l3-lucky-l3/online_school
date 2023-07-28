<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentMinutes;
use App\Models\History;
use App\Models\Alert;
use App\Models\TeacherBalance;
use Illuminate\Support\Facades\Auth;


class HistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user_role = $user->role;
        $alert_exist = Alert::where('user_id', $user->id)->where('seen', false)->exists();

        if ($user_role == 'ученик') {
            $minutes_balance = StudentMinutes::where('user_id', $user->id)->value('minutes');
            $hrefs_icons_texts = config('app.student_hrefs_icons_texts');
            $all_history = History::where('student_id', $user->id)->get();
        }
        elseif ($user_role == 'преподаватель') {
            $minutes_balance = TeacherBalance::where('user_id', $user->id)->value('balance');
            $hrefs_icons_texts = config('app.teacher_hrefs_icons_texts');
            $all_history = History::where('teacher_id', $user->id)->get();
        }
        
        return view('history', compact('user', 
                                      'alert_exist',
                                      'minutes_balance', 
                                      'hrefs_icons_texts',
                                      'all_history',
                                      'user_role'));
    }
}
