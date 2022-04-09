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
                        <li class="active">
                            <a href="#">
                                {{$page->title}}
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
            @if ($page->wbsite_right_column == 0)
                <div class="col-lg-12">
                    <div class="categoti-content-area">
                        <div class="row">
                            <h3 class="mb-4">{{$page->title}}</h3>
                            {!! $page->description!!}
                        </div>
                    </div>
                </div> 
            @else 
                <div class="col-lg-8">
                    <div class="categoti-content-area">
                        <div class="row">
                            <h3 class="mb-4">{{$page->title}}</h3>
                            {!! $page->description!!}
                        </div>
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
                            <input type="text" placeholder="{{__('Enter Your Email Address')}}" name="email" class="subEmail">
                            <button type="submit" class="submit subBtn">{{__('Subscribe')}}</button>
                        </form>
                    </div>
                    <div class="celander-widget-area mt-4">
                            <div id="datecalender">
                            </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
<!-- More News Area End -->
@endsection

@push('js')
<script src="{{asset('assets/front/js/notify.min.js')}}"></script>
<script src="{{asset('assets/front/js/rfront.js')}}"></script>

@endpush