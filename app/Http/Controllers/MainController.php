<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Alert;
use App\Models\Permission;
use Carbon\Carbon;


class MainController extends Controller
{
    public function index()
    {
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

        return view('main');
    }


    public function send(Request $request)
    {
        $validated = $request->validate([
            'message' => ['string'],
            'email' => ['required', 'string', 'max:50', 'email'],
        ]);

        $toEmail = 'web_development_bes_artem@mail.ru';
        $subject = 'Письмо в поддержку (Online_school)';
        $message = "Email: {$validated['email']} \nСообщение: {$validated['message']}";

        Mail::raw($message, function ($mail) use ($toEmail, $subject) {
            $mail->to($toEmail);
            $mail->subject($subject);
        });

        foreach (User::where('role', 'админ')->get() as $admin) {
            Alert::create([
                'user_id' => $admin['id'],
                'alert_text' => "Пользователь прислал сообщение в поддержку: {$message}",
                'send_on_email' => true,
            ]);
        }

        return redirect('/')->with('success', 'Ваше сообщение отправлено успешно!');
    }
}
