<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@extends('layouts.public_default')
@section('title', $course->name)
@section('content')
    <section class="courses-section spad" id = 'a'>
        <div class="container">
            <div class="section-title text-center">
                <h3>{{ $course->name }}</h3>
                <div class="col-md-5"></div>
                <div class="col-md-1"><strong>@lang('message.progress')</strong></div>
                <div class="col-md-2">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">{{$progress}}&#37</div>
                        {{ Form::hidden('progress', $progress, ['id' => 'progress_course']) }}
                    </div>
                </div>
            </div>
            @if(session()->has(trans('message.success')))
                <div class="alert alert-success">
                    {{session(trans('message.success'))}}
                </div>
            @elseif(session()->has(trans('message.fails')))
                <div class="alert alert-success">
                    {{session(trans('message.fails'))}}
                </div>
            @endif
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-5">
                    @foreach($subject as $subjects)
                    <div>
                        <h3>
                            {{ Form::open(['method' => 'patch', 'route' => 'close-subject']) }}
                                @if($subjects->pivot->status == config('admin.subject_start'))
                                    <a href="{{ route('subject.details', $subjects->id) }}" id="read">{{ $subjects->name }}</a>
                                    {{Form::hidden('subject_id', $subjects->id, ['id' => 'subject_id'])}}
                                    <span class="subject-style">@lang('message.start')</span>
                                    {{ Form::submit(trans('message.subject_end'), ['class' => ' btn btn-danger close-subjet', 'id' => 'close']) }}
                                @elseif ($subjects->pivot->status == config('admin.subject_end'))
                                    {{ $subjects->name }}
                                    <span class="subject-style">@lang('message.complete')</span>
                                @endif
                            {{ Form::close() }}
                        </h3>
                    </div>
                @endforeach()
                </div>
                <div>
                    {{ $subject->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection()
