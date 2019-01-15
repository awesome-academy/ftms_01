<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use Response;

class AddTraineeToCourseController extends Controller
{
    public function index()
    {
        $course = Course::all();

        return view('admin.course.trainees.index', compact('course'));
    }

    public function show(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        $trainee = $course->users()->get()->groupBy('name');

        return response()->json($trainee);
    }

    public function create()
    {
        $course = Course::where('status', '!=', config('admin.course_end'));
        $user = User::where('role', config('admin.member'))->get();

        return view('admin.course.trainees.create', compact('course', 'user'));
    }

    public function showSubject(Request $request)
    {
        $subject = Subject::where('course_id', $request->course_id)->where('status', config('admin.subject_ready'))->get();

        return response()->json($subject);
    }

    public function stores(Request $request)
    {
        try
        {
            $subject = $request->subject;
            $status = config('admin.subject_ready');
            foreach ($subject as $value) {
                $user = User::findOrFail($request->user_id);
                $user->courses()->attach($request->course_id, ['subject_id' => $value, 'status' => $status]);
            }

            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
        } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_falis'));
        }

        return redirect()->route('show-trainee');
    }

    public function deleteTrainee($user, $course, Request $request)
    {
        try
        {
            User::findOrFail($user)->courses()->wherePivot('course_id', $course)->detach();
            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
        } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_falis'));
        }

        return back();
    }
}
