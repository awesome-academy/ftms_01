<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseCalendar;
use App\Models\Course;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calendars = CourseCalendar::paginate(config('admin.paginate_calendar'));

        return view('admin.calendar.index', compact('calendars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();

        return view('admin.calendar.create', compact('courses'));
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
            $hour_start = "hour_start";
            $hour_end = "hour_end";
            $day = "day";
            $counter = $request->count;
            for ($i = 1; $i <= $counter; $i++) {
                $input['course_id']=$request->course_id;
                $hourStart = $hour_start.$i;
                $input['hour_start'] = $request->$hourStart;
                $hourEnd = $hour_end.$i;
                $input['hour_end'] = $request->$hourEnd;
                $dayCourse = $day.$i;
                $input['day'] = $request->$dayCourse;
                CourseCalendar::create($input);

                $request->session()->flash(trans('message.success'), trans('message.notification_success'));
            }
        } catch (Exception $e) {
            $request->$request->session()->flash(trans('message.fails'), trans('message.notification_fails'));
        }

        return redirect()->route('calendar.index');
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
    public function edit(CourseCalendar $calendar)
    {
        return view('admin.calendar.edit', compact('calendar'));
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
            CourseCalendar::findOrFail($id)->update($input);

            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
        } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_fails'));
        }

        return redirect()->route('calendar.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try
        {
            CourseCalendar::findOrFail($id)->delete();

            $request->session()->flash(trans('message.success'), trans('message.notification_success'));
        } catch (Exception $e) {
            $request->session()->flash(trans('message.fails'), trans('message.notification_fails'));
        }

        return redirect()->route('calendar.index');
    }
}
