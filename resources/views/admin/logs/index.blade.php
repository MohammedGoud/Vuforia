@extends('admin.app')
@section('title')
{{'Log Table'}}
@stop
@section('pagetitle')
{{'Log Table'}}
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
        <?php $id=(isset($_GET['id'])?$_GET['id']:0); ?>
        <li><a href="{{url('/admin/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active"><a href="{{url('admin/logs')}}">Log</a></li>

    </ul>
    @stop
@section('content')
    <div class="content">
        @include('admin.message')
        <div class="panel panel-flat">
            <div class="panel-heading">
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>


            <table class="table datatable-basic  table-hover">

                <thead>
                <tr>
                    <th hidden></th>
                    <th hidden></th>
                    <th hidden></th>
                    <th hidden></th>
                    <th hidden></th>
                    <th hidden></th>
                    <th hidden></th>
                    <th hidden></th>
                    <th hidden></th>

                </tr>
                </thead>
                <tbody>
                @foreach($categories as $cat)
                <tr>

                    <td width="20%">
                        <div class="media-left media-middle">
                            <a href="#" class="btn bg-teal-400 btn-rounded btn-icon btn-xs">
                                <span class="letter-icon">{{substr($cat->name, 0, 1)}}</span>
                            </a>
                        </div>

                        <div class="media-body">
                            <a href="#" class="display-inline-block text-default text-semibold letter-icon-title">{{$cat->name}}</a>
                            <div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> Active</div>
                        </div>
                    </td>
                    <td >
                        <a href="#" class="text-default display-inline-block">
                            <span class="text-semibold">{{$cat->action}}</span>
                            <span class="display-block text-muted">{{isset($cat->marker_name)?$cat->marker_name:''}}</span>
                        </a>
                    </td>
                    <td width="20%" >
                        <h6 class="no-margin">{{$cat->creation_date}} </h6>
                    </td>
                    <td hidden></td>
                    <td hidden></td>
                    <td hidden></td>
                    <td hidden></td>
                    <td hidden></td>
                    <td hidden></td>

                </tr>
                 @endforeach
                </tbody>



            </table>
        </div>

    </div>


@stop


