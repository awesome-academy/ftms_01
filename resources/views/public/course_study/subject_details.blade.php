@extends('layouts.public_default')
@section('title', $subject->name)
@section('content')
    <section class="courses-section spad">
        <div class="container">
            <div class="section-title text-center">
                <h3>{{ $subject->name }}</h3>
            </div>
            <div class="row">
                {{ Form::open(['route' => 'report']) }}
                    {{ Form::textarea('subject', $subject->content->content, ['class' => 'form-control', 'rows' => config('admin.rows_subject'), 'disabled']) }}
                    {{ Form::hidden('subject_id', $subject->id) }}
                    <div class="form-group">
                        <h3>@lang('message.report')</h3>
                    </div>
                    <div class="form-group">
                        {{ Form::label(trans('message.content_report')) }}
                        @if(session()->has(trans('message.success')))
                            <div class="alert alert-success">
                                {{session(trans('message.success'))}}
                            </div>
                        @elseif(session()->has(trans('message.fails')))
                            <div class="alert alert-success">
                                {{session(trans('message.fails'))}}
                            </div>
                        @endif
                        {{ Form::textarea('content', '', ['class' => 'form-control', 'rows' => config('admin.rows'), 'required']) }}
                        {{ Form::hidden('subject_id', $subject->id) }}
                    </div>
                    {{ Form::submit(trans('message.report'), ['class' => 'btn btn-success']) }}
                {{ Form::close() }}
            </div>
        </div>
    </section>
@endsection()
