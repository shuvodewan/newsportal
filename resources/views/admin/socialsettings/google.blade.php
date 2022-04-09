@extends('layouts.admin')

@section('content')

<div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{ __('Google Login') }}</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                      </li>
                      <li>
                        <a href="javascript:;">{{ __('Social Settings') }}</a>
                      </li>
                      <li>
                        <a href="{{ route('social.settings.google') }}">{{ __('Google Login') }}</a>
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
                        <div class="gocover" style=""></div>
                        <form action="{{ route('social.settings.update') }}" id="geniusform" method="POST" enctype="multipart/form-data">
                          {{ csrf_field() }}

                        <div class="row justify-content-center">
                          <div class="col-lg-12">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Client ID') }} *</h4>
                                <p class="sub-heading">{{ __('Get Your Client ID from console.cloud.google.com') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <input type="text" class="input-field" placeholder="{{ __('Enter Client ID') }}" name="gclient_id" value="{{ $data->gclient_id}}" required="">
                          </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-12">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Client Secret') }} *</h4>
                                <p class="sub-heading">{{ __('Get Your Client Secret from console.cloud.google.com') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-12">
                          <input type="text" class="input-field" placeholder="{{ __('Enter Client Secret') }}" name="gclient_secret" value="{{ $data->gclient_secret}}" required="">
                          </div>
                        </div>


                        <div class="row justify-content-center">
                          <div class="col-lg-12">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Website URL') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <input type="text" class="input-field" placeholder="{{ __('Website URL') }}"  value="{{ url('/') }}" readonly>
                          </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-12">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Redirect URL') }} *</h4>
                                <p class="sub-heading">{{ __('Copy this url and paste it to your Redirect URL in console.cloud.google.com.') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <input type="text" class="input-field" placeholder="{{ __('Enter Site URL') }}" name="gredirect" value="{{url('/auth/google/callback')}}" readonly>
                          </div>
                        </div>


                        <div class="row justify-content-center">
                          <div class="col-lg-12">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
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
