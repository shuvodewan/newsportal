(function($) {
    "use strict";

    $(document).ready(function(){
        image_category_language_Byid();
    })


    $(document).on('change','#image_category_language_edit_id',function(){
        var language = $(this).val();
        var category = $("#categoryId").val();
        var url = mainurl+'admin/languageOnUpdate/'+language+'/'+category;
      
        $.ajax({
            type        : 'GET',
            url         : url,
            contentType : false,
            processData : false,
            data        : {},
            success     : function(data){
                            $("#image_album_id").html(data);
            }
        })
    })
    
    function image_category_language_Byid(){
        var language = $("#image_category_language_edit_id").val();
        var category = $("#categoryId").val();
        var url = mainurl+'admin/languageOnUpdate/'+language+'/'+category;
      
        $.ajax({
            type        : 'GET',
            url         : url,
            contentType : false,
            processData : false,
            data        : {},
            success     : function(data){
                            $("#image_album_id").html(data);
            }
        })
    }
    

    
})(jQuery);