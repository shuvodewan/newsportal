<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Spatie\Sitemap\SitemapGenerator;


Route::redirect('admin', 'admin/login');
Route::get('/test',function(){

})->name('login');

Route::prefix('admin')->group(function(){
    Route::get('/login','Admin\LoginController@loginForm')->name('admin.loginForm');
    Route::post('/login','Admin\LoginController@login')->name('admin.login');

    Route::get('/forgot', 'Admin\LoginController@showForgotForm')->name('admin.forgot');
    Route::post('/forgot', 'Admin\LoginController@forgot')->name('admin.forgot.submit');


    Route::group(['middleware' => 'permissions:menu_builder'], function () {
        //--------------Menu Builder Area---------------
        Route::get('menu-builder','Admin\MenuBuilderController@index')->name('admin.menu.builder');
        Route::post('menu-builder/store','Admin\MenuBuilderController@store')->name('admin.menu.builder.store');
        //--------------Menu Builder Area---------------
    });

    Route::group(['middleware' => 'permissions:categories'], function () {
        
        //--------------Categories Area Start-----------
        Route::get('/categories/datatables','Admin\CategoryController@categoriesDatatables')->name('categories.datatables');
        Route::get('/categories','Admin\CategoryController@categories')->name('categories.index');
        Route::get('/category/slug','Admin\CategoryController@categorySlug')->name('categories.categorySlug');
        Route::get('/categories/create','Admin\CategoryController@categoriesCreate')->name('categories.categoriesCreate');
        Route::post('/categories','Admin\CategoryController@categoriesStore')->name('categories.categoriesStore');
        Route::get('/categories/edit/{id}','Admin\CategoryController@categoriesEdit')->name('categories.categoriesEdit');
        Route::post('/categories/update/{id}','Admin\CategoryController@categoriesUpdate')->name('categories.categoriesUpdate');
        Route::get('/categories/delete/{id}','Admin\CategoryController@categoriesDelete')->name('categories.categoriesDelete');
        //--------------Categories Area End--------------
    
        //-------------SubCategories Area Start-----------
        Route::get('/subcategories/datatables','Admin\SubCategoryController@datatables')->name('subcategories.datatables');
        Route::get('/subcategories','Admin\SubCategoryController@index')->name('subcategories.index');
        Route::get('/subcategories/create','Admin\SubCategoryController@create')->name('subcategories.create');
        Route::post('/subcategories','Admin\SubCategoryController@store')->name('subcategories.store');
        Route::get('/subcategories/edit/{id}','Admin\SubCategoryController@edit')->name('subcategories.edit');
        Route::post('/subcategories/update/{id}','Admin\SubCategoryController@update')->name('subcategories.update');
        Route::get('/subcategories/delete/{id}','Admin\SubCategoryController@delete')->name('subcategories.delete');
        Route::get('/subcategories/languageOnUpdate/{x}/{y}','Admin\SubCategoryController@languageOnUpdate')->name('subcategories.languageOnUpdate');

        //-------------SubCategories Area End---------------
    });


    Route::group(['middleware' => 'permissions:add_post'], function () {

        //  New post 
        Route::get('/add-post', function(){
            return view('admin.post.format');
        })->name('admin.post.format');



        
        //-------------Post Article area--------------------
        Route::get('/add-article','Admin\ArticleController@create')->name('article.create');
        Route::post('/add-article','Admin\ArticleController@store')->name('article.store');
        Route::post('/article/update/{id}','Admin\ArticleController@update')->name('article.update');
        Route::get('/add-article/subcategory/{id}','Admin\ArticleController@subcategory')->name('article.subcategory');
        Route::get('/edit-article/subcategoryUpdate/{x}/{y}','Admin\ArticleController@subcategoryUpdate')->name('article.subcategoryUpdate');
        //-------------slug create-------------------------
        Route::get('/add-article/slugCreate/','Admin\ArticleController@slugCreate')->name('article.slugCreate');
        //-------------slug check--------------------------
        Route::get('/add-article/slugCheck/','Admin\ArticleController@slugCheck')->name('article.slugCheck');
        //-------------category by language----------------
        Route::get('/add-article/languageOnUpdate/{x}/{y}','Admin\ArticleController@languageOnUpdate')->name('article.languageOnUpdate');
        Route::get('/add-article/language/{id}','Admin\ArticleController@language')->name('article.language');
        //-------------Post Article area end----------------
    
    
    
        //-------------Post Audio area-----------
        Route::get('/add-audio','Admin\AudioController@create')->name('audio.create');
        Route::post('/add-audio','Admin\AudioController@store')->name('audio.store');
        Route::post('/audio/update/{id}','Admin\AudioController@update')->name('audio.update');
        Route::get('/add-audio/subcategory/{id}','Admin\AudioController@subcategory')->name('audio.subcategory');
        Route::get('/edit-audio/subcategoryUpdate/{x}/{y}','Admin\AudioController@subcategoryUpdate')->name('audio.subcategoryUpdate');
        //------------slug create----------------
        Route::get('/add-audio/slugCreate/','Admin\AudioController@slugCreate')->name('audio.slugCreate');
        //------------slug check----------------
        Route::get('/add-audio/slugCheck/','Admin\AudioController@slugCheck')->name('audio.slugCheck');
        //------------category by language---------
        Route::get('/add-audio/language/{id}','Admin\AudioController@language')->name('audio.language');
        Route::get('/add-audio/languageOnUpdate/{x}/{y}','Admin\AudioController@languageOnUpdate')->name('audio.languageOnUpdate');
        //-------------Post Audio area end-----------
    
    
    
    
        //-------------Post Video area------------
        Route::get('/add-video','Admin\VideoController@create')->name('video.create');
        Route::post('/add-video','Admin\VideoController@store')->name('video.store');
        Route::post('/video/update/{id}','Admin\VideoController@update')->name('video.update');
        Route::get('/add-video/subcategory/{id}','Admin\VideoController@subcategory')->name('video.subcategory');
        Route::get('/edit-video/subcategoryUpdate/{x}/{y}','Admin\VideoController@subcategoryUpdate')->name('video.subcategoryUpdate');
        //--------------slug create---------------
        Route::get('/add-video/slugCreate/','Admin\VideoController@slugCreate')->name('video.slugCreate');
        //---------------slug check---------------
        Route::get('/add-video/slugCheck/','Admin\VideoController@slugCheck')->name('video.slugCheck');
        //---------------category by language-------
        Route::get('/add-video/language/{id}','Admin\VideoController@language')->name('video.language');
        Route::get('/add-video/languageOnUpdate/{x}/{y}','Admin\VideoController@languageOnUpdate')->name('video.languageOnUpdate');
        //-------------Post Video area------------


        //-------------Post Trivia Quiz Area----------------
        Route::get('/add-tquiz', 'Admin\TQuizController@create')->name('tquiz.create');
        Route::post('/add-tquiz/submit', 'Admin\TQuizController@store')->name('tquiz.store');
        Route::post('/add-tquiz/update/{id}', 'Admin\TQuizController@update')->name('tquiz.update');
        Route::get('/remove-tquizquestion/{id}','Admin\TQuizController@removequestion')->name('tquiz.removequestion');
        Route::get('/remove-tquizanswer/{id}','Admin\TQuizController@removeanswer')->name('tquiz.removeanswer');
        Route::get('/remove-tquizresult/{id}','Admin\TQuizController@removeresult')->name('tquiz.removeresult');
        //-------------Post Trivia Quiz Area----------------

        
        //-------------Post Personality Quiz Area--------------
        Route::get('/add-pquiz', 'Admin\PQuizController@create')->name('pquiz.create');
        Route::post('/add-pquiz', 'Admin\PQuizController@store')->name('pquiz.store');
        Route::post('/add-pquiz/update/{id}','Admin\PQuizController@update')->name('pquiz.update');
        Route::get('/remove-pquizanswer/{id}','Admin\PQuizController@removeanswer')->name('pquiz.removeanswer');
        Route::get('/remove-pquizresult/{id}','Admin\PQuizController@removepresult')->name('pquiz.removeresult');
        Route::get('/remove-pquizquestion/{id}','Admin\PQuizController@removepquestion')->name('pquiz.removepquestion');
        //-------------Post Personality Quiz Area--------------


        //------------Post Shorted List Area-------------------
        Route::get('/add-shortlist','Admin\ShortListController@create')->name('shortlist.create');
        Route::post('/add-shortlist','Admin\ShortListController@store')->name('shortlist.store');
        Route::post('/add-shortlist/update/{id}','Admin\ShortListController@update')->name('shortlist.update');
        Route::get('/remove-shortlist/{id}','Admin\ShortListController@remove')->name('shortlist.remove');
        //------------Post Shorted List Area-------------------
    });


   //----------------post show area-----------

   Route::group(['middleware' => 'permissions:posts'], function () {
       
       //-------------Slider Post Area------------
        Route::get('/post/datatables','Admin\PostController@datatables')->name('post.datatables');
        Route::get('/post','Admin\PostController@index')->name('post.index');
        Route::get('/post/edit/{id}','Admin\PostController@edit')->name('post.edit');
        Route::get('/post/view/{id}','Admin\PostController@view')->name('post.view');
        Route::get('/post/slider/{id}','Admin\PostController@sliderChange')->name('post.sliderChange');
        Route::get('/post/feature/{id}','Admin\PostController@featureChange')->name('post.feature');
        Route::get('/post/sliderright/{id}','Admin\PostController@sliderright')->name('post.sliderright');
        Route::get('/post/trending/{id}','Admin\PostController@trendingChange')->name('post.trendingChange');
        Route::get('/post/pending/{id}','Admin\PostController@pendingChange')->name('post.pendingChange');
        Route::get('/post/delete/{id}','Admin\PostController@delete')->name('post.delete');
        Route::get('/post/sliderBulk','Admin\PostController@sliderBulk')->name('post.add.sliderBulk');
        Route::get('/post/breakingBulk','Admin\PostController@breakingBulk')->name('post.add.breakingBulk');
        Route::get('/post/featureBulk','Admin\PostController@featureBulk')->name('post.add.feature');
        Route::get('/post/rightBulk','Admin\PostController@rightBulk')->name('post.add.rightBulk');
        Route::get('/post/remove/sliderBulk','Admin\PostController@removesliderBulk')->name('post.remove.sliderBulk');
        Route::get('/post/remove/breakingBulk','Admin\PostController@removebreakingBulk')->name('post.remove.breakingBulk');
        Route::get('/post/remove/featureBulk','Admin\PostController@removefeatureBulk')->name('post.remove.featureBulk');
        Route::get('/post/remove/rightBulk','Admin\PostController@removerightBulk')->name('post.remove.rightBulk');
        Route::get('/post/bulkdelete','Admin\PostController@bulkdelete')->name('post.bulkdelete');


        Route::get('/category-filter/language/{id}','Admin\PostController@categoryFilter')->name('categoryFilter.language');
        //-------------Slider Post Area------------
    
        //--------------Slider Post Area----------
        Route::get('/slider/datatables','Admin\SliderController@datatables')->name('slider.datatables');
        Route::get('/slider','Admin\SliderController@index')->name('slider.index');
        Route::get('/slider/category-filter/language/{id}','Admin\SliderController@categoryFilter')->name('categoryFilter.language');
       //--------------Slider Post Area----------
    
        //-------------feature Post Area-----------
        Route::get('/feature/datatables','Admin\FeaturedController@datatables')->name('feature.datatables');
        Route::get('/feature','Admin\FeaturedController@index')->name('feature.index');
        Route::get('/feature/category-filter/language/{id}','Admin\FeaturedController@categoryFilter')->name('categoryFilter.language');
        //-------------feature Post Area-----------
    
        
        //------------breaking Post Area------------
        Route::get('/breaking/datatables','Admin\BreakingController@datatables')->name('breaking.datatables');
        Route::get('/breaking','Admin\BreakingController@index')->name('breaking.index');
        Route::get('/breaking/category-filter/language/{id}','Admin\BreakingController@categoryFilter')->name('breaking.categoryFilter.language');
        //------------breaking Post Area------------
    
         //-----------pending Post Area-----------
         Route::get('/pending/datatables','Admin\PendingController@datatables')->name('pending.datatables');
         Route::get('/pending','Admin\PendingController@index')->name('pending.index');
         Route::get('/pending/category-filter/language/{id}','Admin\PendingController@categoryFilter')->name('pending.categoryFilter.language');
         //-----------pending Post Area-----------
   });

    Route::group(['middleware' => 'permissions:schedule_post'], function () {
        
        //------------Schedule Post Area----------
        Route::get('/schedule/datatables','Admin\ScheduleController@datatables')->name('schedule.datatables');
        Route::get('/schedule','Admin\ScheduleController@index')->name('schedule.index');
        Route::get('/schedule/postApprove','Admin\ScheduleController@postApprove')->name('schedule.postApprove');
        //------------Schedule Post Area----------
    });

    Route::group(['middleware' => 'permissions:drafts'], function () {
        
        //-----------Draft Post Area------------
        Route::get('/draft/datatables','Admin\DraftController@datatables')->name('draft.datatables');
        Route::get('/draft','Admin\DraftController@index')->name('draft.index');
        Route::get('/draft/article/approve','Admin\DraftController@draftArticle')->name('draft.article');
        Route::get('/draft/audio/approve','Admin\DraftController@draftAudio')->name('draft.audio');
        Route::get('/draft/video/approve','Admin\DraftController@draftVideo')->name('draft.video');
        //-----------Draft Post Area end------------
    });


    //----------------post show area end-----------

    Route::group(['middleware' => 'permissions:rss_feeds'], function () {
        
        //-------------Rss Feeds Section-----------
        Route::get('/rss/datatables','Admin\RssFeedsController@datatables')->name('rss.datatables');
        Route::get('/rss','Admin\RssFeedsController@index')->name('rss.index');
        Route::get('/rss/create','Admin\RssFeedsController@create')->name('rss.create');
        Route::post('/rss','Admin\RssFeedsController@store')->name('rss.store');
        Route::get('/rss/edit/{id}','Admin\RssFeedsController@edit')->name('rss.edit');
        Route::post('/rss/update/{id}','Admin\RssFeedsController@update')->name('rss.update');
        Route::get('/rss/delete/{id}','Admin\RssFeedsController@delete')->name('rss.delete');
        Route::get('/rss/category/{id}','Admin\RssFeedsController@categoryByLanguage')->name('rss.category');
        Route::get('/rss/categoryUpdate/{x}/{y}','Admin\RssFeedsController@categoryByLanguageUpdate')->name('rss.categoryUpdate');
        Route::get('rss-feed/update/{id}','Admin\RssFeedsController@feedUpdate')->name('rss.feedUpdate');
        Route::get('rss-feed/cronJobUpdate','Admin\RssFeedsController@cronJobUpdate')->name('rss.cronJobUpdate');
        //-------------Rss Feeds Section Ends-----------
    });


    Route::group(['middleware' => 'permissions:languages'], function () {
        
        //------------Language area--------------
        Route::get('/language/datatables','Admin\LanguageController@datatables')->name('language.datatables');
        Route::get('/add-language','Admin\LanguageController@index')->name('admin.language.index');
        Route::get('/add-language/create','Admin\LanguageController@create')->name('admin.language.create');
        Route::post('/add-language','Admin\LanguageController@store')->name('admin.language.store');
        Route::get('/add-language/edit/{id}','Admin\LanguageController@edit')->name('admin.language.edit');
        Route::post('/add-language/update/{id}','Admin\LanguageController@update')->name('admin.language.update');
        Route::get('/add-language/delete/{id}','Admin\LanguageController@delete')->name('admin.language.delete');
        Route::get('/languages/status/{id}', 'Admin\LanguageController@status')->name('admin.language.status');
        //------------Language area end--------------


        //-------------Admin Language Area--------------
        Route::get('/admin-language/datatables','Admin\AdminLanguageController@datatables')->name('admin_language.datatables');
        Route::get('/admin-add-language','Admin\AdminLanguageController@index')->name('admin.admin_language.index');
        Route::get('/admin-add-language/create','Admin\AdminLanguageController@create')->name('admin.admin_language.create');
        Route::post('/admin-add-language','Admin\AdminLanguageController@store')->name('admin.admin_language.store');
        Route::get('/admin-add-language/edit/{id}','Admin\AdminLanguageController@edit')->name('admin.admin_language.edit');
        Route::post('/admin-add-language/update/{id}','Admin\AdminLanguageController@update')->name('admin.admin_language.update');
        Route::get('/admin-add-language/delete/{id}','Admin\AdminLanguageController@delete')->name('admin.admin_language.delete');
        Route::get('/admin-languages/status/{id}', 'Admin\AdminLanguageController@status')->name('admin.admin_language.status');
        //-------------Admin Language Area--------------
    });



    //-------------gallery area--------------
    Route::get('/gallery/show', 'Admin\GalleryController@show')->name('admin.gallery.show');
    Route::post('/gallery/store', 'Admin\GalleryController@store')->name('admin.gallery.store');
    Route::get('/gallery/delete', 'Admin\GalleryController@destroy')->name('admin.gallery.delete');
    //-------------gallery area end--------------

    Route::group(['middleware' => 'permissions:polls'], function () {
        
        //-------------Polls Area Start----------
        Route::get('/add-polls/datatables','Admin\PollController@datatables')->name('addPolls.datatables');
        Route::get('/add-polls','Admin\PollController@index')->name('addPolls.index');
        Route::get('/add-polls/create','Admin\PollController@create')->name('addPolls.create');
        Route::post('/add-polls','Admin\PollController@store')->name('addPolls.store');
        Route::get('/add-polls/edit/{id}','Admin\PollController@edit')->name('addPolls.edit');
        Route::post('/add-polls/update/{id}','Admin\PollController@update')->name('addPolls.update');
        Route::get('/add-polls/delete/{id}','Admin\PollController@delete')->name('addPolls.delete');
        Route::get('/add-polls/showOnHomePage','Admin\PollController@showOnHomePage')->name('addPolls.showOnHomePage');
    
        Route::get('/poll-option/create/{id}','Admin\PollController@pollcreate')->name('pollOption.create');
        Route::post('/poll-option/create','Admin\PollController@pollstore')->name('pollOption.pollstore');
        Route::get('/poll-option/edit/{id}','Admin\PollController@polledit')->name('pollOption.polledit');
        Route::get('/poll-option/update/{id}','Admin\PollController@pollupdate')->name('pollOption.pollupdate');
        Route::get('/poll-option/view/{id}','Admin\PollController@pollview')->name('pollOption.pollview');
        Route::get('/poll-option/delete/{id}','Admin\PollController@optiondelete')->name('pollOption.optiondelete');
        //-------------Polls Area Start End----------
    });


    Route::group(['middleware' => 'permissions:widgets'], function () {
        
        //----------Widget Section Area----------
        Route::get('/widget/datatables','Admin\WidgetController@datatables')->name('widget.datatables');
        Route::get('/widget/index','Admin\WidgetController@index')->name('widget.index');
        Route::get('widget/create','Admin\WidgetController@create')->name('widget.create');
        Route::post('widget/store','Admin\WidgetController@store')->name('widget.store');
        Route::get('widget/edit/{id}','Admin\WidgetController@edit')->name('widget.edit');
        Route::post('widget/update/{id}','Admin\WidgetController@update')->name('widget.update');
        Route::get('widget/delete/{id}','Admin\WidgetController@delete')->name('widget.delete');
        Route::get('widget-settings','Admin\WidgetController@widgetSettings')->name('widget.settings');
        Route::post('widget-settings/update','Admin\WidgetController@widgetSettingsUpdate')->name('widget.settings.update');
        //----------Widget Section Area End-----------
    });


    Route::group(['middleware' => 'permissions:create_ads'], function () {
        
        //---------Ads Section---------
        Route::get('/ads/datatables','Admin\AddSpaceController@datatables')->name('ads.datatables');
        Route::get('/ads/index','Admin\AddSpaceController@index')->name('ads.index');
        Route::get('/ads/create','Admin\AddSpaceController@create')->name('ads.create');
        Route::post('/ads/store','Admin\AddSpaceController@store')->name('ads.store');
        Route::get('/ads/edit/{id}','Admin\AddSpaceController@edit')->name('ads.edit');
        Route::post('/ads/update/{id}','Admin\AddSpaceController@update')->name('ads.update');
        Route::get('/ads/delete/{id}','Admin\AddSpaceController@delete')->name('ads.delete');
        //---------Ads Section end---------
    });


    Route::group(['middleware' => 'permissions:add_gallery'], function () {
        
        //--------------Image Album Section-------------
        Route::get('/image-album/datatables','Admin\ImageAlbumController@datatables')->name('image.album.datatables');
        Route::get('/image-album','Admin\ImageAlbumController@index')->name('image.album.index');
        Route::get('/image-album/create','Admin\ImageAlbumController@create')->name('image.album.create');
        Route::post('/image-album','Admin\ImageAlbumController@store')->name('image.album.store');
        Route::get('/image-album/edit/{id}','Admin\ImageAlbumController@edit')->name('image.album.edit');
        Route::post('/image-album/update/{id}','Admin\ImageAlbumController@update')->name('image.album.update');
        Route::get('/image-album/delete/{id}','Admin\ImageAlbumController@delete')->name('image.album.delete');
        //--------------Image Album Section-------------

        //--------------Image Category Section-------------
        Route::get('/image-category/datatables','Admin\ImageCategoryController@datatables')->name('image.category.datatables');
        Route::get('/image-category','Admin\ImageCategoryController@index')->name('image.category.index');
        Route::get('/image-category/create','Admin\ImageCategoryController@create')->name('image.category.create');
        Route::post('/image-category','Admin\ImageCategoryController@store')->name('image.category.store');
        Route::get('/image-category/edit/{id}','Admin\ImageCategoryController@edit')->name('image.category.edit');
        Route::post('/image-category/update/{id}','Admin\ImageCategoryController@update')->name('image.category.update');
        Route::get('/image-category/delete/{id}','Admin\ImageCategoryController@delete')->name('image.category.delete');
        Route::get('/categoryByLanguage/{id}','Admin\ImageCategoryController@categoryByLanguage')->name('image.categoryByLanguage');
        Route::get('/languageOnUpdate/{x}/{y}','Admin\ImageCategoryController@languageOnUpdate')->name('image.languageOnUpdate');
        //--------------Image Category Section-------------

        //-------------Image Gallery Section---------------
        Route::get('/image-gallery/datatables','Admin\ImageGalleryController@datatables')->name('image.gallery.datatables');
        Route::get('/image-gallery','Admin\ImageGalleryController@index')->name('image.gallery.index');
        Route::get('/image-gallery/create','Admin\ImageGalleryController@create')->name('image.gallery.create');
        Route::post('/image-gallery','Admin\ImageGalleryController@store')->name('image.gallery.store');
        Route::get('/image-gallery/edit/{id}','Admin\ImageGalleryController@edit')->name('image.gallery.edit');
        Route::post('/image-gallery/update/{id}','Admin\ImageGalleryController@update')->name('image.gallery.update');
        Route::get('/image-gallery/delete/{id}','Admin\ImageGalleryController@delete')->name('image.gallery.delete');
        Route::get('/image-gallery/galleryShow/{id}','Admin\ImageGalleryController@galleryShow')->name('image.gallery.galleryShow');
        Route::get('/albumByLanguage/{id}','Admin\ImageGalleryController@albumByLanguage')->name('gallery.albumByLanguage');
        Route::get('/categoryByAlbum/{id}','Admin\ImageGalleryController@categoryByAlbum')->name('gallery.categoryByAlbum');
        Route::get('/albumByLanguageUpdate/{x}/{y}','Admin\ImageGalleryController@albumByLanguageUpdate')->name('gallery.albumByLanguageUpdate');
        Route::get('/categoryByAlbumUpdate/{x}/{y}','Admin\ImageGalleryController@categoryByAlbumUpdate')->name('gallery.categoryByAlbumUpdate');
        //-------------Image Gallery Section---------------
    });


    Route::group(['middleware' => 'permissions:general_settings'], function () {
        
        //------------General Settings-----------
        Route::post('/generalsettings/update','Admin\GeneralSettingsController@update')->name('admin.generalsettings.update');
        Route::get('/generalsettings/logo','Admin\GeneralSettingsController@logo')->name('admin.generalsettings.logo');
        Route::get('/generalsettings/favicon','Admin\GeneralSettingsController@favicon')->name('admin.generalsettings.favicon');
        Route::get('/generalsettings/loader','Admin\GeneralSettingsController@loader')->name('admin.generalsettings.loader');
        Route::get('/generalsettings/website/content','Admin\GeneralSettingsController@websiteContent')->name('admin.generalsettings.websiteContent');
        Route::get('/generalsettings/footer','Admin\GeneralSettingsController@footer')->name('admin.generalsettings.footer');
        Route::get('/generalsettings/error/page','Admin\GeneralSettingsController@errorPage')->name('admin.generalsettings.errorPage');
        Route::get('/generalsettings/popular/tags','Admin\GeneralSettingsController@popularTags')->name('admin.generalsettings.popularTags');

        Route::get('/generalsettings/tawakto/{x}','Admin\GeneralSettingsController@tawkto')->name('admin.generalsettings.tawkto');
        Route::get('/generalsettings/disqus/{x}','Admin\GeneralSettingsController@disqus')->name('admin.generalsettings.disqus');
        Route::get('/generalsettings/smtp/{x}','Admin\GeneralSettingsController@smtp')->name('admin.generalsettings.smtp');
        
        
        //-------------Language Base Logo Area----------------
        Route::get('/language/logo/datatables','Admin\LogoController@datatables')->name('admin.languagelogo.datatables');
        Route::get('/language/logo','Admin\LogoController@index')->name('admin.languagelogo.index');
        Route::get('/language/logo/create','Admin\LogoController@create')->name('admin.languagelogo.create');
        Route::post('/language/logo','Admin\LogoController@store')->name('admin.languagelogo.store');
        Route::get('/language/logo/edit/{id}','Admin\LogoController@edit')->name('admin.languagelogo.edit');
        Route::post('/language/logo/update/{id}','Admin\LogoController@update')->name('admin.languagelogo.update');
        Route::get('/language/logo/delete/{id}','Admin\LogoController@delete')->name('admin.languagelogo.delete');
        //-------------Language Base Logo Area----------------
        
        //------------General Settings-----------
    });


    
    Route::group(['middleware' => 'permissions:seo_tools'], function () {
        
        //------------Seo Management-------------
        Route::post('seo/update','Admin\SeoController@update')->name('seo.update');
        Route::get('seo/google-analytics','Admin\SeoController@googleAnalytics')->name('seo.google.analytics');
        Route::get('seo/meta-keywords','Admin\SeoController@metaKeywords')->name('seo.meta.keywords');
        //------------Seo Management-------------
    });
    
    
    Route::group(['middleware' => 'permissions:social_settings'], function () {
        
        //-------------SocialSettings Manage-----------
        Route::post('social-settings/update','Admin\SocialSettingsController@update')->name('social.settings.update');
        Route::get('social-settings/google','Admin\SocialSettingsController@google')->name('social.settings.google');
        Route::get('social-settings/facebook','Admin\SocialSettingsController@facebook')->name('social.settings.facebook');
        //-------------SocialSettings Manage-----------

        //-------------SocialLink Manage-------------
        Route::get('social-link/datatables','Admin\SocialLinkController@datatables')->name('social.link.datatables');
        Route::get('social-link','Admin\SocialLinkController@index')->name('social.link.index');
        Route::get('social-link/create','Admin\SocialLinkController@create')->name('social.link.create');
        Route::post('social-link','Admin\SocialLinkController@store')->name('social.link.store');
        Route::get('social-link/edit/{id}','Admin\SocialLinkController@edit')->name('social.link.edit');
        Route::post('social-link/update/{id}','Admin\SocialLinkController@update')->name('social.link.update');
        Route::get('social-link/delete/{id}','Admin\SocialLinkController@delete')->name('social.link.delete');
        //-------------SocialLink Manage-------------
    });
    

    Route::group(['middleware' => 'permissions:pages'], function () {
        
        //-------------Page Create Area----------------
        Route::get('page/datatables','Admin\PageController@datatables')->name('admin.page.datatables');
        Route::get('/page','Admin\PageController@index')->name('admin.page.index');
        Route::get('/page/create','Admin\PageController@create')->name('admin.page.create');
        Route::post('/page','Admin\PageController@store')->name('admin.page.store');
        Route::get('/page/edit/{id}','Admin\PageController@edit')->name('admin.page.edit');
        Route::post('/page/update/{id}','Admin\PageController@update')->name('admin.page.update');
        Route::get('/page/delete/{id}','Admin\PageController@delete')->name('admin.page.delete');
        Route::get('/page/slugCreate','Admin\PageController@slugCreate')->name('admin.page.slugCreate');
        //-------------Page Create Area----------------
    });


    Route::group(['middleware' => 'permissions:emails_settings'], function () {
        
        //---------------Email Manage-------------------
        Route::get('email/config','Admin\EmailController@config')->name('admin.email.config');
        Route::get('email/group','Admin\EmailController@group')->name('admin.email.group');
        Route::post('email/group','Admin\EmailController@groupmailsend')->name('admin.email.groupmailsend');
        //---------------Email Manage-------------------
    });


    Route::group(['middleware' => 'permissions:newsLetter'], function () {
        
        //---------------Subscriber----------------------
        Route::get('/subscriber/datatables','Admin\SubscriberController@datatables')->name('admin.subscriber.datatables');
        Route::get('/subscriber','Admin\SubscriberController@index')->name('admin.subscriber.index');
        Route::get('/subscriber/download','Admin\SubscriberController@download')->name('admin.subscriber.download');
        Route::get('/send-mail','Admin\SubscriberController@email')->name('admin.subscriber.email');
        Route::post('/send-mail','Admin\SubscriberController@sendemail')->name('admin.subscriber.sendemail');
        //---------------Subscriber----------------------
    });


    Route::group(['middleware' => 'permissions:role_management'], function () {
        
        //----------------Role Management-----------------
        Route::get('/role/datatables','Admin\RoleController@datatables')->name('admin.role.datatables');
        Route::get('/role','Admin\RoleController@index')->name('admin.role.index');
        Route::get('/role/create','Admin\RoleController@create')->name('admin.role.create');
        Route::post('/role','Admin\RoleController@store')->name('admin.role.store');
        Route::get('/role/edit/{id}','Admin\RoleController@edit')->name('admin.role.edit');
        Route::post('/role/update/{id}','Admin\RoleController@update')->name('admin.role.update');
        Route::get('/role/update/{id}','Admin\RoleController@delete')->name('admin.role.delete');
        //----------------Role Management-----------------
    });


    Route::group(['middleware' => 'permissions:user_management'], function () {
        //----------------Staff Management----------------
        Route::get('/user/datatables','Admin\StaffController@datatables')->name('admin.staff.datatables');
        Route::get('/user','Admin\StaffController@index')->name('admin.staff.index');
        Route::get('/user/create','Admin\StaffController@create')->name('admin.staff.create');
        Route::post('/user','Admin\StaffController@store')->name('admin.staff.store');
        Route::get('/user/edit/{id}','Admin\StaffController@edit')->name('admin.staff.edit');
        Route::post('/user/update/{id}','Admin\StaffController@update')->name('admin.staff.update');
        Route::get('/user/delete/{id}','Admin\StaffController@delete')->name('admin.staff.delete');
        //----------------Staff Management----------------
    });

    Route::group(['middleware' => 'permissions:administration_management'], function () {
        //----------------Staff Management----------------
        Route::get('/administator/datatables','Admin\AdministerController@datatables')->name('admin.administator.datatables');
        Route::get('/administator','Admin\AdministerController@index')->name('admin.administator.index');
        Route::get('/administator/create','Admin\AdministerController@create')->name('admin.administator.create');
        Route::post('/administator','Admin\AdministerController@store')->name('admin.administator.store');
        Route::get('/administator/edit/{id}','Admin\AdministerController@edit')->name('admin.administator.edit');
        Route::post('/administator/update/{id}','Admin\AdministerController@update')->name('admin.administator.update');
        //----------------Staff Management----------------
    });





    Route::group(['middleware' => 'permissions:site_map'], function () {
        Route::get('/sitemaps', 'Admin\SiteMapController@all')->name('admin.sitemap.all');
        Route::get('/sitemap.xml', 'Admin\SiteMapController@index')->name('sitemap.index');
        Route::get('/sitemap/categories.xml', 'Admin\SiteMapController@categories')->name('sitemap.categories');
        Route::get('/sitemap/subcategories.xml', 'Admin\SiteMapController@subcategories')->name('sitemap.subcategories');
        Route::get('/sitemap/posts.xml', 'Admin\SiteMapController@posts')->name('sitemap.posts');
    });

    Route::group(['middleware' => 'permissions:font_option'], function () {
        Route::get('/fonts/datatables','Admin\FontController@datatables')->name('admin.fonts.datatables');
        Route::get('/fonts','Admin\FontController@index')->name('fonts.index');
        Route::get('/fonts/status/{id}', 'Admin\FontController@status')->name('admin.fonts.status');  
    });

    Route::group(['middleware' => 'permissions:cache_management'], function () {
        //----------------Cache Management-----------------
        Route::get('/cache','Admin\CacheController@clear')->name('admin.cache.clear');
        //----------------Cache Management-----------------
    });

    Route::get('/logout','Admin\DashboardController@logout')->name('admin.logout');
    Route::get('/dashboard','Admin\DashboardController@index')->name('admin.dashboard');

    Route::get('/profile', 'Admin\DashboardController@profile')->name('admin.profile');
    Route::post('/profile', 'Admin\DashboardController@profileUpdate')->name('admin.profile.update');
    Route::get('/password', 'Admin\DashboardController@passwordreset')->name('admin.password');
    Route::post('/password', 'Admin\DashboardController@changepass')->name('admin.password.update');

    Route::get('/check/movescript', 'Admin\DashboardController@movescript')->name('admin-move-script');
    Route::get('/generate/backup', 'Admin\DashboardController@generate_bkup')->name('admin-generate-backup');
    Route::get('/activation', 'Admin\DashboardController@activation')->name('admin-activation-form');
    Route::post('/activation', 'Admin\DashboardController@activation_submit')->name('admin-activate-purchase');
    Route::get('/clear/backup', 'Admin\DashboardController@clear_bkup')->name('admin-clear-backup');

    
});

