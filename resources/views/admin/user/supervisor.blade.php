@extends('layouts.default_admin')
@section('title', trans('message.user'))
@section('content')
    <section class="content-header">
        <h1>@lang('message.list_suppervisor_course')</h1>
    </section>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">
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
                        <th>@lang('message.role')</th>
                        <th>@lang('message.action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($supervisor as $supervisors)
                        <tr>
                            <td>{{ $supervisors->name }}</td>
                            <td>{{ $supervisors->email }}</td>
                            <td>{{ $supervisors->role_custom }}</td>
                            <td>
                                <div class="col-md-2">
                                    {{ Form::button('<i class="fa fa-eye"></i>', ['class' => 'btn btn-success show-modal', 'data-toggle' => 'modal', 'data-target' => '#exampleModal'.$supervisors->id, 'title' => trans('message.view')]) }}
                                </div>
                                <div class="col-md-2">
                                    @if(Auth::user()->role == config('admin.supervisor'))
                                    @else
                                    {{ Form::open(['route' => ['delete-suppervisor', $supervisors->id], 'method' => 'delete']) }}
                                            {{ Form::button('<i class="fa fa-trash-o"></i>', ['class' => 'btn btn-danger delete', 'type' => 'submit', 'title' => trans('message.delete')]) }}
                                        {{ Form::close() }}
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="exampleModal{{$supervisors->id}}"   tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                            {{ Html::image(asset('storage/image/'. (!$supervisors->profile ? 'abstract-user-flat-3.svg' : 'avatar/'.$supervisors->profile->image )),
                                                '', ['class' => 'img-circle img-profile']) }}
                                        </div>
                                        <br>
                                        <div class="profile-modal">
                                            <div class="form-group">
                                                <p>
                                                    <strong>@lang('message.name') : </strong>
                                                    {{ $supervisors->name }}
                                                </p>
                                                <p>
                                                    <strong>@lang('message.phone') : </strong>
                                                    {{ (!$supervisors->profile) ? '' : $supervisors->profile->phone }}
                                                </p>
                                                <p>
                                                    <strong>@lang('message.address') : </strong>
                                                    {{ (!$supervisors->profile) ? '' :  $supervisors->profile->address }}
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
                {{ $supervisor->links() }}
            </div>
        </div>
    </div>
@endsection()
