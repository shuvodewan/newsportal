(function($) {
    "use strict";

    $(document).on('change','#album_language_id',function(){
        var language = $(this).val();
        var url = mainurl+'admin/albumByLanguage/'+language;
        $.ajax({
            type        : 'GET',
            url         : url,
            contentType : false,
            processData : false,
            data        : {},
            success     : function(data){
                            $("#image_album_id").html(data);
                            $('#image_category_id').find('option:not(:first)').remove();
            }
        })
    })
    
    
    $(document).on('change','#image_album_id',function(){
        var album = $(this).val();
        var url = mainurl+'admin/categoryByAlbum/'+album;
        $.ajax({
            type        : 'GET',
            url         : url,
            contentType : false,
            processData : false,
            data        : {},
            success     : function(data){
                            $("#image_category_id").html(data);
            }
        })
    })
    
    // Gallery Section Insert
    $(document).on('click', '.remove-img' ,function() {
        var id = $(this).find('input[type=hidden]').val();
        $('#galval'+id).remove();
        $(this).parent().parent().remove();
      });
    
      $('#prod_gallery').on('click' ,function() {
        $('#uploadgallery').click();
        //  $('.selected-image .row').html('');
        $('#geniusform').find('.removegal').val(0);
      });
    
    
      $("#uploadgallery").on('change' ,function(event){
         var total_file=document.getElementById("uploadgallery").files.length;
         for(var i=0;i<total_file;i++)
         {
          $('.selected-image .row').append('<div class="col-sm-6">'+
                                            '<div class="img gallery-img">'+
                                                '<span class="remove-img"><i class="fas fa-times"></i>'+
                                                '<input type="hidden" value="'+i+'">'+
                                                '</span>'+
                                                '<a href="'+URL.createObjectURL(event.target.files[i])+'" target="_blank">'+
                                                '<img src="'+URL.createObjectURL(event.target.files[i])+'" alt="gallery image">'+
                                                '</a>'+
                                            '</div>'+
                                      '</div> '
                                          );
          $('#geniusform').append('<input type="hidden" name="galval[]" id="galval'+i+'" class="removegal" value="'+i+'">')
         }
    
      });

})(jQuery);