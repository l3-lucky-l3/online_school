<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AdditionalInformation;


class AdditionalInformationController extends Controller
{
    public function index()
    {
        $teacher_subject = AdditionalInformation::where('user_id', Auth::user()->id)->value('teacher_subject');
        $teacher_classes = AdditionalInformation::where('user_id', Auth::user()->id)->value('teacher_classes');
        $teacher_comment = AdditionalInformation::where('user_id', Auth::user()->id)->value('teacher_comment');

        return view('change_additional_information', compact('teacher_subject', 'teacher_classes', 'teacher_comment'));
    }


    public function change(Request $request)
    {
        $validated = $request->validate([
            'teacher_subject' => 'required|string',
            'teacher_classes' => 'required',
            'teacher_comment' => 'required|string',
        ]);

        AdditionalInformation::where('user_id', Auth::user()->id)->update([
            'teacher_subject' => $validated['teacher_subject'],
            'teacher_classes' => $validated['teacher_classes'],
            'teacher_comment' => $validated['teacher_comment'],
        ]);

        return redirect()->back()->with('success', 'Информация изменена успешно.');
    }
}
