@extends('layouts.default_admin')
@section('title', trans('message.progress'))
@section('content')
    <section class="content-header">
        <h1>@lang('message.progress')</h1>
    </section>
    <div class="box">
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
                                <a href="{{ route('show-progress', $course->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach()
                </tbody>
            </table>
        </div>
    </div>
@endsection()
