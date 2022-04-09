@extends('layouts.front')

@push('css')
    <style>
        .js-cookie-consent{
                position: fixed;
                bottom: 0px;
                padding: 14px;
                color  : #fff;
                text-align: center;
                width: 100%;
                z-index: 10000000000;
                background-color: #8e44ad;
                border-color: #8e44ad;
            }
    </style>

@endpush

@section('contents')

<!-- Top Header Area Start -->
<section class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="content">
                    <div class="left-content">
                        <div class="heading">
                            <span>{{__('Trending Now!')}} </span>
                        </div>
                        <div class='marquee'>
                            <marquee onMouseOver="this.stop()" onMouseOut="this.start()" scrollamount="5">
                                {!!$is_breaking!!}</marquee>
                        </div>
                    </div>
                    <div class="right-content">
                        <span class="date-now">{{\Carbon\Carbon::now()->toFormattedDateString()}}<span class="time-now"></span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Top Header Area End -->

<!-- Hero Area Start -->
<section class="hero-area">
    <div class="container">
        <div class="row py">
            <div class="col-lg-6 r-p">
                <div class="intro-carousel">
                    @foreach ($sliders as $slider)
                        <a href="{{ route('frontend.details',[$slider->id,$slider->slug])}}" class="single-news big">
                            <div class="content-wrapper">
                                @if ($slider->image_big || $slider->rss_image)
                                    <div class="tag" style="background:{{$slider->category->color}}">
                                        {{$slider->category->title}}
                                    </div>
                                @endif
                                @if ($slider->image_big || $slider->rss_image)
                                    @if ($slider->image_big)
                                        <img src="{{asset('assets/images/post/'.$slider->image_big)}}"  alt="">
                                    @endif

                                    @if ($slider->rss_image)
                                        <img src="{{$slider->rss_image}}" alt="">
                                    @endif

                                    @if ($slider->post_type == 'audio')
                                        <span  class="vid-aud">
                                            <i class="fas fa-volume-up"></i>
                                        </span>
                                    @endif
                                    @if ($slider->post_type == 'video')
                                        <span  class="vid-aud">
                                            <i class="fas fa-video"></i>
                                        </span> 
                                    @endif
                                @else 
                                    <img src="{{asset('assets/images/nopic.png')}}" alt="">
                                @endif
                                <div class="inner-content">
                                    <span>
                                        <h4 class="title">
                                            {{strlen($slider->title)>40 ? mb_substr($slider->title,0,40,"utf-8") : $slider->title}}
                                        </h4>
                                    </span>
                                    <ul class="post-meta">
                                        <li>
                                            <span>
                                                {{$slider->createdAt()}}
                                            </span>
                                        </li>
                                        <li>
                                            <span>|</span>
                                        </li>
                                        <li>
                                            <span>
                                                {{$slider->admin->name}}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3 r-p mycol">
                @foreach ($slider_rights_firsts as $slider_rights_first)
                    <a href="{{ route('frontend.details',[$slider_rights_first->id,$slider_rights_first->slug])}}" class="single-news animation">
                        <div class="content-wrapper">
                            @if ($slider_rights_first->image_big || $slider_rights_first->rss_image)
                                <div class="tag" style="background:{{$slider_rights_first->category->color}}">
                                    {{$slider_rights_first->category->title}}
                                </div>
                            @endif
                            @if ($slider_rights_first->image_big || $slider_rights_first->rss_image)
                                @if ($slider_rights_first->image_big)
                                    <img data-src="{{asset('assets/images/post/'.$slider_rights_first->image_big)}}" alt="" class="lazy">
                                @endif
                                @if ($slider_rights_first->rss_image)
                                    <img data-src="{{$slider_rights_first->rss_image}}" alt="" class="lazy">
                                @endif
                                @if ($slider_rights_first->post_type == 'audio')
                                    <span  class="vid-aud">
                                        <i class="fas fa-volume-up"></i>
                                    </span>
                                @endif
                                @if ($slider_rights_first->post_type == 'video')
                                    <span  class="vid-aud">
                                        <i class="fas fa-video"></i>
                                    </span> 
                                @endif
                            @else 
                                    <img src="{{asset('assets/images/nopic.png')}}" alt="">
                            @endif
                            <div class="inner-content">
                                <span>
                                    <h4 class="title">
                                        {{strlen($slider_rights_first->title)>40 ? mb_substr($slider_rights_first->title,0,40,"utf-8") : $slider_rights_first->title}}
                                    </h4>
                                </span>
                                <ul class="post-meta">
                                    <li>
                                        <span>
                                            {{$slider_rights_first->createdAt()}}
                                        </span>
                                    </li>
                                    <li>
                                        <span>|</span>
                                    </li>
                                    <li>
                                        <span>
                                            {{$slider_rights_first->admin->name}}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="col-lg-3 r-p mycol">
                @foreach ($slider_rights_seconds as $slider_rights_second)
                    <a href="{{ route('frontend.details',[$slider_rights_second->id,$slider_rights_second->slug])}}" class="single-news animation">
                        <div class="content-wrapper">
                            @if ($slider_rights_second->image_big || $slider_rights_second->rss_image)
                                <div class="tag" style="background:{{$slider_rights_second->category->color}}">
                                    {{$slider_rights_second->category->title}}
                                </div>
                            @endif
                            @if ($slider_rights_second->image_big || $slider_rights_second->rss_image)
                                @if ($slider_rights_second->post_type == 'audio')
                                <span  class="vid-aud">
                                    <i class="fas fa-volume-up"></i>
                                </span>
                                @endif
                                @if ($slider_rights_second->post_type == 'video')
                                    <span  class="vid-aud">
                                        <i class="fas fa-video"></i>
                                    </span> 
                                @endif
                                @if ($slider_rights_second->image_big)
                                    <img data-src="{{asset('assets/images/post/'.$slider_rights_second->image_big)}}" alt="" class="lazy">
                                @endif
                                @if ($slider_rights_second->rss_image)
                                    <img data-src="{{$slider_rights_second->rss_image}}" alt="" class="lazy">
                                @endif
                            @else 
                                    <img src="{{asset('assets/images/nopic.png')}}" alt="">
                            @endif
                            <div class="inner-content">
                                <span>
                                    <h4 class="title">
                                        {{strlen($slider_rights_second->title)>40 ? mb_substr($slider_rights_second->title,0,40,"utf-8") : $slider_rights_first->title}}
                                    </h4>
                                </span>
                                <ul class="post-meta">
                                    <li>
                                        <span>
                                            {{$slider_rights_second->createdAt()}}
                                        </span>
                                    </li>
                                    <li>
                                        <span>|</span>
                                    </li>
                                    <li>
                                        <span>
                                            {{$slider_rights_second->admin->name}}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Hero Area End -->

