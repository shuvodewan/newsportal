@extends('layouts.admin')

@section('content')

<div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{ __('Facebook Login') }}</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                      </li>
                      <li>
                        <a href="javascript:;">{{ __('Social Settings') }}</a>
                      </li>
                      <li>
                        <a href="{{ route('social.settings.facebook') }}">{{ __('Facebook Login') }}</a>
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
                        <div class="gocover" style=""></div>
                        <form action="{{ route('social.settings.update') }}" id="geniusform" method="POST" enctype="multipart/form-data">
                          {{ csrf_field() }}

                          @include('includes.admin.form-error')
                          @include('includes.admin.form-success') 

                        <div class="row justify-content-center">
                          <div class="col-lg-12">
                            <div class="left-area">
                                <h4 class="heading">{{ __('App ID') }} *</h4>
                                <p class="sub-heading">{{ __('Get Your App ID from developers.facebook.com') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <input type="text" class="input-field" placeholder="{{ __('Enter App ID') }}" name="fclient_id" value="{{ $data->fclient_id }}" required="">
                          </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-12">
                            <div class="left-area">
                                <h4 class="heading">{{ __('App Secret') }} *</h4>
                                <p class="sub-heading">{{ __('Get Your App Secret from developers.facebook.com') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <input type="text" class="input-field" placeholder="{{ __('Enter App Secret') }}" name="fclient_secret" value="{{ $data->fclient_secret }}" required="">
                          </div>
                        </div>


                        <div class="row justify-content-center">
                          <div class="col-lg-12">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Website URL') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <input type="text" class="input-field" placeholder="{{ __('Website URL') }}"  value="{{ url('/') }}" readonly="">
                          </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-12">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Valid OAuth Redirect URI') }} *</h4>
                                <p class="sub-heading">{{ __('Copy this url and paste it to your Valid OAuth Redirect URI in developers.facebook.com.') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-12">
                            @php
                            $url = url('/auth/facebook/callback');
                            $url = preg_replace("/^http:/i", "https:", $url);
                            @endphp
                            <input type="text" class="input-field" placeholder="{{ __('Enter Site URL') }}" name="fredirect" value="{{$url}}" readonly>
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