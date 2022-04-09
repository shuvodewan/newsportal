(function($) {
    "use strict";
    $(document).ready(function(){
        categoryByLanguage();
        var is_schedule = $('.schedule').val();
        if(is_schedule ==1){
            $('.datepick').css('display','block');
        }
        setTimeout(function(){ 
            category();
        }, 500);
    })

        function categoryByLanguage(){
        $('.categoryDiv').css('display','block');
        var x = $("#article_language_id").val();
        var id = $("#article_post_id").val();
        var url = mainurl+'admin/add-article/languageOnUpdate/'+x+'/'+id;

        $.ajax({
            type        : 'GET',
            url         : url,
            contentType : false,
            processData : false,
            data        : {},
            success     : function(data){
                            $("#article_parent_id").html(data);
            }
        })
    }

    //get the category which belongs to a specific language
    $(document).on('change',"#article_language_id",function(){
        $('.categoryDiv').css('display','block');
        var x = $(this).val();
        var id = $("#article_post_id").val();
        var url = mainurl+'admin/add-article/languageOnUpdate/'+x+'/'+id;
        $.ajax({
            type        : 'GET',
            url         : url,
            contentType : false,
            processData : false,
            data        : {},
            success     : function(data){
                            $("#article_parent_id").html(data);
            }
        });
    })
    

    function category(){
        var x = $("#article_parent_id").val();
        var id = $("#article_post_id").val();
        var url = mainurl+'admin/edit-article/subcategoryUpdate/'+x+'/'+id;
        $.ajax({
            type        : 'GET',
            url         : url,
            contentType : false,
            processData : false,
            data        : {},
            success     : function(data){
                        // console.log(data);
                        $("#subcategory_id").html(data);
            }
        })
    }

    //get the subcategory which belongs to a specific category
    $(document).on('change',"#article_parent_id",function(){
        var x = $(this).val();
        var id = $("#article_post_id").val();
        var url = mainurl+'admin/edit-article/subcategoryUpdate/'+x+'/'+id;
        $.ajax({
            type        : 'GET',
            url         : url,
            contentType : false,
            processData : false,
            data        : {},
            success     : function(data){
                        $("#subcategory_id").html(data);
            }
        })
    })


    var dateToday = new Date();
    var dates =  $( "#from" ).datetimepicker({
      format:'Y-m-d H:i',
      minDate:dateToday,
});

})(jQuery);


