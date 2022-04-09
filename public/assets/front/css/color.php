<?php
header("Content-type: text/css; charset: UTF-8");
    if(isset($_GET['base_color'])){
        $base_color = '#'.$_GET['base_color'];
    }else{
        $base_color = '#9C27B0';
    }
    if(isset($_GET['footer_color'])){
        $footer_color = '#'.$_GET['footer_color'];
    }else{
        $footer_color = '#101d29';
    }

    if(isset($_GET['copyright_color'])){
        $copyright_color = '#'.$_GET['copyright_color'];
    }else{
        $copyright_color = '#060f16';
    }
?>

.mainmenu-area .navbar #main_menu .navbar-nav .nav-link.active, .mainmenu-area .navbar #main_menu .navbar-nav .nav-link:hover {
    color: <?php echo $base_color?>;
}

.top-header .content {
    border-bottom: 1px solid <?php echo $base_color?>;
}

.top-header .content .left-content .heading {
    background: <?php echo $base_color?>;
}

.top-header .content .right-content {
    background: <?php echo $base_color?>;
}

.home-front-area .aside-tab .nav li a.active {
    background: <?php echo $base_color?>;
}

.header-area .title {
    color: <?php echo $base_color?>;
}


.pignose-calender .pignose-calender-top {
    background-color:<?php echo $base_color?>!important;
}

.pignose-calender .pignose-calender-body .pignose-calender-row .pignose-calender-unit.pignose-calender-unit-active a {
    background: <?php echo $base_color?>;
    color: #fff !important;
}

.pignose-calender .pignose-calender-header .pignose-calender-week.pignose-calender-week-sun, 
.pignose-calender .pignose-calender-header .pignose-calender-week.pignose-calender-week-sat, 
 .pignose-calender .pignose-calender-body .pignose-calender-row .pignose-calender-unit.pignose-calender-unit-sat a,
 .pignose-calender .pignose-calender-body .pignose-calender-row .pignose-calender-unit.pignose-calender-unit-sun a
  {
    color: #000 !important;
}
.pignose-calender .pignose-calender-body .pignose-calender-row .pignose-calender-unit.pignose-calender-unit-active a{
    color: #fff!important;
}
.home-front-area .main-content.tab-view .nav .nav-link.active {
    color: <?php echo $base_color?>;
}

.aside-newsletter-widget .subscribe-form .submit {
    background: <?php echo $base_color?>;
}

.home-front-area .main-content.tab-view .nav .nav-link::before {
    background: <?php echo $base_color?>;
}

.home-front-area .main-content.tab-view .nav .nav-link::before {
    background: <?php echo $base_color?>;
}



.featured-news .owl-controls .owl-dots .owl-dot.active {
    background: <?php echo $base_color?>;
}

.mybtn1 {
    background: <?php echo $base_color?>;
}

.footer {
    background: <?php echo $footer_color ?>;
}

.footer .copy-bg {
    background: <?php echo $copyright_color ?>;
}
.bottomtotop i {
    background: <?php echo $base_color?>;
}

.footer .footer-widget ul li a:hover {
  color: <?php echo $base_color?>;
}

.footer .fotter-social-links ul li a:hover {
  background: <?php echo $base_color?>;
}

.footer .tags-widget .tag-list li a:hover {
  background: <?php echo $base_color?>;
  border-color: <?php echo $base_color?>;
}

.footer .copy-bg .content .content p a {
    color: <?php echo $base_color?>;
}

.home-front-area .tags-widget .tag-list li a:hover {
  background: <?php echo $base_color?>;
}

.comment-log-reg-tabmenu .nav-tabs .nav-link.active {
    background:<?php echo $base_color?>;
}

.login-area .submit-btn {
    background:<?php echo $base_color?>;
}

.login-area .log-reg-header-area .title {
    color: <?php echo $base_color?>;
}

.login-area .form-input i {
    color: <?php echo $base_color?>;
}

.login-area .log-reg-social-area .title {
    color: <?php echo $base_color?>;
}

.single-news .content-wrapper .img .vid-aud {
    background: <?php echo $base_color?>;
}

.single-box.landScape-small-with-meta .img .vid-aud {
    background: <?php echo $base_color?>;
}

.more-news .single-news.land-scap-medium .img .vid-aud {
    background: <?php echo $base_color?>;
}
.mainmenu-area .navbar #main_menu .navbar-nav .nav-item.mega-menu .nav .nav-link:hover {
    border-left: 3px solid <?php echo $base_color?>;
}

.header-area .title::before {
  background: <?php echo $base_color?>;
}

.single-news.big .content-wrapper .vid-aud {
    background: <?php echo $base_color?>;
}


.single-news-menu .content-wrapper .vid-aud {
    background: <?php echo $base_color?>;
}

.widget-slider.owl-carousel .owl-controls .owl-nav .owl-prev, .widget-slider.owl-carousel .owl-controls .owl-nav .owl-next {
    border: 1px solid <?php echo $base_color?>;
    border-radius: 50%;
    color: <?php echo $base_color?>;
}

.sub-categori-author .left-area .select-option .header-area {
    background: <?php echo $base_color?>;
}

.sub-categori-author .left-area .filter-result-area .header-area {
    background: <?php echo $base_color?>;
}

.breadcrumb-area .pages li.active a {
    color: <?php echo $base_color?>;
}

.page-item.active .page-link{
    background-color: <?php echo $base_color?>;
    border-color: <?php echo $base_color?>;
}

.page-link {
    color: <?php echo $base_color?>;
}

.custom-control-input:checked~.custom-control-label::before {
    border-color: <?php echo $base_color?>;
    background-color: <?php echo $base_color?>;
}

.single-box.landScape-small-with-meta .content .post-meta li a:hover {
    color: <?php echo $base_color?>;
}

.breadcrumb-area .pages li a:hover {
    color: <?php echo $base_color?>;
}

.news-details-page .details-post .single-news .content .post-meta li a:hover {
    color: <?php echo $base_color?>;
}

.categori-widget-area .categori-list a:hover {
    color: <?php echo $base_color?>;
}