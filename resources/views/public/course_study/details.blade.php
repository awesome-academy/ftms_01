@extends('layouts.public_default')
@section('title', $course->name)
@section('content')
    <section class="courses-section spad">
        <div class="container">
            <div class="section-title text-center">
                <h3>{{ $course->name }}</h3>
            </div>
            <div class="row">
                @foreach($subject as $subjects)
                    <div>
                        <h3>
                            <a href="{{ route('subject.details', $subjects->id) }}">{{$subjects->name}}</a>
                        </h3>
                    </div>
                @endforeach()
                <div>
                    {{ $subject->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection()
