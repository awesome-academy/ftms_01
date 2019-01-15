@extends('layouts.default_admin')
@section('title', trans('message.subject'))
@section('content')
    <section class="content-header">
        <h1>@lang('message.subject')</h1>
    </section>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">
                <a href="{{route('subject.create')}}" class="btn btn-primary">
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
                        <th class="col-name-subject">@lang('message.name_subject')</th>
                        <th class="name-course">@lang('message.name_course')</th>
                        <th>@lang('message.status')</th>
                        <th class="col-action">@lang('message.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subject as $subjects)
                        <tr>
                            <td>{{ $subjects->name }}</td>
                            <td>{{ $subjects->course->name }}</td>
                            <td>{{ $subjects->status_custom }}</td>
                            <td>
                                <div class="col-md-4">
                                    <a href="{{ route('subject.show', $subjects) }}" class="btn btn-success" title="{{trans('message.view')}}"><i class="fa fa-eye"></i></a>
                                </div>
                                @if(Auth::user()->role == config('admin.admin'))
                                    <div class="col-md-4">
                                        <a href="{{ route('subject.edit', $subjects) }}" class="btn btn-primary" title="{{trans('message.edit')}}"><i class="fa fa-edit"></i></a>
                                    </div>
                                    <div class="col-md-4">
                                        {{ Form::open(['method' => 'delete', 'route' => ['subject.destroy', $subjects->id]]) }}
                                            {{ Form::button('<i class="fa fa-trash-o"></i>', ['class' => 'btn btn-danger delete', 'type' => 'submit', 'title' => trans('message.delete')]) }}
                                        {{ Form::close() }}
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach()
                </tbody>
            </table>
            <div>
                {{ $subject->links() }}
            </div>
        </div>
    </div>
@endsection()
