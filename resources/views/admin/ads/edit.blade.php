@extends('layouts.load')

@section('content')


    <div class="add-product-content p-0 shadow-none">
        @include('includes.admin.form-success')
        <div class="row">
            <div class="col-lg-12">
                <div class="product-description">
                    <div class="body-area shadow-none">
                    @include('includes.admin.form-error')
                    <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                     <form id="geniusformdataedit"  action="{{ route('ads.update',$data->id)}}" method="POST"
                            enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" id="photo" value="{{$data->photo}}">
                            <input type="hidden" id="databaseBannerType" value="{{$data->banner_type}}">
                            <input type="hidden" id="banner_code1" value="{{$data->banner_code}}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Placements') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                   <select name="add_placement" id="placement">
                                       <option value="">Please Select a Placements</option>
                                       <option value="header" {{$data->add_placement =='header' ? 'selected' : ''}}>header</option>
                                       <option value="index_bottom" {{$data->add_placement =='index_bottom' ? 'selected' : ''}}>Index Bottom</option>
                                       <option value="sidebar_bottom" {{$data->add_placement =='sidebar_top' ? 'selected' : ''}}>Sidebar Bottom</option>
                                       <option value="sponsor" {{$data->add_placement =='sponsor' ? 'selected' : ''}}>Sponsor Ads</option>
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
                                    <select name="addSize" id="banner_size" onchange="bannerSize()">
                                        <option value="">Please Select a Banner Size</option>
                                        <option value="size_728" {{$data->addSize =='size_728' ? 'selected' : ''}}>Size 728x90</option>
                                        <option value="size_468" {{$data->addSize =='size_468' ? 'selected' : ''}}>Size 468x60</option>
                                        <option value="size_234" {{$data->addSize =='size_234' ? 'selected' : ''}}>Size 234x60</option>
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
                                    <select name="" id="banner" onchange="bannerValue()">
                                        @if ($data->banner_type=="image")
                                        <option value="image" {{$data->banner_type=="image" ? 'selected' : ''}}>Banner from Image</option>
                                        @else if($data->banner_type=="code")
                                        <option value="code" {{$data->banner_type=="code" ? 'selected' : ''}}>Banner From code</option>
                                        @endif
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
                                <textarea class="input-field banner_code" name="banner_code" id="banner_code" placeholder="Your Script *">{{$data->banner_code}}</textarea>
                                </div>
                            </div>

                            <div class="row image" style="display:none;">
                                <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">Current Banner Image *</h4>
                                </div>
                                </div>
                                <div class="col-lg-12">
                                <div class="img-upload">
                                    <div id="image-preview" class="img-preview" style="background: url({{ $data->photo ? asset('assets/images/addBanner/'.$data->photo) : asset('assets/images/noimage.png') }});">
                                        <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>Upload</label>
                                        <input type="file" name="photo" class="img-upload" id="image-upload">
                                    </div>
                                        <p class="text prefer-size"></p>
                                </div>
                
                                </div>
                            </div>

                            @if($data->photo)
                                <div class="row link">
                                    <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{__('Link')}} *</h4>
                                    </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="text" class="input-field" name="link"
                                    placeholder="{{ __('Enter link(ex:example.com)') }}" id="link" autocomplete="off" value="{{$data->link}}">
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-lg-4">
                                  <div class="left-area">
                                      <h4 class="heading">{{__('Status')}} *</h4>
                                  </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="custom-control custom-radio d-inline-block mr-4">
                                        <input type="radio"  name="status" id="enable" value="1"  class="custom-control-input" @if($data->status ==1) checked @endif>
                                        <label class="custom-control-label" for="enable">{{__('Enable')}}</label>
                                    </div>

                                    <div class="custom-control custom-radio d-inline-block">
                                        <input type="radio"  name="status" value="0" id="disable"  class="custom-control-input" @if($data->status ==0) checked @endif> 
                                        <label class="custom-control-label" for="disable">{{__('Disable')}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="addProductSubmit-btn"
                                        type="submit">{{ __('Update Ads') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script src="{{asset('assets/admin/js/ads.js')}}"></script>
@endsection
