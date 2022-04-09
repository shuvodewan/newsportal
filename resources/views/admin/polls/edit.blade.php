@extends('layouts.load')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/datetimepicker.css') }}">
@endsection

@section('content')

    <div class="add-product-content p-0 shadow-none">
        @include('includes.admin.form-success')
        <div class="row">
            <div class="col-lg-12">
                <div class="product-description">
                    <div class="body-area shadow-none">
                        @include('includes.admin.form-both')
                    <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>

                        <form id="geniusformdataedit"  action="{{ route('addPolls.update',$poll_option->id)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Language') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <select name="language_id" id="">
                                    @foreach ($datas as $data)
                                        <option value="{{$data->id}}" {{$data->id == $poll_option->language_id}}>{{$data->language}}</option>
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
                                <textarea name="question" id="" class="input-field">{{ $poll_option->question }}</textarea>
                            </div>
                        </div>

                        <div class="pollOption">
                            @if (count($poll_option->child)>0)
                            @foreach ($poll_option->child as $item)
                                <input type="hidden" name="option_id" value="{{$item->id}}">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Poll Option') }} *</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="text" name="poll_option[]" class="input-field float-left" placeholder="poll option here" value="{{ $item->poll_option }}" autocomplete="off"/>
                                    </div>
                                </div>
                            @endforeach
                            @else 
                                <p class="text-danger">{{__('No Poll Option Create yet')}}</p>
                            @endif
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
                                        <input id="from" class="input-field" type="text" name="end_date" autocomplete="off" placeholder="{{__('End Date')}}" value="{{ $poll_option->end_date }}">
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
                                        <input class="custom-control-input" type="radio"  name="status" value="1" id="enable" {{ $poll_option->status == 1 ? 'checked' : ''}}>
                                        <label class="custom-control-label" for="enable">{{__('Enable')}}</label>
                                    </div>
                                    <div class="custom-control custom-radio d-inline-block">
                                        <input class="custom-control-input" type="radio" class="ml-3" name="status" id="disable" value="0" {{ $poll_option->status == 0 ? 'checked' : ''}}> 
                                        <label class="custom-control-label" for="disable">{{__('Disable')}}</label>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="addProductSubmit-btn"
                                        type="submit">{{ __('Update Polls') }}</button>
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
<script src="{{asset('assets/admin/js/datetimepicker.js')}}"></script>
<script src="{{asset('assets/admin/js/poll.js')}}"></script>

@endsection