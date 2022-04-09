(function($) {
    "use strict";

    $( document ).ready(function() {
        var right=0;
        var wrong=0; 
        $(document).on('click', '.single-answer', function(){
            var data = $(this).data('assign-value');
            var card = $(this).data('card');

            let currId = $(this).data('question_id');
                $(".question-"+currId).each(function() {
                    $(this).click(false);
                });  
            
            if(data==1){
                if(card != 'yes'){
                    $(this).addClass('ans-correct');
                    $(this).parent().next().children('.correct-result').css('display','block');
                    $(this).find("#correctCircle").removeClass('far fa-circle');
                    $(this).find("#correctCircle").addClass("far fa-check-circle");
                }
                    $(this).addClass('ans-correct');
                    $(this).parent().parent().parent().next().children('.correct-result').css('display','block');
                    $(this).find("#correctCircle").removeClass('far fa-circle');
                    $(this).find("#correctCircle").addClass("far fa-check-circle");
                right++;
            }else{
                if(card != 'yes'){
                    $(this).addClass('ans-wrong');
                    $(this).parent().next().children('.wrong-result').css('display','block');
                    $(this).find("#correctCircle").removeClass('far fa-circle');
                    $(this).find("#correctCircle").addClass("far fa-times-circle");
                }
                $(this).addClass('ans-wrong');
                $(this).parent().parent().parent().next().children('.wrong-result').css('display','block');
                $(this).find("#correctCircle").removeClass('far fa-circle');
                $(this).find("#correctCircle").addClass("far fa-times-circle");

                wrong++;
            }
            var allanswer = right+wrong;
            var totalquiz = $("#totalQuizz").val();
            if(allanswer==totalquiz){
                $('.quiz-score').css('display','block');
                $('.correct-value b').text(right);
                $('.wrong-value b').text(wrong);
                
                    $('.tresult').each(function(index,el){
                        var maxresult = $(this).data('max');
                        var minresult = $(this).data('min');
                        var resultId =  $(this).data('result');
                        for(let i=minresult; i<=maxresult;i++){
                            if(i==right){
                                $('.result-'+resultId).css('display','block');
                            }
                        }
                    })
            }
        });
        
    });

})(jQuery);