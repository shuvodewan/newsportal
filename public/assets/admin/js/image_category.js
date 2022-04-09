(function($) {
    "use strict";


$(document).on('change',"#image_category_language_id",function(){
    var language = $(this).val();
    var url = mainurl+'admin/categoryByLanguage/'+language;

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



})(jQuery);