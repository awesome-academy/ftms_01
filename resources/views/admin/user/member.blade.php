@extends('layouts.default_admin')
@section('title', trans('message.user'))
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">@lang('message.user')
                <a href="{{route('register')}}" class="btn btn-primary">
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
                        <th class="col-title-post"> @lang('message.name') </th>
                        <th class="col-name"> @lang('message.email')</th>
                        <th class="col-name"> @lang('message.role')</th>
                        <th id="col-image"> @lang('message.password') </th>
                        <th> @lang('message.action') </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($member as $members)
                        <tr>
                            <td> {{ $members->name }} </td>
                            <td> {{ $members->email }} </td>
                            <td> {{ $members->role_custom }} </td>
                            <td> {{ $members->password }} </td>
                            <td>
                                <div class="col-md-5">
                                    {{Form::open()}}
                                        {{Form::submit(trans('message.delete'), ['class' => 'btn btn-danger delete'])}}
                                    {{Form::close()}}
                                </div>
                            </td>
                        </tr>
                    @endforeach()
                </tbody>
            </table>
            <div>
                {{ $member->links() }}
            </div>
        </div>
    </div>
@endsection()
