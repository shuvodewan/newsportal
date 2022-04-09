@extends('layouts.admin')

@section('content')

<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Edit Articles') }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}">{{ __('Articles') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @include('includes.admin.form-both')
    <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
    <form id="geniusformdata2" action="{{ route('article.update',$data->id)}}" enctype="multipart/form-data">
           {{csrf_field()}}
    <input type="hidden" name="is_pending" value="{{ $data->is_pending}}">
    <input type="hidden" name="post_type" value="{{ $data->post_type}}">
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
                                            <textarea class="input-field textarea" name="meta_tag" placeholder="{{__('Keyword meta tag')}}">{{ $data->meta_tag }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="left-area">
                                                <h4 class="heading">{{ __('Tags') }} *</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <input type="text" placeholder="{{ __('Tags') }}" class="tags input-field" id="tags" name="tags" value="{{$data->tags}}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                          <div class="left-area">
                                            <h4 class="heading">
                                                {{__('Description')}} *
                                            </h4>
                                          </div>
                                        </div>
                                        <div class="col-lg-12 description">
                                            <textarea class="nic-edit" name="description" placeholder="{{__('Description')}}" id="description">{{ $data->description}}</textarea> 
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
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
                                              <h4 class="heading">{{__('Current Featured Image')}} *</h4>
                                          </div>
                                        </div>
                                        <div class="col-lg-12">
                                          <div class="img-upload custom-image-upload">
                                              <div id="image-preview" class="img-preview" style="background: url({{ $data->image_big ? asset('assets/images/post/'.$data->image_big) : asset('assets/admin/images/upload.png') }});">
                                                <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>Upload</label>
                                                  <input type="file" name="image_big" class="img-upload" id="image-upload">
                                              </div>
                                                <p class="text">{{__('Prefered Size: (600x600) or Square Sized Image')}}</p>
                                          </div>
                        
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="left-area">
                                                    <h4 class="heading">
                                                        {{__('Gallery Images')}} *
                                                    </h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <a href="#" class="set-gallery" data-toggle="modal" data-target="#setgallery">
                                                    <i class="icofont-plus"></i> {{__('Set Gallery')}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               </div>
           </div>


           <div class="row mt-3 categoryDiv" style="display:none;">
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
                                                <option value="">{{__('Please a Sub Category(if any)')}}</option>
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


           <div class="row mt-3">
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
                                                <input type="radio" class="custom-control-input"  name="is_feature" value="1" id="is_feature1" @if($data->is_feature ==1) checked @endif> 
                                                <label for="is_feature1" class="custom-control-label">{{__('Yes')}}</label>
                                            </div>    
                                            <div class="custom-control custom-radio d-inline-block mr-5">
                                                <input type="radio" class="custom-control-input" name="is_feature" value="0" id="is_feature2" @if($data->is_feature ==0) checked @endif> 
                                                <label for="is_feature2" class="custom-control-label">{{__('No')}}</label>
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
                                                <input type="radio" class="custom-control-input"  name="is_slider" value="1" id="slider1" @if($data->is_slider ==1) checked @endif>
                                                <label for="slider1" class="custom-control-label">{{__('Yes')}}</label>
                                            </div>
                                             <div class="custom-control custom-radio d-inline-block mr-5">
                                                <input type="radio" class="custom-control-input" name="is_slider" value="0" id="slider2" @if($data->is_slider ==0) checked @endif> 
                                                <label for="slider2" class="custom-control-label">{{__('No')}}</label>
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
                                                <input type="radio"  class="custom-control-input" name="slider_right" value="1" id="slider_right1" @if($data->slider_right ==1) checked @endif> 
                                                <label for="slider_right1" class="custom-control-label">{{__('Yes')}}</label>
                                            </div>   
                                            <div class="custom-control custom-radio d-inline-block mr-5">
                                                <input type="radio" class="custom-control-input" name="slider_right" value="0" id="slider_right2" @if($data->slider_right ==0) checked @endif> 
                                                <label for="slider_right2" class="custom-control-label">{{__('No')}}</label>
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
                                                <input type="radio" class="custom-control-input"  name="is_trending" value="1" id="is_trending1" @if($data->is_trending ==1) checked @endif>
                                                <label for="is_trending1" class="custom-control-label">{{__('Yes')}}</label>
                                            </div>   
                                            <div class="custom-control custom-radio d-inline-block mr-5">
                                                <input type="radio" class="custom-control-input" name="is_trending" value="0" id="is_trending2" @if($data->is_trending ==0) checked @endif>
                                                <label for="is_trending2" class="custom-control-label">{{__('No')}}</label>
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


           <div class="row mt-3">
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
                                        <input type="checkbox" class="schedule" name="schedule_post" value="{{ $data->schedule_post}}" {{$data->schedule_post ==1 ? 'checked':''}} disabled >
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
                                            <input type="submit" data-draft="0" class="btn btn-success submit-btn1" value="Update Post">
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

<div class="modal fade-scale" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">{{ __("Image Gallery") }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="top-area">
                <div class="row">
                    <div class="col-sm-6 text-right">
                        <div class="upload-img-btn">
                            <form  method="POST" enctype="multipart/form-data" id="form-gallery">
                                {{ csrf_field() }}
                            <input type="hidden" id="post_id" name="post_id" value="{{ $data->id }}">
                            <input type="file" name="gallery[]" class="hidden" id="article_upload_gallery_edit" accept="image/*" multiple>
                                    <label id="article_gallery_edit"><i class="icofont-upload-alt"></i>{{ __("Upload File") }}</label>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <a href="javascript:;" class="upload-done" data-dismiss="modal"> <i class="fas fa-check"></i> {{ __("Done") }}</a>
                    </div>
                    <div class="col-sm-12 text-center">( <small>{{ __("You can upload multiple Images.") }}</small> )</div>
                </div>
            </div>
            <div class="gallery-images">
                <div class="selected-image">
                    <div class="row">


                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

{{-- DELETE MODAL --}}

<div class="modal fade-scale" id="post-approve" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header d-block text-center">
                <h4 class="modal-title d-inline-block">{{ __('Post Approve') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p class="text-center">
                    {{ __('You are about to approve this Post') }}.
                </p>
                <p class="text-center">{{ __('Do you want to proceed?') }}</p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger btn-ok">{{ __('Approve') }}</a>
            </div>

        </div>
    </div>
</div>

{{-- DELETE MODAL ENDS --}}

@endsection


@section('scripts')
<script src="{{asset('assets/admin/js/page.js')}}"></script>
<script src="{{asset('assets/admin/js/articleEdit.js')}}"></script>
<script src="{{asset('assets/admin/js/image_gallary.js')}}"></script>
<script src="{{asset('assets/admin/js/tagify.js')}}"></script>
<script>
    $('.tags').tagify();
</script>

@endsection
