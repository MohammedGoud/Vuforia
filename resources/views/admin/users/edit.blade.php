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
        <li><a href="{{url('/mzadqater_admin')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{url('mzadqater_admin/categories')}}">Categories</a></li>
        <li class="active">Edit category</li>
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
                    {!! Form::open(['method' => 'PATCH','route' => ['mzadqater_admin.categories.update', $details->category_id] ,'class'=>'form-horizontal form-validate-jquery' ,'enctype'=>"multipart/form-data" ]) !!}

                    <fieldset class="content-group">
                        <div class="form-group">
                            <label class="control-label col-lg-2">Category name ar <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <input type="text" name="cat_ar" class="form-control" required="required" value="{{isset($details->category_names)?$details->category_names:''}}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-lg-2">Category name en <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <input type="text" name="cat_en" class="form-control" required="required" value="{{isset($details->category_name)?$details->category_name:''}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Category parent  <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <select name="parent" data-placeholder="Select a parent..." class="select" required="required">
                                    <option value="0">Is a parent</option>
                                     <?php  $select=''; ?>
                                     @foreach($cats as $cat)


                                     @if($details->category_parent==$cat->category_id)
                                     <?php $select='selected="selected"';?>
                                     @else
                                     <?php  $select=''; ?>
                                     @endif
                                    <option value="{{$cat->category_id}}" {{$select}}>{{$cat->category_names .' '.$cat->category_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Title seo <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <input type="text" name="seo" class="form-control" required="required" value="{{isset($details->tetle_web)?$details->tetle_web:''}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Keywords ar </label>
                            <div class="col-lg-10">
                                <textarea name="key_ar" class="form-control" >{{isset($details->keywordsar)?$details->keywordsar:''}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Keywords en </label>
                            <div class="col-lg-10">
                                <textarea name="key_en" class="form-control" >{{isset($details->keywords)?$details->keywords:''}}</textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-lg-2"> Description ar </label>
                            <div class="col-lg-10">
                           <textarea name="desc_ar"  rows="5" cols="5" class="form-control">{{isset($details->descriptionar)?$details->descriptionar:''}}
								</textarea>  </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2"> Description en </label>
                            <div class="col-lg-10">
                           <textarea name="desc_en" rows="5" cols="5" class="form-control" >{{isset($details->description)?$details->description:''}}
								</textarea>  </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Category Icon <a href="http://fontawesome.io/icons/" target="_blank">use link</a> <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <input type="text" name="icon" class="form-control" required="required" value="{{isset($details->icon)?$details->icon:''}}">
                            </div>
                        </div>
                        <?php $path = url('/assets/images/categories/'); ?>
                        <div class="form-group hidden">
                            <label class="col-lg-2 control-label">Category Image:</label>
                            <div class="col-lg-10">
                                <div class="file-preview" id="image_preview">
                                    <div class="close fileinput-remove text-right">×</div>
                                    <div class="file-preview-thumbnails">
                                        <div class="file-preview-frame" >


                                            <img src="{{isset($details->category_images)? $path.'/'.$details->category_images :''}}" class="file-preview-image" title="testimages.jpg" alt="testimages.jpg" style="width:auto;height:160px;">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>   <div class="file-preview-status text-center text-success"></div>
                                    <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
                                </div>
                                <input type="file" class="file-input-custom" accept="image/*"  name="image">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Category order</label>
                            <div class="col-lg-2">
                            <input type="text"  class="touchspin-basic input-sm" name="order" value="{{isset($details->category_order)?$details->category_order:''}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Types select</label>
                            <div class="col-lg-10">
                                <select multiple="multiple" class="form-control" name="types[]">
                                     @foreach($types as $type)
                                        @if(in_array($type->id,$cat_types))
                                            <?php $select='selected="selected"';?>
                                        @else
                                            <?php  $select=''; ?>
                                        @endif

                                        <option value="{{$type->id}}" {{$select}}>{{$type->name_en .' '}} {{ ' '. $type->name_ar}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2"> Status <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <div class="checkbox checkbox-switchery switchery-xs">
                                    <label>
                                        <input type="checkbox" name="status" class="switchery"  {{($details->status==1)?'checked':''}} >
                                        Published or not
                                    </label>
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


 



