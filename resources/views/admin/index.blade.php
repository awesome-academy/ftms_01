@extends('layouts.default_admin')
@section('title', trans('message.title_admin'))
@section('content')
    <section class="courses-section spad">
        <div class="container">
            <div class="section-title text-center">
                <h2>@lang('message.profile')</h2>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-7">
                    {{ Html::image(asset('storage/image/'. (!$user->profile ? 'abstract-user-flat-3.svg' : 'avatar/'.$user->profile->image )),
                        '', ['class' => 'img-circle img-profile']) }}
                    <div class = "box-profile">
                        <p>@lang('message.name') : <strong> {{ $user->name }} </strong></p>
                        <p>@lang('message.email') : <strong> {{ $user->email }}</strong></p>
                        <p>@lang('message.phone') : <strong>{{ !$user->profile ? '' : $user->profile->phone }}</strong></p>
                        <p>@lang('message.address') : <strong>{{ !$user->profile ? '' : $user->profile->address }}</strong></p>
                        <a href="{{ route('myprofile.show', $user->id) }}" class="btn btn-primary">@lang('message.edit_profile')</a>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </section>
@endsection()
