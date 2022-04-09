@extends('layouts.admin')

@section('content')

<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Add Image Gallery') }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}">{{ __('Image Gallery') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="add-product-content">
        @include('includes.admin.form-error')
        @include('includes.admin.form-success')
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="product-description">
                    <div class="body-area">
                      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                     <form id="geniusformdata"  action="{{ route('image.gallery.store')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
   
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Language') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <select name="language_id" id="album_language_id">
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
                                    <h4 class="heading">{{ __('Album') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <select name="image_album_id" id="image_album_id">
                                    <option value="">{{__('Please Select Your Album')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Category') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <select name="image_category_id" id="image_category_id">
                                    <option value="">{{__('Please Select Your Category')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="left-area">
                                        <h4 class="heading">
                                            {{__('Gallery Images')}} *
                                        </h4>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <a href="#" class="set-gallery" data-toggle="modal" data-target="#setgallery">
                                        <i class="icofont-plus"></i> {{__('Make Gallery')}}
                                </a>
                                <input type="file" name="gallery[]" class="hidden" id="uploadgallery" accept="image/*" multiple>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="addProductSubmit-btn"
                                    type="submit">{{ __('Create Image Gallery') }}</button>
                            </div>
                        </div>

                        </form>
                        <div class="modal fade-scale" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Image Gallery') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="top-area">
                                        <div class="row">
                                            <div class="col-sm-6 text-right">
                                                <div class="upload-img-btn">
                                                    <label id="prod_gallery"><i class="icofont-upload-alt"></i>{{ __('Upload File') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="javascript:;" class="upload-done" data-dismiss="modal"> <i class="fas fa-check"></i> {{ __('Done') }}</a>
                                            </div>
                                            <div class="col-sm-12 text-center">( <small>{{ __('You can upload multiple Images.') }}</small> )</div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{asset('assets/admin/js/image_gallary_front.js')}}"></script>
@endsection
