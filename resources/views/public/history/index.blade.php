@extends('layouts.public_default')
@section('title', trans('message.history'))
@section('content')
    <section class="courses-section spad">
        <div class="container">
            <h2>@lang('message.history')</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>@lang('message.name_course')</th>
                        <th>@lang('message.date')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $history)
                        <tr>
                            <td>
                                @if($history->type == config('admin.read'))
                                    {{ Form::button($history->type_custom, ['class' => 'btn btn-primary']) }}
                                @elseif($history->type == config('admin.report'))
                                    {{ Form::button($history->type_custom, ['class' => 'btn btn-success']) }}
                                @else
                                    {{ Form::button($history->type_custom, ['class' => 'btn btn-danger']) }}
                                @endif
                                @lang('message.subject') {{ $history->subject->name }}
                            </td>
                            <td>
                                {{ $history->created_at_custom }}
                            </td>
                        </tr>
                    @endforeach()
                </tbody>
            </table>
            <div>
                {{ $histories->links() }}
            </div>
        </div>
    </section>
@endsection()
