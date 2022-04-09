 (function($) {
    "use strict";

    //schedule checkbox is check or not
    $(document).on('change',".schedule",function(){
        if($('.schedule').is(':checked')){
            $('.datepick').css('display','block');
            $('.saveAsDraft').css('display','none');
        }else{
            $('.datepick').css('display','none');
            $('.saveAsDraft').css('display','inline-block');
            $('#from').val('');
        }
    })
    

    //get the category which belongs to a specific language
    $(document).on('change',"#video_language_id",function(){
        $('.categoryDiv').css('display','block');
        var x = $(this).val();
        var url = mainurl+'admin/add-video/language/'+x;
        $.ajax({
            type        : 'GET',
            url         : url,
            contentType : false,
            processData : false,
            data        : {},
            success     : function(data){
                            $("#video_parent_id").html(data);
            }
        });
    })


    //get the subcategory which belongs to a specific category
    $(document).on('change',"#video_parent_id",function(){
        var x = $(this).val();
        var url = mainurl+'admin/add-video/subcategory/'+x;
        $.ajax({
            type        : 'GET',
            url         : url,
            contentType : false,
            processData : false,
            data        : {},
            success     : function(data){
                        $("#subcategory_id").html(data);
            }
        })
    })

    
    //Datepicker initiate 
    var dateToday = new Date();
    var dates =  $( "#from" ).datetimepicker({
      format:'Y-m-d H:i:s',
      minDate:dateToday,
    });

    //create slug from title
    $("#title").keyup(function(){
        var title = $(this).val();
        var url   = mainurl+'admin/add-video/slugCreate';
        $.ajax({
            type        : 'GET',
            url         : url,
            data        : {title:title},
            success     : function(data){
                            $("#slug").prop('value',data);
            }
        })
    })


    $("#videoAdd").on('change',function(){
        var videoOption = $('option:selected',this).attr('value');
        if(videoOption == 'embed_video'){
            console.log(videoOption);
            $(".embedVideo").css('display','block');
            $(".localVideo").css('display','none');
        }else{
            $(".embedVideo").css('display','none');
            $(".localVideo").css('display','block');
        }
    })


//video preview create
$(function() {
    $('.upload-video-file').on('change', function(){
      if (isVideo($(this).val())){
        $('.video-preview').attr('src', URL.createObjectURL(this.files[0]));
        $('.video-prev').show();
      }
      else
      {
        $('.upload-video-file').val('');
        $('.video-prev').hide();
        alert("Only video files are allowed to upload.")
      }
    });
});

// If user tries to upload videos other than these extension , it will throw error.
function isVideo(filename) {
    var ext = getExtension(filename);
    switch (ext.toLowerCase()) {
    case 'm4v':
    case 'avi':
    case 'mp4':
    case 'mov':
    case 'mpg':
    case 'mpeg':
    case 'webm':
        // etc
        return true;
    }
    return false;
}

function getExtension(filename) {
    var parts = filename.split('.');
    return parts[parts.length - 1];
}

})(jQuery);
