<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentModels\CourseRepository;
use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use App\Http\Requests\CourseRequest;
use App\Upload;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $courseRepository, $uploadImage;

    public function __construct(CourseRepository $courseRepository, Upload $uploadImage)
    {
        $this->courseRepository = $courseRepository;
        $this->uploadImage = $uploadImage;
    }

    public function index()
    {
        $course = Course::paginate(config('admin.paginate_course'));
        return view('admin.course.index', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supervisor = User::where('role', config('admin.supervisor'));
        return view('admin.course.create', compact('supervisor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        try
        {
            $input = $request->all();
            $file = $this->uploadImage->uploadImage($request->image);
            $input['image'] = $file;
            $input['status'] = config('admin.course_ready');
            $course = $this->courseRepository->create($input);
            $course->courseUsers()->attach($course['id'], ['user_id' => $input['user_id']]);
            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
        } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_fails'));
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('admin.course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
       try
        {
            $input = $request->all();
            $input['status'] = $request->status;
            $image = $request->old_image;
            if($request->has('image'))
            {
                $file = $this->uploadImage->uploadImage($request->image);
                $image = $file;
            }
            $this->courseRepository->update($input, $id);
            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
       } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_fails'));
       }
       return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        try
        {
            $course = $this->courseRepository->find($id);
            $subject = $course->subjects()->get();
            foreach ($subject as  $value) {
                $value->content->delete();
            }
            Subject::where('course_id', $id)->delete();
            $course->courseUsers()->detach();
            $this->courseRepository->delete($id);

            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
        } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_fails'));
        }

        return back();
    }

    public function showCourse()
    {
        $courses = Course::where('status', config('admin.course_start'))->paginate(config('admin.paginate_course'));

        return view('admin.progress.index', compact('courses'));
    }

    public function showProgress($id)
    {
        $progress = [];
        $course = Course::findOrFail($id);
        $users = $course->users()->get()->groupBy('pivot.user_id');
        foreach ($users as $user) {
            $subject = count($user->first()->subjects()->wherePivot('course_id', $course->id)->get());
            $subjectComplete = count($user->first()->subjects()->wherePivot('course_id', $course->id)->wherePivot('status', 0)->get());
            $progress[$user->first()->id] = round(($subjectComplete/$subject)*config('admin.progress'));
        }

        return view('admin.progress.show_progress', compact('users', 'progress'));
    }
}
