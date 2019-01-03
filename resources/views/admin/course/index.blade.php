@extends('layouts.default_admin')
@section('title', trans('message.course'))
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">@lang('message.course')
                <a href="{{route('course.create')}}" class="btn btn-primary">
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
                        <th class="name-course">@lang('message.name')</th>
                        <th class="col-img-course">@lang('message.image')</th>
                        <th>@lang('message.date_start')</th>
                        <th>@lang('message.date_end')</th>
                        <th>@lang('message.status')</th>
                        <th class="col-action">@lang('message.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($course as $courses)
                        <tr>
                            <td>{{ $courses->name }}</td>
                            <td>
                                {{ Html::image(asset('storage/image/course/'.$courses->image), '', ['class' => 'img img-circle img-course']) }}
                            </td>
                            <td>{{ $courses->date_start_custom }}</td>
                            <td>{{ $courses->date_end_custom }}</td>
                            <td>{{ $courses->status_custom }}</td>
                            <td>
                                <div class="col-md-4">
                                    <a href="" class="btn btn-success">@lang('message.view')</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('course.edit', $courses) }}" class="btn btn-primary">@lang('message.edit')</a>
                                </div>
                                <div class="col-md-4">
                                    {{ Form::open(['method' => 'delete', 'route' => ['course.destroy', $courses->id]]) }}
                                        {{ Form::submit(trans('message.delete'), ['class' => 'btn btn-danger delete']) }}
                                    {{ Form::close() }}
                                </div>
                            </td>
                        </tr>
                    @endforeach()
                </tbody>
            </table>
            <div>
                {{ $course->links() }}
            </div>
        </div>
    </div>
@endsection()
