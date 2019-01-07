@extends('layouts.public_default')
@section('title', trans('message.profile'))
@section('content')
    <section class="courses-section spad">
        <div class="container">
            <div class="section-title text-center">
                <h2>@lang('message.profile')</h2>
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
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-7">
                    {{ Html::image(asset('storage/image/'. (!$user->profile ? 'abstract-user-flat-3.svg' : 'avatar/'.$user->profile->image )),
                        '', ['class' => 'img-circle img-profile']) }}
                    <br>
                    <div class = "box-profile">
                        <p>@lang('message.name') : <strong> {{ $user->name }} </strong></p>
                        <p>@lang('message.email') : <strong> {{ $user->email }}</strong></p>
                        <p>@lang('message.phone') : <strong>{{ !$user->profile ? '' : $user->profile->phone }}</strong></p>
                        <p>@lang('message.address') : <strong>{{ !$user->profile ? '' : $user->profile->address }}</strong></p>
                        <a href="" class="btn btn-primary show-modal" data-toggle="modal" data-target="#exampleModal">@lang('message.edit_profile')</a>
                        <a href="{{ route('home') }}" class="btn btn-primary">@lang('message.back')</a>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">@lang('message.edit_profile')</h5>
                            {{ Form::button('<span aria-hidden="true">&times; </span>', ['class' => 'close', 'data-dismiss' => 'modal', 'aria-label' => 'close']) }}
                        </div>
                        <div class="modal-body">
                            {{ Form::open(['method' => 'PATCH', 'route' => ['profile.update', $user->id], 'files' => true]) }}
                                <div class="form-group">
                                    {{ Html::image(asset('storage/image/'. (!$user->profile ? 'abstract-user-flat-3.svg' : 'avatar/'.$user->profile->image )),
                                        '', ['class' => 'img-circle img-profile']) }}
                                    {{ Form::file('image', ['class' => 'form-control']) }}
                                    {{ Form::hidden('oldImg', (!$user->profile ? '' : $user->profile->image)) }}
                                    @if($errors->has('image'))
                                        @include('commonts.errors')
                                    @endif
                                </div>
                                <div class="form-group">
                                    {{ Form::label(trans('message.name')) }}
                                    {{ Form::text('name', $user->name, ['class' => 'form-control', 'required']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label(trans('message.email')) }}
                                    {{ Form::email('email', $user->email, ['class' => 'form-control', 'required']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label(trans('message.phone')) }}
                                    {{ Form::number('phone', (!$user->profile ? '' : $user->profile->phone), ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label(trans('message.address')) }}
                                    {{ Form::text('address', (!$user->profile ? '' : $user->profile->address), ['class' => 'form-control']) }}
                                </div>
                                <div class="modal-footer">
                                    {{ Form::button(trans('message.close'), ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
                                    {{ Form::submit(trans('message.edit'), ['class' => 'btn btn-primary a']) }}
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection()
