@extends('layouts.admin')
@section('content')

          <div class="content-area">
            <div class="mr-breadcrumb">
              <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Website Loader') }}</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                      </li>
                      <li>
                        <a href="javascript:;">{{ __('General Settings') }}</a>
                      </li>
                      <li>
                        <a href="{{ route('admin.generalsettings.loader') }}">{{ __('Website Loader') }}</a>
                      </li>
                    </ul>
                </div>
              </div>
            </div>
            <div class="add-logo-area">
              @include('includes.admin.form-both')
              <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="special-box">
                        <div class="heading-area">
                            <h4 class="title">
                              {{ __('Website Loader') }}
                            </h4>
                        </div>
                      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                        <form class="uplogo-form" id="geniusform" action="{{ route('admin.generalsettings.update') }}" method="POST" enctype="multipart/form-data">
                          {{csrf_field()}}   
  
                          <div class="currrent-logo">
                            <h4 class="title">
                              {{ __('Current Loader') }} :
                            </h4>
                            <img src="{{ $data->loader ? asset('assets/images/'.$data->loader):asset('assets/images/noimage.png')}}" alt="">
                          </div>
                          <div class="set-logo">
                            <h4 class="title">
                              {{ __('Set New Loader') }} :
                            </h4>
                            <input class="img-upload1" type="file" name="loader">
                          </div>

             


                          <div class="submit-area mb-4">
                            <button type="submit" class="submit-btn">{{ __('Save') }}</button>
                          </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="special-box">
                        <div class="heading-area">
                            <h4 class="title">
                              {{ __('Admin Loader') }}
                            </h4>
                        </div>

                        <form class="uplogo-form" id="geniusform" action="{{ route('admin.generalsettings.update') }}" method="POST" enctype="multipart/form-data">
                          {{csrf_field()}}   
   
        
                          <div class="currrent-logo">
                            <h4 class="title">
                              {{ __('Current Loader') }} :
                            </h4>

                            <img src="{{ $data->admin_loader ? asset('assets/images/'.$data->admin_loader):asset('assets/images/noimage.png')}}" alt="">
                          </div>
                          
                          <div class="set-logo">
                            <h4 class="title">
                              {{ __('Set New Loader') }} :
                            </h4>
                            <input class="img-upload1" type="file" name="admin_loader">
                          </div>


                          <div class="submit-area mb-4">
                            <button type="submit" class="submit-btn">{{ __('Save') }}</button>
                          </div>
                        </form>
                    </div>
                </div>
              </div>
            </div>
          </div>

@endsection