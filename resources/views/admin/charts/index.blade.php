@extends('layouts.default_admin')
@section('title', trans('message.precious'))
@section('content')
    {!! Charts::assets() !!}
    <div class="container">
        {!! $chartMonth->render() !!}
    </div>
    <div class="container">
        {!! $chartYear->render() !!}
    </div>
    <div class="container">
        {!! $chartPrecious->render() !!}
    </div>
@endsection
