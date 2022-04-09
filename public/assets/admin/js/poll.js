(function($) {
    "use strict";

    var dateToday = new Date();
    var dates =  $( "#from" ).datetimepicker({
    format:'Y-m-d H:i:s',
    minDate:dateToday,
    });

    $("#poll-option").on('click', function(){
        $(".pollOption").append(''+
                        '<div class="row">'+
                          '<div class="col-lg-4">'+
                          '<div class="left-area">'+
                            ' <h4 class="heading">Poll Option *</h4>'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-lg-7">'+
                            '<input type="text" name="poll_option[]" class="input-field float-left" placeholder="poll option here" autocomplete="off"/>'+
                            '</div>'+
                            '<a href="javascript:void(0);" class="remove_button float-right"><img src="'+mainurl+'assets/images/remove.png"/></a>'+
                          '</div>'+
                    '');
    });

    $(document).on('click','.remove_button',function(){
        $(this.parentNode).remove();
    })

})(jQuery);