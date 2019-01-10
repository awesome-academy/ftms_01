<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Subject;
use App\Models\Report;
use App\Models\History;
use Auth;
use Session;

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
        $subjectComplete = User::findOrFail(Auth::user()->id)
            ->subjects()
            ->wherePivot('course_id', $id)
            ->wherePivot('status', config('admin.subject_end'))
            ->get();
        $progress = round((count($subjectComplete)/count($subject)*config('admin.progress')));

        return view('public.course_study.details', compact('subject','course', 'progress'));
    }

    public function SubjectDetails(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        if (!Session::has('history'.$subject->id)) {
            Session::put('history'.$subject->id, true);
            History::create([
                'user_id' => Auth::user()->id,
                'subject_id' => $subject->id,
                'type' => config('admin.read')
            ]);
        }

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
            History::create([
                'user_id' => Auth::user()->id,
                'subject_id' => $request->subject_id,
                'type' => config('admin.report')
            ]);

            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
        } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_fails'));
        }

        return back();
    }

    public function CloseSubject(Request $request)
    {
        try
        {
            $user = User::findOrFail(Auth::user()->id);
            $subject = $user->subjects()->wherePivot('subject_id', $request->subject_id)->get();

            foreach ($subject as  $value) {
                $value->pivot->status = config('admin.subject_end');
                $value->pivot->save();
                History::create([
                    'user_id' => Auth::user()->id,
                    'subject_id' => $value->id,
                    'type' => config('admin.close')
                ]);
            }

            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
        } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_fails'));
        }

        return back();
    }

    public function history()
    {
        $histories = Auth::user()->histories()->paginate(config('admin.paginate_history'));

        return view('public.history.index', compact('histories'));
    }

    public function calendar()
    {
        $user = Auth::user();
        $course = $user->courses()
            ->where('courses.status', config('admin.course_start'))
            ->get()->groupBy('pivot.course_id')->first();
        $calendars = $course->first()->calendars()->paginate(config('admin.paginate_calendar'));

        return view('public.calendar.index', compact('calendars'));
    }
}
