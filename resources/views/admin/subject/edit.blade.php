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
        {{ Form::open(['method' => 'PATCH', 'route' => ['subject.update', $subject->id]]) }}
            <div class="form-group">
                {{ Form::label(trans('message.name_subject')) }}
                {{ Form::text('name', $subject->name, ['class' => 'form-control', 'placeholder' => trans('message.name_subject'), 'required']) }}
                @if($errors->has('name'))
                    @include('commonts.errors')
                @endif
            </div>
            <div class="form-group">
                {{ Form::label(trans('message.content')) }}
                {{ Form::textarea('content', $subject->content->content, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('message.status')) }}
                {{ Form::select('status', [ config('admin.subject_end') => trans('message.subject_end'), config('admin.subject_ready') => trans('message.subject_ready')], $subject->status, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                <a href="{{ route('subject.index') }}" class="btn btn-success">@lang('message.back')</a>
                {{ Form::submit(trans('message.save'), ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
    </div>
</div>
@endsection()
