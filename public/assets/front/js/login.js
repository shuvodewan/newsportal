(function($) {
    "use strict";

    $(".registerform").on('submit', function (e) {
        e.preventDefault();
        var $this = $(this).parent();
        $this.find('button.submit-btn').prop('disabled', true);
        $this.find('.alert-info').show();
        var regdata = $this.find('.mregdata').val();
        $('.signup-form .alert-info p').html(regdata);
        $.ajax({
        method: "POST",
        url: $(this).prop('action'),
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            if ((data.errors)) {
                $this.find('.alert-success').hide();
                $this.find('.alert-info').hide();
                $this.find('.alert-danger').show();
                $this.find('.alert-danger ul').html('');
                for (var error in data.errors) {
                $this.find('.alert-danger p').html(data.errors[error]);
                }
                $this.find('button.submit-btn').prop('disabled', false);
            } else {
                $this.find('.alert-info').hide();
                $this.find('.alert-danger').hide();
                $this.find('.alert-success').show();
                $this.find('.alert-success p').html(data);
                $this.find('button.submit-btn').prop('disabled', false);
            }
            $('.refresh_code').click();
        }
        });
    });

    $(".mloginform").on('submit', function (e) {
        var $this = $(this).parent();
        e.preventDefault();
        $this.find('button.submit-btn').prop('disabled', true);
        $this.find('.alert-info').show();
        var authdata = $this.find('.mauthdata').val();
        $('.signin-form .alert-info p').html(authdata);
        $.ajax({
          method: "POST",
          url: $(this).prop('action'),
          data: new FormData(this),
          dataType: 'JSON',
          contentType: false,
          cache: false,
          processData: false,
          success: function (data) {
            if ((data.errors)) {
              $this.find('.alert-success').hide();
              $this.find('.alert-info').hide();
              $this.find('.alert-danger').show();
              $this.find('.alert-danger ul').html('');
              for (var error in data.errors) {
                $('.signin-form .alert-danger p').html(data.errors[error]);
              }
            } else {
              $this.find('.alert-info').hide();
              $this.find('.alert-danger').hide();
              $this.find('.alert-success').show();
              $this.find('.alert-success p').html('Success !');
  
              window.location = data;
            }
            $this.find('button.submit-btn').prop('disabled', false);
          }
        });
  
      });


})(jQuery);