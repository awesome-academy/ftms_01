<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentModels\CourseRepository;
use App\Repositories\EloquentModels\UserRepository;
use App\Repositories\EloquentModels\SubjectRepository;
use App\Repositories\EloquentModels\CalendarRepository;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Upload;
use App\Jobs\SendMailEndCourse;
use App\Notifications\MailNotification;
use Pusher\Pusher;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $courseRepository, $uploadImage, $userRepository, $subjectRepository, $calendarRepository;

    public function __construct(CourseRepository $courseRepository, Upload $uploadImage, UserRepository $userRepository, SubjectRepository $subjectRepository, CalendarRepository $calendarRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->uploadImage = $uploadImage;
        $this->userRepository = $userRepository;
        $this->subjectRepository = $subjectRepository;
        $this->calendarRepository = $calendarRepository;
    }

    public function index()
    {
        $course = $this->courseRepository->paginate(config('admin.paginate_course'));

        return view('admin.course.index', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supervisor = $this->userRepository->where('role', '=', config('admin.supervisor'));

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

        return redirect()->route('course.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = $this->courseRepository->find($id);
        $subjects = $course->subjects()->paginate(config('admin.paginate_course'));
        $calendars = $course->calendars()->get();

        return view('admin.course.show', compact('subjects', 'calendars', 'course'));
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
            $course = $this->courseRepository->update($input, $id);
            $users = $course->users()->get()->groupBy('pivot.user_id');

            if ($course->status == config('admin.course_end'))
            {
                $options = array(
                    'cluster' => 'ap1',
                    'useTLS' => true
                );
                $pusher = new Pusher(
                    env('PUSHER_APP_KEY'),
                    env('PUSHER_APP_SECRET'),
                    env('PUSHER_APP_ID'),
                    $options
                );
                foreach ($users as $user) {
                    dispatch(new SendMailEndCourse($user->first(), $course));
                    $user->first()->notify(new MailNotification($course));
                    $notifications = json_decode($user->first()->unreadNotifications);
                    foreach ($notifications as $notification) {
                        if ($course->id == $notification->data->course->id) {
                            $data = [
                                'content' => trans('message.notification_course_end') .' '. $course->name,
                                'id' => $user->first()->id,
                                'notification_id' => $b->id
                            ];
                        }
                    }
                    $pusher->trigger('send-message', 'NotifyEndCourse', $data);
                }
            }

            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
       } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_fails'));
       }

       return redirect()->route('course.index');
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
            $this->calendarRepository->where('course_id', '=',$id)->delete();
            $this->subjectRepository->where('course_id', '=', $id)->delete();
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
        $courses = $this->courseRepository->where('status', '=', config('admin.course_start'))->paginate(config('admin.paginate_course'));

        return view('admin.progress.index', compact('courses'));
    }

    public function showProgress($id)
    {
        $progress = [];
        $course = $this->courseRepository->find($id);
        $users = $course->users()->get()->groupBy('pivot.user_id');
        foreach ($users as $user) {
            $subject = count($user->first()->subjects()->wherePivot('course_id', $course->id)->get());
            $subjectComplete = count($user->first()->subjects()->wherePivot('course_id', $course->id)->wherePivot('status', config('admin.subject_end'))->get());
            $progress[$user->first()->id] = round(($subjectComplete/$subject)*config('admin.progress'));
        }

        return view('admin.progress.show_progress', compact('users', 'progress'));
    }
}
