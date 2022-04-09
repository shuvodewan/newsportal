@extends('layouts.load')

@section('content')

    <div class="add-product-content p-0 shadow-none">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-description">
                    <div class="body-area shadow-none">
                    @include('includes.admin.form-both')
                    <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                     <form id="geniusformdata" action="{{ route('categories.categoriesStore')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Language') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <select name="language_id" id="">
                                        <option value="">{{('Please Select a Language')}}</option>
                                        @foreach ($datas as $data)
                                            <option value="{{$data->id}}">{{$data->language}}</option>
                                        @endforeach
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
                                        placeholder="{{ __('Title') }}" id="title" autocomplete="off">
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
                                        placeholder="{{ __('Slug') }}" id="slug">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Menu Order') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="number" class="input-field" name="category_order"
                                        placeholder="{{ __('Menu Order') }}">
                                @if ($cat_id)  
                                    <p class="mt-3">{{__('Available Menu Order')}} : {{$cat_id}}</p>
                                @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Color') }} *</h4>
                                    </div>
                                  </div>
                                  <div class="col-lg-12">
                                      <div class="form-group">
                                        <div class="input-group colorpicker-component cp">
                                          <input type="text" name="color" class="form-control input-field color-field cp"  />
                                          <span class="input-group-addon"><i></i></span>
                                        </div>
                                      </div>
                                  </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Show At Home Page') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="custom-control custom-radio d-inline-block mr-4">
                                        <input class="custom-control-input" type="radio" class="checklist1" id="show_at_homepage1" name="show_at_homepage" value="1" >
                                        <label class="custom-control-label" for="show_at_homepage1">{{__('Yes')}}</label>
                                    </div>
                                    <div class="custom-control custom-radio d-inline-block">
                                        <input class="custom-control-input" type="radio" class="checklist1" id="show_at_homepage0" name="show_at_homepage" value="0" checked> 
                                        <label class="custom-control-label" for="show_at_homepage0">{{__('No')}}</label>
                                    </div>
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
                                        <input class="custom-control-input" type="radio" class="checklist2" name="show_on_menu" id="yes" value="1" >
                                        <label class="custom-control-label" for="yes">{{__('Yes')}}</label>
                                    </div>
                                    <div class="custom-control custom-radio d-inline-block">
                                        <input class="custom-control-input" type="radio" class="checklist2" name="show_on_menu" id="no" value="0" checked> 
                                        <label class="custom-control-label" for="no">{{__('No')}}</label>
                                    </div>
                                </div>
                            </div>
                           
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button class="addProductSubmit-btn"
                                        type="submit">{{ __('Create Category') }}</button>
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

@endsection
