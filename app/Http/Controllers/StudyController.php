<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subjects;
use App\Models\Lesson;
use App\Models\MinuteCost;
use App\Models\StudentMinutes;
use App\Models\Alert;
use Illuminate\Support\Facades\Auth;


class StudyController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $alert_exist = Alert::where('user_id', $user->id)->where('seen', false)->exists();
        $minutes_balance = StudentMinutes::where('user_id', $user->id)->value('minutes');
        $hrefs_icons_texts = config('app.student_hrefs_icons_texts');
        
        $all_sub = [];
        foreach (Subjects::all() as $sub) {
            array_push($all_sub, $sub['subject']);
        }

        return view('study', compact('user', 'alert_exist', 'minutes_balance', 'hrefs_icons_texts', 'all_sub'));
    }

    public function create_lesson(Request $request)
    {
        $validated = $request->validate([
            'question' => ['required', 'string'],
            'number_class' => ['required', 'integer', 'min:1', 'max:11'],
            'subject' => ['required', 'string', 'max:100'],
            'start_time' => ['required'],
            'duration' => ['required', 'numeric', 'min:1'],
            'pause' => ['required', 'numeric', 'min:0'],
        ]);

        $user = Auth::user();

        // проверка хватает ли ученику минут чтоб создать урок
        if (StudentMinutes::where('user_id', $user->id)->value('minutes') >= $validated['duration'] - $validated['pause']) {
            $validated['name'] = $user->first_name . ' ' . $user->last_name;
            $validated['user_id'] = $user->id;
            $validated['cost'] = $validated['duration'] * MinuteCost::first()->minute_cost * 0.8;

            Lesson::create($validated);

            DB::table('student_minutes')
                ->where('user_id', $user->id)
                ->decrement('minutes', $validated['duration'] - $validated['pause']);
    
            return redirect('profile')->with('success_lesson_create', 'Урок создан успешно, ожидайте когда преподватель примет урок');    
        }
        //иначе
        return redirect()->back()->with('error', "У Вас недостаточно минут для создания урока.");
    }
}
