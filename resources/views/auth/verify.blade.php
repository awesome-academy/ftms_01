@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('message.verify_email')</div>
                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                @lang('message.send_verification')
                            </div>
                        @endif
                        @lang('message.check_email')
                        @lang('message.not_get_email'), <a href="{{ route('verification.resend') }">@lang('message.click')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
