// //create slug from title
$("#title").keyup(function(){
    var title = $(this).val();
    var url = mainurl+'admin/category/slug';
    $.ajax({
        type        : 'GET',
        url         : url,
        data        : {title:title},
        success     : function(data){
                        $("#slug").prop('value',data);
        }
    })
})