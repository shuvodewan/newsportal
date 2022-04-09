(function($) {
    "use strict";

    function isEmpty(el){
        return !$.trim(el.html())
    }

    if($('.first-quiz-result')){
        var qr = 2;
    }else{
        var qr = 1;
    }

    $("#quiz-result").on('click', function(){
        $(".quiz-result-area").append(''+
                        '<div class="row mt-5">'+
                          '<div class="col-lg-12">'+
                            '<h6> <b>'+lang.sort_listed_item+'</b></h6>'+
                            '</div>'+
                            '</div>'+
                            '<div class="row">'+
                            '<div class="col-lg-12">'+
                            '<div class="add-product-content card mb-4">'+
                            '<div id="headingTwo">'+
                            '<div class="btn d-flex justify-content-between bg-light" type="button" data-toggle="collapse" data-target="#collapse'+qr+'" aria-expanded="true" aria-controls="collapse'+qr+'">'+
                             '<div class="left">'+
                                qr+
                             '</div>'+
                             '<div class="right">'+
                             '<span class="btn btn-danger btn-sm">'+
                             '<i class="fas fa-trash remove_quiz_result"></i>'+
                             '</span>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '<div id="collapse'+qr+'" class="collapse show" aria-labelledby="heading'+qr+'">'+
                             '<div class="card-body  pt-3">'+
                             '<div class="product-description">'+
                             '<div class="body-area p-0">'+
                             '<div class="row">'+
                             '<div class="col-lg-12">'+
                             '<div class="left-area">'+
                             '<h4 class="heading">'+lang.item_title+' *</h4>'+
                             '</div>'+
                             '</div>'+
                             '<div class="col-lg-12">'+
                             '<input type="text" name="item_title[]" class="input-field" placeholder="'+lang.item_title+'">'+
                             '</div>'+
                             '</div>'+
                             '<div class="row">'+
                             '<div class="col-lg-4">'+
                             '<div class="row">'+
                             '<div class="col-lg-12">'+
                             '<div class="left-area">'+
                             '<h4 class="heading">'+lang.image+'</h4>'+
                             '</div>'+
                             '</div>'+
                             '<div class="col-lg-12">'+
                             '<div class="img-upload custom-image-upload">'+
                             '<div id="image-preview" class="img-preview" style="background: url('+mainurl+'assets/admin/images/upload.png);">'+
                             '<label for="image-upload" class="img-label" id="image-label">'+
                             '<i class="icofont-upload-alt"></i>'+lang.upload+'</label>'+
                             '<input type="file" name="item_photo[]" class="img-upload" id="image-upload">'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '<div class="col-lg-8">'+
                             '<div class="row item_description">'+
                             '<div class="col-lg-12">'+
                             '<div class="left-area">'+
                             '<h4 class="heading">'+lang.description+'</h4>'+
                             '</div>'+
                             '</div>'+
                             '<div class="col-lg-12">'+
                             '<textarea class="m-edit'+qr+'" name="item_description" placeholder="Details"></textarea>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                          '</div>'+
                    '');
                    var elementArray = document.getElementsByClassName("m-edit"+qr);
                        for (var i = 0; i < elementArray.length; ++i) {
                            nicEditors.editors.push(
                                new nicEditor().panelInstance(
                                elementArray[i]
                                )
                            );
                            $('.nicEdit-panelContain').parent().width('100%');
                            $('.nicEdit-panelContain').parent().next().width('98%');
                        }
                        qr++;

    });

    $(document).on('click','.remove_quiz_result',function(){
            swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $(this).parent().parent().parent().parent().parent().parent().parent().prev().remove();
                $(this).parent().parent().parent().parent().parent().parent().parent().remove();
            } 
        })
    })
})(jQuery);