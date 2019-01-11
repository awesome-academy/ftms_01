@extends('layouts.default_admin')
@section('title', trans('message.user'))
@section('content')
    <section class="content-header">
        <h1>@lang('message.list_trainee_course')</h1>
    </section>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">
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
                        <th> @lang('message.role')</th>
                        <th> @lang('message.action') </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($member as $members)
                        <tr>
                            <td>{{ $members->name }}</td>
                            <td>{{ $members->email }}</td>
                            <td>{{ $members->role_custom }}</td>
                            <td>
                                <div class="col-md-2">
                                    {{ Form::button('<i class="fa fa-eye"></i>', ['class' => 'btn btn-success show-modal', 'data-toggle' => 'modal', 'data-target' => '#exampleModal'.$members->id, 'title' => trans('message.view')]) }}
                                </div>
                                <div class="col-md-2">
                                    {{ Form::open(['route' => ['delete-member', $members->id], 'method' => 'delete']) }}
                                        {{ Form::button('<i class="fa fa-trash-o"></i>', ['class' => 'btn btn-danger delete', 'type' => 'submit', 'title' => trans('message.delete')]) }}
                                    {{ Form::close() }}
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="exampleModal{{$members->id}}"
                            tabindex="-1"
                            role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            @lang('message.profile')
                                        </h5>
                                        {{ Form::button('<span aria-hidden="true">&times; </span>', ['class' => 'close', 'data-dismiss' => 'modal', 'aria-label' => 'close']) }}
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            {{ Html::image(asset('storage/image/'. (!$members->profile ? 'abstract-user-flat-3.svg' : 'avatar/'.$members->profile->image )),
                                                '', ['class' => 'img-circle img-profile']) }}
                                        </div>
                                        <br>
                                        <div class="profile-modal">
                                            <div class="form-group">
                                                <p>
                                                    <strong>@lang('message.name') : </strong>
                                                    {{ $members->name }}
                                                </p>
                                                <p>
                                                    <strong>@lang('message.phone') : </strong>
                                                    {{ (!$members->profile) ? '' : $members->profile->phone }}
                                                </p>
                                                <p>
                                                    <strong>@lang('message.address') : </strong>
                                                    {{ (!$members->profile) ? '' : $members->profile->address }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{ Form::button(trans('message.close'), ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach()
                </tbody>
            </table>
            <div>
                {{ $member->links() }}
            </div>
        </div>
    </div>
@endsection()
