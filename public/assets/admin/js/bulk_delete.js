(function($) {
    "use strict";

    $(document).on('click','.bulk-delete',function(){
        var ids = $(".postCheck:checked").map(function() {
            return $(this).val();
        }).get();
        var url = mainurl+'admin/post/bulkdelete';
        window.location = url+'?ids='+ids;
    });

})(jQuery);