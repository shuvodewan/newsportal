@extends('layouts.front')

@push('css')

@endpush

@section('contents')
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bc-bg-img">
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
                        <a href="{{ route('front.authorProfile',$admin->name)}}">
                            {{$admin->name}}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Breadcrumb Area Start -->
<div class="vendor-profile-top">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="organize-by">
                    <div class="organizer-profile">
                        <div class="left">
                            @if ($admin->photo)
                            <img src="{{asset('assets/images/admin/'.$admin->photo)}}" alt="">
                            @endif
                        </div>
                        <div class="right">
                            <a href="#">
                                <h5 class="title">
                                    {{$admin->name}}
                                </h5>
                            </a>
                            <p class="date">
                                Member Since {{$admin->created_at->format('Y')}}
                            </p>
                            <a href="#" class="btn btn-outline-primary btn-sm mr-1"><i class="fas fa-tachometer-alt"></i>{{__('Writer Dashboard')}}</a>
                            <a href="{{ route('front.followerCreate',$admin->id) }}" class="btn btn-outline-success btn-sm mr-1">{{__('Follow')}}</a>
                            <a href="{{ route('front.following',$admin->name)}}" class="btn btn-outline-info btn-sm">{{__('Followers')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <div class="t-info-list">
                    <div class="pack-count">
                        {{ count($all_posts)}}
                        <small>{{__('Post')}}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="categori-page-news">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="categoti-content-area">
                    <div class="row">
                        @if (count($posts)>0)
                            @foreach ($posts as $post)
                                <div class="col-md-6 mycol">
                                    <div class="single-news animation">
                                        <div class="content-wrapper">
                                            <div class="tag" style="background:{{$post->category->color}}">
                                                {{$post->category->title}}
                                            </div>
                                            @if ($post->image_big)
                                                <img data-src="{{asset('assets/images/post/'.$post->image_big)}}" alt="" class="lazy">
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
                                            <img src="{{$post->rss_image}}" alt="" >
                                            @endif
                                            <img src="{{asset('assets/images/post/'.$post->image_big)}}" alt="">
                                            <div class="inner-content">
                                                <a href="{{ route('frontend.details',[$post->id,$post->slug])}}">
                                                    <h4 class="title">
                                                        {{strlen($post->title)>170 ? mb_substr($post->title,0,170,'utf-8').'...' : $post->title}}
                                                    </h4>
                                                    </a><ul class="post-meta"><a href="#">
                                                        </a><li><a href="#">
                                                            </a><a href="{{ route('frontend.postByDate').'?date='.$post->created_at->format('Y-m-d') }}">
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
                                    </div>
                                </div>
                            @endforeach
                        @else 
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <p class="text-danger text-danger text-center">{{__('This Author has no News.')}}</p>
                                </div>
                            </div>
                        </div>  
                        @endif
                        
                    </div>
                </div>
                <div class="mt-4">
                    {{ $posts->links() }}
                </div>
            </div>
            <div class="col-lg-4 aside">
                <div class="categori-widget-area">
                    <div class="header-area">
                        <h4 class="title">
                               {{__(' CATEGORIES')}}
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
                <div class="aside-newsletter-widget mt-3 subarea">
                    <h4 class="title">{{__('Newsletter')}}</h4>
                    <p class="text">{{__('Subscribe to our newsletter to stay.')}}</p>
                    <form action="{{ route('front.subscribers.store') }}" class="subscribe-form" method="POST" id="subForm">
                        @csrf
                        <input type="text" placeholder="Enter Your Email Address" name="email" class="subEmail">
                        <button type="submit" class="submit subBtn">{{__('Subscribe')}}</button>
                    </form>
                </div>
                <div class="celander-widget-area mt-4">
                        <div id="datecalender">
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('js')
<script src="{{asset('assets/front/js/rfront.js')}}"></script>
@endpush
