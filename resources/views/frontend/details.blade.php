@extends('layouts.front')

@push('css')
<style>
    video {
        width: 100%;
        height: auto;
    }

</style>
@endpush

@section('contents')
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="pages">
                    <li>
                        <a href="#">
                            {{__('Home')}}
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            {{__('News')}}
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" style="color:{{$data->category->color}}">
                            {{$data->category->title}}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area Start -->

<!-- News Details Page Start -->
<section class="news-details-page">
	<input type="hidden" value="{{$data->id}}" id="post">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @if ($data->post_type == 'article')
                <div class="details-content-area">
                    <div class="row">
                        <div class="col-lg-12 details-post">
                            <div class="single-news">
                                @if ($data->galleries->count()>0)
                                    <div class="model-gallery-image">
                                        <div class="one-item-slider">
                                            @foreach ($data->galleries as $gallery)
                                                <div class="item"><img src="{{asset('assets/images/galleries/'.$gallery->photo)}}" alt="">
                                                </div>
                                            @endforeach
                                        </div>
                                        <ul class="all-item-slider">
                                            @foreach ($data->galleries as $gallery)
                                                <li>
                                                    <img src="{{asset('assets/images/galleries/'.$gallery->photo)}}" alt="">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                <div class="img">
                                    @if ($data->image_big || $data->rss_image)
                                        <div class="tag" style="background:{{$data->category->color}}">
                                            {{$data->category->title}}
                                        </div>
                                    @endif
                                    @if ($data->image_big)
                                    <img src="{{asset('assets/images/post/'.$data->image_big)}}" alt="">
                                    @else 
                                        <img src="{{$data->rss_image}}" alt="">
                                    @endif
                                </div>
                                @endif

                                <div class="content">
                                    <h4 class="title">
                                        {{$data->title}}
                                    </h4>
                                    <ul class="post-meta">
                                        <li>
                                            <a href="#">
                                                <i class="far fa-calendar-alt"></i> {{$data->createdAt()}}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#disqus_thread">
                                            </a>
                                        </li>
                                    </ul>
                                    {{-- {!! clean( $data->description) !!}  --}}
                                    {!! $data->description !!}
                                </div>
                                <div class="post-footer">
                                    <div class="header-area">
                                        <p class="title">
                                            {{__('Share')}} :
                                        </p>
                                    </div>
                                    <!-- AddToAny BEGIN -->
                                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                        <ul class="social-share">
                                            <li>
                                                <a class="a2a_button_facebook">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="a2a_button_twitter">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="a2a_button_linkedin">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="a2a_button_pinterest">
                                                    <i class="fab fa-pinterest-p"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <script async src="https://static.addtoany.com/menu/page.js"></script>
                                </div>
                            </div>
                            <div class="comment-area">
                                <div class="header-area">
                                    <h4 class="title">
                                        {{__('Leave A Comment')}}
                                    </h4>
                                </div>
                                <div id="disqus_thread"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if ($data->post_type == 'rss')
                <div class="details-content-area">
                    <div class="row">
                        <div class="col-lg-12 details-post">
                            <div class="single-news">
                                <div class="img">
                                    <div class="tag" style="background:{{$data->category->color}}">
                                        {{$data->category->title}}
                                    </div>
                                    <img src="{{$data->rss_image}}" alt="">
                                </div>
                                <div class="content">
                                    <h4 class="title">
                                        {{$data->title}}
                                    </h4>
                                    <ul class="post-meta">
                                        <li>
                                            <a href="#">
                                                <i class="far fa-calendar-alt"></i> {{$data->createdAt()}}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#disqus_thread">
                                                <i class="fas fa-user"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    {!! $data->description !!}
                                </div>
                                @if ($data->rss_link)
                                <a href="{{ $data->rss_link }}" class="btn btn-sm btn-info float-right mt-2">{{__('Read
                                    More')}}...</a>
                                @endif
                                <div class="post-footer">
                                    <div class="header-area">
                                        <p class="title">
                                            {{__('Share')}} :
                                        </p>
                                    </div>
                                    <!-- AddToAny BEGIN -->
                                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                        <ul class="social-share">
                                            <li>
                                                <a class="a2a_button_facebook">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="a2a_button_twitter">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="a2a_button_linkedin">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="a2a_button_pinterest">
                                                    <i class="fab fa-pinterest-p"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <script async src="https://static.addtoany.com/menu/page.js"></script>
                                </div>
                            </div>
                            <div class="comment-area">

                                <div class="header-area">
                                    <h4 class="title">
                                        {{__('Leave A Comment')}}
                                    </h4>
                                </div>
                                <div id="disqus_thread"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if ($data->post_type == 'video')
                <div class="details-content-area">
                    <div class="row">
                        <div class="col-lg-12 details-post">
                            <div class="single-news">
                                <div class="img">
                                    <div class="tag" style="background:{{$data->category->color}}">
                                        {{$data->category->title}}
                                    </div>

                                    @if ($data->embed_video)
                                        {!!$data->embed_video!!}
                                    @else 
                                        <video controls >
                                            <source src="{{asset('assets/videos/'.$data->video)}}" type="video/mp4">
                                        </video>

                                    @endif
                                </div>
                                <div class="content">
                                    <h4 class="title">
                                        {{$data->title}}
                                    </h4>
                                    <ul class="post-meta">
                                        <li>
                                            <a href="#">
                                                <i class="far fa-calendar-alt"></i> {{$data->createdAt()}}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#disqus_thread">
                                                <i class="fas fa-user"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    {!! $data->description !!}
                                </div>
                                <div class="post-footer">
                                    <div class="header-area">
                                        <p class="title">
                                            {{__('Share')}} :
                                        </p>
                                    </div>
                                    <!-- AddToAny BEGIN -->
                                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                        <ul class="social-share">
                                            <li>
                                                <a class="a2a_button_facebook">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="a2a_button_twitter">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="a2a_button_linkedin">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="a2a_button_pinterest">
                                                    <i class="fab fa-pinterest-p"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <script async src="https://static.addtoany.com/menu/page.js"></script>
                                </div>
                            </div>
                            <div class="comment-area">
                                <div class="header-area">
                                    <h4 class="title">
                                        {{__('Leave A Comment')}}
                                    </h4>
                                </div>
                                <div id="disqus_thread"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if ($data->post_type == 'audio')
                <div class="details-content-area">
                    <div class="row">
                        <div class="col-lg-12 details-post">
                            <div class="single-news">
                                <div id="blue-playlist-container">
                                    <!-- Amplitude Player -->
                                    <div id="amplitude-player">
                                        <!-- Left Side Player -->
                                        <div id="amplitude-left">
                                            <img data-amplitude-song-info="cover_art_url" class="album-art" />
                                            <div class="amplitude-visualization" id="large-visualization">
                
                                            </div>
                                            <div id="player-left-bottom">
                                                <div id="time-container">
                                                    <span class="current-time">
                                                        <span class="amplitude-current-minutes"></span>:<span
                                                            class="amplitude-current-seconds"></span>
                                                    </span>
                                                    <div id="progress-container">
                                                        <div class="amplitude-wave-form">
                
                                                        </div>
                                                        <input type="range" class="amplitude-song-slider" />
                                                        <progress id="song-played-progress"
                                                            class="amplitude-song-played-progress"></progress>
                                                        <progress id="song-buffered-progress" class="amplitude-buffered-progress"
                                                            value="0"></progress>
                                                    </div>
                                                    <span class="duration">
                                                        <span class="amplitude-duration-minutes"></span>:<span
                                                            class="amplitude-duration-seconds"></span>
                                                    </span>
                                                </div>
                
                                                <div id="control-container">
                                                    <div id="repeat-container">
                                                        <div class="amplitude-repeat" id="repeat"></div>
                                                        <div class="amplitude-shuffle amplitude-shuffle-off" id="shuffle"></div>
                                                    </div>
                
                                                    <div id="central-control-container">
                                                        <div id="central-controls">
                                                            <div class="amplitude-prev" id="previous"></div>
                                                            <div class="amplitude-play-pause" id="play-pause"></div>
                                                            <div class="amplitude-next" id="next"></div>
                                                        </div>
                                                    </div>
                
                                                    <div id="volume-container">
                                                        <div class="volume-controls">
                                                            <div class="amplitude-mute amplitude-not-muted"></div>
                                                            <input type="range" class="amplitude-volume-slider" />
                                                            <div class="ms-range-fix"></div>
                                                        </div>
                                                        <div class="amplitude-shuffle amplitude-shuffle-off" id="shuffle-right"></div>
                                                    </div>
                                                </div>
                
                                                <div id="meta-container">
                                                    <span data-amplitude-song-info="name" class="song-name"></span>
                
                                                    <div class="song-artist-album">
                                                        <span data-amplitude-song-info="artist"></span>
                                                        <span data-amplitude-song-info="album"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Left Side Player -->
                
                                        <!-- Right Side Player -->
                                        <div id="amplitude-right">
                                            <div class="song amplitude-song-container amplitude-play-pause"
                                                data-amplitude-song-index="0">
                                                <div class="song-now-playing-icon-container">
                                                    <div class="play-button-container">
                
                                                    </div>
                                                    <img class="now-playing"
                                                        src="{{asset('assets/images/post/'.$data->image_big)}}" />
                                                </div>
                                                <div class="song-meta-data">
                                                    <span class="song-title">{{ strlen($data->title)>30 ? mb_substr($data->title,0,30,'utf-8').'...' : $data->title}}</span>
                                                    <span class="song-artist">{{$data->admin->name}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Right Side Player -->
                                    </div>
                                    <!-- End Amplitdue Player -->
                
                                </div>
                                <div class="content">
                                    <h4 class="title">
                                        {{$data->title}}
                                    </h4>
                                    <ul class="post-meta">
                                        <li>
                                            <a href="#">
                                                <i class="far fa-calendar-alt"></i> {{$data->createdAt()}}
                                            </a>
                                        </li>
                                        <li>
                                            <li>
                                                <a href="#disqus_thread">
                                            
                                                </a>
                                            </li>
                                        </li>
                                    </ul>
                                    {!! $data->description !!}
                                </div>
                                <div class="post-footer">
                                    <div class="header-area">
                                        <p class="title">
                                            Share :
                                        </p>
                                    </div>
                                    <!-- AddToAny BEGIN -->
                                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                        <ul class="social-share">
                                            <li>
                                                <a class="a2a_button_facebook">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="a2a_button_twitter">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="a2a_button_linkedin">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="a2a_button_pinterest">
                                                    <i class="fab fa-pinterest-p"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <script async src="https://static.addtoany.com/menu/page.js"></script>
                                </div>
                            </div>
                            <div class="comment-area">
                                <div class="header-area">
                                    <h4 class="title">
                                        {{__('Leave A Comment')}}
                                    </h4>
                                </div>
                                <div id="disqus_thread"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-4 aside">
                @if ($ws->category_indetails == 1)
                <div class="categori-widget-area">
                    <div class="header-area">
                        <h4 class="title">
                            {{__('CATEGORIES')}}
                        </h4>
                    </div>
                    <ul class="categori-list">
                        @foreach ($categories as $category)
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
                @if ($ws->newsletter_indetails == 1)
                <div class="aside-newsletter-widget subarea">
                    <h4 class="title">{{__('Newsletter')}}</h4>
                    <p class="text">{{__('Subscribe to our newsletter to stay.')}}</p>
                    <form action="{{ route('front.subscribers.store') }}" class="subscribe-form" method="POST" id="subForm">
                        @csrf
                        <input type="text" placeholder="{{__('Enter Your Email Address')}}" name="email" class="subEmail">
                        <button type="submit" class="submit subBtn">{{__('Subscribe')}}</button>
                    </form>
                </div>
                @endif
                @if ($ws->calendar_indetails == 1)
                <div class="celander-widget-area">
                    <div id="datecalender">
                    </div>
                </div>
                @endif
            </div>
        </div>
	</div>
	@php
		$title = strlen($data->title)>50 ? mb_substr($data->title,0,50,'utf-8').'...' : $data->title;
		$image = asset('assets/images/post/'.$data->image_big);
		$audio = asset('assets/audios/'.$data->audio);
	@endphp
</section>
<?php
?>
<!-- News Details Page End -->
@endsection

@push('js')
<script>
    "use strict";
    var title = "<?php echo $title; ?>";
    var image = "<?php echo $image; ?>";
    var audio = "<?php echo $audio; ?>";
</script>
<script src="{{asset('assets/front/js/notify.min.js')}}"></script>

<script id="dsq-count-scr" src="//{{ $gs->disqus}}.disqus.com/count.js" async></script>
@if ($data->post_type == 'audio')    
    <script src="{{asset('assets/front/js/audioActive.js')}}"></script>
@endif

@if ($gs->is_disqus == 1)
    <script>
        (function () { // DON'T EDIT BELOW THIS LINE
            var d = document,
            s = d.createElement('script');
            s.src = 'https://{{ $gs->disqus}}.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
@endif

<script src="{{asset('assets/front/js/rfront.js')}}"></script>
<script src="{{asset('assets/front/js/frontdetails.js')}}"></script>

@endpush