Route::get('/','Front\FrontendController@index')->name('frontend.index');
Route::get('/tag/{search}','Front\FrontendController@searchByTag')->name('tag.search');
Route::get('/details/{id}/{slug}','Front\FrontendController@details')->name('frontend.details');

Route::post('the/genius/ocean/2441139', 'Front\FrontendController@subscription');
Route::get('finalize', 'Front\FrontendController@finalize');


Route::post('/poll-vote','Front\PollVoteController@vote')->name('front.poll.vote');
Route::get('/poll-result/{id}','Front\PollVoteController@result')->name('front.poll.result');
Route::post('/subscribers','Front\SubscriberController@store')->name('front.subscribers.store');
Route::get('/load-more','Front\FrontendController@loadMore')->name('frontend.loadMore');
Route::get('/post/post-by-date','Front\FrontendController@postByDate')->name('frontend.postByDate');
Route::get('/gallery-view/{id}','Front\GalleryController@view')->name('gallery.view');
Route::get('/all-poll','Front\FrontendController@allPoll')->name('front.allPoll');
Route::get('/all-poll-result','Front\FrontendController@allPollResult')->name('front.allPollResult');
Route::get('/news-search','Front\FrontendController@newsSearch')->name('front.news_search');
Route::get('/page/{sl}','Front\FrontendController@page')->name('dynamic.page');
Route::get('/language/{id}','Front\FrontendController@language')->name('front.language');


