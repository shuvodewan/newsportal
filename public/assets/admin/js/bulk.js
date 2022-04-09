(function($) {
    "use strict";

    $(document).on('click','#add-to-slider',function(){
        var ids = $(".postCheck:checked").map(function() {
            return $(this).val();
        }).get();
        var url = mainurl+'admin/post/sliderBulk';
        window.location = url+'?ids='+ids;
    });
    
    $(document).on('click','#add-to-breaking',function(){
        var ids = $(".postCheck:checked").map(function() {
            return $(this).val();
        }).get();
        var url = mainurl+'admin/post/breakingBulk';
        window.location = url+'?ids='+ids;
    });
    
    $(document).on('click','#add-to-feature',function(){
        var ids = $(".postCheck:checked").map(function() {
            return $(this).val();
        }).get();
        var url = mainurl+'admin/post/featureBulk';
        window.location = url+'?ids='+ids;
    });
    
    $(document).on('click','#add-to-slider-right',function(){
        var ids = $(".postCheck:checked").map(function() {
            return $(this).val();
        }).get();
        var url = mainurl+'admin/post/rightBulk';
        window.location = url+'?ids='+ids;
    });
    
    
    $(document).on('click','#remove-to-slider',function(){
        var ids = $(".postCheck:checked").map(function() {
            return $(this).val();
        }).get();
        var url = mainurl+'admin/post/remove/sliderBulk';
        window.location = url+'?ids='+ids;
    });
    
    $(document).on('click','#remove-to-breaking',function(){
        var ids = $(".postCheck:checked").map(function() {
            return $(this).val();
        }).get();
        var url = mainurl+'admin/post/remove/breakingBulk';
        window.location = url+'?ids='+ids;
    });
    
    $(document).on('click','#remove-to-feature',function(){
        var ids = $(".postCheck:checked").map(function() {
            return $(this).val();
        }).get();
        var url = mainurl+'admin/post/remove/featureBulk';
        window.location = url+'?ids='+ids;
    });
    
    $(document).on('click','#remove-to-slider-right',function(){
        var ids = $(".postCheck:checked").map(function() {
            return $(this).val();
        }).get();
        var url = mainurl+'admin/post/remove/rightBulk';
        window.location = url+'?ids='+ids;
    });

    $(document).on('click','.bulk-delete',function(){
        var ids = $(".postCheck:checked").map(function() {
            return $(this).val();
        }).get();
        var url = mainurl+'admin/post/bulkdelete';
        window.location = url+'?ids='+ids;
    });

})(jQuery);