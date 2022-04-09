@extends('layouts.load')

@section('styles')

@endsection

@section('content')

<div class="add-product-content P-0 shadow-none">
    <div class="row">
        <div class="col-lg-12">
            <div class="product-description">
                <div class="body-area  shadow-none">
                    @include('includes.admin.form-error')
                    @include('includes.admin.form-success')
                <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                <form id="geniusformdata" action="{{route('social.link.store')}}" method="POST" enctype="multipart/form-data">
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
                                <option value="facebook">{{__('Facebook')}}</option>
                                <option value="twitter">{{__('Twitter')}}</option>
                                <option value="instagram">{{__('Instagram')}}</option>
                                <option value="linkedin">{{__('Linkedin')}}</option>
                                <option value="youtube">{{__('Youtube')}}</option>
                                <option value="vimeo">{{__('Vimeo')}}</option>
                                <option value="pinterest">{{__('Pinterest')}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Social Link') }} *</h4>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="text" class="input-field" name="link" placeholder="{{ __('Social Link') }}" required="" value="">
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
                            <input type="text" id="icons" class="input-field" name="icon" placeholder="{{ __('Social Icon') }}" required="" value="">
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