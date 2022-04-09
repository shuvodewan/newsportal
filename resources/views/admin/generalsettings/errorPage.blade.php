@extends('layouts.admin')

@section('content')

            <div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{__('Banner')}}</h4>
                      <ul class="links">
                        <li>
                          <a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}} </a>
                        </li>
                        <li>
                          <a href="javascript:;">{{__('General Settings')}}</a>
                        </li>
                        <li>
                          <a href="{{ route('admin.generalsettings.errorPage') }}">{{__('Error Page')}}</a>
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
                        {{csrf_field()}}
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="left-area">
                                <h4 class="heading">{{__('Current Image')}} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <div class="img-upload full-width-img">
                                <div id="image-preview" class="img-preview" style="background: url({{$data->error_photo ? asset('assets/images/'.$data->error_photo) : asset('assets/images/noimage.png') }});">
                                    <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>Upload Image</label>
                                    <input type="file" name="error_photo" class="img-upload" id="image-upload">
                                  </div>
                                  <p class="text">{{__('Prefered Size: (600x600) or Square Sized Image')}}</p>
                            </div>

                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-12">
                            <div class="left-area">
                              <h4 class="heading">
                                   {{__('Title')}} *
                              </h4>
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <textarea class="nic-edit" name="error_title" placeholder="Title">{{$data->error_title}}</textarea> 
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
                              <textarea class="nic-edit" name="error_text" placeholder="{{__('Description')}}">{{$data->error_text}}</textarea> 
                          </div>
                        </div>

                        <div class="row">
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