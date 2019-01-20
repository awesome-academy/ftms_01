@extends('layouts.default_admin')
@section('title', trans('message.precious'))
@section('content')
    {!! Charts::assets() !!}
    <div class="container">
        <h3>@lang('message.statistical_month')</h3>
        {!! $chartMonth->render() !!}
    </div>
    <div class="container">
        <h3>@lang('message.statistical_precious')</h3>
        {!! $chartPrecious->render() !!}
    </div>
    <div class="container">
        <h3>@lang('message.statistical_year')</h3>
        {!! $chartYear->render() !!}
    </div>
    <div class="container">
        <h3>@lang('message.total')</h3>
        <div class="col-md-5">
            {!! $userChart->render() !!}
        </div>
        <div class="col-md-7">
            {!! $courseChart->render() !!}
        </div>
    </div>
@endsection
