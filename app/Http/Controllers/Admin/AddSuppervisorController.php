<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Http\Requests\AddSuppervisorRequest;

class AddSuppervisorController extends Controller
{
    public function index()
    {
        $course = Course::all();
        return view('admin.course.suppervisor.index', compact('course'));
    }

    public function show(Request $request)
    {
        $suppervisor = Course::findOrFail($request->course_id)->courseUsers()->get();
        return response()->json($suppervisor);
    }

    public function create()
    {
        $course = Course::all();
        $user = User::where('role', config('admin.supervisor'))->get();
        return view('admin.course.suppervisor.create', compact('course', 'user'));
    }

    public function stores(Request $request)
    {
        try
        {
            $course = Course::findOrFail($request->course_id);
            foreach ($request->user_id as $value) {
                $course->courseUsers()->attach($value);
            }
            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
        } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_fails'));
        }

        return back();
    }

    public function delete($user, $course, Request $request)
    {
        try
        {
            User::findOrFail($user)->userCourses()->wherePivot('course_id', $course)->detach();
            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
        } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_fails'));
        }

        return back();
    }
}
