@extends('layouts.default_admin')
@section('title', trans('message.progress'))
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">@lang('message.progress')
            </h3>
        </div>
        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="name-course">@lang('message.name_course')</th>
                        <th class="col-img-course">@lang('message.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->name }}</td>
                            <td>
                                <a href="{{ route('show-progress', $course->id) }}" class="btn btn-primary">@lang('message.view')</a>
                            </td>
                        </tr>
                    @endforeach()
                </tbody>
            </table>
        </div>
    </div>
@endsection()
