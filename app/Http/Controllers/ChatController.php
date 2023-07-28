<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TeacherAndStudent;
use App\Models\Chat;
use App\Models\StudentMinutes;
use App\Models\Alert;
use App\Models\TeacherBalance;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $alert_exist = Alert::where('user_id', $user->id)->where('seen', false)->exists();

        if ($user->role == 'ученик') {
            $minutes_balance = "Осталось минут " . StudentMinutes::where('user_id', $user->id)->value('minutes') . " мин.";
            $hrefs_icons_texts = config('app.student_hrefs_icons_texts');
            $your_students_or_teachers = 'Учителя';

            $interlocutors = [];
            foreach (TeacherAndStudent::where('student_id', $user->id)->get() as $teacher) {
                array_push($interlocutors, 
                            ['info' => $teacher['teacher_id'], 
                            'name' => User::where('id', $teacher['teacher_id'])->value('first_name') . ' ' . User::where('id', $teacher['teacher_id'])->value('last_name'),
                            ]);
            }

            return view('all_chats', compact('user', 
                                            'alert_exist',
                                            'minutes_balance', 
                                            'hrefs_icons_texts',
                                            'your_students_or_teachers',
                                            'interlocutors'));
        }
        elseif ($user->role == 'преподаватель') {
            $minutes_balance = "Баланс: " . TeacherBalance::where('user_id', $user->id)->value('balance') . " руб.";
            $hrefs_icons_texts = config('app.teacher_hrefs_icons_texts');
            $your_students_or_teachers = 'Ученики';

            $interlocutors = [];
            foreach (TeacherAndStudent::where('teacher_id', $user->id)->get() as $student) {
                array_push($interlocutors, 
                            ['info' => $student['student_id'], 
                            'name' => User::where('id', $student['student_id'])->value('first_name') . ' ' . User::where('id', $student['student_id'])->value('last_name'),
                            ]);
            }

            return view('all_chats', compact('user', 
                                            'alert_exist',
                                            'minutes_balance', 
                                            'hrefs_icons_texts',
                                            'your_students_or_teachers',
                                            'interlocutors'));
        }
    }

    
    public function check_chat($user_id)
    {
        $user = Auth::user();
        $alert_exist = Alert::where('user_id', $user->id)->where('seen', false)->exists();

        if (User::where('id', $user_id)->exists()) {

            $current_user_id = $user->id;

            $receiver_first_name = User::where('id', $user_id)->value('first_name');
            $receiver_last_name = User::where('id', $user_id)->value('last_name');

            $messages = Chat::where('sender_id', $current_user_id)
                            ->where('receiver_id', $user_id)
                            ->orWhere('sender_id', $user_id)
                            ->where('receiver_id', $current_user_id)
            ->get();
            

            if ($user->role == 'ученик') {
                $minutes_balance = "Осталось минут " . StudentMinutes::where('user_id', $user->id)->value('minutes') . " мин.";
                $hrefs_icons_texts = config('app.student_hrefs_icons_texts');
            }
            elseif ($user->role == 'преподаватель') {
                $minutes_balance = "Баланс: " . TeacherBalance::where('user_id', $user->id)->value('balance') . " руб.";
                $hrefs_icons_texts = config('app.teacher_hrefs_icons_texts');
            }

            return view('chat', compact('user', 
                                        'alert_exist',
                                        'minutes_balance',
                                        'hrefs_icons_texts',
                                        'current_user_id', 'receiver_first_name', 'receiver_last_name',
                                        'user_id',
                                        'messages'));       
        }

        return redirect('chat');
    }


    public function send_message(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'receiver_id' => ['integer'],
            'message_text' => ['string'],
        ]);

        Chat::create([
            'sender_id' => $user->id,
            'receiver_id' => $validated['receiver_id'],
            'message_text' => $validated['message_text'],
        ]);

        Alert::create([
            'user_id' => $validated['receiver_id'],
            'alert_text' => "Пользователь {$user->first_name} {$user->last_name} прислал сообщение: {$validated['message_text']}",
        ]);

        return redirect()->back();
    }
}
