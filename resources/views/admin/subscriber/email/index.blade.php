@extends('layouts.admin')

@section('content')
            <div class="content-area">

            <div class="mr-breadcrumb">
              <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Group Email') }}</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                      </li>
                      <li>
                        <a href="javascript:;">{{ __('Email Settings') }}</a>
                      </li>
                      <li>
                        <a href="{{ route('admin.email.group') }}">{{ __('Group Email') }}</a>
                      </li>
                    </ul>
                </div>
              </div>
            </div>

              <div class="add-product-content">
                <div class="row justify-content-center">
                  <div class="col-lg-8">
                    <div class="product-description">
                      <div class="body-area">
                        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                        @include('includes.admin.form-error')
                        @include('includes.admin.form-success')
                      <form id="geniusform" action="{{route('admin.subscriber.sendemail')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                    
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Email Subject') }} *</h4>
                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <input type="text" class="input-field" name="subject" placeholder="{{ __('Email Subject') }}" value="" required="">
                          </div>
                        </div>



                        <div class="row">
                          <div class="col-lg-12">
                            <div class="left-area">
                              <h4 class="heading">
                                   {{ __('Email Body') }} *
                              </h4>
                              <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-12">
                              <textarea class="nic-edit" name="body" placeholder="{{ __('Email Body') }}"></textarea> 
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-lg-12">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Send Email') }}</button>
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