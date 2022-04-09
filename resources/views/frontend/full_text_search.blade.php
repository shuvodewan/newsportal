@extends('layouts.front')

@push('css')

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
                            <a href="#">
                                {{$searchKey}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
</div>
<!-- Breadcrumb Area Start -->

<!-- Categori Page Start -->
<section class="categori-page-news">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="categoti-content-area">
                    <div class="row">
                        @if ($results->count()>0)
                            @foreach ($results as $post)
                                <div class="col-md-6 mycol">
                                    <div class="single-news animation">
                                        <div class="content-wrapper">
                                            <div class="tag">
                                            </div>
                                            @if ($post->image_big || $post->rss_image)
                                                @if ($post->image_big)
                                                    <img src="{{asset('assets/images/post/'.$post->image_big)}}" alt="">
                                                @endif
                                                @if ($post->rss_image)
                                                    <img src="{{$post->rss_image}}" alt="">
                                                @endif
                                            @else
                                                <img src="{{asset('assets/images/nopic.png')}}" alt="">
                                            @endif
                                            <div class="inner-content">
                                                <a href="{{ route('frontend.details',[$post->id,$post->slug])}}">
                                                    <h4 class="title">
                                                        {{ strlen($post->title)>50 ? mb_substr($post->title,0,50,'utf-8').'...' : $post->title}}
                                                    </h4>
                                                    <ul class="post-meta">
                                                        <li>
                                                            <a href="#">
                                                                {{$post->createdAt()}}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <span>|</span>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                {{$post->admin->name}}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else 
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-danger text-danger text-center">{{__('This Search Key has no News.')}}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
               <div class="mt-4"> {{ $results->links() }}</div>
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
                        <input type="text" placeholder="{{__('Enter Your Email Address')}}" name="email" class="subEmail">
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
<!-- More News Area End -->
@endsection

@push('js')
    <script src="{{asset('assets/front/js/notify.min.js')}}"></script>
    <script src="{{asset('assets/front/js/rfront.js')}}"></script>
@endpush