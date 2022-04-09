(function($) {
    "use strict";

    $(document ).ready(function() {
        var first_answer=0;
        var second_answer=0;
        var third_answer=0;
        var i=0;

        $(document).on('click', '.single-answer', function(){
            var data = $(this).data('assign-value');
            let currId = $(this).data('question_id');
                $(".question-"+currId).each(function() {
                    $(this).click(false);
                });  
            
                $(this).addClass('ans-correct');
                $(this).find("#correctCircle").removeClass('far fa-circle');
                $(this).find("#correctCircle").addClass("far fa-check-circle");

                if(data==1){
                    first_answer++;
                    
                }else if(data==2){
                    second_answer++;
                    
                }else if(data==3){
                    third_answer++;
                }
                i++;
                var totalquiz = $("#totalQuiz").val();
                if(totalquiz==i){
                    result();
                }
        });

        function result(){
            if(first_answer>second_answer && first_answer>third_answer){
                    $('.tresult').each(function(index,el){
                        if(index==0){
                            var resultId =  $(this).data('result');
                            $('.result-'+resultId).css('display','block');
                        }
                    })
                }else if(second_answer>first_answer && second_answer>third_answer){
                    $('.tresult').each(function(index,el){
                        if(index==1){
                            var resultId =  $(this).data('result');
                            $('.result-'+resultId).css('display','block');
                        }
                    })
                }else{
                    $('.tresult').each(function(index,el){
                        if(index==2){
                            var resultId =  $(this).data('result');
                            $('.result-'+resultId).css('display','block');
                        }
                    })
                }
        }
        
    });


})(jQuery);