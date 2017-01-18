@extends('admin.app')
@section('title')
{{'Users Table'}}
@stop
@section('pagetitle')
{{'Users Table'}}
@stop
@section('header')

        <!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="{{url('')}}/assets_admin/assests/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
<link href="{{url('')}}/assets_admin/assests/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="{{url('')}}/assets_admin/assests/css/core.css" rel="stylesheet" type="text/css">
<link href="{{url('')}}/assets_admin/assests/css/components.css" rel="stylesheet" type="text/css">
<link href="{{url('')}}/assets_admin/assests/css/colors.css" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->
<!-- Core JS files -->
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/plugins/loaders/pace.min.js"></script>
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/core/libraries/jquery.min.js"></script>
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/core/libraries/bootstrap.min.js"></script>
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->
<!-- Theme JS files -->
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/plugins/forms/selects/select2.min.js"></script>

<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/core/app.js"></script>
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/pages/datatables_basic.js"></script>
<!-- /theme JS files -->




@stop
@section('breadcrump')
    <ul class="breadcrumb">
        <li><a href="{{url('/mzadqater_admin/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active"><a href="{{url('mzadqater_admin/users/')}}">Users</a></li>

    </ul>
    @stop
@section('content')
    <div class="content">
        @include('admin.message')
        <div class="panel panel-flat">



            <table class="table datatable-basic table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Code</th>
                    <th hidden>Password</th>
                    <th hidden>Status</th>
                    <th hidden>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $cat)

                <tr>
                    <td><a href="{{url('mzadqater_admin/users/edit/'.$cat->user_id)}}">{{$cat->user_name}}</a></td>
                    <td><a href="{{url('mzadqater_admin/users/edit/'.$cat->user_id)}}">{{$cat->user_email}}</a></td>
                    <td>{{$cat->user_phone}}</td>
                    <td>{{$cat->user_registered_code}}</td>
                    <td hidden>{{$cat->user_password}}</td>
                    <td hidden></td>
                    <td hidden></td>



                </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer text-muted">
            &copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
        </div>
        <!-- /footer -->
    </div>


@stop


