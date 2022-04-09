@extends('layouts.load')

@section('content')

    <div class="add-product-content p-0 shadow-none">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="product-description">
                    <div class="body-area  shadow-none">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Question') }} *</h4>
                                        <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    {{ $data->question}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                        <h4 class="heading">{{ __('Poll Option') }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    @if (count($data->child)>0)
                                        @foreach ($data->child as $value)
                                        <div class="custom-control custom-radio mb-2">
                                            <input type="radio" class="custom-control-input">
                                            <label class="custom-control-label">{{$value->poll_option}} </label>
                                          </div>
                                            
                                        @endforeach 

                                        @else 
                                        <p class="text-danger">{{__('No Poll Create yet')}}</p>
                                    @endif
                                    
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

@endsection