(function($) {
    "use strict";

    $(document).ready(function(){
        categoryByLanguageUpdate();
    })

    $(document).on('change','#rss_language_update_id',function(){
        var language = $(this).val();
        var rssId = $("#rssId").val();
        var url = mainurl+'admin/rss/categoryUpdate/'+language+'/'+rssId;
    
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

    function categoryByLanguageUpdate(){
        var language = $("#rss_language_update_id").val();
        var rssId = $("#rssId").val();
        var url = mainurl+'admin/rss/categoryUpdate/'+language+'/'+rssId;
    
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
    }

})(jQuery);