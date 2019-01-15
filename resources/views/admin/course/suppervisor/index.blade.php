@extends('layouts.default_admin')
@section('title', trans('message.management_suppervisor'))
@section('content')
    <section class="content-header">
        <h1>@lang('message.list_suppervisor_course')</h1>
    </section>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">
                <a href=" {{ route('supperviosr.create') }} " class="btn btn-primary">
                    <i class="fa fa-paint-brush"></i>@lang('message.create')
                </a>
            </h3>
            <div class="option-course">
                {{ Form::label(trans('message.name_course')) }}
                {{ Form::select('course_id', $course->pluck('name','id'), null, ['class' => 'form-control', 'id' => 'course_suppervisor']) }}
            </div>
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
                        <th class="col-name-subject">@lang('message.name_suppervisor')</th>
                        <th class="col-action">@lang('message.action')</th>
                    </tr>
                </thead>
                <tbody id="suppervisor">

                </tbody>
            </table>
        </div>
    </div>
@endsection
