<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\StudentMinutes;
use App\Models\AdditionalInformation;
use App\Models\TeacherAccountConfirmation;
use App\Models\TeacherBalance;
use App\Models\Alert;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $alert_exist = Alert::where('user_id', $user->id)->where('seen', false)->exists();

        //отправка уведомлений на email пользователю
        foreach (Alert::where('send_on_email', false)->get() as $alert) {
            if (Permission::where('user_id', $alert['user_id'])->value('permission_to_email')) {      
                $email = 'web_development_bes_artem@mail.ru';
                $toEmail = User::where('id', $alert['user_id'])->value('email');
                $subject = 'Уведомление (Online_school)';
                $message = $alert['alert_text'];

                Mail::raw($message, function ($mail) use ($toEmail, $subject) {
                    $mail->to($toEmail);
                    $mail->subject($subject);
                });

                Alert::where('user_id', $alert['user_id'])->update(['send_on_email' => true]);
            }
        }

        //вернуть ученику минуты если урок не приняли
        $lessons = DB::table('lessons')->where('start_time', '<', Carbon::now());

        if (count($lessons->get())) {
            foreach ($lessons->get() as $lesson) {
                $minutes = $lesson->duration - $lesson->pause;
                DB::table('student_minutes')
                    ->where('user_id', $lesson->user_id)
                    ->increment('minutes', $minutes);
                Alert::create([
                    'user_id' => $lesson->user_id,
                    'alert_text' => "Ваш урок никто не принял. Вам было возвращено {$minutes} мин.",
                ]);
            }
            $lessons->delete();  
        }


        if ($user->role == 'ученик') {
            $minutes_balance = StudentMinutes::where('user_id', $user->id)->value('minutes');
            $hrefs_icons_texts = config('app.student_hrefs_icons_texts');

            return view('student_profile', compact('user', 
                                                   'alert_exist',
                                                   'minutes_balance', 
                                                   'hrefs_icons_texts'));
        }
        elseif ($user->role == 'преподаватель') {
            $minutes_balance = TeacherBalance::where('user_id', $user->id)->value('balance');
            $hrefs_icons_texts = config('app.teacher_hrefs_icons_texts');
            $about_me = AdditionalInformation::where('user_id', $user->id)->select('teacher_subject', 'teacher_classes', 'teacher_comment')->first();
            $account_confirmation = TeacherAccountConfirmation::where('user_id', $user->id)->value('account_confirmation');
            
            return view('teacher_profile', compact('user', 
                                                   'alert_exist',
                                                   'minutes_balance', 
                                                   'hrefs_icons_texts', 
                                                   'about_me',
                                                   'account_confirmation'));
        }
        elseif ($user->role == 'админ') {
            $hrefs_icons_texts = config('app.admin_hrefs_icons_texts');

            $teacher_info = [];
            foreach (TeacherAccountConfirmation::where('account_confirmation', false)->get() as $confirmation) {
                array_push($teacher_info, [
                    'about_teacher' => [
                        'first_name' => User::where('id', $confirmation['user_id'])->value('first_name'),
                        'last_name' => User::where('id', $confirmation['user_id'])->value('last_name'),
                        'email' => User::where('id', $confirmation['user_id'])->value('email'),
                    ],
                    'additional_information_teacher' => [
                        'teacher_subject' => AdditionalInformation::where('user_id', $confirmation['user_id'])->value('teacher_subject'),
                        'teacher_classes' => AdditionalInformation::where('user_id', $confirmation['user_id'])->value('teacher_classes'),
                        'teacher_comment' => AdditionalInformation::where('user_id', $confirmation['user_id'])->value('teacher_comment'),
                    ],
                    'teacher_id' => $confirmation['user_id'],
                ]);
            }

            return view('admin_profile', compact('user',
                                                 'alert_exist',
                                                 'hrefs_icons_texts', 
                                                 'teacher_info'));
        }
        else {
            Auth::logout();
            return redirect('register')->withErrors([
                'role' => 'Данной роли не существует',
            ]);
        }
    }


    public function confirm_teacher(Request $request)
    {
        if (Auth::user()->role == 'админ') {
            $validated = $request->validate([
                'teacher_id' => ['integer', 'min:1'],
            ]);

            TeacherAccountConfirmation::where('user_id', $validated['teacher_id'])->update([
                'account_confirmation' => true,
            ]);

            return redirect()->back()->with('success_confirm', 'Преподватель подтверждён успешно!');
        }
        
        return redirect('profile');
    }
}
