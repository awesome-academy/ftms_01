@extends('layouts.default_admin')
@section('title', trans('message.create'))
@section('content')
    <div class="box-body course-box">
        {{ Form::open(['route' => 'calendar.store']) }}
            <div class="form-group">
                {{ Form::label(trans('message.name_course')) }}
                {{ Form::select('course_id', $courses->pluck('name', 'id'), null, ['class' => 'form-control']) }}
                {{ Form::hidden('count', config('admin.count'), ['id' => 'counter']) }}
            </div>
            <div id="box_calendar">
                <div id="box_calendar1">
                    <div class="form-group">
                        {{ Form::label(trans('message.date_study')) }}
                        {{ Form::number('day1', '', ['class' => 'form-control', 'placeholder' => trans('message.date_study'), 'required']) }}
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label(trans('message.hour_start')) }}
                            {{ Form::time('hour_start1', '', ['class' => 'form-control',]) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label(trans('message.hour_end')) }}
                            {{ Form::time('hour_end1', '', ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="right">
                <a href="" class="btn btn-primary" id="add-text-calendar"><i class="fa fa-plus-circle"></i></a>
                <a href="" class="btn btn-danger" id="delete-text-calendar"><i class="fa fa-trash-o"></i></a>
            </div>
            <br>
            <div class="form-group">
                <a href="{{ route('calendar.index') }}" class="btn btn-success">@lang('message.back')</a>
                {{ Form::submit(trans('message.create'), ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
    </div>
@endsection()
