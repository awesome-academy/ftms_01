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
        {{ Form::open(['route' => 'subject.store']) }}
            <div class="form-group">
                {{ Form::label(trans('message.name_course')) }}
                {{ Form::select('course_id', $course->pluck('name', 'id'), null, ['class' => 'form-control']) }}
            </div>
            <div id="box_group">
                <div id="box_group1">
                    <div class="form-group">
                        {{ Form::label(trans('message.name_subject')) }}
                        {{ Form::text('name1', '', ['class' => 'form-control', 'placeholder' => trans('message.name_subject'), 'required']) }}
                        @if($errors->has('name'))
                            @include('commonts.errors')
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::label(trans('message.content')) }}
                        {{ Form::textarea('content1', '', ['class' => 'form-control', 'rows' => config('admin.rows')]) }}
                    </div>
                </div>
            </div>
            <div class="right">
                <a href="" class="btn btn-primary" id="add-text-subject"><i class="fa fa-plus-circle"></i></a>
                <a href="" class="btn btn-danger" id="delete-text-subject"><i class="fa fa-trash-o"></i></a>
            </div>
            <div class="form-group">
                {{ Form::submit(trans('message.create'), ['class' => 'btn btn-primary']) }}
                <a href="{{ route('subject.index') }}" class="btn btn-success">@lang('message.list')</a>
            </div>
            {{ Form::hidden('counter', 1, ['id' => 'counter']) }}
        {{ Form::close() }}
    </div>
</div>
@endsection()
