@extends('layouts.load')

@section('styles')
    
@endsection

@section('content')

    <div class="add-product-content p-0 shadow-none">
        @include('includes.admin.form-success')
        <div class="row">
            <div class="col-lg-12">
                <div class="product-description">
                    <div class="body-area shadow-none">
                    @include('includes.admin.form-error')
                    <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                     <form id="geniusformdataedit" action="{{ route('widget.update',$data->id)}}" method="POST" enctype="multipart/form-data">
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
                                            <option value="{{$language->id}}" {{$data->language_id == $language->id ? 'selected' : ''}}>{{$language->language}}</option>
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
                                            placeholder="{{ __('Enter Title') }}" id="title" autocomplete="off" value="{{ $data->title}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                  <div class="left-area">
                                    <h4 class="heading">
                                        {{__('Description')}} *
                                    </h4>
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                    <textarea class="nic-edit" name="description" placeholder="{{__('Description')}}" id="description">{{ $data->description}}</textarea> 
                                </div>
                              </div>

                            <div class="row">
                                <div class="col-lg-2">
                                  <div class="left-area">
                                      <h4 class="heading">{{__('Visibility')}} *</h4>
                                  </div>
                                </div>
                                <div class="col-lg-8">

                                    <div class="custom-control custom-radio d-inline-block mr-4">
                                        <input class="custom-control-input" type="radio"  name="status" value="1" id="visible"  {{$data->status == 1 ? 'checked':''}}> 
                                        <label class="custom-control-label" for="visible">{{__('visible')}}</label>
                                    </div>
                                    <div class="custom-control custom-radio d-inline-block">
                                        <input class="custom-control-input" type="radio" class="ml-3" name="status" value="0" id="invisible"  {{$data->status == 0 ? 'checked':''}}> 
                                        <label class="custom-control-label" for="invisible">{{__('invisible')}}</label>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="addProductSubmit-btn"
                                        type="submit">{{ __('Update Widget') }}</button>
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