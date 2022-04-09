(function($) {
    "use strict";

    function isEmpty(el){
        return !$.trim(el.html())
     }

     let ck = 0;
     if (document.querySelector('.first-question') !== null) {
         var valOfFirstQuestion = $('.first-question').length;
          ck = valOfFirstQuestion+1;
         var ans_id = 1
     } else {
          ck = 1;
     }

     if (document.querySelector('.quiz-answer-area') !== null) {
         var qmr = Math.floor(Math.random() * 26) + Date.now();
     } else {
         var qmr  = 1;
     }
     

     $("#add-quiz-question").on('click', function(){
         var qaw = qmr + Date.now();
         var anss_id = ans_id+1;
         $(".add_edit_question").append(''+
                           '<div class="row mt-5">'+
                           '<div class="col-lg-12">'+
                             '<h6 id="ques_text'+ck+'"> <b>'+lang.question+'</b></h6>'+
                             '</div>'+
                             '</div>'+
                             '<div class="row">'+
                             '<div class="col-lg-12">'+
                             '<div class="add-product-content card mb-4">'+
                             '<div id="heading'+ck+'">'+
                             '<div class="btn d-flex justify-content-between bg-light">'+
                             '<div class="left">'+
                             '#'+
                             ck+
                             '</div>'+
                             '<div class="right align-self-center">'+
                             '<button type="button" data-toggle="collapse" data-target="#collapse'+ck+'"class="collapsebutton mr-2 btn btn-info" data-id="plus" aria-expanded="true" aria-controls="collapse'+ck+'"><i class="fas fa-plus"></i></button>'+
                             '<span class="btn btn-danger btn-sm">'+
                             '<i class="fas fa-trash remove_quiz_question" data-ckid="'+ck+'"></i>'+
                             '</span>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '<div id="collapse'+ck+'" class="collapse show" aria-labelledby="heading'+ck+'">'+
                             '<div class="card-body pt-3">'+
                             '<div class="product-description">'+
                             '<div class="body-area p-0">'+
                             '<div class="row">'+
                             '<div class="col-lg-12">'+
                             '<div class="left-area">'+
                             '<h4 class="heading">'+lang.question+' *</h4>'+
                             '</div>'+
                             '</div>'+
                             '<div class="col-lg-12">'+
                             '<input type="text" class="input-field" name="question_title[]" placeholder="'+lang.question+'" required>'+
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
                             '<input type="file" name="question_photo[]" class="img-upload" id="image-upload">'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '<div class="col-lg-8">'+
                             '<div class="row question_description">'+
                             '<div class="col-lg-12">'+
                             '<div class="left-area">'+
                             '<h4 class="heading">'+lang.description+'</h4>'+
                             '</div>'+
                             '</div>'+
                             '<div class="col-lg-12">'+
                             '<textarea class="n-edit'+ck+'" name="question_description" placeholder="Details" id="description"></textarea>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '<hr>'+
                             '<div class="row quiz-answer-area">'+
                             '<div class="col-lg-12">'+
                             '<div class="left-area">'+
                             '</div>'+
                             '</div>'+
                             '<div class="col-lg-12">'+
                             '<div class="row" id="quiz-single-answer">'+
                             '<div class="col-xl-4 col-6 quiz-single-div">'+
                             '<input type="hidden" name="answer_id['+ck+']['+ans_id+']" value="0">'+
                             '<div class="card single-answer">'+
                             '<div class="card-body py-3 border">'+
                             '<div class="img-upload custom-image-upload">'+
                             '<div id="image-preview" class="img-preview" style="background: url('+mainurl+'assets/admin/images/upload.png);">'+
                             '<label for="image-upload" class="img-label"id="image-label">'+
                             '<i class="icofont-upload-alt"></i>'+lang.upload+''+
                             '</label>'+
                             '<input type="file" name="answer_photo['+ck+']['+ans_id+']" class="img-upload" id="image-upload">'+
                             '</div>'+
                             '</div>'+
                             '<input type="text" class="input-field mt-3" name="answer_title['+ck+']['+ans_id+']" placeholder="'+lang.answer_text+'" autocomplete="off">'+
                             '<div class="correct-ans mt-2">'+
                             '<div class="custom-control custom-radio">'+
                             '<input type="radio" id="customRadio'+qmr+'" name="correct_answer['+ck+']" value="'+ans_id+'" class="custom-control-input req_question" checked required>'+
                             '<label class="custom-control-label" for="customRadio'+qmr+'">'+lang.correct+'</label>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '<div class="col-xl-4 col-6 quiz-single-div">'+
                             '<input type="hidden" name="answer_id['+ck+']['+anss_id+']" value="0">'+
                             '<div class="card single-answer">'+
                             '<div class="card-body py-3 border">'+
                             '<div class="img-upload custom-image-upload">'+
                             '<div id="image-preview" class="img-preview" style="background: url('+mainurl+'assets/admin/images/upload.png);">'+
                             '<label for="image-upload" class="img-label" id="image-label">'+
                             '<i class="icofont-upload-alt"></i>'+lang.upload+''+
                             '</label>'+
                             '<input type="file" name="answer_photo['+ck+']['+anss_id+']" class="img-upload" id="image-upload">'+
                             '</div>'+
                             '</div>'+
                             '<input type="text" class="input-field mt-3" name="answer_title['+ck+']['+anss_id+']" placeholder="'+lang.answer_text+'" autocomplete="off">'+
                             '<div class="correct-ans mt-2">'+
                             '<div class="custom-control custom-radio">'+
                             '<input type="radio" id="customRadio'+qaw+'" name="correct_answer['+ck+']" value="'+anss_id+'" class="custom-control-input req_question" required>'+
                             '<label class="custom-control-label" for="customRadio'+qaw+'">'+lang.correct+'</label>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '<div class="row">'+
                             '<div class="col-lg-12 text-center">'+
                             '<a href="javascript:;" class="btn btn-info quiz-answer" data-question="'+ck+'">'+
                             '<i class="fa fa-plus"></i>'+lang.add_answer+'</a>'+
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

                     var elementArray = document.getElementsByClassName("n-edit"+ck);
                         for (var i = 0; i < elementArray.length; ++i) {
                             nicEditors.editors.push(
                                 new nicEditor().panelInstance(
                                 elementArray[i]
                                 )
                             );
                             $('.nicEdit-panelContain').parent().width('100%');
                             $('.nicEdit-panelContain').parent().next().width('98%');
                         }
                         ck++;
                         qmr++;
     });


    $(document).on('click','.remove_quiz_question',function(){
        var id = $(this).data('quiz_qid');
        var new_id = $(this).data('ckid');
        var url = mainurl+'admin/remove-tquizquestion/'+id;
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
            $(this).parent().parent().parent().parent().parent().parent().parent().remove();
            $("#ques_text"+new_id).remove();
            $("#remove_ques_id"+id).remove();
            $.get(url);
            ck = ck -1;
        } else if (
            result.dismiss === swal.DismissReason.cancel
        ) {
            }
        })
    })

    if (document.querySelector('.quiz-answer-area') !== null) {
        var qaa = 3;
    } else {
        var qaa  = 1;
    }


    $(document).on('click','.quiz-answer', function(){
        var selector = $(this).parent().parent().prev();
        var quiz_parent = $(this).data("question");
        var totalCount=$(this).parent().parent().prev().find(".quiz-single-div").length;
        var addQuizAnswer = totalCount+1;
        var addAgainQuizAnswer = addQuizAnswer+1;
        
        if(selector){
            var qa=2;
        }else{
            var qa=1;
        }
        var qww = qaa+1;
        $(selector).append(''+
                        '<div class="col-lg-12">'+
                          '<div class="left-area">'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-lg-12">'+
                            '<div class="row" id="quiz-single-answer">'+
                            '<input type="hidden" name="answer_id['+quiz_parent+']['+addQuizAnswer+']" value="0">'+
                            '<div class="col-xl-4 col-6 quiz-single-div">'+
                            '<div class="card single-answer">'+
                          '<div class="close">'+
                          '<i class="fa fa-times remove_button"></i>'+
                          '</div>'+
                          '<div class="card-body py-3 border">'+
                          '<div class="img-upload custom-image-upload">'+
                          '<div id="image-preview" class="img-preview'+qa+'" style="background: url('+mainurl+'assets/admin/images/upload.png);">'+
                          '<label for="image-upload" class="img-label"id="image-label">'+
                          '<i class="icofont-upload-alt"></i>'+lang.upload+''+
                          '</label>'+
                          '<input type="file" name="answer_photo['+quiz_parent+']['+addQuizAnswer+']" class="img-upload" id="image-upload">'+
                          '</div>'+
                          '</div>'+
                          '<input type="text" class="input-field mt-3" name="answer_title['+quiz_parent+']['+addQuizAnswer+']" placeholder="'+lang.answer_text+'" autocomplete="off">'+
                          '<div class="correct-ans mt-2">'+
                          '<div class="custom-control custom-radio">'+
                          '<input type="radio" id="customRadio'+qaa+'" name="correct_answer['+quiz_parent+']" value="'+addQuizAnswer+'" class="custom-control-input req_question" required>'+
                          '<label class="custom-control-label" for="customRadio'+qaa+'">'+lang.correct+'</label>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+
                          '<input type="hidden" name="answer_id['+quiz_parent+']['+addAgainQuizAnswer+']" value="0">'+
                          '<div class="col-xl-4 col-6 quiz-single-div">'+
                          '<div class="card single-answer">'+
                          '<div class="close">'+
                          '<i class="fa fa-times remove_button"></i>'+
                          '</div>'+
                          '<div class="card-body py-3 border">'+
                          '<div class="img-upload custom-image-upload">'+
                          '<div id="image-preview" class="img-preview" style="background: url('+mainurl+'assets/admin/images/upload.png);">'+
                          '<label for="image-upload" class="img-label" id="image-label">'+
                          '<i class="icofont-upload-alt"></i>'+lang.upload+''+
                          '</label>'+
                          '<input type="file" name="answer_photo['+quiz_parent+']['+addAgainQuizAnswer+']" class="img-upload" id="image-upload">'+
                          '</div>'+
                          '</div>'+
                          '<input type="text" class="input-field mt-3" name="answer_title['+quiz_parent+']['+addAgainQuizAnswer+']" placeholder="'+lang.answer_text+'" autocomplete="off">'+
                          '<div class="correct-ans mt-2">'+
                          '<div class="custom-control custom-radio">'+
                          '<input type="radio" id="customRadio'+qww+'" name="correct_answer['+quiz_parent+']" value="'+addAgainQuizAnswer+'" class="custom-control-input req_question" required>'+
                          '<label class="custom-control-label" for="customRadio'+qww+'">'+lang.correct+'</label>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+
                    '');
                    qaa+=2;
    });

    $(document).on('click','.remove_button',function(){
        $(this).parent().parent().parent().remove();
    })

    var qr = 0;

    if($('.first-quiz-result')){
        var valOfFirstQuizResult = $('.first-quiz-result').length;
        qr = valOfFirstQuizResult+1;
    }else{
        qr = 1;
    }

    $("#quiz-result").on('click', function(){
        $(".quiz-result-area-edit").append(''+
                        '<div class="row mt-5">'+
                          '<div class="col-lg-12">'+
                            '<h6 id="ress_text'+qr+'"> <b>'+lang.result+'</b></h6>'+
                            '</div>'+
                            '</div>'+
                            '<div class="row">'+
                            '<div class="col-lg-12">'+
                            '<div class="add-product-content card mb-4">'+
                            '<div id="heading'+qr+'">'+
                            '<div class="btn d-flex justify-content-between bg-light">'+
                             '<div class="left">'+'#'+qr+
                             '</div>'+
                             '<div class="right">'+
                             '<button type="button" data-toggle="collapse" data-target="#collapse'+qr+'" aria-expanded="true" aria-controls="collapse'+qr+'" class="resultCollapse btn btn-info mr-2" data-id="plus"><i class="fas fa-minus"></i></button>'+
                             '<span class="btn btn-danger btn-sm">'+
                             '<i class="fas fa-trash remove_quiz_result_edit" data-qrid="'+qr+'"></i>'+
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
                             '<h4 class="heading">'+lang.result+' *</h4>'+
                             '</div>'+
                             '</div>'+
                             '<div class="col-lg-12">'+
                             '<input type="text" name="result_title[]" class="input-field" placeholder="'+lang.result+'">'+
                             '</div>'+
                             '</div>'+
                             '<div class="row">'+
                             '<div class="col-lg-4">'+
                             '<div class="row">'+
                             '<div class="col-lg-12">'+
                             '<div class="left-area">'+
                             '<h4 class="heading">'+lang.result+'</h4>'+
                             '</div>'+
                             '</div>'+
                             '<div class="col-lg-12">'+
                             '<div class="img-upload custom-image-upload">'+
                             '<div id="image-preview" class="img-preview" style="background: url('+mainurl+'assets/admin/images/upload.png);"">'+
                             '<label for="image-upload" class="img-label" id="image-label">'+
                             '<i class="icofont-upload-alt"></i>'+lang.upload+'</label>'+
                             '<input type="file" name="result_photo[]" class="img-upload" id="image-upload">'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '<div class="col-lg-8">'+
                             '<div class="row result_description">'+
                             '<div class="col-lg-12">'+
                             '<div class="left-area">'+
                             '<h4 class="heading">'+lang.description+'</h4>'+
                             '</div>'+
                             '</div>'+
                             '<div class="col-lg-12">'+
                             '<textarea class="m-edit'+qr+'" name="result_description" placeholder="Details"></textarea>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '</div>'+
                             '<hr>'+
                             '<div class="row">'+
                             '<div class="col-lg-12">'+
                             '<div class="left-area">'+
                             '<h6 class="heading">'+lang.number_of_correct_answer+'<small>('+lang.range_of_correct+')</small> </h4>'+
                             '</div>'+
                             '</div>'+
                             '<div class="col-lg-12">'+
                             '<div class="row">'+
                             '<div class="col-md-6">'+
                             '<input type="number" name="min[]" class="input-field" placeholder="'+lang.min+'" min="0">'+
                             '</div>'+
                             '<div class="col-md-6">'+
                             '<input type="number" name="max[]" class="input-field" placeholder="'+lang.max+'" min="0">'+
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

    $(document).on('click','.remove_quiz_result_edit',function(){
        var id = $(this).data('result_edit');
        var qrid = $(this).data('qrid');
        var url = mainurl+'admin/remove-tquizresult/'+id;
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
                $(this).parent().parent().parent().parent().parent().parent().parent().remove();
                $("#edit_tresult"+id).remove();
                $.get(url);
                $("#ress_text"+qrid).remove();
                qr = qr -1;
            } else if (
                result.dismiss === swal.DismissReason.cancel
            ) {

            }
        })
    })

    


    $(document).on('click','.remove_button',function(){
        var id = $(this).data('val');
        var removeurl = mainurl+'admin/remove-tquizanswer/'+id;
        $(this).parent().parent().parent().remove();
        $.get(removeurl);
    })


    $(document).on("click",".collapsebutton",function(){
        var val = $(this).attr('data-id');
  
        if(val == 'plus'){
            $(this).html('<i class="fas fa-plus"></i>');
            var pls = $(this).attr("data-id" ,'minus');
        }

        if(val== 'minus'){
            $(this).html('<i class="fas fa-minus"></i>');
            var pls = $(this).attr("data-id" ,'plus');
        }
    })


    $(document).on("click",".resultCollapse",function(){
        var val = $(this).attr('data-id');
  
        if(val == 'plus'){
            $(this).html('<i class="fas fa-plus"></i>');
            var pls = $(this).attr("data-id" ,'minus');
        }

        if(val== 'minus'){
            $(this).html('<i class="fas fa-minus"></i>');
            var pls = $(this).attr("data-id" ,'plus');
        }
    })

})(jQuery);