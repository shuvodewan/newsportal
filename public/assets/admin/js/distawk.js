(function($) {
    "use strict";

    $(document).on('change','#is_talkto',function(){
        var active = $(this).val();
        if(active){
          var  url = mainurl+'admin/generalsettings/tawakto/'+active;
          $.ajax({
              url         : url,
              type        : 'get',
              contentType : false,
              processData : false,
              data        :{},
              success     : function(data){
                            if(data==1){
                              $.notify("Tawk to activated:(", "success");
                              location.reload();
                            }else{
                              $.notify("Tawk to deactivated", "error");
                              location.reload();
                            }       

              }
          }) 
        }
    })

    $(document).on('change','#is_disqus',function(){
        var active = $(this).val();
        if(active){
          var  url = mainurl+'admin/generalsettings/disqus/'+active;
          $.ajax({
              url         : url,
              type        : 'get',
              contentType : false,
              processData : false,
              data        :{},
              success     : function(data){
                            if(data==1){
                              $.notify("disqus to activated:(", "success");
                              location.reload();
                            }else{
                              $.notify("disqus to deactivated", "error");
                              location.reload();
                            }       
    
              }
          })
        }
    })


    $(document).on('change','#is_smtp',function(){
      var active = $(this).val();
      if(active){
        var  url = mainurl+'admin/generalsettings/smtp/'+active;
        $.ajax({
            url         : url,
            type        : 'get',
            contentType : false,
            processData : false,
            data        :{},
            success     : function(data){
                          if(data==1){
                            $.notify("smtp to activated:(", "success");
                            location.reload();
                          }else{
                            $.notify("smtp to deactivated", "error");
                            location.reload();
                          }       
  
            }
        })
      }
  })


})(jQuery);