@extends('layouts.admin')

@section('styles')
<link href="{{asset('assets/admin/css/tabbar.css')}}" rel="stylesheet" />
@endsection

@section('content')

<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Add Personality Quiz') }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}">{{ __('Personality Quiz') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @include('includes.admin.form-error')
    @include('includes.admin.form-success')
    <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
    <form id="personalityformdata" action="{{ route('pquiz.store')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}

<input type="hidden" name="is_pending">
<input type="hidden" name="post_type">
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
                                    <select name="language_id" id="video_language_id">
                                        <option value="">{{__('Please Select a Language')}}</option>
                                        @foreach ($languages as $language)
                                            <option value="{{$language->id}}">{{$language->language}}</option>
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
                                        placeholder="{{ __('Title') }}" autocomplete="off" id="title">
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
                                    <input type="text" class="input-field" name="slug"
                                        placeholder="{{ __('Slug') }}" autocomplete="off" id="slug">
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
                                        placeholder="{{ __('Keyword meta tag') }}"></textarea>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Tags') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" placeholder="{{ __('Tags') }}" class="form-control tags" id="tags" name="tags" value="">
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
                                    <textarea class="nic-edit" name="description" placeholder="{{__('Description')}}" id="description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="quiz-result-area first-quiz-result">
            <div class="row mt-5">
                <div class="col-lg-12">
                    <h6> <b>{{__('Results')}}</b></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="add-product-content card mb-4">
                        <div id="headingTwo">
                            <div class="btn d-flex justify-content-between bg-light">
                                <div class="left header-part">
                                    #<span class="result_serial_no">1</span><span class="result_title ml-2"></span>
                                </div>
                                <div class="right">
                                    <button type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" class="resultCollapse btn btn-info" data-id="plus"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo">
                            <div class="card-body  pt-3">
                                <div class="product-description">
                                    <div class="body-area p-0">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="left-area">
                                                    <h4 class="heading">{{ __('Result') }} *</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 input-area">
                                                <input type="text" name="result_title[]" class="input-field" id="get_result_title" placeholder="{{ __('Result') }}">
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
                                                                style="background: url({{ asset('assets/admin/images/upload.png') }});">
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
                                                        <textarea class="nic-edit" name="result_description" placeholder="{{__('Description')}}"></textarea>
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
    
        <div class="row mb-4">
            <div class="col-lg-12 text-center">
                <a href="javascript:;" id="quiz-result" class="btn btn-info"> <i class="fa fa-plus"></i>{{__('Add Result')}}</a>
            </div>
        </div>

    <div class="quiz-question first-question">
        <div class="row mt-5">
            <div class="col-lg-12">
                <h6> <b>{{__('Question')}}</b></h6>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="add-product-content card mb-4">
                    <div id="heading-0" class="iub">
                        <div class="btn d-flex justify-content-between bg-light">
                            <div class="left">
                                #1
                            </div>
                            <div class="right align-self-center">
                                <button type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="collapsebutton btn btn-info" data-id="plus"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
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
                                            <input type="text" class="input-field" name='question_title[]' placeholder="{{ __('Question') }}">
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
                                                            style="background: url({{ asset('assets/admin/images/upload.png') }});">
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
                                                    <textarea class="nic-edit" name="question_description" placeholder="{{__('Description')}}"></textarea>
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
                                                <div class="col-xl-4 col-6 quiz-single-div">
                                                    <div class="card single-answer">
                                                        <div class="card-body py-3 border">
                                                            <div class="img-upload custom-image-upload">
                                                                <div id="image-preview" class="img-preview"
                                                                    style="background: url({{ asset('assets/admin/images/upload.png') }});">
                                                                    <label for="image-upload" class="img-label"id="image-label">
                                                                        <i class="icofont-upload-alt"></i>{{__('Upload')}}
                                                                    </label>
                                                                    <input type="file" name="answer_photo[1][1]" class="img-upload" id="image-upload">
                                                                </div>
                                                            </div>
                                                            <input type="text" class="input-field mt-3" name="answer_title[1][1]" placeholder="{{ __('Answer Text') }}" autocomplete="off">
                                                            <div class="correct-ans mt-2">
                                                                <div class="form-group">
                                                                    <select class="form-control myColors" id="" name="answer_option[1][1]">
                                                                      <option value="">{{__('Select a Result')}}</option>
                                                                    </select>
                                                                  </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-6 quiz-single-div">
                                                    <div class="card single-answer">
                                                        <div class="card-body py-3 border">
                                                            <div class="img-upload custom-image-upload">
                                                                <div id="image-preview" class="img-preview"
                                                                    style="background: url({{ asset('assets/admin/images/upload.png') }});">
                                                                    <label for="image-upload" class="img-label" id="image-label">
                                                                        <i class="icofont-upload-alt"></i>{{__('Upload')}}
                                                                    </label>
                                                                    <input type="file" name="answer_photo[1][2]" class="img-upload" id="image-upload">
                                                                </div>
                                                            </div>
                                                            <input type="text" class="input-field mt-3" name="answer_title[1][2]" placeholder="{{ __('Answer Text') }}" autocomplete="off">
                                                            <div class="correct-ans mt-2">
                                                                <div class="form-group">
                                                                    <select class="form-control myColors" id="" name="answer_option[1][2]">
                                                                      <option value="">{{__('Select a Result')}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <a href="javascript:;"  class="btn btn-info quiz-answer" data-question="1"><i class="fa fa-plus"></i> {{__('Add Answer')}}</a>
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

    <div class="row mb-4">
        <div class="col-lg-12 text-center">
            <a href="javascript:;" id="add-quiz-question" class="btn btn-info"> <i class="fa fa-plus"></i>{{__('Add Question')}}</a>
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
                                                    style="background: url({{ asset('assets/admin/images/upload.png') }});">
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
                                            <select name="category_id" id="video_parent_id">
                                                <option value="">{{__('Please select a category')}}*</option>
                                                @foreach ($datas as $data)
                                                <option value="{{$data->id}}">{{$data->title}}</option>
                                                @endforeach
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
                                                    name="is_feature" value="1" id="is_feature1">
                                                <label class="custom-control-label"
                                                    for="is_feature1">{{__('Yes')}}</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block mr-5">
                                                <input type="radio" class="custom-control-input"
                                                    name="is_feature" value="0" id="is_feature2" checked>
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
                                                    name="is_slider" value="1" id="slider1">
                                                <label class="custom-control-label" for="slider1">{{__('Yes')}}</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block mr-5">
                                                <input type="radio" class="custom-control-input"
                                                    name="is_slider" value="0" id="slider2" checked>
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
                                                    name="slider_right" value="1" id="slider_right1">
                                                <label class="custom-control-label"
                                                    for="slider_right1">{{__('Yes')}}</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block mr-5">
                                                <input type="radio" class="custom-control-input"
                                                    name="slider_right" value="0" id="slider_right2" checked>
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
                                                    name="is_trending" value="1" id="is_trending1">
                                                <label class="custom-control-label"
                                                    for="is_trending1">{{__('Yes')}}</label>
                                            </div>
                                            <div class="custom-control custom-radio d-inline-block mr-5">
                                                <input type="radio" class="custom-control-input"
                                                    name="is_trending" value="0" id="is_trending2" checked>
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
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="left-area">
                                                <h4 class="heading">{{ __('Schedule Post') }} *</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <input type="checkbox" class="schedule" name="schedule_post"
                                                value="1">
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
                                                <input id="from" class="input-field" type="text"
                                                    name="schedule_post_date" autocomplete="off"
                                                    placeholder="{{__('Start Date')}}" required="" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">

                                        </div>
                                        <div class="col-lg-12">
                                            <input type="submit" data-draft="1"
                                                class="btn btn-warning personality-btn1 saveAsDraft"
                                                value="Save as Drafts">
                                            <input type="submit" data-draft="0"
                                                class="btn btn-success personality-btn1 addPost" value="Add Post">
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
<script src="{{asset('assets/admin/js/videoCreate.js')}}"></script>
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
<script src="{{asset('assets/admin/js/pquiz.js')}}"></script>

@endsection
