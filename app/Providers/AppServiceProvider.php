<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\GeneralSettings;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App;
use App\Models\Font;
use App\Models\Language;
use App\Models\SocialLink;
use App\Models\View;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['*'],function($view){

            if (Session::has('language')) 
            {
                if (\Request::is('admin/*')) { 
                    $data = DB::table('admin_languages')->where('is_default','=',1)->first();
                    App::setlocale($data->name);

                }else {
                    $data = DB::table('languages')->find(Session::get('language'));
                    App::setlocale($data->name);                    
                }
            }
                
            else{

                if (\Request::is('admin/*')) { 
                    $a_lang = DB::table('admin_languages')->where('is_default','=',1)->first();
                    App::setlocale($a_lang->name);
        
                }else {
                    $language = DB::table('languages')->where('is_default','=',1)->first();
                    App::setlocale($language->name);                  
                }
            }
 

            $gs = GeneralSettings::find(1);
            if(session()->has('language')){
                $default_language = Language::find(session()->get('language'));
            }else{
    
                $default_language = Language::where('is_default',1)->first();
            }
            $social_links = SocialLink::orderBy('id','desc')->get();
            $languages    = Language::orderBy('id','desc')->get();
            $categories   = Category::orderBy('category_order','asc')
                                        ->where('language_id','=',$default_language->id)
                                        ->where('parent_id','=',null)
                                        ->where('show_on_menu','=',1)
                                        ->get();

            $top_views    = DB::table('views')
                                        ->select(DB::raw('count(*) as top_viwes, post_id'))
                                        ->groupBy('post_id')
                                        ->orderBy('top_viwes','desc')
                                        ->take(6)
                                        ->get();
                                        
            $default_font = Font::where('is_default',1)->first();
            $tags = explode(',',$gs->tags);
            $view->with('gs',$gs);
            $view->with('categories',$categories);
            $view->with('social_links',$social_links);
            $view->with('top_views',$top_views);
            $view->with('tags',$tags);
            $view->with('default_language',$default_language);
            $view->with('default_font',$default_font);
            $view->with('languages',$languages);
        });

        $gs = GeneralSettings::findOrFail(1);
        Config::set('mail.host', $gs->smtp_host);
        Config::set('mail.port', $gs->smtp_port);
        Config::set('mail.encryption', $gs->email_encryption);
        Config::set('mail.username', $gs->smtp_user);
        Config::set('mail.password', $gs->smtp_pass);

        if (!Session::has('popup')) 
        {
            $gs->with('visited', 1);
        }
        Session::put('popup' , 1);
    }
}
