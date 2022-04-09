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
                                    @php
                                        $totalquiz = count($data->pquizs);
                                    @endphp
                                    <input type="hidden" id="totalQuiz" value="{{$totalquiz}}">
                                    @foreach ($data->pquizs as $quiz)
                                        <div class="quiz-question">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h3 class="title">
                                                        {{$loop->iteration}}. {{$quiz->question_title}}
                                                    </h3>
                                                    <div class="description font-text"></div>
                                                    <div class="image">
                                                    <img src="{{asset('assets/images/pquiz/'.$quiz->question_photo)}}" alt="" >
                                                    </div>
                                                    <div class="question-answers">
                                                        @foreach ($quiz->answers as $answer)
                                                        @if ($answer->answer_photo)
                                                                <label class="m-2">
                                                                    <img src="{{asset('assets/images/panswer/'.$answer->answer_photo)}}" alt="I'm sad" height="150" width="150"/>
                                                                  </label>
                                                                @endif
                                                            <div class="single-answer question-{{$quiz->id}}" id="question-{{$quiz->id}}" data-question_id="{{$quiz->id}}" data-answer_id="{{$answer->id}}" data-assign-value="{{$answer->answer_option}}">
                                                                <div class="radio">
                                                                    <i class="far fa-circle" id="correctCircle"></i>
                                                                </div>
                                                                <div class="text">
                                                                    <span>{{$answer->answer_title}}</span>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="col-12">
                                                        <h6 class="alert alert-success correct-result" role="alert" style="display:none">
                                                            <i class="fas fa-check mr-2"></i>{{__('Correct Answer')}}
                                                        </h6>
                                                        <h6 class="alert alert-danger wrong-result" role="alert" style="display:none">
                                                            <i class="fas fa-times mr-2"></i>{{__('Wrong Answer')}}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="quiz-score" style="display:none;">
                                    <div class="mycol">
                                        <h5 class="correct alert alert-success correct-value"  role="alert">{{__('Correct Answer')}}: <b>1</b></h5>
                                    </div>
                                    <div class="mycol">
                                        <h5 class="wrong alert alert-danger wrong-value" role="alert">{{__('Wrong Answer')}}: <b>6</b></h5>
                                    </div>
                                </div>
                                <div class="quiz-result">
                                    <div class="row">
                                        @foreach ($data->presults as $result)
                                            <div class="col-sm-12 tresult result-{{$result->id}}" data-result="{{$result->id}}" style="display: none;">
                                                <h4 class="title m-2">
                                                    {{$result->result_title}}
                                                </h4>
                                                <div class="description font-text"></div>
                                                <div class="image">
                                                    <img src="{{asset('assets/images/presult/'.$result->result_photo)}}" alt="" >
                                                </div>
                                                <p class="m-2">{!! $result->result_description !!}</p>
                                            </div>
                                        @endforeach
                                    </div>
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
<script src="{{asset('assets/front/js/personality.js')}}"></script>
@endpush
