<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
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
                        <a href="">
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
                            <li><a href=""><i class="fa fa-circle-o"></i> @lang('message.user')</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-item" href="" id="logout">
                            @lang('message.logout')
                        </a>
                        {{ Form::open(['route' => 'logout', 'id' => 'logout-form', 'display' => 'none']) }}
                        {{ Form::close() }}
                    </li>
                </ul>
            </section>
        </aside>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>@lang('message.dashboard')</h1>
            </section>
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
    {{ Html::script(asset('js/styles.js')) }}
</body>
</html>
