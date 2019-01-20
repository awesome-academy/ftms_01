<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EloquentModels\CourseRepository;
use App\Repositories\EloquentModels\UserRepository;
use App\Repositories\EloquentModels\SubjectRepository;
use App\Repositories\EloquentModels\ReportRepository;
use App\Repositories\EloquentModels\HistoryRepository;
use Auth;
use Session;
use Illuminate\Pagination\Paginator;

class CourseStudyController extends Controller
{
    protected $courseRepository, $userRepository, $subjectReposiory, $historyRepository, $reportRepository;

    public function __construct(
        CourseRepository $courseRepository,
        UserRepository $userRepository,
        SubjectRepository $subjectReposiory,
        ReportRepository $reportRepository,
        HistoryRepository $historyRepository
    )
    {
        $this->courseRepository = $courseRepository;
        $this->userRepository = $userRepository;
        $this->subjectReposiory = $subjectReposiory;
        $this->historyRepository = $historyRepository;
        $this->reportRepository = $reportRepository;
    }

    public function index()
    {
        $courseStart = $this->userRepository->find(Auth::user()->id)->courses()
            ->where('courses.status', config('admin.course_start'))
            ->get()->groupBy('pivot.course_id');

        return view('public.course_study.index', compact('courseStart'));
    }

    public function ShowSubject(Request $request, $id)
    {
        $course = $this->courseRepository->find($id);
        $subject = $this->userRepository->find(Auth::user()->id)
            ->subjects()->wherePivot('course_id', $id)
            ->paginate(config('admin.paginate_subject'));
        $subjectComplete = $this->userRepository->find(Auth::user()->id)
            ->subjects()
            ->wherePivot('course_id', $id)
            ->wherePivot('status', config('admin.subject_end'))
            ->get();
        $progress = round((count($subjectComplete)/count($subject)*config('admin.progress')));

        return view('public.course_study.details', compact('subject','course', 'progress'));
    }

    public function SubjectDetails(Request $request, $id)
    {
        $subject = $this->subjectReposiory->find($id);

        if (!Session::has('history'.$subject->id)) {
            Session::put('history'.$subject->id, true);
            $history = [
                'user_id' => Auth::user()->id,
                'subject_id' => $subject->id,
                'type' => config('admin.read')
            ];
            $this->historyRepository->create($history);
        }

        return view('public.course_study.subject_details', compact('subject'));
    }

    public function showReport()
    {
        if (Auth::check())
        {
            $reports = $this->userRepository->find(Auth::user()->id)->reports()->paginate(config('admin.paginate_report'));
        }

        return view('report.index', compact('reports'));
    }

    public function report(Request $request)
    {
        try
        {
            $input = $request->all();
            $input['user_id'] = Auth::user()->id;
            $this->reportRepository->create($input);
            $history = [
                'user_id' => Auth::user()->id,
                'subject_id' => $subject->id,
                'type' => config('admin.read')
            ];
            $this->historyRepository->create($history);

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
            $user =$this->userRepository->find(Auth::user()->id);
            $subject = $user->subjects()->wherePivot('subject_id', $request->subject_id)->get();

            foreach ($subject as  $value) {
                $value->pivot->status = config('admin.subject_end');
                $value->pivot->save();
                $history = [
                    'user_id' => Auth::user()->id,
                    'subject_id' => $subject->id,
                    'type' => config('admin.read')
                ];
                $this->historyRepository->create($history);
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

    public function CourseEnd()
    {
        $courseEnds = Auth::user()->courses()->where('courses.status', config('admin.course_end'))->get()->groupBy('pivot.course_id');

        return view('public.course_end.index', compact('courseEnds'));
    }

    public function CourseEndDetail($id)
    {
        $course = $this->courseRepository->find($id);
        $subjects = Auth::user()->subjects()->wherePivot('course_id', $id)->paginate(config('admin.paginate_subject'));

        return view('public.course_end.show', compact('subjects','course'));
    }
}
