@extends('layouts.public_default')
@section('title', trans('message.system_trainer'))
@section('content')
    <section class="courses-section spad">
        <div class="container">
            <div class="section-title text-center">
                <h2>{{ $course->name }}</h2>
            </div>
            <div class="row">
               <div class="col-md-7">
                    <h2>@lang('message.content')</h2>
                    @foreach($subject as $subjects)
                        <h3>{{$subjects->name}}</h3>
                    @endforeach()
               </div>
               <div class="col-md-5">
                    <h2>@lang('message.list_trainee_course')</h2>
                    @foreach($member as $members)
                        <h4>
                            <a href="{{ route('profile.show', $members->id) }}">{{ $members->name }}</a>
                        </h4>
                    @endforeach()
               </div>
            </div>
            <div>
                {{ $subject->links() }}
            </div>
        </div>
    </section>
@endsection()
