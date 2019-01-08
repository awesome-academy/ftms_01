@extends('layouts.public_default')
@section('title', trans('message.system_trainer'))
@section('content')
    <section class="courses-section spad">
        <div class="container">
            <div class="section-title text-center">
                <h3>@lang('message.course_current')</h3>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 course-item">
                    <div class="course-thumb">
                        {{ Html::image(asset('')) }}
                        <div class="course-cat">
                            <span></span>
                        </div>
                    </div>
                    <div class="course-info">
                        <h4></h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection()

