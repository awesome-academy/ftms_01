@extends('layouts.default_admin')
@section('title', trans('message.add_suppervisor_to_course'))
@section('content')
    <div class="box box-warning create-box" >
        <div class="box-header with-border course-title">
            <h3 class="box-title">@lang('message.add_suppervisor_to_course')</h3>
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
            {{ Form::open(['route' => 'suppervisor.stores']) }}

                <div class="form-group">
                    {{ Form::label(trans('message.name_course')) }}
                    {{ Form::select('course_id', $course->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'course_id']) }}
                </div>
                <div class="form-group">
                    {{ Form::select('user_id[]', $user->pluck('name', 'id'), null, ['class' => 'form-control', 'multiple' => 'multiple', 'required']) }}
                </div>
                <div class="form-group">
                    <a href="{{ route('suppervisor.index') }}" class="btn btn-success">@lang('message.back') </a>
                    {{ Form::submit(trans('message.create'), ['class' => 'btn btn-primary']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection()
