@extends('layouts.admin')

@section('content')

<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Add Ads') }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}">{{ __('Ads') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="add-product-content">
        @include('includes.admin.form-success')
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="product-description">
                    <div class="body-area">
                    @include('includes.admin.form-error')
                    <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                     <form id="geniusformdata"  action="{{ route('ads.store')}}" method="POST"
                            enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Placements') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                   <select name="add_placement" id="placement">
                                       <option value="">{{__('Please Select a Placements')}}</option>
                                       <option value="header">{{__('header')}}</option>
                                       <option value="index_bottom">{{__('Index Bottom')}}</option>
                                       <option value="sidebar_bottom">{{__('Sidebar Bottom')}}</option>
                                       <option value="sponsor">{{__('Sponsor Ads')}}</option>
                                   </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Banner Size') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <select name="addSize" id="banner_size">
                                        <option value="">{{__('Please Select a Banner Size')}}</option>
                                        <option value="size_728">{{__('Size 728x90')}}</option>
                                        <option value="size_468">{{__('Size 468x60')}}</option>
                                        <option value="size_234">{{__('Size 234x60')}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Banner') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <select name="banner_type" id="banner">
                                        <option value="">{{__('Please Select a Options')}}</option>
                                        <option value="image">{{__('Banner from Image')}}</option>
                                        <option value="code">{{__('Banner From code')}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row code" style="display:none;">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Banner') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <textarea class="input-field banner_code" name="banner_code" id="banner_code" placeholder="Your Script *"></textarea>
                                </div>
                            </div>

                            <div class="row image" style="display:none;">
                                <div class="col-lg-12">
                                  <div class="left-area">
                                      <h4 class="heading">{{__('Current Banner Image')}} *</h4>
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                  <div class="img-upload">
                                      <div id="image-preview" class="img-preview" style="background: url({{ asset('assets/admin/images/upload.png') }});">
                                        <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>Upload</label>
                                          <input type="file" name="photo" class="img-upload" id="image-upload">
                                      </div>
                                        <p class="text prefer-size"></p>
                                  </div>
                
                                </div>
                            </div>

                            <div class="row link" style="display:none;">
                                <div class="col-lg-12">
                                  <div class="left-area">
                                      <h4 class="heading">{{__('Link')}} *</h4>
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" class="input-field" name="link"
                                    placeholder="{{ __('Enter link(ex:example.com)') }}" id="link" autocomplete="off">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2">
                                  <div class="left-area">
                                      <h4 class="heading">{{__('Status')}} *</h4>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="custom-control custom-radio d-inline-block mr-4">
                                        <input class="custom-control-input" type="radio"  name="status" value="1" id="enable">
                                        <label class="custom-control-label" for="enable">{{__('Enable')}}</label>
                                    </div>
                                    <div class="custom-control custom-radio d-inline-block">
                                        <input class="custom-control-input" type="radio" class="ml-3" name="status" value="0" id="disable" checked>
                                        <label class="custom-control-label" for="disable">{{__('Disable')}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="addProductSubmit-btn"
                                        type="submit">{{ __('Create Ads') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <p class="ml-5">[NB: for homepage preparable size is 720x90]</p>
                    <p class="ml-5">[NB: for Sidebar preparable size is 468x60]</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{asset('assets/admin/js/ads.js')}}"></script>
@endsection
