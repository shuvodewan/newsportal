$(function ($) {
    "use strict";
    $("li.nav-item.dropdown.mega-menu .nav-link").on('mouseover', function(){
        $(this).parents("li.nav-item.dropdown.mega-menu").find(".go-tab-c").removeClass('active');
        $(this).parents("li.nav-item.dropdown.mega-menu").find(".go-tab-c").first().addClass('active');
        
    });
    
    
    
    $('.dropdown-menu .tab-link').on('mouseover', function(){
        let targerLink =$(this).data('tab');
        
        $(this).parents('li.nav-item.dropdown.mega-menu').find(".go-tab-c").each(function() {
            $(this).removeClass('active');
        });
        
        $(targerLink).addClass('active');
        
    });
 

});