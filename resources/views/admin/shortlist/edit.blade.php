@extends('layouts.admin')

@section('styles')
<link href="{{asset('assets/admin/css/tabbar.css')}}" rel="stylesheet" />
@endsection

@section('content')

<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Edit Sorted List Item') }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="#">{{ __('Sorted List Item') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @include('includes.admin.form-error')
    @include('includes.admin.form-success')
    <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
    <form id="sortformdata" action="{{ route('shortlist.update',$data->id)}}" method="POST" enctype="multipart/form-data">
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
                                                <option value="">{{__('Please Select a Language')}}</option>
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
                                                placeholder="{{ __('Enter Title') }}" autocomplete="off" id="title" value="{{ $data->title }}">
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
                                                placeholder="{{ __('Enter Slug') }}" autocomplete="off" id="slug" value="{{ $data->slug }}">
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
                                                placeholder="Keyword meta tag">{{ $data->meta_tag }}</textarea>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="left-area">
                                                <h4 class="heading">{{ __('Tags') }} *</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <input type="text" placeholder="" class="form-control tags" id="tags" name="tags" value="{{$data->tags}}">
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
                                            <textarea class="nic-edit" name="description" placeholder="Details" id="description">{{ $data->description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @foreach ($data->sorts as $sort)
            <input type="hidden" name="sort_id[]" value="{{$sort->id}}">
                <div class="quiz-result-area first-quiz-result">
                    <div class="row mt-5">
                        <div class="col-lg-12">
                            <h6> <b>{{__('Sorted List Items')}}</b></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="add-product-content card mb-4">
                                <div id="headingTwo">
                                    <div class="btn d-flex justify-content-between bg-light" type="button"
                                        data-toggle="collapse" data-target="#collapse{{$loop->iteration}}" aria-expanded="true"
                                        aria-controls="collapse{{$loop->iteration}}">
                                        <div class="left">
                                            #{{$loop->iteration}}
                                        </div>
                                        @if (!$loop->first)
                                            <div class="right">
                                                <span class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash remove_quiz_result" data-id="{{$sort->id}}"></i>
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div id="collapse{{$loop->iteration}}" class="collapse show" aria-labelledby="heading{{$loop->iteration}}">
                                    <div class="card-body  pt-3">
                                        <div class="product-description">
                                            <div class="body-area p-0">
                
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="left-area">
                                                            <h4 class="heading">{{ __('Item Title') }} *</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="item_title[]" value="{{$sort->item_title}}" class="input-field" placeholder="{{ __('Item Title') }}">
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
                                                                        style="background: url({{ $sort->item_photo ? asset('assets/images/sort/'.$sort->item_photo) : asset('assets/admin/images/upload.png') }});">
                                                                        <label for="image-upload" class="img-label"id="image-label">
                                                                            <i class="icofont-upload-alt"></i>{{__('Upload')}}
                                                                        </label>
                                                                        <input type="file" name="item_photo[]" class="img-upload" id="image-upload">
                                                                    </div>
                                                                </div>
                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="row item_description">
                                                            <div class="col-lg-12">
                                                                <div class="left-area">
                                                                    <h4 class="heading">
                                                                        {{__('Description')}}
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <textarea class="nic-edit" name="item_description" placeholder="Details">{{$sort->item_description}}</textarea>
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
                                                        class="btn btn-success sort-btn1 addPost" value="Update Post">
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
<script src="{{asset('assets/admin/js/articleEdit.js')}}"></script>
<script src="{{asset('assets/admin/js/tagify.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>  
<script>
    $('.tags').tagify();
</script>


<script type="text/javascript">
    "use strict";
    var lang = {
        'sort_listed_item': '{{ __('Sorted List Items') }}',
        'item_title': '{{ __('Item Title') }}',
        'image': '{{ __('Image') }}',
        'description': '{{ __('Description') }}',
        'upload': '{{ __('Upload') }}',
    }

</script>
<script src="{{asset('assets/admin/js/sort_edit.js')}}"></script>

@endsection
