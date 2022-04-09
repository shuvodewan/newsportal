(function($) {
    "use strict";

    //schedule checkbox is check or not
    $(document).on('change',".schedule",function(){
        if($('.schedule').is(':checked')){
            $('.datepick').css('display','block');
            $('.saveAsDraft').css('display','none');
            // $('.addPost').css('margin-left','150px');
        }else{
            $('.datepick').css('display','none');
            $('.saveAsDraft').css('display','inline-block');
            $('#from').val('');
        }
    })

    //get the category which belongs to a specific language
    $(document).on('change',"#article_language_id",function(){
        $('.categoryDiv').css('display','block');
        var x = $(this).val();
        var url = mainurl+'admin/add-article/language/'+x;
        $.ajax({
            type        : 'GET',
            url         : url,
            contentType : false,
            processData : false,
            data        : {},
            success     : function(data){
                            $("#article_parent_id").html(data);

            }
        });
    })


    //get the subcategory which belongs to a specific category
    $(document).on('change',"#article_parent_id",function(){
        var x = $(this).val();
        var url = mainurl+'admin/add-article/subcategory/'+x;
        $.ajax({
            type        : 'GET',
            url         : url,
            contentType : false,
            processData : false,
            data        : {},
            success     : function(data){
                        $("#subcategory_id").html(data);
            }
        })
    })

    //Datepicker initiate 
    var dateToday = new Date();
    var dates =  $( "#from" ).datetimepicker({
      format:'Y-m-d H:i:s',
      minDate:dateToday,
    });

    $(document).on('click', '.remove-img', function () {
		var id = $(this).find('input[type=hidden]').val();
		$('#galval' + id).remove();
		$(this).parent().parent().remove();
	});

	$(document).on('click', '#article_gallery', function () {
		$('#articleuploadgallery').click();
		// $('.selected-image .row').html('');
		// $('#geniusformdata2').find('.removegal').val(0);
	});


	$("#articleuploadgallery").change(function (event) {
		var total_file = document.getElementById("articleuploadgallery").files.length;
		for (var i = 0; i < total_file; i++) {
			$('.selected-image .row').append('<div class="col-sm-6">' +
				'<div class="img gallery-img">' +
				'<span class="remove-img"><i class="fas fa-times"></i>' +
				'<input type="hidden" value="' + i + '">' +
				'</span>' +
				'<a href="' + URL.createObjectURL(event.target.files[i]) + '" target="_blank">' +
				'<img src="' + URL.createObjectURL(event.target.files[i]) + '" alt="gallery image">' +
				'</a>' +
				'</div>' +
				'</div> '
			);
			$('#geniusformdata2').append('<input type="hidden" name="gallery[]" id="galval' + i +
				'" class="removegal" value="' + i + '">')
		}

	});

})(jQuery);
