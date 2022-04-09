@extends('layouts.load')

@section('content')
    <div class="add-product-content p-0 shadow-none">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-description">
                    <div class="body-area">
                        @include('includes.admin.form-error')
                        @include('includes.admin.form-success')
                    <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                    <form id="geniusformdata" action="{{route('social.link.update',$data->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Social Media Name') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <select name="name" id="">
                                    <option value="">{{__('Select a Social Media Here')}}</option>
                                    <option value="facebook" {{$data->name == 'facebook' ? 'selected' : ''}}>{{__('Facebook')}}</option>
                                    <option value="twitter" {{$data->name == 'twitter' ? 'selected' : ''}}>{{__('Twitter')}}</option>
                                    <option value="instagram" {{$data->name == 'instagram' ? 'selected' : ''}}>{{__('Instagram')}}</option>
                                    <option value="linkedin" {{$data->name == 'linkedin' ? 'selected' : ''}}>{{__('Linkedin')}}</option>
                                    <option value="youtube" {{$data->name == 'youtube' ? 'selected' : ''}}>{{__('Youtube')}}</option>
                                    <option value="vimeo" {{$data->name == 'vimeo' ? 'selected' : ''}}>{{__('Vimeo')}}</option>
                                    <option value="pinterest" {{$data->name == 'pinterest' ? 'selected' : ''}}>{{__('Pinterest')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Social Link') }} *</h4>
                                    <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <input type="text" class="input-field" name="link" placeholder="{{ __('Social Link') }}" required="" value="{{ $data->link}}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Icon') }} *</h4>
                                </div>
                            </div>
                                
                            <div class="col-lg-12 d-flex">
                                <i class="" id="icn"></i>
                                <input type="text" id="icons" class="input-field" name="icon" placeholder="{{ __('Social Icon') }}" required="" value="{{ $data->icon}}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
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
<script src="{{ asset('assets/admin/js/iconpicker.js') }}"></script>
<script src="{{ asset('assets/admin/js/icon.js') }}"></script>

@endsection