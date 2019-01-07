@extends('layouts.public_default')
@section('title', trans('message.calendar'))
@section('content')
    <section class="courses-section spad">
        <div class="container">
            <h2>@lang('message.calendar')</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>@lang('message.name_course')</th>
                        <th>@lang('message.date_study')</th>
                        <th>@lang('message.hour_start')</th>
                        <th>@lang('message.hour_end')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($calendars as $calendar)
                        <tr>
                            <td>{{ $calendar->course->name }}</td>
                            <td>{{ $calendar->day }}</td>
                            <td>{{ $calendar->hour_start }}</td>
                            <td>{{ $calendar->hour_end }}</td>
                        </tr>
                    @endforeach()
                </tbody>
            </table>
            <div>
                {{ $calendars->links() }}
            </div>
        </div>
    </section>
@endsection()
