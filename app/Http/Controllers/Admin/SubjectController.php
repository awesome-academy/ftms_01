<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Course;
use App\Models\SubjectContent;
use App\Repositories\EloquentModels\SubjectRepository;
use App\Repositories\EloquentModels\SubjectContentRepository;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $subjectRepository, $subjectContentRepository;

    public function __construct(SubjectRepository $subjectRepository, SubjectContentRepository $subjectContentRepository)
    {
        $this->subjectRepository = $subjectRepository;
        $this->subjectContentRepository = $subjectContentRepository;
    }

    public function index()
    {
        $subject = Subject::paginate(config('admin.paginate_subject'));
        return view('admin.subject.index', compact('subject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = Course::all();
        return view('admin.subject.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $name = "name";
            $content = "content";
            $counter = $request->counter;
            for ($i = 1; $i <= $counter; $i++) {
                $input['course_id']=$request->course_id;
                $input['status'] = config('admin.subject_ready');
                $value = $name.$i;
                $input['name'] = $request->$value;
                $subject = $this->subjectRepository->create($input);
                $input['subject_id'] = $subject['id'];
                $subject_content = $content.$i;
                $input['content'] = $request->$subject_content;
                $this->subjectContentRepository->create($input);

                $request->session()->flash(trans('message.success'), trans('message.notification_success'));
            }
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
    public function show(Subject $subject)
    {
        return view('admin.subject.view', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('admin.subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $input = $request->all();
            $subject = $this->subjectRepository->update($input, $id);
            $id_content = $subject->content->id;
            $this->subjectContentRepository->update($input, $id_content);

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
            $subject = $this->subjectRepository->find($id);
            $subject->content->delete();
            $this->subjectRepository->delete($id);

            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
        } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_fails'));
        }
        return back();
    }
}
