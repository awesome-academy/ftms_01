<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EloquentModels\CourseRepository;
use App\Repositories\EloquentModels\UserRepository;
use Auth;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $courseRepository, $userRepository;

    public function __construct(CourseRepository $courseRepository, UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->courseRepository = $courseRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $course = $this->userRepository->find(Auth::user()->id)->courses()->where('courses.status', '!=', config('admin.course_end'))->get()->groupBy('pivot.course_id');

        return view('home', compact('course'));
    }

    public function show(Request $request, $id)
    {
        $course = $this->courseRepository->find($id);
        $subject = $this->userRepository->find(Auth::user()->id)->subjects()->wherePivot('course_id', $id)->paginate(config('admin.paginate_subject'));
        $member = $course->users()->where('users.id', '!=', Auth::user()->id)->get()->groupBy('pivot.user_id');

        return view('course_details', compact('subject', 'course', 'member'));
    }

    public function ShowNotification($id)
    {
        try
        {
            $result = DB::table('notifications')->where('id', $id)->first();
            DB::table('notifications')->where('id', $id)->update(['read_at' => Carbon::now()]);

            return view('notification_endcourse', compact('result'));
        } catch (Exception $e) {
            return view('errors.404');
        }
    }
}
