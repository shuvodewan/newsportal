$(function ($) {
    "use strict";

    jQuery(document).ready(function () {


       
    //   magnific popup activation
    $('.video-play-btn').magnificPopup({
        type: 'video'
    });
    $('.img-popup').magnificPopup({
        type: 'image'
    });


    $('.refresh_code').on( "click", function() {

        $.get(mainurl+'/contact/refresh_code', function(data, status){
            $('.codeimg1').attr("src",mainurl+"/assets/images/capcha_code.png?time="+ Math.random());
        });
    })

      
    // Mobile Menu js
        
        $('.navsm .toogle-icon').on('click', function () {
            $('.mobile-menu').css({
                'left' : '0%',
                'opacity' : '1'
            });
        });
        $('.mobile-menu .logo-area .close-menu').on('click', function () {
            $('.mobile-menu').css({
                'left' : '-100%',
                'opacity' : '0'
            });
        });

        
    $('.go-dropdown .main-link').on('click', function (e) {
        e.preventDefault();
    $(this).next('.go-dropdown-menu').toggle('slow');
    $(this).toggleClass('active');

    if ($('.go-dropdown .toggle-icon i').hasClass('fas fa-plus')) {

        $('.go-dropdown .toggle-icon i').removeClass('fas fa-plus')
        $('.go-dropdown .toggle-icon i').addClass('fas fa-minus');
    }
    else {
        if ($('.go-dropdown .toggle-icon i').hasClass('fas fa-minus')) {

            $('.go-dropdown .toggle-icon i').removeClass('fas fa-minus')
            $('.go-dropdown .toggle-icon i').addClass('fas fa-plus');
        }
    }
    }); 
        

    $(".all-item-slider a").on('click', function (e) {
        e.preventDefault();
        // console.log($(this).attr('href'));
        $(".all-item-slider a").each(function () {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        let href = $(this).attr('href');

        
        $(".one-item-slider source").attr('src', href);
        $(".one-item-slider video")[0].load();
    });
    
    // Serch option toggle

        $('.web-serch').on('click', function () {
        $('.search-form-area').toggle();
    });


    // Hero Area Slider
    var $mainSlider = $('.intro-carousel');
    $mainSlider.owlCarousel({
        loop: true,
        navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 1
            }
        }
    });
    // Hero Area Slider
    var $widget_slider = $('.widget-slider');
    $widget_slider.owlCarousel({
        loop: true,
        navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 1
            }
        }
    });

    // Hero Area Slider
    var $mainSlider = $('.feature-news-slider');
    $mainSlider.owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        autoplay: false,
        margin: 4,
        autoplayTimeout: 6000,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 1
            },
            500: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 2
            }
        }
    });
        
    /**------------------------------
     *  News Details  carousel
     * ---------------------------**/
    $('.one-item-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.all-item-slider',
        responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    vertical: false,
                    horizontal: true,
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.all-item-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.one-item-slider',
        arrows: true,
        prevArrow: '<i class="fa fa fa-chevron-left slidPrv4"></i>',
        nextArrow: '<i class="fa fa-chevron-right slidNext4"></i>',
        dots: false,
        centerMode: false,
        centerPadding: '20px',
        focusOnSelect: true,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            }
            },
            {
                breakpoint: 767,
                settings: {
                    vertical: false,
                    horizontal: true,
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            }
        ]
    });

    


});



    /*-------------------------------
        back to top
    ------------------------------*/
    $(document).on('click', '.bottomtotop', function () {
        $("html,body").animate({
            scrollTop: 0
        }, 2000);
    });

    //define variable for store last scrolltop
    var lastScrollTop = '';
    $(window).on('scroll', function () {
        var $window = $(window);
        if ($window.scrollTop( ) > 110 ) {
            $(".mainmenu-area").addClass('nav-fixed');
        } else {
            $(".mainmenu-area").removeClass('nav-fixed');
        }

        /*---------------------------
            back to top show / hide
        ---------------------------*/
        var st = $(this).scrollTop();
        var ScrollTop = $('.bottomtotop');
        if ($(window).scrollTop() > 1000) {
            ScrollTop.fadeIn(1000);
        } else {
            ScrollTop.fadeOut(1000);
        }
        lastScrollTop = st;

    });

    $(window).on('load', function () {
  
    /*---------------------
        Preloader
    -----------------------*/
    var preLoder = $("#preloader");
    preLoder.addClass('hide');
    var backtoTop = $('.back-to-top')
    /*-----------------------------
        back to top
    -----------------------------*/
    var backtoTop = $('.bottomtotop')
    backtoTop.fadeOut(100);
    });



    $(window).scroll(function(){
        var scrollPos = $(document).scrollTop();
        if (scrollPos >= 2927) {
            $('.home-front-area .ad-area').addClass('ad-area-fixed');

        }
        else {
            $('.home-front-area .ad-area').removeClass('ad-area-fixed');
        }

    });


    (function () { // DON'T EDIT BELOW THIS LINE
  
    var d = document,
        s = d.createElement('script');
    s.src = 'https://'+gs+'.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
})();


    $(document).on('change','#languageChange',function(){
        var language_id = $(this).val();
        var url = mainurl+'language/'+language_id;
        window.location = url;
    })

    
    $('.subBtn').on('click',function(e){
		e.preventDefault();
		var url  = $('.subscribe-form').attr('action');
		var data = new FormData(subForm);

		$.ajax({
			url  : url,
			type : 'POST',
			data : data,
			cache: false,
			contentType: false,
			processData: false,
			success : function(data){
						if(data == 1){
							$(".subEmail").notify("Please Put Correct Email", { position:"top-left" });
						}
						if(data == 2){
							$(".subEmail").notify("You Already Subscribed",{ position:"top-left" });
						}
						if(data == 3){
                            $('.subEmail').val('');
							$(".subEmail").notify("Thank you for subscribing us","success",{ position:"top-left" });
						}
			}

		})
    })
    

});