(function($) {
    "use strict";

    //create slug from title
    $("#title").on('keyup',function(){
        var title = $(this).val();
        var url = mainurl+'admin/page/slugCreate';
        $.ajax({
            type        : 'GET',
            url         : url,
            data        : {title:title},
            success     : function(data){
                            $("#slug").prop('value',data);
            }
        })
    })



})(jQuery);