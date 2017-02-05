@extends('admin.app')
@section('title')
{{'Add Marker'}}
@stop
@section('pagetitle')
{{'Add Marker'}}
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
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/plugins/forms/validation/validate.min.js"></script>
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/plugins/forms/inputs/touchspin.min.js"></script>
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/plugins/forms/styling/switch.min.js"></script>
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/plugins/forms/styling/switchery.min.js"></script>
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/plugins/forms/styling/uniform.min.js"></script>
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/pages/form_validation.js"></script>
<!-- Theme JS files -->
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/plugins/forms/styling/uniform.min.js"></script>
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/plugins/forms/styling/switchery.min.js"></script>
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/plugins/forms/inputs/touchspin.min.js"></script>
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/core/app.js"></script>
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/pages/form_input_groups.js"></script>
<!-- /theme JS files -->
<!-- Theme JS files -->
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/plugins/notifications/bootbox.min.js"></script>
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/pages/components_modals.js"></script>
<!-- /theme JS files -->
<!-- Theme JS files -->
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/plugins/uploaders/fileinput.min.js"></script>
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/pages/uploader_bootstrap.js"></script>
<!-- /theme JS files -->
<script type="text/javascript" src="{{url('')}}/assets_admin/assests/js/custom/category.js"></script>





@stop
@section('breadcrump')
    <ul class="breadcrumb">
        <li><a href="{{url('/admin')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('admin/markers?id='.$_GET['id'])}}">Markers</a></li>
        <li class="active">Add Marker</li>
    </ul>
    @stop
@section('content')
    <div class="content">
        <!-- Form validation -->
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

            <div class="panel-body">
                <form class="form-horizontal form-validate-jquery" action="{{url('admin/markers/')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="project_id" value="{{$project_id}}">
                    <fieldset class="content-group">

                        <div class="form-group">
                            <label class="control-label col-lg-2">Name :<span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <input type="text" name="name" class="form-control" required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Meta Data :<span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <?php $types=array('Villa','Apartment','Home');?>
                                <select class="form-control" name="meta_data">
                                    @for($i=0;$i<count($types);$i++)
                                        <option value="{{$types[$i]}}">{{$types[$i]}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label text-semibold">Marker :</label>
                            <div class="col-lg-10">
                                <input type="file" class="file-styled" accept="image" name="image" data-show-upload="no" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label text-semibold">3D Models</label>
                            <div class="col-lg-10">
                                <div class="form-group form-group-lg">
                                    <input type="file" class="file-input" data-show-caption="false" data-show-upload="false" name="model[]" data-browse-class="btn btn-primary btn-lg btn-icon" data-remove-class="btn btn-danger btn-lg btn-icon">
                                    <span class="help-inline ml-10">Add</span>
                                </div>

                                <div class="form-group">
                                    <input type="file" class="file-input" data-show-caption="false" data-show-upload="false" name="model[]">
                                    <span class="help-inline ml-10">Add</span>
                                </div>

                                <div class="form-group">
                                    <input type="file" class="file-input" data-show-caption="false" data-show-upload="false" name="model[]" data-browse-class="btn btn-primary btn-sm btn-icon" data-remove-class="btn btn-danger btn-sm btn-icon">
                                    <span class="help-inline ml-10">Add</span>
                                </div>

                                <div class="form-group">
                                    <input type="file" class="file-input" data-show-caption="false" data-show-upload="false" name="model[]" data-browse-class="btn btn-primary btn-xs btn-icon" data-remove-class="btn btn-danger btn-xs btn-icon">
                                    <span class="help-inline ml-10">Add</span>
                                </div>
                            </div>
                        </div>









                    </fieldset>

                    <div class="text-right">
                        <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                        <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </form>
            </div>
        </div>


    </div>



@stop


