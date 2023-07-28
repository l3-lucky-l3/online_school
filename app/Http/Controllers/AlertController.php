<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentMinutes;
use App\Models\Permission;
use App\Models\Alert;
use App\Models\TeacherBalance;
use Illuminate\Support\Facades\Auth;


class AlertController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $alert_exist = Alert::where('user_id', $user->id)->where('seen', false)->exists();
        $value_permission = Permission::where('user_id', $user->id)->value('permission_to_email');
        $all_alert = Alert::where('user_id', $user->id)->get();
        Alert::where('user_id', $user->id)->update(['seen' => true]);
        Alert::where('user_id', $user->id)->update(['send_on_email' => true]);

        if ($user->role == 'ученик') {
            $minutes_balance = "Осталось минут: " . StudentMinutes::where('user_id', $user->id)->value('minutes') . " мин.";
            $hrefs_icons_texts = config('app.student_hrefs_icons_texts');
        }
        elseif ($user->role == 'преподаватель') {
            $minutes_balance = "Баланс: " . TeacherBalance::where('user_id', $user->id)->value('balance') . " руб.";
            $hrefs_icons_texts = config('app.teacher_hrefs_icons_texts');
        }
        elseif ($user->role == 'админ') {
            $minutes_balance = "Панель администратора";
            $hrefs_icons_texts = config('app.admin_hrefs_icons_texts');
        }
        return view('alert', compact('user', 
                                     'alert_exist',
                                     'minutes_balance', 
                                     'hrefs_icons_texts',
                                     'value_permission',
                                     'all_alert'));
    }


    public function permissions(Request $request)
    {
        Permission::where('user_id', Auth::user()->id)->update([
            'permission_to_email' => $request->input('isChecked'),
        ]);
    }
}
