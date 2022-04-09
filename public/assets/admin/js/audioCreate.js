(function($) {
    "use strict";

    //schedule checkbox is check or not
    $(document).on('change',".schedule",function(){
        if($('.schedule').is(':checked')){
            $('.datepick').css('display','block')
            $('.saveAsDraft').css('display','none');
            // $('.addPost').css('margin-left','150px');
        }else{
            $('.datepick').css('display','none');
            $('.saveAsDraft').css('display','inline-block');
            $('#from').val('');
        }
    })

    //get the category which belongs to a specific language
    $(document).on('change',"#audio_language_id",function(){
        $('.categoryDiv').css('display','block');
        var x = $(this).val();
        var url = mainurl+'admin/add-audio/language/'+x;
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


    //get the subcategory which belongs to a specific category
    $(document).on('change',"#audio_parent_id",function(){
        var x = $(this).val();
        var url = mainurl+'admin/add-audio/subcategory/'+x;
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


//Get Audio
var $audio = $('#myAudio');
$('#audio1').on('change', function(e) {
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

})(jQuery);