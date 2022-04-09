@extends('layouts.admin')

@section('content')

<div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{__('Website Footer')}}</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}} </a>
                      </li>
                      <li>
                        <a href="javascript:;">{{__('General Settings')}}</a>
                      </li>
                      <li>
                        <a href="{{ route('admin.generalsettings.footer')}}">{{__('Footer')}}</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="add-product-content">
                @include('includes.admin.form-both')
                <div class="row justify-content-center">
                  <div class="col-lg-8">
                    <div class="product-description">
                      <div class="body-area">
                        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                      <form class="uplogo-form" id="geniusform" action="{{route('admin.generalsettings.update')}}" method="POST" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <div class="row justify-content-center">
                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                        {{__('Copyright Text')}} *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                  
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                  <textarea name="copyright_text" required="">{{$data->copyright_text}}</textarea>
                                  </div>
                              </div>
                            </div>
                          <div class="row justify-content-center">
                              <div class="col-lg-12">
                                <div class="left-area">
                                    <h4 class="heading">
                                        {{__('Footer Text')}} *
                                        <p class="sub-heading">{{(__('In Any Language'))}}</p>
                                    </h4>
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="tawk-area">
                                    <textarea class="nic-edit"  name="footer_text">{{$data->footer_text}}</textarea>
                                  </div>
                              </div>
                            </div>


                        <div class="row justify-content-center">
                          <div class="col-lg-12">
                            <button class="addProductSubmit-btn" type="submit">{{__('Save')}}</button>
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