(function($) {
    "use strict";

  $(document).ready(function() {


function disablekey()
{
 document.onkeydown = function (e)
 {
  return false;
 }
}

function enablekey()
{
 document.onkeydown = function (e)
 {
  return true;
 }
}

// **************************************  AJAX REQUESTS SECTION *****************************************

  // Status Start
      $(document).on('click','.status',function () {
        var link = $(this).attr('data-href');
            $.get( link, function(data) {
              }).done(function(data) {
                $('#geniustable').DataTable().ajax.reload();
                  $('.alert-danger').hide();
                  $('.alert-success').show();
                  $('.alert-success p').html(data);
            })
          });
  // Status Ends



// ADD OPERATION

$(document).on('click','#add-data',function(){
  $('#modal1').find('.modal-title').html('ADD NEW '+$('#headerdata').val());
  $('#modal1 .modal-content .modal-body').html('').load($(this).attr('data-href'),function(response, status, xhr){
      if(status == "success")
      {
        
      }

    });
});

// ADD OPERATION END


// Attribute Modal

$(document).on('click','.attribute',function(){
if(admin_loader == 1)
  {
  $('.submit-loader').show();
}
  $('#attribute').find('.modal-title').html($('#attribute_data').val());
  $('#attribute .modal-content .modal-body').html('').load($(this).attr('data-href'),function(response, status, xhr){
      if(status == "success")
      {
        if(admin_loader == 1)
          {
            $('.submit-loader').hide();
          }
      }

    });
});



// Attribute Modal Ends


// EDIT OPERATION

$(document).on('click','.edit',function(){
  $('#modal1').find('.modal-title').html('EDIT '+$('#headerdata').val());
  $('#modal1 .modal-content .modal-body').html('').load($(this).attr('data-href'),function(response, status, xhr){
      if(status == "success")
      {

      }
    });
});


// EDIT OPERATION END




// EDIT OPERATION END





// ADD / EDIT FORM SUBMIT FOR DATA TABLE


$(document).on('submit','#geniusformdata',function(e){
  e.preventDefault();
  disablekey();
  // alert('ok');
  $('.gocover').show();
      $.ajax({
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       dataType:'JSON',
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          if ((data.errors)) {
          $('.alert-success').hide();
          $('.alert-danger').show();
          $('.alert-danger ul').html('');
            for(var error in data.errors)
            {
              $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>');
            }

            $("#modal1 .modal-content .modal-body .alert-danger").focus();
            $('button.addProductSubmit-btn').prop('disabled',false);
            $('#geniusformdata input , #geniusformdata select , #geniusformdata textarea').eq(1).focus();
          }
          else
          {
            $('#geniustable').DataTable().ajax.reload();
            
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success p').html(data);
 
            $('button.addProductSubmit-btn').prop('disabled',false);
            $('#modal1,#modal2,#verify-modal').modal('hide');
           }

           $('body, html').animate({
            scrollTop: $('html').offset().top
          }, 'slow');
          
           $('.gocover').hide();
          enablekey();
       }

      });

});



$(document).on('submit','#geniusformdataedit',function(e){
  e.preventDefault();
  disablekey();
  $('.gocover').show();
      $.ajax({
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       dataType:'JSON',
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          if ((data.errors)) {
          $('.alert-success').hide();
          $('.alert-danger').show();
          $('.alert-danger ul').html('');
            for(var error in data.errors)
            {
              $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>');
            }

            $("#modal1 .modal-content .modal-body .alert-danger").focus();
            $('button.addProductSubmit-btn').prop('disabled',false);
            $('#geniusformdata input , #geniusformdata select , #geniusformdata textarea').eq(1).focus();
          }
          else
          {
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success p').html(data);
 
            $('#geniustable').DataTable().ajax.reload();

            $('button.addProductSubmit-btn').prop('disabled',false);
            $('#modal1,#modal2,#verify-modal').modal('hide');
           }

           $('body, html').animate({
            scrollTop: $('html').offset().top
          }, 'slow');
          
           $('.gocover').hide();
          enablekey();
       }

      });

});



// ADD / EDIT FORM SUBMIT FOR DATA TABLE ENDS

// ADD / EDIT article


$(document).on('click','.tquiz-btn1',function(e){
  e.preventDefault();
  disablekey();
  $('.gocover').show();

  var draft =  $(this).data("draft");
  var description = $(".description div.nicEdit-main").html(); 

  var question_description = $(".question_description div.nicEdit-main").map(function() {
    return $(this).html();
 }).get();
 

  var result_description= $(".result_description div.nicEdit-main").map(function() {
    return $(this).html();
 }).get();
 
  
  let fd = new FormData(document.getElementById("tquizformdata"));
  fd.append('draft',draft);
  fd.append('description',description);

  let QueDesLength = question_description.length;
  for (let i=0; i<question_description.length; i++) {
    fd.append('question_description[]', question_description[i]);
    }

  let ResDesLength = result_description.length;
  for (let i=0; i<result_description.length; i++) {
    fd.append('result_description[]', result_description[i]);
    }
  
      $.ajax({
       method:"POST",
       url:$("#tquizformdata").prop('action'),
       data:fd,
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          if ((data.errors)) {
          $('.alert-success').hide();
          $('.alert-danger').show();
          $('.alert-danger ul').html('');
            for(var error in data.errors)
            {
              $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>');
            }
  
            $("#modal1 .modal-content .modal-body .alert-danger").focus();
            $('button.addProductSubmit-btn').prop('disabled',false);
            $('#geniusformdata input , #geniusformdata select , #geniusformdata textarea').eq(1).focus();
          }
          else
          {
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success p').html(data);
  
            $('button.addProductSubmit-btn').prop('disabled',false);
            $('#modal1,#modal2,#verify-modal').modal('hide');

           }
           
           $('body, html').animate({
              scrollTop: $('html').offset().top
            }, 'slow');

          $('.gocover').hide();
          enablekey();
       }

      });
});

$(document).on('click','.sort-btn1',function(e){
  e.preventDefault();
  disablekey();
  $('.gocover').show();

  var draft =  $(this).data("draft");
  var description = $(".description div.nicEdit-main").html(); 

  var item_description= $(".item_description div.nicEdit-main").map(function() {
    return $(this).html();
 }).get();
 
 
  
  let fd = new FormData(document.getElementById("sortformdata"));
  fd.append('draft',draft);
  fd.append('description',description);

  for (let i=0; i<item_description.length; i++) {
    fd.append('item_description[]', item_description[i]);
    }

      $.ajax({
       method:"POST",
       url:$("#sortformdata").prop('action'),
       data:fd,
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          if ((data.errors)) {
          $('.alert-success').hide();
          $('.alert-danger').show();
          $('.alert-danger ul').html('');
            for(var error in data.errors)
            {
              $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>');
            }
            $("#modal1 .modal-content .modal-body .alert-danger").focus();
            $('button.addProductSubmit-btn').prop('disabled',false);
            $('#geniusformdata input , #geniusformdata select , #geniusformdata textarea').eq(1).focus();
          }
          else
          {
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success p').html(data);
  
            $('button.addProductSubmit-btn').prop('disabled',false);
            $('#modal1,#modal2,#verify-modal').modal('hide');
           }
           $('.gocover').hide();
          enablekey();

          $('body, html').animate({
            scrollTop: $('html').offset().top
        }, 'slow');
       }

      });
});

