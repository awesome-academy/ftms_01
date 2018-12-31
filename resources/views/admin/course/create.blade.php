@extends('layouts.default_admin')
@section('title', trans('message.create'))
@section('content')
<div class="box box-warning create-box" >
    <div class="box-header with-border course-title">
        <h3 class="box-title">@lang('message.create')</h3>
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
        {{ Form::open(['route' => 'course.store', 'enctype' => 'multipart/form-data']) }}
            <div class="form-group">
                {{ Form::label(trans('message.supervisor')) }}
                {{ Form::select('user_id', $supervisor->pluck('name', 'id'), null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('message.name')) }}
                {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => trans('message.name_course'), 'required']) }}
                @if($errors->has('name'))
                    @include('commonts.errors')
                @endif
            </div>
            <div class="form-group">
                {{ Form::label(trans('message.image')) }}
                {{ Form::file('image', ['class' => 'form-control', 'required']) }}
                @if($errors->has('image'))
                    @include('commonts.errors')
                @endif
            </div>
            <div class="form-group">
                {{ Form::label(trans('message.date_start')) }}
                {{ Form::date('date_start', '', ['class' => 'form-control' .($errors->has('date_start') ? ' is-invalid' : ''), 'required' => 'required']) }}
                @if($errors->has('date_start'))
                    @include('commonts.errors')
                @endif
            </div>
            <div class="form-group">
                {{ Form::label(trans('message.date_end')) }}
                {{ Form::date('date_end', '', ['class' => 'form-control', 'required']) }}
            </div>
            <div class="form-group">
                {{ Form::submit(trans('message.create'), ['class' => 'btn btn-primary']) }}
                <a href="{{ route('course.index') }}" class="btn btn-success">@lang('message.back') </a>
            </div>
        {{ Form::close() }}
    </div>
</div>

@endsection()
