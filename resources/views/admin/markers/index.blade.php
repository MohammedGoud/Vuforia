@extends('admin.app')
@section('title')
{{'Markers Table'}}
@stop
@section('pagetitle')
{{'Markers Table'}}
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
        <li class="active"><a href="{{url('admin/markers?id='.$id)}}">Markers</a></li>

    </ul>
    @stop
@section('content')
    <div class="content">
        @include('admin.message')
        <div class="panel panel-flat">
            <div class="panel-heading">
                <a href="{{url('admin/markers/create?id='.$id)}}"> <h5 class="panel-title"><i class="icon-plus-circle2"></i> Add Marker</h5></a>
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
                    <th >Name</th>
                    <th>Marker </th>
                    <th>Meta Data</th>
                    <th hidden></th>
                    <th hidden></th>
                    <th hidden></th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $cat)

                <tr>

                    <td>{{$cat->title}}</td>
                    <td><img src="{{url('markers/'.$cat->url)}}" style="width:90px;"></td>
                    <td >{{$cat->meta_data}}</td>
                    <td hidden></td>
                    <td hidden></td>
                    <td hidden></td>
                    <td>
                        <ul class="icons-list">
                            <li class="text-danger-600">
                                {!! Form::open(['method' => 'DELETE','route' => ['markers.destroy', $cat->id]  ]) !!}
                                {!! Form::button('<i class="icon-trash"></i>', ['type' => 'submit']) !!}
                                {!! Form::close() !!}</li>
                            <li class="text-info-600"><a href="{{url('admin/markers/'.$cat->id.'/edit')}}" data-popup="tooltip" data-original-title="Edit"><i class="icon-pencil7"></i></a></li>


                        </ul>
                    </td>
                </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

    </div>


@stop


