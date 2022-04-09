(function($) {
    "use strict";

$(document).on('change','#banner',function(){
    var banner = $(this).val();
    if(banner == 'image'){
       $('.image').css('display','block');
       $('.code').css('display','none');
  
    }else{
      $('.code').css('display','block');
      $('.image').css('display','none');
 
    }
})

$(document).on('change','#banner_size',function(){
    var banner_size = $(this).val();
    
    if(banner_size == 'size_728')
    {
        $('.prefer-size').text('Prefered Size: (728x90) or Square Sized Image');
    }else if(banner_size == 'size_468')
    {
        $('.prefer-size').text('Prefered Size: (468x60) or Square Sized Image');
    }
    else{
        $('.prefer-size').text('Prefered Size: (234x60) or Square Sized Image');
    }
})


var checkValue = $("#databaseBannerType").val();
var photo = $("#photo").val();
var banner_code1 = $("#banner_code1").val();
    if(checkValue == 'image' && photo){
        $('.image').css('display','block');
        $('.code').css('display','none');
   
   

    }else if(checkValue == 'code' && banner_code1){
        $('.code').css('display','block');
         $('.image').css('display','none');
     
    }else{
        $('.image').css('display','none');
        $('.code').css('display','none');
    }

})(jQuery);
