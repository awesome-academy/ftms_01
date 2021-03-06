<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{ Html::style('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic') }}
    {{ Html::style(asset('css/admin.css')) }}
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="index2.html" class="logo">
                <span class="logo-lg">@lang('message.home')</span>
            </a>
            <nav class="navbar navbar-static-top">
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                    </div>
                </div>
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">@lang('message.main_navigation')</li>
                    <li class="">
                        <a href="{{ route('admin') }}">
                            <i class="fa fa-dashboard"></i> <span>@lang('message.dashboard')</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-table"></i> <span>@lang('message.management')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-user"></i> <span>@lang('message.user')</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <a href="{{ route('member.show') }}"><i class="fa fa-circle-o"></i> @lang('message.member')</a>
                                    </li>
                                     <li>
                                        <a href="{{ route('supervisor.show') }}"><i class="fa fa-circle-o"></i> @lang('message.supervisor')</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-graduation-cap"></i>
                                    <span>@lang('message.course')</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <a href="{{ route('course.index') }}"><i class="fa fa-circle-o"></i> @lang('message.list_course')</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('show-trainee') }}"><i class="fa fa-circle-o"></i> @lang('message.list_trainee_course')</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('suppervisor.index') }}"><i class="fa fa-circle-o"></i> @lang('message.list_suppervisor_course')</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('calendar.index') }}"><i class="fa fa-circle-o"></i> @lang('message.calendar')</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('show-course') }}"><i class="fa fa-circle-o"></i> @lang('message.progress')</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('subject.index') }}">
                                    <i class="fa fa-flash"></i> <span>@lang('message.subject')</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout-admin') }}">
                            @lang('message.logout')
                        </a>
                    </li>
                </ul>
            </section>
        </aside>
        <div class="content-wrapper">

            <div>
                @yield('content')
            </div>
        </div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                @lang('message.version')
            </div>
            <strong>@lang('message.copyright') &copy;<a href="https://adminlte.io">@lang('message.cource')</a></strong>@lang('message.allright')
        </footer>
    </div>
    {{ Html::script(asset('js/jquery.js')) }}
    {{ Html::script(asset('js/adminlte.min.js')) }}
    {{ Html::script(asset('js/bootstrap.min.js')) }}
    {{ Html::script(asset('js/styles.js')) }}
</body>
</html>