Route::get('/profile/{admin}','Front\FrontendController@authorProfile')->name('front.authorProfile');
Route::get('/follower','Front\FrontendController@follower')->name('front.follower');



Route::get('/follower/create/{id}','Front\FollowController@followerCreate')->name('front.followerCreate');
Route::get('/follower/{admin}','Front\FollowController@following')->name('front.following');

Route::get('/contact/refresh_code','Front\FrontendController@refresh_code');
Route::get('/log-reg','Front\RegisterController@LogReg')->name('front.LogReg');

Route::post('/register','Front\RegisterController@register')->name('front.register');
Route::get('/register/verify/{token}', 'Front\RegisterController@token')->name('user.register.token');
Route::post('/login','Front\LoginController@login')->name('front.login');
Route::get('/logout','Front\LoginController@logout')->name('front.logout');

Route::get('auth/{provider}', 'Front\SocialRegisterController@redirectToProvider')->name('social.provider');
Route::get('auth/{provider}/callback', 'Front\SocialRegisterController@handleProviderCallback');

Route::get('/{category}/{subcategory}','Front\FrontendController@postBySubcategory')->name('frontend.postBySubcategory');
Route::get('/{category}','Front\FrontendController@category')->name('frontend.category');

Route::get('/click/count/{id}','Front\FrontendController@clickCount')->name('frontend.click.count');