$(document).on('click','.personality-btn1',function(e){
  e.preventDefault();
  disablekey();
  $('.gocover').show();

  var draft =  $(this).data("draft");
  var description = $(".description div.nicEdit-main").html(); 

  var question_description = $(".question_description div.nicEdit-main").map(function() {
    return $(this).html();
 }).get();
 

  var result_description= $(".result_description div.nicEdit-main").map(function() {
    return $(this).html();
 }).get();
 
 
  
  let fd = new FormData(document.getElementById("personalityformdata"));
  fd.append('draft',draft);
  fd.append('description',description);

  for (let i=0; i<question_description.length; i++) {
    fd.append('question_description[]', question_description[i]);
    }

  for (let i=0; i<result_description.length; i++) {
    fd.append('result_description[]', result_description[i]);
    }

      $.ajax({
       method:"POST",
       url:$("#personalityformdata").prop('action'),
       data:fd,
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          if ((data.errors)) {
          $('.alert-success').hide();
          $('.alert-danger').show();
          $('.alert-danger ul').html('');
            for(var error in data.errors)
            {
              $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>');
            }
  
            $("#modal1 .modal-content .modal-body .alert-danger").focus();
            $('button.addProductSubmit-btn').prop('disabled',false);
            $('#geniusformdata input , #geniusformdata select , #geniusformdata textarea').eq(1).focus();
          }
          else
          {
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success p').html(data);

            $('button.addProductSubmit-btn').prop('disabled',false);
            $('#modal1,#modal2,#verify-modal').modal('hide');

           }
           $('.gocover').hide();
          enablekey();

               
          $('body, html').animate({
            scrollTop: $('html').offset().top
        }, 'slow');
       }

      });
});

