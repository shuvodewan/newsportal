@extends('layouts.admin')

@section('styles')
<link href="{{asset('assets/admin/css/tabbar.css')}}" rel="stylesheet" />
@endsection

@section('content')

<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Edit Quiz') }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}">{{ __('Quiz') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @include('includes.admin.form-error')
    @include('includes.admin.form-success')
    <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
    <form id="tquizformdata" action="{{ route('tquiz.update',$data->id)}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}

<input type="hidden" name="is_pending">
<input type="hidden" name="post_type">
<input type="hidden" id="article_post_id" value="{{ $data->id}}">

<div class="row">
    <div class="col-lg-8">
        <div class="add-product-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-description">
                        <div class="body-area">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Language') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <select name="language_id" id="article_language_id">
                                        <option value="">Please Select a Language</option>
                                        @foreach ($languages as $language)
                                        <option value="{{$language->id}}" {{ $language->id == $data->language_id ? 'selected' : ''}}>{{$language->language}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Title') }} *</h4>
                                        <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" class="input-field" name="title"
                                placeholder="{{ __('Title') }}" id="title" autocomplete="off" value="{{ $data->title }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Slug') }} *</h4>
                                        <p class="sub-heading">{{ __('In English') }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" class="input-field" id="slug" name="slug"
                                        placeholder="{{ __('Slug') }}" value="{{ $data->slug }}">
                                        <p id="slugCheck"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Keyword meta tag') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <textarea class="form-control textarea" name="meta_tag"
                                        placeholder="{{ __('Keyword meta tag') }}">{{ $data->meta_tag }}</textarea>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Tags') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" placeholder="{{ __('Tags') }}" class="form-control tags" id="tags" name="tags" value="{{$data->tags}}">
                                </div>
                            </div>

                            <div class="row description">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">
                                            {{__('Description')}} *
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <textarea class="nic-edit" name="description" placeholder="{{__('Description')}}" id="description">{{ $data->description}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="add_edit_question">
            @php
                $i=1;
            @endphp
        @foreach ($data->tquizs as $quiz)
            @php
                $j=1;
            @endphp
        <input type="hidden" name="question_id[]" value="{{$quiz->id}}">
        <div class="quiz-question first-question">
            <div class="row mt-5">
                <div class="col-lg-12">
                    <h6 id="remove_ques_id{{$quiz->id}}"> <b>{{__('Question')}}</b></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="add-product-content card mb-4">
                        <div id="heading-0" class="iub">
                            <div class="btn d-flex justify-content-between bg-light">
                                <div class="left">
                                    #{{$loop->iteration}}
                                </div>
                                <div class="right align-self-center">
                                    <button type="button" data-toggle="collapse"
                                    data-target="#collapse{{$loop->iteration}}" aria-expanded="true" aria-controls="collapse{{$loop->iteration}}" class="collapsebutton btn btn-info" data-id="plus"><i class="fas fa-minus"></i></button>
                                    @if (!$loop->first)
                                        <span class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash remove_quiz_question" data-quiz_qid="{{$quiz->id}}"></i>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div id="collapse{{$loop->iteration}}" class="collapse show" aria-labelledby="heading{{$loop->iteration}}">
                            <div class="card-body pt-3">
                                <div class="product-description">
                                    <div class="body-area p-0">

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="left-area">
                                                    <h4 class="heading">{{ __('Question') }} *</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="text" class="input-field" name="question_title[]" value="{{$quiz->question_title}}" placeholder="{{ __('Question') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="left-area">
                                                            <h4 class="heading">{{__('Image')}}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="img-upload custom-image-upload">
                                                            <div id="image-preview" class="img-preview"
                                                                style="background: url({{ $quiz->question_photo ? asset('assets/images/quiz/'.$quiz->question_photo) :asset('assets/admin/images/upload.png') }});">
                                                                <label for="image-upload" class="img-label" id="image-label">
                                                                    <i class="icofont-upload-alt"></i>{{__('Upload')}}</label>
                                                                <input type="file" name="question_photo[]" class="img-upload" id="image-upload">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="row question_description">
                                                    <div class="col-lg-12">
                                                        <div class="left-area">
                                                            <h4 class="heading">
                                                                {{__('Description')}}
                                                            </h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <textarea class="nic-edit" name="question_description" value="{{$quiz->question_description}}" placeholder="{{__('Description')}}"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row quiz-answer-area">
                                            <div class="col-lg-12">
                                                <div class="left-area">
                                                    <h4 class="heading">{{ __('Answer') }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="row" id="quiz-single-answer">
                                                    @foreach ($quiz->answers as $key=>$answer)
                                                    <input type="hidden" name="answer_id[{{$i}}][{{$j}}]" value="{{$answer->id}}">
                                                        <div class="col-xl-4 col-6 quiz-single-div mt-2">
                                                            <div class="card single-answer">
                                                                @if (!($key==0 || $key==1))
                                                                    <div class="close">
                                                                        <i class="fa fa-times remove_button" data-val="{{$answer->id}}"></i>
                                                                    </div>
                                                                @endif
                                                                <div class="card-body py-3 border">
                                                                    <div class="img-upload custom-image-upload">
                                                                        <div id="image-preview" class="img-preview"
                                                                            style="background: url({{ $answer->answer_photo ? asset('assets/images/quizanswer/'.$answer->answer_photo) : asset('assets/admin/images/upload.png') }});">
                                                                            <label for="image-upload" class="img-label"id="image-label">
                                                                                <i class="icofont-upload-alt"></i>{{__('Upload')}}
                                                                            </label>
                                                                            <input type="file" name="answer_photo[{{$i}}][{{$j}}]" class="img-upload" id="image-upload">
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" class="input-field mt-3" name="answer_title[{{$i}}][{{$j}}]" value="{{$answer->answer_title}}" placeholder="{{ __('Answer Text') }}" autocomplete="off">
                                                                    <div class="correct-ans mt-2">
                                                                        <div class="custom-control custom-radio">
                                                                        <input type="radio" id="customRadio[{{$i}}][{{$j}}]" name="correct_answer[{{$i}}]" class="custom-control-input" value="{{$j}}" @if($answer->correct_answer ==1) checked @endif>
                                                                            <label class="custom-control-label" for="customRadio[{{$i}}][{{$j}}]">{{__('Correct')}}</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $j++;
                                                        @endphp
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <a href="javascript:;"  class="btn btn-info quiz-answer" data-question="{{$loop->iteration}}"><i class="fa fa-plus"></i> {{__('Add Answer')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
            $i++;
        @endphp
    @endforeach
</div>

    <div class="row mb-4">
        <div class="col-lg-12 text-center">
            <a href="javascript:;" id="add-quiz-question" class="btn btn-info"> <i class="fa fa-plus"></i>{{__('Add Question')}}</a>
        </div>
    </div>

<div class="quiz-result-area-edit">
    @foreach ($data->tresults as $tresult)
        <input type="hidden" name="tresult_id[]" value="{{$tresult->id}}">
        <div class="quiz-result-area first-quiz-result">
            <div class="row mt-5">
                <div class="col-lg-12">
                    <h6 id="edit_tresult{{$tresult->id}}"> <b>{{__('Result')}}</b></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="add-product-content card mb-4">
                        <div id="heading{{$loop->iteration}}">
                            <div class="btn d-flex justify-content-between bg-light">
                                <div class="left">
                                    #{{$loop->iteration}}
                                </div>
                                <div class="right">
                                    <button type="button" data-toggle="collapse" data-target="#collapse{{$loop->iteration}}result" aria-expanded="true" aria-controls="collapse{{$loop->iteration}}result" class="resultCollapse btn btn-info" data-id="plus"><i class="fas fa-minus"></i></button>
                                    @if (!$loop->first)
                                        <span class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash remove_quiz_result_edit" data-result_edit="{{$tresult->id}}"></i>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div id="collapse{{$loop->iteration}}result" class="collapse show" aria-labelledby="heading{{$loop->iteration}}">
                            <div class="card-body  pt-3">
                                <div class="product-description">
                                    <div class="body-area p-0">
        
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="left-area">
                                                    <h4 class="heading">{{ __('Result') }} *</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="text" name="result_title[]" value="{{$tresult->result_title}}" class="input-field" placeholder="{{ __('Result') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="left-area">
                                                            <h4 class="heading">{{__('Image')}}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="img-upload custom-image-upload">
                                                            <div id="image-preview" class="img-preview"
                                                                style="background: url({{ $tresult->result_photo ? asset('assets/images/quizresult/'.$tresult->result_photo) : asset('assets/admin/images/upload.png') }});">
                                                                <label for="image-upload" class="img-label"id="image-label">
                                                                    <i class="icofont-upload-alt"></i>{{__('Upload')}}
                                                                </label>
                                                                <input type="file" name="result_photo[]" class="img-upload" id="image-upload">
                                                            </div>
                                                        </div>
        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="row result_description">
                                                    <div class="col-lg-12">
                                                        <div class="left-area">
                                                            <h4 class="heading">
                                                                {{__('Description')}}
                                                            </h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <textarea class="nic-edit" name="result_description" placeholder="{{__('Description')}}">{{$tresult->result_description}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="left-area">
                                                    <h4 class="heading">{{__('Number of Correct Answers')}} <small>({{__('The range of correct answers to show this result')}})</small> </h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="number" name="min[]" class="input-field" value="{{$tresult->min}}" placeholder="{{ __('Min') }}" min="0">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="number" name="max[]" class="input-field" value="{{$tresult->max}}" placeholder="{{ __('Max') }}" min="0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
    <div class="row mb-4">
        <div class="col-lg-12 text-center">
            <a href="javascript:;" id="quiz-result" class="btn btn-info"> <i class="fa fa-plus"></i>{{__('Add Result')}}</a>
        </div>
    </div>
</div>


    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="add-product-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-description">
                                <div class="body-area">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="left-area">
                                                <h4 class="heading">{{__('Current Preview Image')}} *</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="img-upload custom-image-upload">
                                                <div id="image-preview" class="img-preview"
                                                    style="background: url({{ $data->image_big ? asset('assets/images/post/'.$data->image_big) : asset('assets/admin/images/upload.png') }});">
                                                    <label for="image-upload" class="img-label"
                                                        id="image-label"><i
                                                            class="icofont-upload-alt"></i>{{__('Upload')}}</label>
                                                    <input type="file" name="image_big" class="img-upload"
                                                        id="image-upload">
                                                </div>
                                                <p class="text">{{__('Prefered Size: (600x600) or Square Sized Image')}}</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 categoryDiv" style="display:none;">
            <div class="col-lg-12">
                <div class="add-product-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-description">
                                <div class="body-area">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="left-area">
                                                <h4 class="heading">{{ __('Category') }} *</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <select name="category_id" id="article_parent_id">
                                    
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="left-area">
                                                <h4 class="heading">{{ __('Sub Category') }} *</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <select name="subcategories_id" id="subcategory_id">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="add-product-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-description">
                                <div class="body-area">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="left-area">
                                                <h4 class="heading">{{ __('Add to Feature') }} *</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-control custom-radio d-inline-block mr-5">
                                                <input type="radio" class="custom-control-input"
                                                    name="is_feature" value="1" id="is_feature1" @if($data->is_feature ==1) checked @endif>
                                                <label class="custom-control-label"
                                                    for="is_feature1">{{__('Yes')}}</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block mr-5">
                                                <input type="radio" class="custom-control-input"
                                                    name="is_feature" value="0" id="is_feature2" @if($data->is_feature ==0) checked @endif>
                                                <label class="custom-control-label" for="is_feature2">{{__('No')}}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="left-area">
                                                <h4 class="heading">{{ __('Add to Slider') }} *</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-control custom-radio d-inline-block mr-5">
                                                <input type="radio" class="custom-control-input"
                                                    name="is_slider" value="1" id="slider1" @if($data->is_slider ==1) checked @endif>
                                                <label class="custom-control-label" for="slider1">{{__('Yes')}}</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block mr-5">
                                                <input type="radio" class="custom-control-input"
                                                    name="is_slider" value="0" id="slider2" @if($data->is_slider ==0) checked @endif>
                                                <label class="custom-control-label" for="slider2">{{__('No')}}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="left-area">
                                                <h4 class="heading">{{ __('Slider Right Post') }} *</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-control custom-radio d-inline-block mr-5">
                                                <input type="radio" class="custom-control-input"
                                                    name="slider_right" value="1" id="slider_right1" @if($data->slider_right ==1) checked @endif>
                                                <label class="custom-control-label"
                                                    for="slider_right1">{{__('Yes')}}</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block mr-5">
                                                <input type="radio" class="custom-control-input"
                                                    name="slider_right" value="0" id="slider_right2" @if($data->slider_right ==0) checked @endif>
                                                <label class="custom-control-label"
                                                    for="slider_right2">{{__('No')}}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="left-area">
                                                <h4 class="heading">{{ __('Add to Trending News') }} *</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-control custom-radio d-inline-block mr-5">
                                                <input type="radio" class="custom-control-input"
                                                    name="is_trending" value="1" id="is_trending1" @if($data->is_trending ==1) checked @endif>
                                                <label class="custom-control-label"
                                                    for="is_trending1">{{__('Yes')}}</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block mr-5">
                                                <input type="radio" class="custom-control-input"
                                                    name="is_trending" value="0" id="is_trending2" @if($data->is_trending ==0) checked @endif>
                                                <label class="custom-control-label"
                                                    for="is_trending2">{{__('No')}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="add-product-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-description">
                                <div class="body-area">
                                    <div class="row" @if($data->schedule_post == 0) ? style="display:none;" : style="display:block;" @endif>
                                        <div class="col-lg-12">
                                            <div class="left-area">
                                                <h4 class="heading">{{ __('Schedule Post') }} *</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                        <input type="checkbox" class="schedule" name="schedule_post" value="{{ $data->schedule_post}}" {{$data->schedule_post ==1 ? 'checked':''}} disabled>
                                        </div>
                                    </div>

                                    <div class="row datepick" style="display:none;">
                                        <div class="col-lg-12">
                                            <div class="left-area">
                                                <h4 class="heading"></h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input id="from" class="input-field" type="text" name="schedule_post_date" autocomplete="off" placeholder="{{__('Start Date')}}" required="" value="{{ $data->schedule_post_date}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">

                                        </div>
                                        <div class="col-lg-12">
                                            <input type="submit" data-draft="0"
                                                class="btn btn-success tquiz-btn1 addPost" value="Update Post">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</form>
</div>

</div>

@endsection


@section('scripts')
<script src="{{asset('assets/admin/js/page.js')}}"></script>
<script src="{{asset('assets/admin/js/articleEdit.js')}}"></script>
<script src="{{asset('assets/admin/js/tagify.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>  
<script>
    $('.tags').tagify();
</script>

<script type="text/javascript">
    "use strict";
    var lang = {
        'question': '{{ __('Question') }}',
        'image': '{{ __('Image') }}',
        'description': '{{ __('Description') }}',
        'upload': '{{ __('Upload') }}',
        'answer': '{{ __('Answer') }}',
        'answer_text': '{{ __('Answer Text') }}',
        'correct': '{{ __('Correct') }}',
        'add_answer': '{{ __('Add Answer') }}',
        'result': '{{ __('Result') }}',
        'min': '{{ __('Min') }}',
        'max': '{{ __('Max') }}',
        'number_of_correct_answer': '{{ __('Number of Correct Answers') }}',
        'range_of_correct': '{{ __('The range of correct answers to show this result') }}',
    }
</script>
<script src="{{asset('assets/admin/js/quiz_edit.js')}}"></script>

@endsection
