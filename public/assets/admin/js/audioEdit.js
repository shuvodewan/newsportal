(function($) {
    "use strict";
    $(document).ready(function(){
        categoryByLanguage(); //when document is ready call categoryByLanguage method
        var is_schedule = $('.schedule').val();
        if(is_schedule == 1){
            $('.datepick').css('display','block');
        }
        setTimeout(function(){ 
            category();
        }, 500);
    })

    //schedule checkbox is check or not
    $(document).on('change',".schedule",function(){
        if($('.schedule').is(':checked')){
            $('.datepick').css('display','block');
        }else{
            $('.datepick').css('display','none');
        }
    })


    //get the category which belongs to a specific language
    $(document).on('change',"#audio_language_id",function(){
        $('.categoryDiv').css('display','block');
        var x = $(this).val();
        var id = $("#id").val();
        var url = mainurl+'admin/add-article/languageOnUpdate/'+x+'/'+id;
        $.ajax({
            type        : 'GET',
            url         : url,
            contentType : false,
            processData : false,
            data        : {},
            success     : function(data){
                            $("#audio_parent_id").html(data);
            }
        });
    })

//get the category which belongs to a specific language
    function categoryByLanguage(){
    $('.categoryDiv').css('display','block');
    var x = $("#audio_language_id").val();
    var id = $("#id").val();

    var url = mainurl+'admin/add-article/languageOnUpdate/'+x+'/'+id;
    $.ajax({
        type        : 'GET',
        url         : url,
        contentType : false,
        processData : false,
        data        : {},
        success     : function(data){
                        $("#audio_parent_id").html(data);
        }
    })
}
    //get the subcategory which belongs to a specific category
    function category(){
    var x   = $("#audio_parent_id").val();
    var id = $("#id").val();
    var url = mainurl+'admin/edit-audio/subcategoryUpdate/'+x+'/'+id;
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
}

    //get the subcategory which belongs to a specific category
    $(document).on('change',"#audio_parent_id",function(){
        var x = $(this).val();
        var id = $("#id").val();
        var url = mainurl+'admin/edit-audio/subcategoryUpdate/'+x+'/'+id;
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
        format:'Y-m-d H:i',
        minDate:dateToday,
    });


//Get Audio
var $audio = $('#myAudio');
$('#audio1').on('change', function(e) {
$('#myAudio').css('display','block');
  var target = e.currentTarget;
  var file = target.files[0];
  var reader = new FileReader();
  
//   console.log($audio[0]);
   if (target.files && file) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $audio.attr('src', e.target.result);
            // $audio.play();
        }
        reader.readAsDataURL(file);
    }
});

var databaseAudio = $('#databaseAudio').val();
if(databaseAudio){
    $('#myAudio').css('display','block');
}

})(jQuery);