<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Lesson;
use App\Models\TeacherAccountConfirmation;
use App\Models\Subjects;
use App\Models\TeacherAndStudent;
use App\Models\History;
use App\Models\Alert;
use App\Models\TeacherBalance;
use Illuminate\Support\Facades\Auth;


class WorkController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $alert_exist = Alert::where('user_id', $user->id)->where('seen', false)->exists();
        $minutes_balance = TeacherBalance::where('user_id', $user->id)->value('balance');
        $hrefs_icons_texts = config('app.teacher_hrefs_icons_texts');
        $account_confirmation = TeacherAccountConfirmation::where('user_id', $user->id)->value('account_confirmation');

        $all_lessons = Lesson::all();

        $subjects = Subjects::pluck('subject');

        return view('work', compact('user', 
                                    'alert_exist',
                                    'minutes_balance', 
                                    'hrefs_icons_texts', 
                                    'account_confirmation',
                                    'all_lessons',
                                    'subjects'));
    }

    public function work_filter(Request $request)
    {
        $validated = $request->validate([
            'user_class' => ['integer'],
            'user_subject' => ['string'],
        ]);

        $user = Auth::user();
        $alert_exist = Alert::where('user_id', $user->id)->where('seen', false)->exists();
        $minutes_balance = TeacherBalance::where('user_id', $user->id)->value('balance');
        $hrefs_icons_texts = config('app.teacher_hrefs_icons_texts');
        $account_confirmation = TeacherAccountConfirmation::where('user_id', $user->id)->value('account_confirmation');

        $all_lessons = Lesson::where('number_class', $validated['user_class'])
            ->where('subject', $validated['user_subject'])
            ->get();

        $subjects = Subjects::pluck('subject');

        $get_data = [
            'user_class' => $validated['user_class'],
            'user_subject' => $validated['user_subject'],
        ];

        return view('work', compact('user', 
                                    'alert_exist',
                                    'minutes_balance', 
                                    'hrefs_icons_texts', 
                                    'account_confirmation',
                                    'all_lessons',
                                    'subjects',
                                    'get_data'));
    }


    public function accept_lesson(Request $request)
    {
        $validated = $request->validate([
            'lesson_id' => 'required|integer',
            'user_id' => 'required|integer',
            'student_name' => 'required|string',
            'question' => 'required|string',
            'number_class' => 'required|integer|min:1|max:11',
            'subject' => 'required|string|max:255',
            'start_time' => 'required',
            'duration' => 'required|integer',
            'pause' => 'required|integer',
        ]);

        $lesson_cost = Lesson::where('id', $validated['lesson_id'])->value('cost') * env('COEFFICIENT_PAYMENT_TEACHER');

        $history = new History();
        $history->student_id = $validated['user_id'];
        $history->student_name = $validated['student_name'];
        $history->teacher_id = Auth::user()->id;
        $history->lesson_id = $validated['lesson_id'];
        $history->question = $validated['question'];
        $history->number_class = $validated['number_class'];
        $history->subject = $validated['subject'];
        $history->start_time = $validated['start_time'];
        $history->duration = $validated['duration'];
        $history->pause = $validated['pause'];
        $history->cost = $lesson_cost;
        $history->save();

        $existingRecord = TeacherAndStudent::where('student_id', $validated['user_id'])
            ->where('teacher_id', Auth::user()->id)
            ->exists();

        if (!$existingRecord) {
            $teacherAndStudent = new TeacherAndStudent();
            $teacherAndStudent->student_id = $validated['user_id'];
            $teacherAndStudent->teacher_id = Auth::user()->id;
            $teacherAndStudent->save(); 
        }

        $lesson = Lesson::where('id', $validated['lesson_id']);
        $lesson->delete();

        DB::table('teacher_balances')
            ->where('user_id', Auth::user()->id)
            ->increment('balance', $lesson_cost);

        return redirect("chat/{$validated['user_id']}");
    }
}
