@extends('layouts.default_admin')
@section('title', trans('message.calendar'))
@section('content')
    <section class="content-header">
        <h1>@lang('message.calendar')</h1>
    </section>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">
                <a href="{{ route('calendar.create') }}" class="btn btn-primary">
                    <i class="fa fa-paint-brush"></i>@lang('message.create')
                </a>
            </h3>
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
        <div class="box-body">
             <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="col-name-subject">@lang('message.name_course')</th>
                        <th class="name-course">@lang('message.date_study')</th>
                        <th class="col-name-subject">@lang('message.hour_start')</th>
                        <th class="col-name-subject">@lang('message.end')</th>
                        <th class="col-action">@lang('message.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($calendars as $calendar)
                        <tr>
                            <td>{{ $calendar->course->name }}</td>
                            <td>{{ $calendar->day }}</td>
                            <td>{{ $calendar->hour_start }}</td>
                            <td>{{ $calendar->hour_end }}</td>
                            <td>
                                @if(Auth::user()->role == config('admin.admin'))
                                    <div class="col-md-5">
                                        <a href="{{ route('calendar.edit', $calendar) }}" class="btn btn-primary" title="{{trans('message.edit')}}"><i class="fa fa-cog"></i></a>
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::open(['method' => 'delete', 'route' => ['calendar.destroy', $calendar->id]]) }}
                                            {{ Form::button('<i class="fa fa-trash-o"></i>', ['class' => 'btn btn-danger delete', 'type' => 'submit']) }}
                                        {{ Form::close() }}
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach()
                </tbody>
            </table>
        </div>
        <div>
            {{ $calendars->links() }}
        </div>
    </div>
@endsection()
