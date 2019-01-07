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
                <h3>@lang('message.course_end')</h3>
            </div>
            <div class="row">
                @foreach($courseEnds as $courseEnd)
                    <div class="col-lg-4 col-md-6 course-item">
                        <a href="{{ route('course-end-detail', $courseEnd->first()->id) }}">
                            <div class="course-thumb">
                                {{ Html::image(asset('storage/image/course/'.$courseEnd->first()->image), '', ['class' => 'img-course']) }}
                                <div class="course-cat">
                                    <span></span>
                                </div>
                            </div>
                            <div class="course-info">
                                <h4>{{ $courseEnd->first()->name }}</h4>
                            </div>
                        </a>
                    </div>
                @endforeach()
            </div>
        </div>
    </section>
@endsection()
