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


})(jQuery);