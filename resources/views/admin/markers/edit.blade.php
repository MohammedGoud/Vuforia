@extends('admin.app')
@section('title')
{{'Edit category'}}
@stop
@section('pagetitle')
{{'Edit category'}}
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


<script>
    $(document).ready(function(){ 
        $( ".file-input-custom" ).click(function() {
             $("#image_preview").hide();
        });
    });
</script>


@stop
@section('breadcrump')
    <ul class="breadcrumb">
        <li><a href="{{url('/admin')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('admin/markers?id='.$project->project_id)}}">Markers</a></li>
        <li class="active">Edit Markers</li>
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
                    {!! Form::open(['method' => 'PATCH','route' => ['markers.update', $project->id] ,'class'=>'form-horizontal form-validate-jquery' ,'enctype'=>"multipart/form-data" ]) !!}
                <input type="hidden" name="project_id" value="{{$project->project_id}}">
                    <fieldset class="content-group">



                        <div class="form-group">
                            <label class="control-label col-lg-2">Name :<span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <input type="text" name="name" class="form-control" required="required" value="{{isset($project->title)?$project->title:''}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Meta Data :<span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <?php $types=array('Villa','Apartment','Home');
                                $select='';
                                ?>
                                <select class="form-control" name="meta_data">
                                    @for($i=0;$i<count($types);$i++)
                                        @if($project->meta_data==$types[$i])
                                            <?php $select='selected="selected"';?>
                                        @else
                                            <?php  $select=''; ?>
                                        @endif
                                        <option value="{{$types[$i]}}"{{$select}}>{{$types[$i]}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>





                        <div class="form-group">
                            <label class="col-lg-2 control-label text-semibold">Marker ;</label>
                            <div class="col-lg-10">
                                <?php if($project->url!=''){ ?>
                                <img src="<?php echo url('markers/'.$project->url)?>"width="300px" height="200px">
                                <?php }?>

                                <input type="file" class="file-input" accept="image/*" name="image" data-show-upload="false">
                                <span class="help-block">JPG - JIF - PNG </span>
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

       @include('admin.footer');
    </div>
    <!-- Vertical form modal -->
    <div id="modal_form_vertical" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add Attribute</h5>
                </div>

                <form action="#">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">

                                    <input type="text" name="label_ar" placeholder="Label AR" class="form-control">
                                </div>
                                <div class="col-sm-6">

                                    <input type="text" name="label_en"  placeholder="Label En" class="form-control">
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">

                                    <select name="parent" data-placeholder="Select a html type..." class="select" required="required">
                                        <option value="0">Select Type</option>
                                        <option value="text">Text Box</option>
                                        <option value="fromto">From - To</option>
                                        <option value="select">Drop Down</option>
                                        <option value="check">Check Box</option>
                                        <option value="radio">Radio Button</option>

                                    </select>
                                </div>


                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">

                            </div>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /vertical form modal -->
@stop


 



