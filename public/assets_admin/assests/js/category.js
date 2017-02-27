$(document).ready(function() {
    var l = window.location;
    var pageName = (function () {
        var a = window.location.href,
            b = a.lastIndexOf("/");
        return a.substr(b + 1);
    }());
    var url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[0];
    var base_url='';
    if(url=='http://localhost/'){
        base_url='http://localhost/sahel/public/cpanel/exams_general';
    }else{
        base_url=url+'/cpanel/exams_general';
    }


 $("#meta").change(function(){
        var value = $(this).val();
        if(value=='3D Model'){
            $('#3d_div').css('display','block');
        }else{
            $('#3d_div').css('display','none');
        }


    });


    $("#360image").click(function(){
        var value = $(this).val();

        if(this.checked){
            $('#360image_div').css('display','block');
        }else{
            $('#360image_div').css('display','none');
        }


    });

    $("#360video").click(function(){
        var value = $(this).val();
        if(this.checked){
            $('#360video_div').css('display','block');
        }else{
            $('#360video_div').css('display','none');
        }


    });


    $("#gps").click(function(){
        var value = $(this).val();
        if(this.checked){
            $('#gps_div').css('display','block');
        }else{
            $('#gps_div').css('display','none');
        }


    });

});