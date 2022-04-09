(function($) {
    "use strict";

    $(document).ready(function(){
        categoryByLanguage();

    })

    function categoryByLanguage(){
        var x = $("#category_language_id").val();
        var id = $("#sub_category_id").val();
        var url = mainurl+'admin/subcategories/languageOnUpdate/'+x+'/'+id;

        $.ajax({
            type        : 'GET',
            url         : url,
            contentType : false,
            processData : false,
            data        : {},
            success     : function(data){
                            $("#category_parent_id").html(data);
            }
        })
    }


})(jQuery);
