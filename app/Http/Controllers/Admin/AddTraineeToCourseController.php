<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentModels\UserRepository;
use App\Repositories\EloquentModels\CourseRepository;
use App\Repositories\EloquentModels\SubjectRepository;
use Response;

class AddTraineeToCourseController extends Controller
{
    protected $userRepository, $subjectRepository, $courseRepository;

    public function __construct(UserRepository $userRepository, CourseRepository $courseRepository, SubjectRepository $subjectRepository)
    {
        $this->userRepository = $userRepository;
        $this->courseRepository = $courseRepository;
        $this->subjectRepository = $subjectRepository;
    }

    public function index()
    {
        $course = $this->courseRepository->all();

        return view('admin.course.trainees.index', compact('course'));
    }

    public function show(Request $request)
    {
        $course = $this->courseRepository->find($request->course_id);
        $trainee = $course->users()->get()->groupBy('name');

        return response()->json($trainee);
    }

    public function create()
    {
        $course = $this->courseRepository->where('status', '!=', config('admin.course_end'))->get();
        $user = $this->userRepository->where('role', '=',config('admin.member'))->get();

        return view('admin.course.trainees.create', compact('course', 'user'));
    }

    public function showSubject(Request $request)
    {
        $subject = $this->subjectRepository->where('course_id', '=',$request->course_id)->where('status', config('admin.subject_ready'))->get();

        return response()->json($subject);
    }

    public function stores(Request $request)
    {
        try
        {
            $subject = $request->subject;
            $user_id = $request->user_id;
            $status = config('admin.subject_start');

            foreach ($subject as $value) {
                foreach ($user_id as $id) {
                    $user = $this->userRepository->find($id);
                    $user->courses()->attach($request->course_id, ['subject_id' => $value, 'status' => $status]);
                }
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
            $this->userRepository->find($user)->courses()->wherePivot('course_id', $course)->detach();
            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
        } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_falis'));
        }

        return back();
    }
}
