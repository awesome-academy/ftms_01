<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="description" content="Unica University Template">
    <meta name="keywords" content="event, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{ Html::style(asset('css/unica.css')) }}
    {{ Html::style(asset('css/bootstrap.min.css')) }}
</head>
<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <header class="header-section">
        <div class="container">
            <div class="header-info">
                <div class="hf-item">
                    <i class="fa fa-clock-o"></i>
                    <p><span>@lang('message.working_time')</span>@lang('message.time_working')</p>
                </div>
                <div class="hf-item">
                    <i class="fa fa-map-marker"></i>
                    <p><span>@lang('message.place')</span>@lang('message.place_working')</p>
                </div>
            </div>
        </div>
    </header>
    <nav class="nav-section">
        <div class="container">
            <div class="nav-right">
               <div class="dropdown">
                    <a id="dropdownMenu1" data-toggle="dropdown" >
                        @if(Auth::user()->profile == null)
                            {{ Html::image(asset('storage/image/abstract-user-flat-3.svg'), '', ['class' => 'img-user']) }}
                            {{ Auth::user()->name }}
                        @else
                            {{ Html::image(asset('storage/image/avatar/'.Auth::user()->profile->image), '', ['class' => 'img-circle img-user']) }}
                            {{ Auth::user()->name }}
                        @endif
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('myprofile.show', Auth::user()->id) }}" id="content-dropdown">@lang('message.profile')</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" id="logout">
                                @lang('message.logout')
                            </a>
                            {{ Form::open(['route' => 'logout', 'id' => 'logout-form', 'display' => 'none']) }}
                            {{ Form::close() }}
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="main-menu">
                <li class="active"><a href="{{ route('home') }}">@lang('message.home')</a></li>
                <li class="dropdown"><a id="dropdownMenu1" data-toggle="dropdown" href="about.html">@lang('message.my_course')<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('coures_study') }}" id="content-dropdown">@lang('message.course_study')</a></li>
                        <li><a href="{{ route('show-calendar') }}">@lang('message.calendar')</a></li>
                        <li><a href="{{ route('course-end') }}">@lang('message.course_end')</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('show-report') }}">@lang('message.list_report')</a></li>
                <li><a href="{{ route('history') }}">@lang('message.history')</a></li>
            </ul>
        </div>
    </nav>
    <div>
        @yield('content')
    </div>
    <footer class="footer-section">
        <div class="container footer-top">
            <div class="row">
                <div class="col-sm-6 col-lg-3 footer-widget">
                    <h6 class="fw-title">@lang('message.contact')</h6>
                    <ul class="contact">
                        <li><p><i class="fa fa-map-marker"></i> @lang('message.place_working')</p></li>
                        <li><p><i class="fa fa-phone"></i> {{ config('admin.phone') }} </p></li>
                        <li><p><i class="fa fa-envelope"></i> {{ config('admin.email') }} </p></li>
                        <li><p><i class="fa fa-clock-o"></i> @lang('message.time_working')</p></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <p>
                    @lang('message.coppyright') &copy;@lang('message.all_template')<i class="fa fa-heart-o" aria-hidden="true"></i> @lang('message.by') <a href="https://colorlib.com" target="_blank">@lang('message.colorlib')</a>
                </p>
            </div>
        </div>
    </footer>
{{ Html::script(asset('js/jquery.js')) }}
{{ Html::script(asset('js/styles.js')) }}
{{ Html::script(asset('js/public/main.js')) }}
{{ Html::script(asset('js/public/public.js')) }}
{{ Html::script(asset('js/bootstrap.min.js')) }}
</body>
</html>
