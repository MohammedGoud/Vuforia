<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>  @yield('title')</title>
             @yield('header')

</head>

    <body>
    <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{url('/admin/home')}}"><img src="{{url('/')}}/assets_admin/assests/images/logo_light.png" alt=""></a>


            <ul class="nav navbar-nav pull-right visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li>
                    <a class="sidebar-control sidebar-main-toggle hidden-xs">
                        <i class="icon-paragraph-justify3"></i>
                    </a>
                </li>


            </ul>

            <ul class="nav navbar-nav navbar-right">


                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{url('/')}}/assets_admin/assests/images/placeholder.jpg" alt="">
                        <span>{{\Session::get('emailadmin')}}</span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
                        <li><a href="{{url('/admin/logout')}}"><i class="icon-switch2"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
            <div class="sidebar sidebar-main">
                <div class="sidebar-content">

                   <?php $controller=Request::segments()[1]; ?>
                    <!-- Main navigation -->
                    <div class="sidebar-category sidebar-category-visible">
                        <div class="category-content no-padding">
                            <ul class="navigation navigation-main navigation-accordion">
                                <!-- Main -->
                                <li ><a href="{{url('admin/home')}}"><i class="icon-stats-bars"></i> <span>Statiscs</span></a></li>
                                <li class=<?php echo ($controller=='markers')?"active" : ''; ?>>
                                    <a href="#"><i class="icon-images3"></i> <span>All Markers</span></a>
                                    <ul>
                                        <li> <a href="{{url('admin/markers')}}"><i class="icon-images2"></i>Markers</a></li>
                                        <li><a href="{{url('admin/markers/create')}}"><i class="icon-add"></i> Add marker</a></li>
                                    </ul>
                                </li>


                                @if(\Session::get('adminrole')=='admin' )
                                    <li class=<?php echo ($controller=='log')?"active" : ''; ?>>
                                        <a href="{{url('admin/log')}}"><i class="icon-copy"></i> <span>Log File</span></a>

                                    </li>

                                <li class=<?php echo ($controller=='users')?"active" : ''; ?>>
                                    <a href="{{url('admin/users')}}"><i class="icon-user-plus"></i> <span>All Users</span></a>
                                </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-wrapper">
                <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"> @yield('pagetitle') </h4>
                        </div>

                        {{--<div class="heading-elements">--}}
                            {{--<div class="heading-btn-group">--}}
                                {{--<a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>--}}
                                {{--<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>--}}
                                {{--<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>

                    <div class="breadcrumb-line">
                     @yield('breadcrump')

                        {{--<ul class="breadcrumb-elements">--}}
                            {{--<li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>--}}
                            {{--<li class="dropdown">--}}
                                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                                    {{--<i class="icon-gear position-left"></i>--}}
                                    {{--Settings--}}
                                    {{--<span class="caret"></span>--}}
                                {{--</a>--}}

                                {{--<ul class="dropdown-menu dropdown-menu-right">--}}
                                    {{--<li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>--}}
                                    {{--<li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>--}}
                                    {{--<li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>--}}
                                    {{--<li class="divider"></li>--}}
                                    {{--<li><a href="#"><i class="icon-gear"></i> All settings</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    </div>
                </div>
                <!-- /page header -->


                <!-- Content area -->
                @yield('content')
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>




</body>
</html>