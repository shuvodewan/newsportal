(function($) {
    "use strict";

    $(document).ready(function(){
        categoryByLanguage();
        videoAppear();
        
        var is_schedule = $('.schedule').val();
        if(is_schedule == 1){
            $('.datepick').css('display','block');
        }else{
            $('.datepick').css('display','none');
        }
        setTimeout(function(){ 
            category();
        }, 500);
    })

    
    $(document).on('change',".schedule",function(){
        if($('.schedule').is(':checked')){
            $('.datepick').css('display','block');
        }else{
            $('.datepick').css('display','none');
        }
    })

    //get the category which belongs to a specific language
    // $(document).on('change',"#video_language_id",function(){
    //     $('.categoryDiv').css('display','block');
    //     var x = $(this).val();
    //     var id = $("#id").val();
    //     var url = mainurl+'admin/add-video/languageOnUpdate/'+x+'/'+id;
    //     $.ajax({
    //         type        : 'GET',
    //         url         : url,
    //         contentType : false,
    //         processData : false,
    //         data        : {},
    //         success     : function(data){
    //                         $("#video_parent_id").html(data);
    //         }
    //     });
    // })


    function videoOption(){
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
    }
    

    //get the category which belongs to a specific language
    function categoryByLanguage(){
        $('.categoryDiv').css('display','block');
        var x = $("#video_language_id").val();
        var id = $("#id").val();
        var url = mainurl+'admin/add-video/languageOnUpdate/'+x+'/'+id;

        $.ajax({
            type        : 'GET',
            url         : url,
            contentType : false,
            processData : false,
            data        : {},
            success     : function(data){
                            $("#video_parent_id").html(data);
            }
        })
    }

    //get the subcategory which belongs to a specific category
    $(document).on('change',"#video_parent_id",function(){
        var x = $(this).val();
        var id = $("#id").val();
        var url = mainurl+'admin/edit-video/subcategoryUpdate/'+x+'/'+id;
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

    //get the subcategory which belongs to a specific category
    function category(){
    var x   = $("#video_parent_id").val();
    var id = $("#id").val();
    var url = mainurl+'admin/edit-video/subcategoryUpdate/'+x+'/'+id;
    $.ajax({
        type        : 'GET',
        url         : url,
        contentType : false,
        processData : false,
        data        : {},
        success     : function(data){
            console.log(data);
                    $("#subcategory_id").html(data);
        }
    })
}
    //Datepicker initiate 
    var dateToday = new Date();
    var dates =  $( "#from" ).datetimepicker({
        format:'Y-m-d H:i',
        minDate:dateToday,
    });


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

function videoAppear(){
    var selectedOption= $('#videoEdit option:selected').attr('value');
    if(selectedOption == 'local_video'){
        $(".localVideo").css('display','block');
        $(".embedVideo").css('display','none');
    }else{
        $(".localVideo").css('display','none');
        $(".embedVideo").css('display','block');
    }
}

$("#videoEdit").on('change',function(){
    var videoOption = $('option:selected',this).attr('value');
    if(videoOption == 'embed_video'){
        $(".embedVideo").css('display','block');
        $(".localVideo").css('display','none');
    }else{
        $("#embed_video").val('');
        $(".embedVideo").css('display','none');
        $(".localVideo").css('display','block');
    }
})

})(jQuery);