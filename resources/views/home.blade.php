@extends('layouts.public_default')
@section('title', trans('message.system_trainer'))
@section('content')
    <section>
        <div class="content">
            {{ Html::image(asset('storage/image/banner.jpg')) }}
        </div>
    </section>
    <section class="courses-section spad">
        <div class="container">
            <div class="section-title text-center">
                <h3>@lang('message.course_current')</h3>
            </div>
            <div class="row">
                @foreach($course as $courses)
                    <div class="col-lg-4 col-md-6 course-item">
                        <a href="{{ route('course.show', $courses->first()->id) }}">
                            <div class="course-thumb">
                                {{ Html::image(asset('storage/image/course/'.$courses->first()->image), '', ['class' => 'img-course']) }}
                                <div class="course-cat">
                                    <span></span>
                                </div>
                            </div>
                            <div class="course-info">
                                <h4>{{ $courses->first()->name }}</h4>
                            </div>
                        </a>
                    </div>
                @endforeach()
            </div>
        </div>
    </section>
@endsection()
