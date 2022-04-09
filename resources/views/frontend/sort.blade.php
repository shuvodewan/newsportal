@extends('layouts.front')

@section('contents')
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
<section class="news-details-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="details-content-area">
                    <div class="row">
                        <div class="col-lg-12 details-post">
                            <div class="single-news">
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
                                            <a href="#disqus_thread"></a>
                                        </li>
                                    </ul>
                                    <p>
                                        {!! $data->description !!}
                                    </p>
                                </div>
                                <div class="quiz-container">
                                    @foreach ($data->sorts as $sort)
                                        <div class="quiz-question">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h3 class="title">
                                                        {{$sort->item_title}}
                                                    </h3>
                                                    <div class="description font-text"></div>
                                                    <div class="image">
                                                    <img src="{{asset('assets/images/sort/'.$sort->item_photo)}}" alt="" >
                                                    </div>
                                                    <p>
                                                        {!! $sort->item_description !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


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
</section>
@endsection

@push('js')

@endpush
