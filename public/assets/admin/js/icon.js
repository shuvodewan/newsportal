(function($) {
    "use strict";

    $( "#icons" ).autocomplete({
        source: icons,
        select: function (event, ui) {
      var label = ui.item.label;
      var value = ui.item.value;
         $('#icn').prop('class',value);
  }
      })
  
  $('#icons').on('change',function(){
      $('#icn').prop('class',$(this).val());
  })
})(jQuery);