<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $course = User::findOrFail(Auth::user()->id)->courses()->paginate(config('admin.paginate_course_public'))->groupBy('pivot.course_id');

        return view('home', compact('course'));
    }

    public function show(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $subject = User::findOrFail(Auth::user()->id)->subjects()->wherePivot('course_id', $id)->paginate(config('admin.paginate_subject'));
        $member = $course->users()->where('users.id', '!=', Auth::user()->id)->get()->groupBy('pivot.user_id');

        return view('course_details', compact('subject', 'course', 'member'));
    }
}
