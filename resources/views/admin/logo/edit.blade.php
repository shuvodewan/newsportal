@extends('layouts.admin')

@section('content')

<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
        <div class="col-lg-12">
            <h4 class="heading">{{ __('Language Base Logo') }}
                <a class="add-btn" href="{{ route('admin.languagelogo.index') }}"><i
                    class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
            <ul class="links">
                <li>
                <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                </li>
                <li>
                <a href="javascript:;">{{ __('General Settings') }}</a>
                </li>
                <li>
                <a href="{{ route('admin.languagelogo.index') }}">{{ __('Language Base Logo') }}</a>
                </li>
            </ul>

        </div>
        </div>
    </div>

    @include('includes.admin.form-both')
    <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
    <form id="geniusform" action="{{ route('admin.languagelogo.update',$data->id) }}" method="POST" enctype="multipart/form-data">
           {{csrf_field()}}
        <div class="row">
            <div class="col-lg-12">
                <div class="add-product-content">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6">
                            <div class="product-description">
                                <div class="body-area">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="left-area">
                                                <h4 class="heading">{{ __('Language') }} *</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <select name="language_id" id="article_language_id" disabled>
                                                <option value="">{{__('Please Select a Language')}}</option>
                                                @foreach ($languages as $language)
                                                    <option value="{{$language->id}}" {{$data->language_id == $language->id ? 'selected' : ''}}>{{$language->language}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="language_id" value="{{$data->language_id}}">


                                    <div class="row">
                                        <div class="col-lg-12">
                                          <div class="left-area">
                                              <h4 class="heading">{{__('Header logo')}} *</h4>
                                          </div>
                                        </div>
                                        <div class="col-lg-12">
                                          <div class="img-upload custom-image-upload">
                                              <div id="image-preview" class="img-preview" style="background: url({{ $data->header_logo ? asset('assets/images/logo/'.$data->header_logo) : asset('assets/admin/images/upload.png') }});">
                                                <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{__('Upload')}}</label>
                                                  <input type="file" name="header_logo" class="img-upload" id="image-upload">
                                              </div>
                                                <p class="text">{{__('Prefered Size: (334x50) or Square Sized Image')}}</p>
                                          </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-12">
                                          <div class="left-area">
                                              <h4 class="heading">{{__('Footer logo')}} *</h4>
                                          </div>
                                        </div>
                                        <div class="col-lg-12">
                                          <div class="img-upload custom-image-upload">
                                              <div id="image-preview" class="img-preview" style="background: url({{ $data->footer_logo ? asset('assets/images/logo/'.$data->footer_logo) : asset('assets/admin/images/upload.png') }});">
                                                <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{__('Upload')}}</label>
                                                  <input type="file" name="footer_logo" class="img-upload" id="image-upload">
                                              </div>
                                                <p class="text">{{__('Prefered Size: (334x50) or Square Sized Image')}}</p>
                                          </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="left-area">
            
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <button class="addProductSubmit-btn"
                                                type="submit">{{ __('Save') }}</button>
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