$(document).on('click','.submit-btn1',function(e){
  e.preventDefault();
  disablekey();
  $('.gocover').show();
  var draft =  $(this).data("draft");
  var description = $(".description div.nicEdit-main").html(); 
  
  let fd = new FormData(document.getElementById("geniusformdata2"));
  fd.append('draft',draft);
  fd.append('description',description);

      $.ajax({
       method:"POST",
       url:$("#geniusformdata2").prop('action'),
       data:fd,
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          if ((data.errors)) {
          $('.alert-success').hide();
          $('.alert-danger').show();
          $('.alert-danger ul').html('');
            for(var error in data.errors)
            {
              $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>');
            }
            $("#modal1 .modal-content .modal-body .alert-danger").focus();
            $('button.addProductSubmit-btn').prop('disabled',false);
            $('#geniusformdata input , #geniusformdata select , #geniusformdata textarea').eq(1).focus();
          }
          else
          {
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success p').html(data);
  
            $('button.addProductSubmit-btn').prop('disabled',false);
            $('#modal1,#modal2,#verify-modal').modal('hide');
           }
           $('.gocover').hide();
          enablekey();

          
          $('body, html').animate({
            scrollTop: $('html').offset().top
        }, 'slow');
       }

      });
});


// ADD / EDIT article ENDS

  $('#confirm-delete').on('show.bs.modal', function(e) {
      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  });

  $('#confirm-delete .btn-ok').on('click', function(e) {

    $.ajax({
      type:"GET",
      url:$(this).attr('href'),
      success:function(data)
      {
        console.log(data);
          $('#confirm-delete').modal('toggle');
          $('#geniustable').DataTable().ajax.reload();
          $('.alert-danger').hide();
          $('.alert-success').show();
          $('.alert-success p').html(data);
      }
    });
    return false;
  });

  $('#confirm-delete1 .btn-ok').on('click', function(e) {

  if(admin_loader == 1)
    {
    $('.submit-loader').show();
  }

    $.ajax({
      type:"GET",
      url:$(this).attr('href'),
      success:function(data)
      {
          $('#confirm-delete1').modal('toggle');
          $('#geniustable').DataTable().ajax.reload();
          $('.alert-danger').hide();
          $('.alert-success').show();
        if(admin == 3)
        {
      $('.alert-success p').html(data[0]);
        }
        else{
      $('.alert-success p').html(data);
        }


    if(admin_loader == 1)
      {
        $('.submit-loader').hide();
      }


      }
    });

    if($('#t-txt').length > 0)
{

  var tdata =  $('#t-txt').val();

  if(tdata.length > 0) {

    var id = $('#t-id').val();
    var title = $('#t-title').val();
    var text = $('#t-txt').val();
    $.ajax({
      url: $('#t-add').val(),
      method: "GET",
      data: { id : id, title: title, text : text }
    });

  }

}

    return false;
  });


  $('#confirm-delete2 .btn-ok').on('click', function(e) {

    $('.submit-loader').show();


    $.ajax({
      type:"GET",
      url:$(this).attr('href'),
      success:function(data)
      {
          $('#confirm-delete2').modal('toggle');
          $('.alert-danger').hide();
          $('.alert-success').show();
          if(admin == 3)
          {
        $('.alert-success p').html(data);
          }
          else{
        $('.alert-success p').html(data[0]);
        $(".nice-select.process.select.order-droplinks").attr('class','nice-select process select order-droplinks '+data[1]);
          }

        $(".nice-select.process.select.order-droplinks").attr('class','nice-select process select order-droplinks '+data[1]);
      }
    });

    return false;
  });

