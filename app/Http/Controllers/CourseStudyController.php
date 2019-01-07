<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Subject;
use App\Models\Report;
use Auth;

class CourseStudyController extends Controller
{
    public function index()
    {
        $courseStart =  User::findOrFail(Auth::user()->id)->courses()
                            ->where('courses.status', config('admin.course_start'))
                            ->get()->groupBy('pivot.course_id');

        return view('public.course_study.index', compact('courseStart'));
    }

    public function ShowSubject(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $subject = User::findOrFail(Auth::user()->id)
                        ->subjects()->wherePivot('course_id', $id)
                        ->paginate(config('admin.paginate_subject'));

        return view('public.course_study.details', compact('subject','course'));
    }

    public function SubjectDetails(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        return view('public.course_study.subject_details', compact('subject'));
    }

    public function showReport()
    {
        if (Auth::check())
        {
            $reports = User::findOrFail(Auth::user()->id)->reports()->paginate(config('admin.paginate_report'));
        }

        return view('report.index', compact('reports'));
    }

    public function report(Request $request)
    {
        try
        {
            $input = $request->all();
            $input['user_id'] = Auth::user()->id;
            Report::create($input);
            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
        } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_fails'));
        }

        return back();
    }
}
