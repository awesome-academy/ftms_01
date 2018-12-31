@extends('layouts.default_admin')
@section('title', trans('message.user'))
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">@lang('message.user')
                @if(Auth::user()->role == config('admin.supervisor'))
                @else
                    <a href="{{route('register')}}" class="btn btn-primary">
                        <i class="fa fa-paint-brush"></i>@lang('message.create')
                    </a>
                @endif
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
                        <th class="col-title-post"> @lang('message.name') </th>
                        <th class="col-name"> @lang('message.email')</th>
                        <th class="col-name"> @lang('message.role')</th>
                        <th id="col-image"> @lang('message.password') </th>
                        <th> @lang('message.action') </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($supervisor as $supervisors)
                        <tr>
                            <td> {{ $supervisors->name }} </td>
                            <td> {{ $supervisors->email }} </td>
                            <td>{{ $supervisors->role_custom }}</td>
                            <td>{{ $supervisors->password }}</td>
                            <td>
                                <div class="col-md-5">
                                    @if(Auth::user()->role == config('admin.supervisor'))
                                    @else
                                        {{Form::open()}}
                                            {{Form::submit(trans('message.delete'), ['class' => 'btn btn-danger delete'])}}
                                        {{Form::close()}}
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach()
                </tbody>
            </table>
            <div>
                {{ $supervisor->links() }}
            </div>
        </div>
    </div>
@endsection()
