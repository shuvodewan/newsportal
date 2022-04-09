(function($) {
"use strict";

// Gallery Section Update
$(document).on("click", ".set-gallery" , function(){
    var post_id = $('#post_id').val();

    $('#post_id').val(post_id);
    $('.selected-image .row').html('');
    var url = mainurl+'admin/gallery/show';

        $.ajax({
                type: "GET",
                url:url,
                data:{id:post_id},
                success:function(data){
                  if(data[0] == 0)
                  {
                    $('.selected-image .row').addClass('justify-content-center');
                      $('.selected-image .row').html('<h3>No Images Found.</h3>');
                   }
                  else {
                    $('.selected-image .row').removeClass('justify-content-center');
                      $('.selected-image .row h3').remove();    
                      var arr = $.map(data[1], function(el) {
                      return el });

                      for(var k in arr)
                      {
                    $('.selected-image .row').append('<div class="col-sm-6">'+
                                    '<div class="img gallery-img">'+
                                        '<span class="remove-img"><i class="fas fa-times"></i>'+
                                        '<input type="hidden" value="'+arr[k]['id']+'">'+
                                        '</span>'+
                                        '<a href="'+mainurl+'assets/images/galleries/'+arr[k]['photo']+'" target="_blank">'+
                                        '<img src="'+mainurl+'assets/images/galleries/'+arr[k]['photo']+'" alt="gallery image">'+
                                        '</a>'+
                                    '</div>'+
                                  '</div>');
                      }                         
                   }

                }
              });
  });

$(document).on('click', '.remove-img' ,function() {
    var id = $(this).find('input[type=hidden]').val();
    $(this).parent().parent().remove();
    var url = mainurl+'admin/gallery/delete';
    $.ajax({
        type: "GET",
        url:url,
        data:{id:id},
        success: function(data){
            console.log(data);
        }
    });
});

$(document).on('click', '#article_gallery_edit' ,function() {
$('#article_upload_gallery_edit').click();
});
                                    
                            
$("#article_upload_gallery_edit").change(function(){
$("#form-gallery").submit();  
});


$(document).on('submit', '#form-gallery' ,function() {
    var url = mainurl+'admin/gallery/store';
      $.ajax({
       url:url,
       method:"POST",
       data:new FormData(this),
       dataType:'JSON',
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
        if(data != 0)
        {
            $('.selected-image .row').removeClass('justify-content-center');
              $('.selected-image .row h3').remove();   
            var arr = $.map(data, function(el) {
            return el });
            for(var k in arr)
               {
                    $('.selected-image .row').append('<div class="col-sm-6">'+
                                    '<div class="img gallery-img">'+
                                        '<span class="remove-img"><i class="fas fa-times"></i>'+
                                        '<input type="hidden" value="'+arr[k]['id']+'">'+
                                        '</span>'+
                                        '<a href="'+mainurl+'assets/images/galleries/'+arr[k]['photo']+'" target="_blank">'+
                                        '<img src="'+mainurl+'assets/images/galleries/'+arr[k]['photo']+'" alt="gallery image">'+
                                        '</a>'+
                                    '</div>'+
                                  '</div>');
                }          
        }
                         
                           }

      });
      return false;
}); 

})(jQuery);