(function($) {
    "use strict";

    $(document).ready(function(){
        featurefilterLanguage();

        $("#headercheck").click(function(){
            if(this.checked){
                $('.postCheck').each(function(){
                    $(".postCheck").prop('checked', true);
                    var checked = $(".postCheck:checked").length;
                    if(checked > 0){
                        $('.selectPost').css('display','block');
                        
                    }
                })
            }else{
                $('.postCheck').each(function(){
                    $(".postCheck").prop('checked', false);
                    $('.selectPost').css('display','none');
                })
            }
        });
    })

    $(document).on("change","#feature_filter_lang",function(){
        table.ajax.url( $("#feature_filter_lang option:selected").data('href') ).load();
            var x = $(this).val();
            var url = mainurl+'admin/feature/category-filter/language/'+x;
            $.ajax({
                type        : 'GET',
                url         : url,
                contentType : false,
                processData : false,
                data        : {},
                success     : function(data){
                                $("#category_id").html(data);
                }
            });
    })

    function featurefilterLanguage(){
        table.ajax.url( $("#feature_filter_lang option:selected").data('href') ).load();
            var x = $("#feature_filter_lang").val();
            var url = mainurl+'admin/feature/category-filter/language/'+x;
            $.ajax({
                type        : 'GET',
                url         : url,
                contentType : false,
                processData : false,
                data        : {},
                success     : function(data){
                    $("#category_id").html(data);
                }
            });
    }

    $(document).on("change","#category_id",function(){
        table.ajax.url( $("#category_id option:selected").data('href') ).load();
    });

    $(document).on("change","#filter_user",function(){
        table.ajax.url( $("#filter_user option:selected").data('href') ).load();
    })

    $('.postCheck').filter(function () {
        return $.inArray(this.value, values) >= 0;
    }).prop('checked', true);

$(document).on('click','.postCheck',function(){

    var checked = $(".postCheck:checked").length;
    if(checked > 0){
        $('.selectPost').css('display','block');
        
    }else{
        $('.selectPost').css('display','none');
    }

});

})(jQuery);