@extends('layouts.admin')

@section('content')

<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Add Pages') }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.page.create') }}">{{ __('Pages') }}</a>
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
                     <form id="geniusformdata" action="{{ route('admin.page.store')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Language') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <select name="language_id" id="language_id">
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
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <input type="text" name="title" id="title" class="input-field" placeholder="{{__('Title')}}" autocomplete="off">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Slug') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <input type="text" name="slug" id="slug" class="input-field" placeholder="{{__('Slug')}}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Placement') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <select name="placement" id="placement">
                                    <option value="">{{__('Please Select a Placement')}}</option>
                                    <option value="footer">{{__('Footer')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Content') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                               <textarea name="description" id="description" cols="30" rows="10" class="nic-edit"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Status') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="custom-control custom-radio d-inline-block mr-4">
                                    <input class="custom-control-input" type="radio" name="status" id="enable" value="1"> 
                                    <label class="custom-control-label" for="enable">{{__('Enable')}}</label>
                                </div>
                                <div class="custom-control custom-radio d-inline-block">
                                    <input class="custom-control-input" type="radio" name="status" id="disable" value="0" checked> 
                                    <label class="custom-control-label" for="disable">{{__('Disable')}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Show Website Right Column') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="custom-control custom-radio d-inline-block mr-4">
                                    <input class="custom-control-input" type="radio" name="wbsite_right_column" id="yes" value="1"> 
                                    <label class="custom-control-label" for="yes">{{__('Yes')}}</label>
                                </div>
                                <div class="custom-control custom-radio  d-inline-block">
                                    <input class="custom-control-input" type="radio" name="wbsite_right_column" id="no" value="0" checked> 
                                    <label class="custom-control-label" for="no">{{__('No')}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="addProductSubmit-btn"
                                    type="submit">{{ __('Add Page') }}</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{asset('assets/admin/js/page.js')}}"></script>
@endsection