// DELETE OPERATION END

  });



// NORMAL FORM

$(document).on('submit','#geniusform',function(e){
e.preventDefault();
  var fd = new FormData(this);
  $('.gocover').show();
 
  if ($('.attr-checkbox').length > 0) {
    $('.attr-checkbox').each(function() {

      // if checkbox checked then take the value of corresponsig price input (if price input exists)
      if($(this).prop('checked') == true) {

        if ($("#"+$(this).attr('id')+'_price').val().length > 0) {
          // if price value is given
          fd.append($("#"+$(this).attr('id')+'_price').data('name'), $("#"+$(this).attr('id')+'_price').val());
        } else {
          // if price value is not given then take 0
          fd.append($("#"+$(this).attr('id')+'_price').data('name'), 0.00);
        }

        // $("#"+$(this).attr('id')+'_price').val(0.00);
      }
    });
  }

var geniusform = $(this);
$('button.addProductSubmit-btn').prop('disabled',true);
    $.ajax({
     method:"POST",
     url:$(this).prop('action'),
     data:fd,
     contentType: false,
     cache: false,
     processData: false,
     success:function(data)
     {
       
        if ((data.errors)) {
          $('.alert-danger').show();
          $('.alert-danger ul').html('');
            for(var error in data.errors)
            {
              $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>');
            }
          geniusform.find('input , select , textarea').eq(1).focus();
        }
        else
        {
          $('.alert-success').show();
          $('.alert-success p').html(data);
          geniusform.find('input , select , textarea').eq(1).focus();
        }

        $('button.addProductSubmit-btn').prop('disabled',false);
      
        $('.gocover').hide();
      
     }

    });

});

// NORMAL FORM ENDS



// NORMAL FORM

$(document).on('submit','#trackform',function(e){
  e.preventDefault();

  $('.gocover').show();


  $('button.addProductSubmit-btn').prop('disabled',true);
      $.ajax({
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          if ((data.errors)) {
          $('#trackform .alert-success').hide();
          $('#trackform .alert-danger').show();
          $('#trackform .alert-danger ul').html('');
            for(var error in data.errors)
            {
              $('#trackform .alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
            }
            $('#trackform input , #trackform select , #trackform textarea').eq(1).focus();
          }
          else
          {
            $('#trackform .alert-danger').hide();
            $('#trackform .alert-success').show();
            $('#trackform .alert-success p').html(data);
            $('#trackform input , #trackform select , #trackform textarea').eq(1).focus();
            $('#track-load').load($('#track-load').data('href'));

          }
          $('.gocover').hide();
          $('button.addProductSubmit-btn').prop('disabled',false);
       }

      });

});

// NORMAL FORM ENDS

// MESSAGE FORM

$(document).on('submit','#messageform',function(e){
  e.preventDefault();
  var href = $(this).data('href');
    $('.gocover').show();
  $('button.mybtn1').prop('disabled',true);
      $.ajax({
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          if ((data.errors)) {
          $('.alert-success').hide();
          $('.alert-danger').show();
          $('.alert-danger ul').html('');
            for(var error in data.errors)
            {
              $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
            }
            $('#messageform textarea').val('');
          }
          else
          {
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success p').html(data);
            $('#messageform textarea').val('');
            $('#messages').load(href);
          }
            $('.gocover').hide();
          $('button.mybtn1').prop('disabled',false);
       }
      });
});

// MESSAGE FORM ENDS


// LOGIN FORM

