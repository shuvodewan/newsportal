(function($) {
    "use strict";

    $(document).ready(function(){
        albumByLanguage();
        setTimeout(function(){
            categoryByAlbum();
        },500) 
    })

    $(document).on('change','#album_update_language_id',function(){
        var language = $(this).val();
        var gallery  = $("#galleryId").val();
        var url = mainurl+'admin/albumByLanguageUpdate/'+language+'/'+gallery;
      
        $.ajax({
            type        : 'GET',
            url         : url,
            contentType : false,
            processData : false,
            data        : {},
            success     : function(data){
                            // console.log(data);
                            $("#image_update_album_id").html(data);
            }
        })
    })
  
    function albumByLanguage(){
      var language = $("#album_update_language_id").val();
      var gallery  = $("#galleryId").val();
      var url = mainurl+'admin/albumByLanguageUpdate/'+language+'/'+gallery;
    
      $.ajax({
          type        : 'GET',
          url         : url,
          contentType : false,
          processData : false,
          data        : {},
          success     : function(data){
                          // console.log(data);
                          $("#image_update_album_id").html(data);
          }
      })
  };


  $(document).on('change','#image_update_album_id',function(){
    var album = $(this).val();
    var gallery  = $("#galleryId").val();
    var url = mainurl+'admin/categoryByAlbumUpdate/'+album+'/'+gallery;
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

  function categoryByAlbum(){
    var album = $("#image_update_album_id").val();
    var gallery  = $("#galleryId").val();
    var url = mainurl+'admin/categoryByAlbumUpdate/'+album+'/'+gallery;
    $.ajax({
        type        : 'GET',
        url         : url,
        contentType : false,
        processData : false,
        data        : {},
        success     : function(data){
                        // console.log(data);
                        $("#image_category_id").html(data);
        }
    })
}

})(jQuery);