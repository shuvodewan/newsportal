@extends('layouts.load')

@section('content')

<div class="add-product-content p-0 shadow-none">
    <div class="row">
        <div class="col-lg-12">
            <div class="product-description">
                <div class="body-area shadow-none">
                    @include('includes.admin.form-error')
                    <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                    <form id="geniusformdata" action="{{ route('subcategories.store')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Language') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <select name="language_id" id="article_language_id">
                                    <option value="">{{__('Please Select Your Language')}}</option>
                                    @foreach ($datas as $data)
                                        <option value="{{$data->id}}">{{$data->language}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Parent Category') }} *</h4>
                                    <p class="sub-heading">{{ __('In English') }}</p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <select name="parent_id" id="article_parent_id">
                                    <option value="">{{__('Please select a category')}}</option>
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
                                    placeholder="{{ __('Title') }}">
                            </div>
                        </div>

                        <input type="hidden" class="input-field" name="slug" placeholder="{{ __('Slug') }}">


                        <div class="row">
                            <div class="col-lg-4">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Show At Menu') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="custom-control custom-radio d-inline-block mr-4">
                                    <input type="radio" class="custom-control-input" id="yes" name="show_on_menu" value="1">
                                    <label class="custom-control-label" for="yes">{{__('Yes')}}</label>
                                </div>
                                <div class="custom-control custom-radio d-inline-block">
                                    <input type="radio" class="custom-control-input" id="no" name="show_on_menu" value="0" checked> 
                                    <label class="custom-control-label" for="no">{{__('No')}}</label>
                                </div>
                            </div>
                        </div>
                        
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="left-area">

                                </div>
                            </div>
                            <div class="col-lg-7">
                                <button class="addProductSubmit-btn"
                                    type="submit">{{ __('Create Sub Category') }}</button>
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
<script src="{{asset('assets/admin/js/articleCreate.js')}}"></script>
@endsection
