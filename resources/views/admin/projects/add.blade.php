@extends('admin.app')
@section('title')
{{'Add Project'}}
@stop
@section('pagetitle')
{{'Add Project'}}
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
        <li><a href="{{url('admin/projects')}}">Projects</a></li>
        <li class="active">Add category</li>
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
                <form class="form-horizontal form-validate-jquery" action="{{url('admin/projects/')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <fieldset class="content-group">
                        <div class="form-group">
                            <label class="control-label col-lg-2">Name <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <input type="text" name="title" class="form-control" required="required">
                            </div>
                        </div>





                        <div class="form-group">
                            <label class="control-label col-lg-2">Breif </label>
                            <div class="col-lg-10">
                                <textarea name="breif" class="form-control" ></textarea>
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

        <!-- Footer -->
        <div class="footer text-muted">
            &copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
        </div>
        <!-- /footer -->
    </div>



@stop


