(function($) {
    "use strict";

    $(document).ready(function() {
        $('#datecalender').pignoseCalender({
            select: function(date, obj) {
                obj.calender.parent().next().show().text('You selected ' + 
                (date[0] === null? 'null':date[0].format('YYYY-MM-DD')) +
                '.');
                var date = date[0].format('YYYY-MM-DD');
                var postbydateurl = mainurl+'post/post-by-date';
                window.location = postbydateurl+'?date='+date;
            }
        });      
    });

        $(document).on('click',".vote",function(e){
                let id  = $(this).data('id');
                let url = mainurl+'poll-vote';
                var form = $("#voteform"+id);
                let fd = new FormData(document.getElementById("voteform"+id));
                e.preventDefault();
                $.ajax({
                type        : 'POST',
                url         : url,
                contentType : false,
                processData : false,
                data        : fd,
                success     : function(data){
                                if(data.errors){
                                    form.find('#errMsg').html(data.errors);
                                }
                                if(data =="success"){
                                    $("#vote_success-"+id).notify("Thank you for voting us","success",{ position:"top-left" });
                                    $("#vote_success-"+id).hide();
                                    $('.viewVoteResult').append('<button type="submit" class="mybtn1 result view_result" data-id="' + id +
                                    '">View Result</button>')
                                }
                }
            });
        })

        $(document).on('click',".result",function(e){
            var id  = $(this).data('id');
            let url = mainurl+'poll-result/'+id;
            var form = $("#voteform"+id);
            var btnTxt = $(this).attr('class');

            e.preventDefault();
            $.ajax({
            type        : 'Get',
            url         : url,
            contentType : false,
            processData : false,
            data        : {},
            success     : function(data){
                            if(btnTxt == 'mybtn1 result view_result'){
                                form.find(".voteresult").html(data).css('display','block ');
                                form.find('.result').text(lang.hide_resultt);
                                form.find('.result').removeClass('view_result');
                            }else{
                                form.find(".voteresult").html(data).css('display','none');
                                form.find('.result').text(lang.view_resultt);
                                form.find('.result').addClass('view_result');
                            }
            }
        });
    })

    if(gs.is_talkto == 1){
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/{{ $gs->tawk_to }}/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
    }

    $("#loadMore").on('click',function(){
        var last_news = $(this).attr('data-id');
        var url = mainurl+'load-more';
        $("#loadMore").text(lang.loading);
        $.ajax({
            type : 'GET',
            url  : url,
            data :  {last_news:last_news},
            contentType: "application/json",
            success    : function(data){
                        if(data['output'].length>0){
                            $(".more").append(data['output']);
                            $("#loadMore").html(lang.load_more);
                            $("#loadMore").attr('data-id',data['id']);
                        }else{
                            $(".more").append('No more Post Available').css('color','red');
                            $("#loadMore").css('display','none');
                        }
            }
        })
    })

    $("#headerAdd").on('click',function(){
        var id = $(this).attr('data-addid');
        console.log(id);
        let url = mainurl+'click/count/'+id;
        $.get(url);
    })


})(jQuery);