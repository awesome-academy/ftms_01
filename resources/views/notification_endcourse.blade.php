@extends('layouts.public_default')
@section('title', trans('message.notification_course_end'))
@section('content')
    <section class="courses-section spad">
        <div class="container">
            <div class="section-title text-center">
                <h2>@lang('message.notification_course_end')</h2>
            </div>
            <div style="text-align: center;">
                <h4>@lang('message.notification_preamble') {{ auth()->user()->name }}</h4>
                <h5>@lang('message.notification_body') <strong>{{ json_decode($result->data)->course->name }}</strong></h5>
                <h5>@lang('message.notification_end')</h5>

            </div>
        </div>
    </section>
@endsection()
