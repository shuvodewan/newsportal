(function($) {
    "use strict";

$(document).on("change","#rss_language_id",function(){
    var language = $(this).val();
    var url = mainurl+'admin/rss/category/'+language;
    $.ajax({
        type        : 'GET',
        url         : url,
        contentType : false,
        processData : false,
        data        : {},
        success     : function(data){
                        $("#category_id").html(data);
        }
    })
})


})(jQuery);