$("#loginform").on('submit',function(e){
  e.preventDefault();
  $('button.submit-btn').prop('disabled',true);
  $('.alert-info').show();
  $('.alert-info p').html($('#authdata').val());
      $.ajax({
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       dataType:'JSON',
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          if ((data.errors)) {
          $('.alert-success').hide();
          $('.alert-info').hide();
          $('.alert-danger').show();
          $('.alert-danger ul').html('');
            for(var error in data.errors)
            {
              $('.alert-danger p').html(data.errors[error]);
            }
          }
          else
          {
            $('.alert-info').hide();
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success p').html('Success !');
            window.location = data;
          }
          $('button.submit-btn').prop('disabled',false);
       }

      });

});


// LOGIN FORM ENDS


// FORGOT FORM

$("#forgotform").on('submit',function(e){
  e.preventDefault();
  $('button.submit-btn').prop('disabled',true);
  $('.alert-info').show();
  $('.alert-info p').html($('#authdata').val());
      $.ajax({
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       dataType:'JSON',
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          if ((data.errors)) {
          $('.alert-success').hide();
          $('.alert-info').hide();
          $('.alert-danger').show();
          $('.alert-danger ul').html('');
            for(var error in data.errors)
            {
              $('.alert-danger p').html(data.errors[error]);
            }
          }
          else
          {
            $('.alert-info').hide();
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success p').html(data);
            $('input[type=email]').val('');
          }
          $('button.submit-btn').prop('disabled',false);
       }

      });

});


// FORGOT FORM ENDS





// SEND MESSAGE SECTION
$(document).on('click','.send',function(){
  $('.eml-val').val($(this).data('email'));
});

          $(document).on("submit", "#emailreply1" , function(){
          var token = $(this).find('input[name=_token]').val();
          var subject = $(this).find('input[name=subject]').val();
          var message =  $(this).find('textarea[name=message]').val();
          var to = $(this).find('input[name=to]').val();
          $('#eml1').prop('disabled', true);
          $('#subj1').prop('disabled', true);
          $('#msg1').prop('disabled', true);
          $('#emlsub1').prop('disabled', true);
            $.ajax({
            type: 'post',
            url: mainurl+'/admin/user/send/message',
            data: {
                '_token': token,
                'subject'   : subject,
                'message'  : message,
                'to'   : to
                  },
                 success: function( data) {
                  $('#eml1').prop('disabled', false);
                  $('#subj1').prop('disabled', false);
                  $('#msg1').prop('disabled', false);
                  $('#subj1').val('');
                  $('#msg1').val('');
                  $('#emlsub1').prop('disabled', false);
                  if(data == 0)
                    $.notify("Oops Something Goes Wrong !!","error");
                  else
                    $.notify("Message Sent !!","success");
                  $('.close').click();
            }
        });
          return false;
        });

// SEND MESSAGE SECTION ENDS



// SEND EMAIL SECTION

          $(document).on("submit", "#emailreply" , function(){
          var token = $(this).find('input[name=_token]').val();
          var subject = $(this).find('input[name=subject]').val();
          var message =  $(this).find('textarea[name=message]').val();
          var to = $(this).find('input[name=to]').val();
          $('#eml').prop('disabled', true);
          $('#subj').prop('disabled', true);
          $('#msg').prop('disabled', true);
          $('#emlsub').prop('disabled', true);
     $.ajax({
            type: 'post',
            url: mainurl+'/admin/order/email',
            data: {
                '_token': token,
                'subject'   : subject,
                'message'  : message,
                'to'   : to
                  },
            success: function( data) {
          $('#eml').prop('disabled', false);
          $('#subj').prop('disabled', false);
          $('#msg').prop('disabled', false);
          $('#subj').val('');
          $('#msg').val('');
        $('#emlsub').prop('disabled', false);
        if(data == 0)
        $.notify("Oops Something Goes Wrong !!","error");
        else
        $.notify("Email Sent !!","success");
        $('.close').click();
            }

        });
          return false;
        });
// SEND EMAIL SECTION ENDS



$(document).on('click','.godropdown .go-dropdown-toggle', function(){
  $('.godropdown .action-list').hide();
  var $this = $(this);
  $this.next('.action-list').toggle();
});


$(document).on('click', function(e)
{
    var container = $(".godropdown");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0)
    {
      container.find('.action-list').hide();
    }
});



// **************************************  AJAX REQUESTS SECTION ENDS *****************************************


})(jQuery);
