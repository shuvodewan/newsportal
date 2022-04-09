<?php 

if (!function_exists('slug_create') ) {
    function slug_create($val) {
        $slug = preg_replace('/\s+/u', '-', trim($val));
        return $slug;
    }
}

if(!function_exists('advertisement')){
    function advertisement(){
        $index_bottom = App\Models\Advertisement::inRandomOrder()
                                        ->where('add_placement','index_bottom')
                                        ->where('addSize','size_728')
                                        ->where('status',1)
                                        ->first(); 
        return $index_bottom;
    }
}

if(!function_exists('sidebar_banner')){
    function sidebar_banner(){
        $sidebar_banner = App\Models\Advertisement::inRandomOrder()
                                        ->where('add_placement','sidebar_bottom')
                                        ->where('addSize','size_468')
                                        ->where('status',1)
                                        ->first(); 
        return $sidebar_banner;
    }
}

if(!function_exists('sponsor_banner')){
    function sponsor_banner(){
        $sponsor_banners     = App\Models\Advertisement::inRandomOrder()
                                        ->where('add_placement','sponsor')
                                        ->where('addSize','size_468')
                                        ->where('status',1)
                                        ->take(2)
                                        ->get();
        return $sponsor_banners;
    }
}

if(!function_exists('header_ads')){

    function header_ads(){
        $header_ads   = App\Models\Advertisement::inRandomOrder()
                                ->where('add_placement','header')
                                ->where('addSize','size_728')
                                ->where('status',1)
                                ->inRandomOrder()
                                ->limit(1)
                                ->first(); 
        return $header_ads;
    }
}

if (! function_exists('convertUtf8')) {
    function convertUtf8( $value ) {
        return mb_detect_encoding($value, mb_detect_order(), true) === 'UTF-8' ? $value : mb_convert_encoding($value, 'UTF-8');
    }
}

if(!function_exists('d_logo')){
    function d_logo($lid){
        $header_footer_logo = App\Models\Language::find($lid)->logos;
        return $header_footer_logo;
    }
}


