@extends('layouts.admin')

@section('content')

<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Import Rss Feed') }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="#">{{ __('Rss Feeds') }}</a>
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
                     <form id="geniusformdata"  action="{{ route('rss.store')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Language') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <select name="language_id" id="rss_language_id">
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
                                        <h4 class="heading">{{ __('Category') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <select name="category_id" id="category_id">
                                        <option value="">{{__('Please Select a Category')}}</option>
                                    </select>
                                </div>
                            </div>
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Feed Name') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <input type="text" name="feed_name" id="feed_name" class="input-field" placeholder="{{ __('Feed Name') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Feed Url') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <input type="text" name="feed_url" id="feed_url" class="input-field" placeholder="{{ __('Feed Url') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Number of Posts to Import') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <input type="number" name="post_limit" id="post_limit" class="input-field" placeholder="{{__('Number of Posts to Import')}}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="left-area">
                                    <h4 class="heading">{{__('Auto Update')}} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="custom-control custom-radio d-inline-block mr-4">
                                    <input class="custom-control-input" type="radio" name="auto_update" id="auto_update1" value="1"> 
                                    <label class="custom-control-label" for="auto_update1">{{__('Yes')}}</label>
                                </div>
                                <div class="custom-control custom-radio d-inline-block">
                                    <input class="custom-control-input" type="radio" class="ml-3" name="auto_update" id="auto_update0" value="0" checked> 
                                    <label class="custom-control-label" for="auto_update0">{{__('No')}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <button class="addProductSubmit-btn"
                                    type="submit">{{ __('Import Rss Feed') }}</button>
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
<script src="{{asset('assets/admin/js/rss.js')}}"></script>
@endsection
