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
        <li><a href="{{url('/admin/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active"><a href="{{url('admin/users/')}}">Users</a></li>

    </ul>
    @stop
@section('content')
    <div class="content">
        @include('admin.message')
        <div class="panel panel-flat">
            <div class="panel-heading">
                <a href="{{url('admin/users/create')}}"> <h5 class="panel-title"><i class="icon-plus-circle2"></i> Add User</h5></a>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>


            <table class="table datatable-basic table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th hidden></th>
                    <th hidden></th>
                    <th hidden></th>
                    <th hidden></th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $cat)

                <tr>
                    <td><a href="{{url('admin/users/'.$cat->id.'/edit')}}">{{$cat->name}}</a></td>
                    <td><a href="{{url('admin/users/'.$cat->id.'/edit')}}">{{$cat->email}}</a></td>
                    <td hidden></td>
                    <td hidden></td>
                    <td hidden></td>
                    <td hidden></td>

                    <td>
                        <ul class="icons-list">
                            <li class="text-danger-600">
                                {!! Form::open(['method' => 'DELETE','url' => ['admin/users/destroy', $cat->id]  ]) !!}
                                {!! Form::button('<i class="icon-trash"></i>', ['type' => 'submit']) !!}
                                {!! Form::close() !!}</li>
                            <li class="text-info-600"><a href="{{url('admin/users/'.$cat->id.'/edit')}}" data-popup="tooltip" data-original-title="Edit"><i class="icon-pencil7"></i></a></li>


                        </ul>
                    </td>
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


