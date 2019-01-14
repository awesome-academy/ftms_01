@extends('layouts.default_admin')
@section('title', trans('message.edit'))
@section('content')
<div class="box box-warning create-box" >
    <div class="box-header with-border course-title">
        <h3 class="box-title">@lang('message.edit')</h3>
    </div>
    <div class="box-body course-box">
        {{ Form::open(['method' => 'patch', 'route' => ['calendar.update', $calendar->id]]) }}
            <div class="form-group">
                {{ Form::label(trans('message.date_study')) }}
                {{ Form::text('day', $calendar->day, ['class' => 'form-control', 'placeholder' => trans('message.name_subject'), 'required']) }}
            </div>
            {{$calendar->date_start}}
            <div class="form-group">
                {{ Form::label(trans('message.hour_start')) }}
                {{ Form::time('hour_start', $calendar->hour_start, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('message.hour_start')) }}
                {{ Form::time('hour_end', $calendar->hour_end, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <a href="{{ route('calendar.index') }}" class="btn btn-danger">@lang('message.back')</a>
                {{ Form::submit(trans('message.save'), ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
    </div>
</div>
@endsection()