<!-- Home Front Area Start -->
<section class="home-front-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @foreach ($home_page_posts as $home_page_post)
                    @if (count($home_page_post->child)>0)
                        @if (count($home_page_post->posts)>0)
                            <!-- News Tabs start -->
                            <div class="main-content tab-view">
                                <div class="row">
                                    <div class="col-lg-12 mycol">
                                        <div class="header-area">
                                            <h3 class="title">
                                                {{$home_page_post->title}}
                                            </h3>
                                            <ul class="nav" role="tablist">
                                                @foreach ($home_page_post->child as $child)
                                                <li class="nav-item">
                                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="pills-home-tab" data-toggle="pill" href="#pills-{{$child->slug}}" role="tab" aria-controls="pills-{{$child->slug}}" aria-selected="true">{{$child->title}}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="tab-content" id="pills-tabContent">
                                            @foreach ($home_page_post->child as $child)
                                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pills-{{$child->slug}}" role="tabpanel" aria-labelledby="pills-{{$child->slug}}-tab">
                                                    <div class="row">
                                                        <div class="col-md-6 mycol">
                                                            @if ($child->subcategoryPosts()->where('schedule_post','=',0)->where('status','=',true)->where('is_pending','=',0)->count()>0)
                                                            @foreach ($child->subcategoryPosts()->orderBy('id','desc')->where('schedule_post','=',0)->where('status','=',true)->where('is_pending','=',0)->take(1)->get() as $post)
                                                                <div class="single-news landScape-normal">
                                                                    <a href="{{ route('frontend.details',[$post->id,$post->slug])}}">
                                                                        <div class="content-wrapper">
                                                                            <div class="img">
                                                                                @if ($post->image_big || $post->rss_image)
                                                                                    <div class="tag" style="background:{{$home_page_post->color}}">
                                                                                        {{$post->category->title}}
                                                                                    </div>
                                                                                @endif
                                                                                @if ($post->image_big || $post->rss_image)
                                                                                    @if ($post->image_big)
                                                                                        <img data-src="{{asset('assets/images/post/'.$post->image_big)}}" alt="" class="lazy">
                                                                                    @endif
                                                                                    @if ($post->rss_image)
                                                                                        <img data-src="{{$post->rss_image}}" alt="" class="lazy">
                                                                                    @endif
                                                                                    @if ($post->post_type == 'audio')
                                                                                        <span  class="vid-aud">
                                                                                            <i class="fas fa-volume-up"></i>
                                                                                        </span>
                                                                                    @endif
                                                                                    @if ($post->post_type == 'video')
                                                                                        <span  class="vid-aud">
                                                                                            <i class="fas fa-video"></i>
                                                                                        </span> 
                                                                                    @endif
                                                                                @else 
                                                                                    <img src="{{asset('assets/images/nopic.png')}}" alt="">
                                                                                @endif
                                                                            </div>
                                                                            <div class="inner-content">
                                                                                <a href="{{ route('frontend.details',[$post->id,$post->slug])}}">
                                                                                    <h4 class="title">
                                                                                        {{strlen($post->title)>170 ? mb_substr($post->title,0,170,'utf-8').'...' : $post->title}}
                                                                                    </h4>
                                                                                    <p class="text">
                                                                                        {!! (strlen(convertUtf8(strip_tags($post->description))) > 400) ? convertUtf8(substr(strip_tags($post->description), 0, 400)) . '...' : convertUtf8(strip_tags($post->description)) !!}
                                                                                    </p>
                                                                                    <ul class="post-meta">
                                                                                        <li>
                                                                                        <a href="{{ route('frontend.postByDate').'?date='.$post->created_at->format('Y-m-d') }}">
                                                                                                {{$post->createdAt()}}
                                                                                            </a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <span>|</span>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a href="{{ route('front.authorProfile',$post->admin->name)}}">
                                                                                                {{$post->admin->name}}
                                                                                            </a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6 mycol">
                                                            @if ($child->subcategoryPosts()->where('schedule_post','=',0)->where('status','=',true)->where('is_pending','=',0)->count()>0)
                                                            @foreach ($child->subcategoryPosts()->orderBy('id','desc')->where('schedule_post','=',0)->where('status','=',true)->where('is_pending','=',0)->skip(1)->take(5)->get() as $post)
                                                                <a href="{{ route('frontend.details',[$post->id,$post->slug])}}">
                                                                    <div class="single-box landScape-small-with-meta">
                                                                        <div class="img">
                                                                            @if ($post->image_big || $post->rss_image)
                                                                                @if ($post->image_big)
                                                                                    <img data-src="{{asset('assets/images/post/'.$post->image_big)}}" alt="" class="lazy">
                                                                                @endif
                                                                                @if ($post->rss_image)
                                                                                    <img data-src="{{$post->rss_image}}" alt="" class="lazy">
                                                                                @endif
                                                                                @if ($post->post_type == 'audio')
                                                                                        <span  class="vid-aud">
                                                                                            <i class="fas fa-volume-up"></i>
                                                                                        </span>
                                                                                @endif
                                                                                @if ($post->post_type == 'video')
                                                                                    <span  class="vid-aud">
                                                                                        <i class="fas fa-video"></i>
                                                                                    </span> 
                                                                                @endif
                                                                            @else
                                                                                <img src="{{asset('assets/images/nopic.png')}}" alt="">
                                                                            @endif
                                                                        </div>
                                                                        <div class="content">
                                                                            <a href="{{ route('frontend.details',[$post->id,$post->slug])}}">
                                                                                <h4 class="title">
                                                                                    {{ strlen($post->title)>130 ? mb_substr($post->title,0,130,'utf-8').'...' : $post->title}}
                                                                                </h4>
                                                                            </a>
                                                                            <ul class="post-meta">
                                                                                <li>
                                                                                    <a href="{{ route('frontend.postByDate').'?date='.$post->created_at->format('Y-m-d') }}">
                                                                                        {{$post->createdAt()}}
                                                                                    </a>
                                                                                </li>
                                                                                <li>
                                                                                    <span>|</span>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="{{ route('front.authorProfile',$post->admin->name)}}">
                                                                                        {{$post->admin->name}}
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <!-- News Tabs End -->
                            <div class="row mb-5">
                                <div class="col-lg-12 mycol">
                                    @php
                                        $index_bottom = advertisement(); //Method from helper.php class
                                    @endphp

                                    @if ($index_bottom)
                                        @if ($index_bottom->banner_type == 'image')
                                            <div class="add-long">
                                                <a href="{{$index_bottom->link}}" target="_blank" data-addid="{{$index_bottom->id}}" id="headerAdd">
                                                    <img data-src="{{asset('assets/images/addBanner/'.$index_bottom->photo)}}" alt="" class="lazy">
                                                </a>
                                            </div>
                                        @else 
                                            {!! $header_ad->banner_code !!}
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endif
                    @else 
                        @if ($home_page_post->posts()->where('schedule_post','=',0)->where('status','=',true)->where('is_pending','=',0)->count()>0)
                            <div class="main-content">
                                <div class="row">
                                    <div class="col-lg-12 mycol">
                                        <div class="header-area">
                                            <h3 class="title">
                                                {{$home_page_post->title}}
                                            </h3>
                                            <a class="view-all" href="{{ route('frontend.category',$home_page_post->slug)}}">
                                                {{__('View all')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mycol">
                                        @foreach ($home_page_post->posts()->orderBy('id','desc')->where('schedule_post','=',0)->where('status','=',true)->where('is_pending','=',0)->take(1)->get() as $post)
                                                <div class="single-news landScape-normal">
                                                    <a href="{{ route('frontend.details',[$post->id,$post->slug])}}">
                                                        <div class="content-wrapper">
                                                            <div class="img">
                                                                @if ($post->image_big || $post->rss_image)
                                                                    <div class="tag" style="background:{{$home_page_post->color}}">
                                                                        {{$post->category->title}}
                                                                    </div>
                                                                @endif
                                                                @if ($post->image_big || $post->rss_image)
                                                                    @if ($post->image_big)
                                                                        <img data-src="{{asset('assets/images/post/'.$post->image_big)}}" alt="" class="lazy">
                                                                    @endif
    
                                                                    @if ($post->rss_image)
                                                                        <img data-src="{{$post->rss_image}}" alt="" class="lazy">
                                                                    @endif
                                                                    @if ($post->post_type == 'audio')
                                                                        <span  class="vid-aud">
                                                                            <i class="fas fa-volume-up"></i>
                                                                        </span>
                                                                    @endif
                                                                    @if ($post->post_type == 'video')
                                                                        <span  class="vid-aud">
                                                                            <i class="fas fa-video"></i>
                                                                        </span> 
                                                                    @endif
                                                                @else 
                                                                    <img src="{{asset('assets/images/nopic.png')}}" alt="">
                                                                @endif
                                                            </div>
                                                            <div class="inner-content">
                                                                <a href="{{ route('frontend.details',[$post->id,$post->slug])}}">
                                                                    <h4 class="title">
                                                                        {{strlen($post->title)>170 ? mb_substr($post->title,0,170,'utf-8').'...' : $post->title}}
                                                                    </h4>
                                                                    <p class="text">
                                                                        {!! (strlen(convertUtf8(strip_tags($post->description))) > 400) ? convertUtf8(substr(strip_tags($post->description), 0, 400)) . '...' : convertUtf8(strip_tags($post->description)) !!} 
                                                                    </p>
                                                                    <ul class="post-meta">
                                                                        <li>
                                                                            <a href="{{ route('frontend.postByDate').'?date='.$post->created_at->format('Y-m-d') }}">
                                                                                {{$post->createdAt()}}
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <span>|</span>
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{ route('front.authorProfile',$post->admin->name)}}">
                                                                                {{$post->admin->name}}
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                    </div>
                                    <div class="col-md-6 mycol">
                                        @foreach ($home_page_post->posts()->orderBy('id','desc')->where('schedule_post','=',0)->where('status','=',true)->where('is_pending','=',0)->skip(1)->take(5)->get() as $post)
                                        <a href="{{ route('frontend.details',[$post->id,$post->slug])}}">
                                            <div class="single-box landScape-small-with-meta">
                                                <div class="img">
                                                    @if ($post->image_big || $post->rss_image)
                                                        @if ($post->image_big)
                                                            <img data-src="{{asset('assets/images/post/'.$post->image_big)}}" alt="" class="lazy">    
                                                        @endif
    
                                                        @if ($post->rss_image)
                                                            <img data-src="{{$post->rss_image}}" alt="" class="lazy">
                                                        @endif
    
                                                        @if ($post->post_type == 'audio')
                                                            <span  class="vid-aud">
                                                                <i class="fas fa-volume-up"></i>
                                                            </span>
                                                        @endif
                                                        @if ($post->post_type == 'video')
                                                            <span  class="vid-aud">
                                                                <i class="fas fa-video"></i>
                                                            </span> 
                                                        @endif
                                                    @else
                                                        <img src="{{asset('assets/images/nopic.png')}}" alt="">
                                                    @endif
                                                </div>
                                                <div class="content">
                                                    <a href="{{ route('frontend.details',[$post->id,$post->slug])}}">
                                                        <h4 class="title">
                                                            {{strlen($post->title)>130 ? mb_substr($post->title,0,130,'utf-8').'...' : $post->title}}
                                                        </h4>
                                                    </a>
                                                    <ul class="post-meta">
                                                        <li>
                                                            <a href="{{ route('frontend.postByDate').'?date='.$post->created_at->format('Y-m-d') }}">
                                                                {{$post->createdAt()}}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <span>|</span>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('front.authorProfile',$post->admin->name)}}">
                                                                {{$post->admin->name}}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
            <div class="col-lg-4 aside">
                @if ($ws->feature_inhome == 1)  
                    <div class="aside-tab mt-4">
                        <ul class="nav" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-tab1-tab" data-toggle="pill" href="#pills-tab1" role="tab" aria-controls="pills-tab1" aria-selected="true">{{__('FEATURED')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-tab2-tab" data-toggle="pill" href="#pills-tab2" role="tab" aria-controls="pills-tab2" aria-selected="false">{{__('RECENT')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-tab3-tab" data-toggle="pill" href="#pills-tab3" role="tab" aria-controls="pills-tab3" aria-selected="false">{{__('TOP VIEWS')}}</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-tab1" role="tabpanel" aria-labelledby="pills-tab1-tab">
                                <div class="row">
                                    @foreach ($is_features as $feature)
                                    <div class="col-lg-12">
                                        <a href="{{route('frontend.details',[$feature->id,$feature->slug])}}">
                                            <div class="single-box landScape-small-with-meta">
                                                <div class="img">
                                                    @if ($feature->image_big || $feature->rss_image)
                                                        @if ($feature->image_big)
                                                            <img data-src="{{asset('assets/images/post/'.$feature->image_big)}}" alt="" class="lazy">
                                                        @endif
    
                                                        @if ($feature->rss_image)
                                                            <img data-src="{{$feature->rss_image}}" alt="" class="lazy">
                                                        @endif
    
                                                        @if ($feature->post_type == 'audio')
                                                                <span  class="vid-aud">
                                                                    <i class="fas fa-volume-up"></i>
                                                                </span>
                                                            @endif
                                                            @if ($feature->post_type == 'video')
                                                                <span  class="vid-aud">
                                                                    <i class="fas fa-video"></i>
                                                                </span> 
                                                        @endif
                                                        
                                                    @else
                                                        <img src="{{asset('assets/images/nopic.png')}}" alt="">
                                                    @endif
                                                </div>
                                                <div class="content">
                                                    <a href="{{route('frontend.details',[$feature->id,$feature->slug])}}">
                                                        <h4 class="title">
                                                        {{strlen($feature->title)>40 ? mb_substr($feature->title,0,40,"utf-8") : $feature->title}}
                                                        </h4>
                                                    </a>
                                                    <ul class="post-meta">
                                                        <li>
                                                            <a href="{{ route('frontend.postByDate').'?date='.$feature->created_at->format('Y-m-d') }}">
                                                                {{$feature->createdAt()}}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <span>|</span>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <a href="{{ route('front.authorProfile',$feature->admin->name)}}">
                                                                    {{$feature->admin->name}}
                                                                </a>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-tab2" role="tabpanel" aria-labelledby="pills-tab2-tab">
                                <div class="row">
                                    @foreach ($is_recents as $is_recent)
                                    <div class="col-lg-12">
                                        <a href="{{route('frontend.details',[$is_recent->id,$is_recent->slug])}}">
                                            <div class="single-box landScape-small-with-meta">
                                                <div class="img">
                                                    @if ($is_recent->image_big || $is_recent->rss_image)
                                                        @if ($is_recent->image_big)
                                                            <img data-src="{{asset('assets/images/post/'.$is_recent->image_big)}}" alt="" class="lazy">
                                                        @endif 
    
                                                        @if ($is_recent->rss_image)
                                                            <img data-src="{{ $is_recent->rss_image}}" alt="" class="lazy">
                                                        @endif 
    
                                                        @if ($is_recent->post_type == 'audio')
                                                            <span  class="vid-aud">
                                                                <i class="fas fa-volume-up"></i>
                                                            </span>
                                                        @endif
                                                        @if ($is_recent->post_type == 'video')
                                                            <span  class="vid-aud">
                                                                <i class="fas fa-video"></i>
                                                            </span> 
                                                        @endif
    
                                                    @else 
                                                        <img src="{{asset('assets/images/nopic.png')}}" alt="">
                                                    @endif
                                                </div>
                                                <div class="content">
                                                    <a href="{{route('frontend.details',[$is_recent->id,$is_recent->slug])}}">
                                                        <h4 class="title">
                                                            {{strlen($is_recent->title)>40 ? mb_substr($is_recent->title,0,40,"utf-8") : $is_recent->title}}
                                                        </h4>
                                                    </a>
                                                    <ul class="post-meta">
                                                        <li>
                                                            <a href="{{ route('frontend.postByDate').'?date='.$is_recent->created_at->format('Y-m-d') }}">
                                                                {{$is_recent->createdAt()}}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <span>|</span>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('front.authorProfile',$is_recent->admin->name)}}">
                                                                {{$is_recent->admin->name}}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-tab3" role="tabpanel" aria-labelledby="pills-tab3-tab">
                                <div class="row">
                                    @foreach ($top_views as $top_view)
                                    @php
                                        $post = \App\Models\Post::where('id',$top_view->post_id)->where('language_id',$default_language->id)->first();
                                    @endphp
                                        @if ($post)
                                            <div class="col-lg-12">
                                                <a href="{{route('frontend.details',[$post->id,$post->slug])}}">
                                                    <div class="single-box landScape-small-with-meta">
                                                        @if ($post->image_big || $post->rss_image)
                                                            <div class="img">
                                                                @if ($post->image_big)
                                                                    <img data-src="{{asset('assets/images/post/'.$post->image_big)}}" alt="" class="lazy">
                                                                @endif
                                                                @if ($post->rss_image)
                                                                    <img data-src="{{$post->rss_image}}" alt="" class="lazy">
                                                                @endif
                                                                @if ($post->post_type == 'audio')
                                                                    <span  class="vid-aud">
                                                                        <i class="fas fa-volume-up"></i>
                                                                    </span>
                                                                @endif
                                                                @if ($post->post_type == 'video')
                                                                    <span  class="vid-aud">
                                                                        <i class="fas fa-video"></i>
                                                                    </span> 
                                                                @endif
                                                            </div>
                                                        @else 
                                                            <div class="img">
                                                                <img src="{{asset('assets/images/nopic.png')}}" alt="">
                                                            </div>
                                                        @endif
                                                        <div class="content">
                                                            <a href="{{route('frontend.details',[$post->id,$post->slug])}}">
                                                                <h4 class="title">
                                                                {{ $post->title }}
                                                                </h4>
                                                            </a>
                                                            <ul class="post-meta">
                                                                <li>
                                                                    <a href="{{ route('frontend.postByDate').'?date='.$post->created_at->format('Y-m-d') }}">
                                                                        {{$post->createdAt()}}
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <span>|</span>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('front.authorProfile',$post->admin->name)}}">
                                                                        {{$post->admin->name}}
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($ws->category_inhome == 1)
                    <div class="categori-widget-area mt-4">
                        <div class="header-area">
                            <h4 class="title">
                                {{__('CATEGORIES')}}
                            </h4>
                        </div>
                        <ul class="categori-list">
                            @foreach ($home_page_posts as $category)
                            <li>
                                <a href="{{ route('frontend.category',$category->slug)}}">
                                    <span>
                                        {{$category->title}}
                                    </span>
                                    <span>
                                        ({{$category->posts()->where('schedule_post','=',0)->where('status','=',true)->count()}})
                                    </span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($ws->follow_inhome == 1)
                    <div class="social-follow-area">
                        <div class="header-area">
                            <h4 class="title">
                               {{__('Follow Us')}}
                            </h4>
                        </div>
                        <ul class="social-links">
                            @foreach ($social_links as $social_link)   
                            <li>
                                <a href="{{ $social_link->link}}" class="{{$social_link->name}}">
                                    <i class="{{$social_link->icon}}"></i>{{$social_link->name}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($ws->tag_inhome == 1)
                    <div class="tags-widget">
                        <div class="header-area">
                            <h3 class="title">
                                {{__('TAGS')}}
                            </h3>
                        </div>  
                        <ul class="tag-list">
                            @foreach ($tags as $tag)
                                <li>
                                    <a href="{{ route('tag.search',$tag)}}">{{$tag}}</a>
                                </li>
                            @endforeach
                             
                        </ul>
                    </div>
                @endif
                <div class="add mt-4">
                    @php
                    $sidebar_banner = sidebar_banner(); //method from helper.php class
                    @endphp
                    @if ($sidebar_banner)
                        @if ($sidebar_banner->banner_type == 'image')
                            <a href="{{$sidebar_banner->link}}">
                                <img data-src="{{asset('assets/images/addBanner/'.$sidebar_banner->photo)}}" alt="" class="lazy">
                            </a>
                        @else 
                            {!! $sidebar_banner->banner_code !!}
                        @endif
                    @endif
                </div>
                @if ($ws->poll_inhome == 1)
                    <div class="poll-area mt-4">
                        <div class="header-area">
                            <h4 class="title">
                               {{__('Poll')}}
                            </h4>
                            <h5 class="title"><a href="{{ route('front.allPoll') }}" style="color: :#ff0000;">{{__('Previous Result')}}</a></h5>
                        </div> 

                        @foreach ($polls as $poll)
                        <div class="poll-box">
                            <h4 class="title">
                                <i class="far fa-question-circle"></i> {{$poll->question}}
                            </h4>
                            <form id="voteform{{$poll->id}}" action="{{ route('front.poll.vote')}}" method="POST" class="voteform">
                                @csrf
                                <input type="hidden" name="poll_question_id" value="{{ $poll->id }}" id="poll_question_id">
                                <input type="hidden" name="ip_address">
                                @foreach ($poll->child as $answer)
                                <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="customControlValidation{{$answer->id}}" name="poll_answer_id" value="{{$answer->id}}">
                                    <label class="custom-control-label" for="customControlValidation{{$answer->id}}">{{$answer->poll_option}}</label>
                                </div>
                                @endforeach
                                @php
                                    $ip = request()->ip();
                                    $isVote = App\Models\PollResult::where('poll_question_id',$poll->id)->where('ip_address',$ip)->first();
                                @endphp
                                @if (!$isVote)
                                    <button data-id="{{$poll->id}}" type="submit" class="mybtn1 vote" id="vote_success-{{$poll->id}}">{{__('Vote')}}</button>
                                @else
                                    <button data-id="{{$poll->id}}" type="submit" class="mybtn1 result view_result" id="vote_view-{{$poll->id}}">{{__('View Result')}}</button>
                                @endif
                                <div class="viewVoteResult"></div>
                                <p id="errMsg"></p>
                                <div class="voteresult"></div>
                            </form>
                        </div>
                        @endforeach
                    </div>
                @endif
                @if ($ws->calendar_inhome == 1)
                    <div class="celander-widget-area mt-4">
                        <div id="datecalender"></div>
                    </div>
                @endif
                @if ($ws->newsletter_inhome == 1)
                    <div class="aside-newsletter-widget mt-4 subarea">
                        <div class="header-area">
                            <h4 class="title">
                            {{__('Newsletter')}}
                            </h4>
                        </div>
                        <p class="text">{{__('Subscribe to our newsletter to stay.')}}</p>
                        <form action="{{ route('front.subscribers.store') }}" class="subscribe-form" method="POST" id="subForm">
                            @csrf
                            <input type="text" placeholder="{{__('Enter Your Email Address')}}" name="email" class="subEmail">
                            <button type="submit" class="submit subBtn">{{__('Subscribe')}}</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="video-gallery-box">
                    <div class="one-item-slider">
                        <video width="100%" height="435" controls>
                            @if (!empty($video_large))  
                                <source src="{{asset('assets/videos/'.$video_large->video)}}" type="video/mp4">
                            @endif
                        </video>
                    </div>
                        <ul class="all-item-slider">
                            @foreach ($video_smalls as $video_small)
                                <li>
                                    <a href="{{asset('assets/videos/'.$video_small->video)}}" class="active">
                                        <div class="left">
                                            <img src="{{asset('assets/images/post/'.$video_small->image_big)}}" alt="">
                                        </div>
                                        <div class="right">
                                            <h4 class="title">
                                                {{strlen($video_small->title)>40 ? mb_substr($video_small->title,0,40,"utf-8").'...' : $video_small->title}}
                                            </h4>
                                            <p class="date">
                                                {{$video_small->createdAt()}}
                                            </p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                @if ($is_features->count()>0)
                <!-- Featured News Area Start -->
                <div class="featured-news">
                    <div class="row">
                        <div class="col-lg-12 mycol">
                            <div class="header-area">
                                <h3 class="title">
                                    {{__('TODAYS FEATURED NEWS')}}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mycol">
                            <div class="feature-news-slider">
                                @foreach ($is_features as $post)
                                <div class="item">
                                    <div class="single-news animation">
                                        <a href="{{ route('frontend.details',[$post->id,$post->slug])}}">
                                            <div class="content-wrapper">
                                                @if ($post->image_big || $post->rss_image)
                                                    <div class="tag" style="background:{{$post->category->color}}">
                                                        {{$post->category->title}}
                                                    </div>
                                                @endif
    
                                                @if ($post->image_big || $post->rss_image)
                                                    @if ($post->image_big)
                                                        <img data-src="{{asset('assets/images/post/'.$post->image_big)}}" alt="" class="lazy">
                                                    @endif
    
                                                    @if ($post->rss_image)
                                                        <img data-src="{{$post->rss_image}}" alt="" class="lazy">
                                                    @endif
                                                @else 
                                                    <img src="{{asset('assets/images/nopic.png')}}" alt="">
                                                @endif
                                                <div class="inner-content">
                                                    <a href="{{ route('frontend.details',[$post->id,$post->slug])}}">
                                                        <h4 class="title">
                                                            {{ strlen($post->title)>30 ? mb_substr($post->title,0,30,'utf-8').'...' : $post->title}}
                                                        </h4>
                                                        <ul class="post-meta">
                                                            <li>
                                                                <a href="{{ route('frontend.postByDate').'?date='.$post->created_at->format('Y-m-d') }}">
                                                                    {{$post->createdAt()}}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <span>|</span>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('front.authorProfile',$post->admin->name)}}">
                                                                    {{$post->admin->name}}
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </a>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Featured News Area End -->
                @endif

                @if ($image_albums->count()>0)
                <!-- Photo Gallery Area Start -->
                <div class="featured-news photos">
                        <div class="row">
                            <div class="col-lg-12 mycol">
                                <div class="header-area">
                                    <h3 class="title">
                                        {{__('Image Gallery')}}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="gallery-images">
                                    <div class="row">
                                        @foreach ($image_albums as $image_album)
                                            @if (count($image_album->categories)>0)
                                                <div class="col-md-6 mycol">
                                                    <a href="{{ route('gallery.view',$image_album->id)}}" class="item">
                                                        <div class="single-news animation">
                                                            <div class="content-wrapper">
                                                                <img data-src="{{asset('assets/images/image-album/'.$image_album->photo)}}" alt="" class="lazy">
                                                                <div class="inner-content">
                                                                    <h4 class="title">
                                                                        {{$image_album->album_name}}
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- Photo Gallery Area End -->
                @endif

                <!-- More News Area Start -->
                @if ($more_news->count()>0)   
                    <div class="more-news">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="more-area">
                                    <div class="header-area">
                                        <h4 class="title">
                                            {{__('More news')}}
                                        </h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 more">
                                        @foreach ($more_news as $more_new)
                                        <a href="{{ route('frontend.details',[$more_new->id,$more_new->slug])}}">
                                            <div class="single-news land-scap-medium">
                                                <div class="img">
                                                    @if ($more_new->image_big || $more_new->rss_image)
                                                        <div class="tag" style="background:{{$more_new->category->color}}">
                                                            {{ $more_new->category->title }}
                                                        </div>
                                                    @endif
                                                    @if ($more_new->image_big || $more_new->rss_image)
                                                        @if ($more_new->image_big)
                                                            <img data-src="{{asset('assets/images/post/'.$more_new->image_big)}}" alt="" class="lazy">
                                                        @endif
                                                        @if ($more_new->rss_image)
                                                            <img data-src="{{$more_new->rss_image}}" alt="" class="lazy"> 
                                                        @endif
                                                        @if ($more_new->post_type == 'audio')
                                                            <span  class="vid-aud">
                                                                <i class="fas fa-volume-up"></i>
                                                            </span>
                                                        @endif
                                                        @if ($more_new->post_type == 'video')
                                                            <span  class="vid-aud">
                                                                <i class="fas fa-video"></i>
                                                            </span> 
                                                        @endif
                                                    @else  
                                                        <img src="{{asset('assets/images/nopic.png')}}" alt="">
                                                    @endif
                                                </div>
                                                <div class="content">
                                                    <a href="{{ route('frontend.details',[$more_new->id,$more_new->slug])}}">
                                                        <h4 class="title">
                                                            {{ strlen($more_new->title)>30 ? mb_substr($more_new->title,0,30,'utf-8').'...' : $more_new->title}}
                                                        </h4>
                                                        <p class="text">
                                                        {!! (strlen(convertUtf8(strip_tags($more_new->description))) > 200) ? convertUtf8(substr(strip_tags($more_new->description), 0, 200)) . '...' : convertUtf8(strip_tags($more_new->description)) !!}
                                                        </p>
                                                    </a>
                                                    <ul class="post-meta">
                                                        <li>
                                                            <a href="{{ route('frontend.postByDate').'?date='.$more_new->created_at->format('Y-m-d') }}">
                                                                {{$more_new->createdAt()}}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <span>|</span>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('front.authorProfile',$more_new->admin->name)}}">
                                                                {{$more_new->admin->name}}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </a>
                                        @php
                                            $last_id = $more_new->id;
                                        @endphp
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text-center mt-4">
                                    <button type="#" class="mybtn1" id="loadMore" data-id="{{ $last_id}}">{{__('Load More')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- More News Area End -->
            </div>
            <div class="col-lg-4 aside">
                <div class="add">
                    <div class="header-area">
                        <h4 class="title">
                        {{__('Sponsor Ad')}}
                        </h4>
                    </div>
                    @foreach ($sponsor_banners as $sponsor_banner)
                        @if ($sponsor_banner)
                            @if ($sponsor_banner->banner_type == 'image')
                                <div class="add-banner mt-2">
                                    <a href="{{$sponsor_banner->link}}">
                                        <img data-src="{{asset('assets/images/addBanner/1578288672add.jpg')}}" alt="" class="lazy">
                                    </a>
                                </div>
                            @else 
                                {!! $sponsor_banner->banner_code !!}
                            @endif
                        @endif
                    @endforeach
                </div>

                <div class="widget-slider">
                    @foreach ($widgets as $widget)
                    <div class="aside-newsletter-widget mt-4">
                        <div class="header-area">
                            <h4 class="title">
                            {{ $widget->title }}
                            </h4>
                        </div>
                        <p class="text"> {!! (strlen(convertUtf8(strip_tags($widget->description))) > 350) ? convertUtf8(substr(strip_tags($widget->description), 0, 350)) . '...' : convertUtf8(strip_tags($widget->description)) !!}</p>
                    </div>
                @endforeach
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- Home Front Area End -->

{{-- @include('cookieConsent::index') --}}

@endsection

@push('js')
    <script>
        "use strict";

        var lang = {
            'load_more': '{{__('Load More')}}',
            'hide_resultt': '{{__('Hide Result')}}',
            'view_resultt': '{{__('View Result')}}',
            'loading': '{{__('Loading......')}}',
        }
    </script>
    <script src="{{asset('assets/front/js/notify.min.js')}}"></script>
    <script id="dsq-count-scr" src="//{{ $gs->disqus}}.disqus.com/count.js" async></script>
    <script src="{{asset('assets/front/js/front.js')}}"></script>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script> 
    <script>
        "use strict";	
        $(function() {
            $('.lazy').Lazy();
        });
    </script>
    
@endpush

