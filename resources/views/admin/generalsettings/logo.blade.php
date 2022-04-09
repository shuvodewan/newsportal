@extends('layouts.admin')
@section('content')

          <div class="content-area">
            <div class="mr-breadcrumb">
              <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Website Logo') }}</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                      </li>
                      <li>
                        <a href="javascript:;">{{ __('General Settings') }}</a>
                      </li>
                      <li>
                        <a href="{{ route('admin.generalsettings.logo') }}">{{ __('Website Logo') }}</a>
                      </li>
                    </ul>

                </div>
              </div>
            </div>
            <div class="add-logo-area">
              @include('includes.admin.form-both')
              <div class="row justify-content-center">
                <div class="col-xl-4 col-md-6">
                    <div class="special-box bg-gray">
                        <div class="heading-area">
                            <h4 class="title">
                              {{ __('Header Logo') }}
                            </h4>
                        </div>
                        <form class="uplogo-form" id="geniusform" action="{{ route('admin.generalsettings.update') }}" method="POST" enctype="multipart/form-data">
                          {{csrf_field()}} 
                          

                          <div class="currrent-logo">
                            <img src="{{ $data->logo ? asset('assets/images/logo/'.$data->logo):asset('assets/images/noimage.png')}}" alt="">
                          </div>
                          <div class="set-logo">
                            <input class="img-upload1" type="file" name="logo">
                          </div>

                          <div class="submit-area mb-4">
                            <button type="submit" class="submit-btn">{{ __('Save') }}</button>
                          </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                  <div class="special-box  bg-gray">
                      <div class="heading-area">
                          <h4 class="title">
                            {{ __('Footer Logo') }}
                          </h4>
                      </div>
                      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                      <form class="uplogo-form" id="geniusform" action="{{ route('admin.generalsettings.update') }}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}   

                        <div class="currrent-logo">
                          <img src="{{$data->logo ? asset('assets/images/logo/'.$data->footer_logo):asset('assets/images/noimage.png')}}" alt="">
                        </div>
                        <div class="set-logo">
                          <input class="img-upload1" type="file" name="footer_logo">
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