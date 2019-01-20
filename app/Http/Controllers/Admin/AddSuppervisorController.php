<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentModels\UserRepository;
use App\Repositories\EloquentModels\CourseRepository;
use App\Http\Requests\AddSuppervisorRequest;

class AddSuppervisorController extends Controller
{
    protected $userRepository, $courseRepository;

    public function __construct(UserRepository $userRepository, CourseRepository $courseRepository)
    {
        $this->userRepository = $userRepository;
        $this->courseRepository = $courseRepository;
    }

    public function index()
    {
        $course = $this->courseRepository->all();

        return view('admin.course.suppervisor.index', compact('course'));
    }

    public function show(Request $request)
    {
        $suppervisor = $this->courseRepository->find($request->course_id)->courseUsers()->get();

        return response()->json($suppervisor);
    }

    public function create()
    {
        $course = $this->courseRepository->all();
        $user = $this->userRepository->where('role', '=',config('admin.supervisor'))->get();

        return view('admin.course.suppervisor.create', compact('course', 'user'));
    }

    public function stores(Request $request)
    {
        try
        {
            $course = $this->courseRepository->find($request->course_id);

            foreach ($request->user_id as $value) {
                $course->courseUsers()->attach($value);
            }
            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
        } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_fails'));
        }

        return redirect()->route('suppervisor.index');
    }

    public function delete($user, $course, Request $request)
    {
        try
        {
            $this->userRepository->find($user)->userCourses()->wherePivot('course_id', $course)->detach();
            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
        } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_fails'));
        }

        return back();
    }
}
