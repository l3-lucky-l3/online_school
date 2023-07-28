<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Alert;


class SupportController extends Controller
{
    public function index()
    {
        return view('support');
    }


    public function send(Request $request)
    {
        $validated = $request->validate([
            'message' => ['string'],
        ]);

        $email = Auth::user()->email;
        $toEmail = 'web_development_bes_artem@mail.ru';
        $subject = 'Письмо в поддержку (Online_school)';
        $message = "Email: {$email} \nСообщение: {$validated['message']}";

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

        return redirect('profile')->with('success', 'Ваше сообщение отправлено успешно!');
    }
}
