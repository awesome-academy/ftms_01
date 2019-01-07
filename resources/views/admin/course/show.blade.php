@extends('layouts.default_admin')
@section('title', trans('message.course_detail'))
@section('content')
    <section class="content-header">
        <h1>@lang('message.course_detail')</h1>
    </section>
    <div class="box">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <h3>@lang('message.subject')</h3>
                @foreach($subjects as $subject)
                    <p> {{ $subject->name }} </p>
                @endforeach()
            </div>
            <div class="col-md-6">
                <h3>@lang('message.calendar')</h3>
                <div class="col-md-6">
                    <p>
                        <strong>@lang('message.date_start') : {{ $course->date_start_custom }}</strong>
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        <strong>@lang('message.date_end') : {{ $course->date_end_custom }}</strong>
                    </p>
                </div>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="name-course">@lang('message.date_study')</th>
                            <th class="col-img-course">@lang('message.hour_start')</th>
                        <th class="col-img-course">@lang('message.hour_end')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($calendars as $calendar)
                            <tr>
                                <td>{{ $calendar->day }}</td>
                                <td>{{ $calendar->hour_start }}</td>
                                <td>{{ $calendar->hour_end }}</td>
                            </tr>
                        @endforeach()
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection()
