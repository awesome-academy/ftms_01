@extends('layouts.public_default')
@section('title', trans('message.list_report'))
@section('content')
    <section class="courses-section spad">
        <div class="container">
            <h2>@lang('message.content_report')</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>@lang('message.name_course')</th>
                        <th>@lang('message.name_subject')</th>
                        <th>@lang('message.content')</th>
                        <th>@lang('message.date')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports as $report)
                        <tr>
                            <td>{{ $report->subject->course->name }}</td>
                            <td>{{ $report->subject->name }}</td>
                            <td>{{ $report->content }}</td>
                            <td>{{ $report->created_at_custom }}</td>
                        </tr>
                    @endforeach()
                </tbody>
            </table>
            <div>
                {{ $reports->links() }}
            </div>
        </div>
    </section>
@endsection()
