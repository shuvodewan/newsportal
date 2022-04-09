@extends('layouts.load')

@section('content')

    <div class="add-product-content p-0 shadow-none">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-description">
                    <div class="body-area shadow-none">
                    @include('includes.admin.form-error')
                    <input type="hidden" id="sub_category_id" value="{{ $data->id}}">
                    <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                     <form id="geniusformdata" action="{{ route('subcategories.update',$data->id)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Language') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <select name="language_id" id="category_language_id">
                                        @foreach ($languages as $language)
                                            <option value="{{$language->id}}" {{ $language->id == $data->language_id ? 'selected' : ''}}>{{$language->language}}</option>
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
                                    <select name="parent_id" id="category_parent_id">

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
                                        placeholder="{{ __('Title') }}" value="{{ $data->title}}">
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
                                    <input type="text" class="input-field" name="slug"
                                        placeholder="{{ __('Slug') }}" value="{{ $data->slug}}">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Show At Menu') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="custom-control custom-radio d-inline-block mr-4">
                                        <input class="custom-control-input" type="radio" class="checklist1" id="show_at_homepage1" name="show_on_menu" value="1"  @if($data->show_on_menu ==1) checked @endif>
                                        <label class="custom-control-label" for="show_at_homepage1">{{__('Yes')}}</label>
                                    </div>
                                    <div class="custom-control custom-radio d-inline-block">
                                        <input class="custom-control-input" type="radio" class="checklist1" id="show_at_homepage0" name="show_on_menu" value="0" @if($data->show_on_menu ==0) checked @endif> 
                                        <label class="custom-control-label" for="show_at_homepage0">{{__('No')}}</label>
                                    </div>

                                </div>
                            </div>
                           
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="addProductSubmit-btn" type="submit">{{ __('Update Sub Category') }}</button>
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
<script src="{{asset('assets/admin/js/subEdit.js')}}"></script>
@endsection
