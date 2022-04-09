@extends('layouts.admin')

@section('styles')
    
@endsection

@section('content')
<div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{__('Tags')}}</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}} </a>
                      </li>
                      <li>
                        <a href="javascript:;">{{__('General Settings')}}</a>
                      </li>
                      <li>
                        <a href="{{ route('admin.generalsettings.popularTags')}}">{{__('Popular Tags')}}</a>
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
                                    <label for="tags">{{ __('Tags') }} <small>{{ __('(Seperated By Comma(,))') }}</small></label>
                                </h4>
                            </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="tawk-area">
                                    <input type="text"  placeholder="{{ __('Tags') }}" class="tags" id="tags"  name="tags" value="{{$data->tags}}">
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

@section('scripts')
<script src="{{asset('assets/admin/js/tagify.js')}}"></script>
<script>
    $('.tags').tagify();
</script>
@endsection
