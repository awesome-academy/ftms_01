@extends('layouts.default_admin')
@section('title', trans('message.progress'))
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">@lang('message.progress')
            </h3>
        </div>
        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="name-course">@lang('message.name')</th>
                        <th class="col-img-course">@lang('message.progress')</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1
                    @endphp
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->first()->name}}</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar{{$i}}"  role="progressbar"
                                        aria-valuemin="0" aria-valuemax="100" >{{$progress[$user->first()->id]}}&#37</div>
                                    {{ Form::hidden('progress', $progress[$user->first()->id], ['id' => 'progress_course'.$i]) }}
                                </div>
                            </td>
                        </tr>
                        @php
                            $i++
                        @endphp
                    @endforeach()
                    {{ Form::hidden('quantity', count($users), ['id' => 'quantityUser'] ) }}
                </tbody>
            </table>
        </div>
    </div>
@endsection()
