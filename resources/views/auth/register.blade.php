@extends('layouts.app')
@section('title', trans('message.register'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('message.register')</div>
                    @if(session()->has(trans('message.success')))
                        <div class="alert alert-success">
                            {{ session(trans('message.success')) }}
                        </div>
                    @endif
                    <div class="card-body">
                        {{ Form::open(['route' => 'register']) }}
                            <div class="form-group row">
                                {{ Form::label(trans('message.name'), '', ['class' => 'col-md-4 col-form-label text-md-right']) }}
                                <div class="col-md-6">
                                    {{ Form::text('name', '', ['class' => 'form-control'.($errors->has('name') ? ' is-invalid' : ''), 'required']) }}
                                    @include('commonts.errors')
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label(trans('message.role'), '', ['class' => 'col-md-4 col-form-label text-md-right']) }}
                                <div class="col-md-6">
                                    {{ Form::select('role', [ config('admin.supervisor') => trans('message.supervisor'), config('admin.member') => trans('message.member')], null, ['class' => 'form-control'])}}
                                    @include('commonts.errors')
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label(trans('message.email'), '', ['class' => 'col-md-4 col-form-label text-md-right']) }}
                                <div class="col-md-6">
                                    {{ Form::email('email', '', ['class' => 'form-control'.($errors->has('email') ? ' is-invalid' : ''), 'required']) }}
                                    @include('commonts.errors')
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label(trans('message.password'), '', ['class' => 'col-md-4 col-form-label text-md-right']) }}
                                <div class="col-md-6">
                                    {{ Form::password('password', ['class' => 'form-control'.($errors->has('password') ? ' is-invalid' : ''), 'required']) }}
                                    @include('commonts.errors')
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label(trans('message.confirm'), '', ['class' => 'col-md-4 col-form-label text-md-right']) }}
                                <div class="col-md-6">
                                    {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    {{ Form::submit(trans('message.register'), ['class' => 'btn btn-primary']) }}
                                    <a href="{{ route('admin') }}">@lang('message.home')</a>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
