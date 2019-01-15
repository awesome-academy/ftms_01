@extends('layouts.default_admin')
@section('title', trans('message.list_course'))
@section('content')
    <section class="content-header">
        <h1>@lang('message.list_course')</h1>
    </section>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">
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
                                    <a href="{{ route('view-course', $courses->id) }}" class="btn btn-success" title="{{trans('message.view')}}"><i class="fa fa-eye"></i></a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('course.edit', $courses) }}" class="btn btn-primary" title="{{trans('message.edit')}}"><i class="fa fa-cog"></i></a>
                                </div>
                                <div class="col-md-4">
                                    {{ Form::open(['method' => 'delete', 'route' => ['course.destroy', $courses->id]]) }}
                                        <div>
                                            {{ Form::button('<i class="fa fa-trash-o"></i>', ['class' => 'btn btn-danger delete', 'type' => 'submit']) }}
                                        </div>
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
