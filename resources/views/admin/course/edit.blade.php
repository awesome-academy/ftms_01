@extends('layouts.default_admin')
@section('title', trans('message.edit'))
@section('content')
<div class="box box-warning create-box" >
    <div class="box-header with-border course-title">
        <h3 class="box-title">@lang('message.edit')</h3>
    </div>
    @if(session()->has(trans('message.success')))
        <div class="alert alert-success">
            {{ session(trans('message.success')) }}
        </div>
    @elseif(session()->has(trans('message.fails')))
         <div class="alert alert-success">
            {{ session(trans('message.fails')) }}
        </div>
    @endif
    <div class="box-body course-box">
        {{ Form::open(['method' => 'PATCH', 'enctype' => 'multipart/form-data', 'route' => ['course.update', $course->id]]) }}
            <div class="form-group">
                {{ Form::label(trans('message.name')) }}
                {{ Form::text('name', $course->name, ['class' => 'form-control', 'placeholder' => trans('message.name_course'), 'disabled']) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('message.image')) }}
                {{ Form::file('image', ['class' => 'form-control']) }}
                {{ Form::hidden('old_image', $course->image) }}
                @if($errors->has('image'))
                    @include('commonts.errors')
                @endif
            </div>
            <div class="form-group">
                {{ Form::label(trans('message.date_start')) }}
                {{ Form::date('date_start', \Carbon\Carbon::parse($course->date_start_custom), ['class' => 'form-control' .($errors->has('date_start') ? ' is-invalid' : ''), 'required' => 'required']) }}
                @if($errors->has('date_start'))
                    @include('commonts.errors')
                @endif
            </div>
            <div class="form-group">
                {{ Form::label(trans('message.date_end')) }}
                {{ Form::date('date_end', \Carbon\Carbon::parse($course->date_end), ['class' => 'form-control', 'required']) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('message.status')) }}
                {{ Form::select('status', [ config('admin.course_ready') => trans('message.ready'), config('admin.course_start') => trans('message.start'), config('admin.course_end') => trans('message.end')], $course->status, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                <a href="{{ route('course.index') }}" class="btn btn-success"> @lang('message.back') </a>
                {{ Form::submit(trans('message.save'), ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
    </div>
</div>
@endsection()
