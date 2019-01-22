@extends('layouts.default_admin')
@section('title', $subject->name)
@section('content')
<div class="box box-warning create-box" >
    <div class="box-header with-border course-title">
        <h3 class="box-title">{{ $subject->name }}</h3>
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
            <div class="form-group">
                {{ Form::label(trans('message.name_subject')) }}
                {{ Form::text('name', $subject->name, ['class' => 'form-control', 'placeholder' => trans('message.name_subject'), 'disabled']) }}
                @if($errors->has('name'))
                    @include('commonts.errors')
                @endif
            </div>
            <div class="form-group">
                {{ Form::label(trans('message.content')) }}
                {{ Form::textarea('content', $subject->content->content, ['class' => 'form-control', 'rows' => 20, 'disabled']) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('message.status')) }}
                {{ Form::text('role', $subject->status_custom, ['class' => 'form-control', 'disabled']) }}
            </div>
            <div class="form-group">
                <a href="{{ route('subject.index') }}" class="btn btn-success">@lang('message.back')</a>
            </div>
    </div>
</div>
@endsection()
