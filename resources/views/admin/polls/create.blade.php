@extends('layouts.admin')


@section('content')

<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Add Poll') }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('addPolls.index') }}">{{ __('Poll') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="add-product-content p-0">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="product-description shadow-none">
                    <div class="body-area">
                        @include('includes.admin.form-both')
                      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                     <form id="geniusformdata" action="{{ route('addPolls.store')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Language') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <select name="language_id" id="">
                                    <option value="">{{__('Please Select a Language')}}</option>
                                    @foreach ($datas as $data)
                                        <option value="{{$data->id}}">{{$data->language}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Question') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <textarea name="question" id="" class="input-field" placeholder="{{ __('Question') }}"></textarea>
                            </div>
                        </div>

                        <div class="pollOption">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Poll Option') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" name="poll_option[]" class="input-field float-left" placeholder="{{ __('Poll Option') }}" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="javascript:;" id="poll-option" class="btn btn-sm btn-dark"><i class="icofont-plus"></i> {{__('Add More Option')}}</a>
                            </div>
                        </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">
                                            <h4 class="heading">{{ __('Show On HomePage') }} *</h4>
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input id="from" class="input-field" type="text" name="end_date" autocomplete="off" placeholder="{{__('End Date')}}" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                  <div class="left-area">
                                      <h4 class="heading">{{__('Status')}} *</h4>
                                  </div>
                                </div>
                                <div class="col-lg-8">

                                    <div class="custom-control custom-radio d-inline-block mr-4">
                                        <input class="custom-control-input" type="radio"  name="status" value="1" id="enable" >
                                        <label class="custom-control-label" for="enable">{{__('Enable')}}</label>
                                    </div>
                                    <div class="custom-control custom-radio d-inline-block">
                                        <input class="custom-control-input" type="radio" class="ml-3" name="status" id="disable" value="0" checked> 
                                        <label class="custom-control-label" for="disable">{{__('Disable')}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="addProductSubmit-btn"
                                        type="submit">{{ __('Create Poll') }}</button>
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
<script src="{{asset('assets/admin/js/poll.js')}}"></script>

@endsection
