@extends('layouts.public_default')
@section('title', trans('message.course_end'))
@section('content')
    <section>
        <div class="content">
            {{ Html::image(asset('storage/image/banner.jpg')) }}
        </div>
    </section>
    <section class="courses-section spad">
        <div class="container">
            <div class="section-title text-center">
                <h3>{{ $course->name }}</h3>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-7">
                    @foreach($subjects as $subject)
                        <div class="col-md-9">
                            <h4>{{$subject->name}}</h4>
                        </div>
                        <div class="col-md-3">
                            @if ($subject->pivot->status == config('admin.subject_end'))
                                <strong>@lang('message.complete')</strong>
                            @else
                                <strong>@lang('message.not_study')</strong>
                            @endif
                        </div>
                    @endforeach()
                </div>
            </div>
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-3">
                    {{ $subjects->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection()
