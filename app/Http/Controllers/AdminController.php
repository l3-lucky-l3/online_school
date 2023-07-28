<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subjects;
use App\Models\Classes;
use App\Models\MinuteCost;
use App\Models\Alert;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $alert_exist = Alert::where('user_id', $user->id)->where('seen', false)->exists();
        $hrefs_icons_texts = config('app.admin_hrefs_icons_texts');
        $subjects = Subjects::all();
        $number_class = Classes::all();
        $minute_cost = MinuteCost::first();

        return view('settings', compact('user', 'alert_exist', 'hrefs_icons_texts', 'subjects', 'number_class', 'minute_cost'));
    }


    public function add_subject(Request $request)
    {
        $validated = $request->validate([
            'subject' => ['string'],
        ]);

        $newSubject = new Subjects();
        $newSubject->subject = $validated['subject'];
        $newSubject->timestamps = false;
        $newSubject->save();

        return redirect()->back()->with('success_admin', 'Предмет успешно добавлен.');
    }

    public function delete_subject(Request $request)
    {
        $validated = $request->validate([
            'subject' => ['string'],
        ]);

        Subjects::where('subject', $validated['subject'])->delete();

        return redirect()->back()->with('success_admin', 'Предмет успешно удален.');
    }


    public function add_class(Request $request)
    {
        $validated = $request->validate([
            'num_class' => ['integer'],
        ]);

        $newSubject = new Classes();
        $newSubject->num_class = $validated['num_class'];
        $newSubject->timestamps = false;
        $newSubject->save();

        return redirect()->back()->with('success_admin', 'Класс успешно добавлен.');
    }

    public function delete_class(Request $request)
    {
        $validated = $request->validate([
            'num_class' => ['integer'],
        ]);

        Classes::where('num_class', $validated['num_class'])->delete();

        return redirect()->back()->with('success_admin', 'Класс успешно удален.');
    }


    public function change_minute_cost(Request $request)
    {
        $validated = $request->validate([
            'last_minute_cost' => ['integer'],
            'minute_cost' => ['integer'],
        ]);

        Minutecost::where('minute_cost', $validated['last_minute_cost'])->update(['minute_cost' => $validated['minute_cost']]);

        return redirect()->back()->with('success_admin', 'Стоимость минут изменена успешно.');
    }
}
