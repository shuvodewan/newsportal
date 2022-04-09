(function($) {
    "use strict";


    $(document).ready(function(){
        $( "#page_list" ).sortable({
        placeholder : "ui-state-highlight",
        update  : function(event, ui)
        {
        var category_id_array = new Array();
        $('#page_list li').each(function(){
            category_id_array.push($(this).attr("id"));
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var url = mainurl+'admin/menu-builder/store'
            $.ajax({
                url:url,
                method:"POST",
                data:{category_id_array:category_id_array},
                success:function(data)
                {
                    $('.alert-success').show();
                    $('.alert-success p').html(data);
                    location.reload();
                }
            });
        }
    });
});


})(jQuery);