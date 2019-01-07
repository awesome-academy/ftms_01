@extends('layouts.public_default')
@section('title', trans('message.profile'))
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
                    <br>
                    <div class = "box-profile">
                        <p>@lang('message.name') : <strong> {{ $user->name }} </strong></p>
                        <p>@lang('message.email') : <strong> {{ $user->email }}</strong></p>
                        <p>@lang('message.phone') : <strong>{{ (!$user->profile ? '' : $user->profile->phone) }}</strong></p>
                        <p>@lang('message.address') : <strong>{{ (!$user->profile ? '' : $user->profile->address) }}</strong></p>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </section>
@endsection()
