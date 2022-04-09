(function($) {
    "use strict";

    $("#lang-btn").on('click', function(){

        $("#lang-section").append(''+
                                    '<div class="lang-area">'+
                                      '<span class="remove lang-remove"><i class="fas fa-times"></i></span>'+
                                      '<div class="row">'+
                                        '<div class="col-lg-6">'+
                                        '<textarea name="keys[]" class="input-field" placeholder="'+lang.language_key+'" required=""></textarea>'+
                                        '</div>'+
                                        '<div class="col-lg-6">'+
                                        '<textarea  name="values[]" class="input-field" placeholder="'+lang.language_value+'" required=""></textarea>'+
                                        '</div>'+
                                      '</div>'+
                                    '</div>'+
                                '');
    
    });
    
    $(document).on('click','.lang-remove', function(){
    
        $(this.parentNode).remove();
        if (isEmpty($('#lang-section'))) {
    
        $("#lang-section").append(''+
                                    '<div class="lang-area">'+
                                      '<span class="remove lang-remove"><i class="fas fa-times"></i></span>'+
                                      '<div class="row">'+
                                        '<div class="col-lg-6">'+
                                        '<textarea name="keys[]" class="input-field" placeholder="'+lang.language_key+'" required=""></textarea>'+
                                        '</div>'+
                                        '<div class="col-lg-6">'+
                                        '<textarea  name="values[]" class="input-field" placeholder="'+lang.language_value+'" required=""></textarea>'+
                                        '</div>'+
                                      '</div>'+
                                    '</div>'+
                                '');
    
    
        }
    
    });

})(jQuery);