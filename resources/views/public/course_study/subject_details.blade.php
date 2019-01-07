@extends('layouts.public_default')
@section('title', $subject->name)
@section('content')
    <section class="courses-section spad">
        <div class="container">
            <div class="section-title text-center">
                <h3>{{ $subject->name }}</h3>
            </div>
            <div class="row">
                {{ Form::open() }}
                    {{ Form::textarea('subject', $subject->content->content, ['class' => 'form-control', 'rows' => config('admin.rows_subject'), 'disabled']) }}
                    <div class="form-group">
                        <h3>@lang('message.report')</h3>
                    </div>
                    <div class="form-group">
                        {{ Form::label(trans('message.content_report')) }}
                        {{ Form::textarea('content', '', ['class' => 'form-control', 'rows' => config('admin.rows')]) }}
                    </div>
                    {{ Form::submit(trans('message.report'), ['class' => 'btn btn-success']) }}
                {{ Form::close() }}
            </div>
        </div>
    </section>
@endsection()
