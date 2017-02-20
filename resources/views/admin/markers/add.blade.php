@extends('admin.app')
@section('title')
{{'Add Marker'}}
@stop
@section('pagetitle')
{{'Add Marker'}}
@stop
@section('header')
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            width: 100%;
            height: 400px;
        }
        .controls {
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }
        #searchInput {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 50%;
        }
        #searchInput:focus {
            border-color: #4d90fe;
        }

    </style>
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
                                    <input type="file" class="file-input" data-show-caption="false" data-show-upload="false" name="model[]" multiple data-browse-class="btn btn-primary btn-lg btn-icon" data-remove-class="btn btn-danger btn-lg btn-icon">
                                    <span class="help-inline ml-10">Browse Your 3D Files</span>
                                </div>

                        </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label text-semibold">360 Image</label>
                            <div class="col-lg-10">
                                <div class="form-group form-group-lg">
                                    <input type="file" class="file-input" data-show-caption="false" data-show-upload="false" name="image360" multiple data-browse-class="btn btn-primary btn-lg btn-icon" data-remove-class="btn btn-danger btn-lg btn-icon">

                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label text-semibold">360 Video</label>
                            <div class="col-lg-10">
                                <div class="form-group form-group-lg">
                                    <input type="file" class="file-input" data-show-caption="false" data-show-upload="false" name="video360" multiple data-browse-class="btn btn-primary btn-lg btn-icon" data-remove-class="btn btn-danger btn-lg btn-icon">

                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label text-semibold">GPS Locations</label>
                            <div class="col-lg-10">
                        <input id="searchInput" class="controls" type="text" placeholder="Enter a location">
                        <div id="map" ></div>
                            </div>
                        </div>
                        <div class="form-group" hidden>
                            <label class="control-label col-lg-2">Lat :<span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <input type="text" name="lat" class="form-control" required="required" id="lat" value="">
                            </div>
                        </div>
                        <div class="form-group" hidden>

                            <label class="control-label col-lg-2">Long :<span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <input type="text" name="long" class="form-control" required="required" id="lon" value="">
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



    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 30.0566104, lng:  31.33010760000002},
                zoom: 13
            });
            var input = document.getElementById('searchInput');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });

            autocomplete.addListener('place_changed', function() {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                marker.setIcon(({
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }

                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                infowindow.open(map, marker);

                //Location details
//                for (var i = 0; i < place.address_components.length; i++) {
//                    if(place.address_components[i].types[0] == 'postal_code'){
//                        document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
//                    }
//                    if(place.address_components[i].types[0] == 'country'){
//                        document.getElementById('country').innerHTML = place.address_components[i].long_name;
//                    }
//                }
                //document.getElementById('location').innerHTML = place.formatted_address;
                document.getElementById('lat').value = place.geometry.location.lat();
                document.getElementById('lon').value = place.geometry.location.lng();
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap" async defer></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABO6YfPN--2IYrHyjcEfG8xaJfX-ULNuU&libraries=places&callback=initMap"
            async defer></script>
@stop


