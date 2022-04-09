@extends('layouts.admin')

@section('content')

<div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{__('Website Contents')}}</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}} </a>
                      </li>
                      <li>
                        <a href="javascript:;">{{__('SEO Tools')}}</a>
                      </li>
                      <li>
                        <a href="{{ route('seo.meta.keywords') }}">{{__('Meta Keywords')}}</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="add-product-content">
                @include('includes.admin.form-success')
                @include('includes.admin.flash-message')
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                        <div class="gocover" style=""></div>
                        <form class="uplogo-form" id="geniusform" action="{{ route('seo.update') }}" method="POST" enctype="multipart/form-data">
                          {{csrf_field()}} 
                          <div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                  <h4 class="heading">
                                    {{__('Meta Keywords')}} *
                                  </h4>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                    <textarea  name="meta_keys">{{ $data->meta_keys}}</textarea>
                                  </div>
                              </div>
                            </div>
                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <button class="addProductSubmit-btn" type="submit">Save</button>
                          </div>
                        </div>
                     </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

@endsection