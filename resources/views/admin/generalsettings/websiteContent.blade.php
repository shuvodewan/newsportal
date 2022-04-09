@extends('layouts.admin')

@section('content')

<div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{ __('Website Contents') }}</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                      </li>
                      <li>
                        <a href="javascript:;">{{ __('General Settings') }}</a>
                      </li>
                      <li>
                        <a href="">{{ __('Website Contents') }}</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="add-product-content">
                @include('includes.admin.form-both')
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                      <form class="uplogo-form" id="geniusform" action="{{ route('admin.generalsettings.update')}}"  method="POST" enctype="multipart/form-data">
                          {{ csrf_field() }}

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Website Title') }} *
                                  </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="{{ __('Write Your Site Title Here') }}" name="title" value="{{$data->title}}" required="">
                          </div>
                        </div>


                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Base Color') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="form-group">
                                <div class="input-group colorpicker-component cp">
                                <input type="text" class="form-control input-field color-field cp" name="theme_color" value="{{$data->theme_color}}"/>
                                  <span class="input-group-addon"><i></i></span>
                                </div>
                              </div>

                          </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Footer Color') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="form-group">
                                <div class="input-group colorpicker-component cp">
                                  <input type="text" class="form-control input-field color-field cp" name="footer_color" value="{{$data->footer_color}}" />
                                  <span class="input-group-addon"><i></i></span>
                                </div>
                              </div>
                          </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Copyright Color') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="form-group">
                                <div class="input-group colorpicker-component cp">
                                <input type="text" class="form-control input-field color-field cp" name="copyright_color" value="{{$data->copyright_color}}"/>
                                  <span class="input-group-addon"><i></i></span>
                                </div>
                              </div>

                          </div>
                        </div>


                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                              <h4 class="heading">
                                  {{ __('Tawk.to') }}
                              </h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="action-list">
                                  <select class="process select droplinks {{ $data->is_talkto == 1 ? 'drop-success' : 'drop-danger' }}" name="is_talkto" id="is_talkto">
                                    <option value="1" {{ $data->is_talkto == 1 ? 'selected' : '' }}>{{ __('Activated') }}</option>
                                    <option value="0" {{ $data->is_talkto == 0 ? 'selected' : '' }}>{{ __('Deactivated') }}</option>
                                  </select>
                                </div>
                          </div>
                        </div>

                          <div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                  <h4 class="heading">
                                      {{ __('Tawk.to Widget Code') }} *
                                  </h4>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                    <input type="text" class="input-field" placeholder="{{ __('Tawk to id here') }}" name="tawk_to" value="{{$data->tawk_to}}" required="">
                                  </div>
                              </div>
                            </div>


                        <div class="row justify-content-center">
                            <div class="col-lg-3">
                              <div class="left-area">
                                <h4 class="heading">
                                    {{ __('Disqus') }}
                                </h4>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="action-list">
                                <select class="process select droplinks {{ $data->is_disqus == 1 ? 'drop-success' : 'drop-danger' }}" name="is_disqus" id="is_disqus">
                                  <option value="1" {{ $data->is_disqus == 1 ? 'selected' : '' }}>{{ __('Activated') }}</option>
                                  <option value="0" {{ $data->is_disqus == 0 ? 'selected' : '' }}>{{ __('Deactivated') }}</option>
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="row justify-content-center">
                              <div class="col-lg-3">
                                <div class="left-area">
                                  <h4 class="heading">
                                      {{ __('Disqus website shortname') }} *
                                  </h4>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="tawk-area">
                                    <input type="text" class="input-field" placeholder="{{ __('Disqus website shortname here') }}" name="disqus" value="{{$data->disqus}}" required="">
                                  </div>
                              </div>
                            </div>


                            <div class="row justify-content-center">
                            <div class="col-lg-3">
                              <div class="left-area">
                                  <h4 class="heading">{{ __('TimeZone') }} *
                                    </h4>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              @php
                                $timezone_identifiers =  
                                    DateTimeZone::listIdentifiers(DateTimeZone::ALL); 
                                  
                                echo "<select name='time_zone'>"; 
                                  
                                echo "<option disabled selected> 
                                        Please Select Timezone 
                                      </option>"; 
                                  
                                $n = 425; 
                                for($i = 0; $i < $n; $i++) { 
                                  if($data->time_zone == $timezone_identifiers[$i]){
                                        $msg = 'selected';
                                    }else{
                                        $msg = '';
                                    }
                                    echo "<option value='" . $timezone_identifiers[$i] ."' ".$msg.">" . $timezone_identifiers[$i] . "</option>"; 
                                } 
                                  
                                echo "</select>"; 
                              @endphp
                            </div>
                          </div>


                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">

                            </div>
                          </div>
                          <div class="col-lg-6">
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

@section('scripts')
<script src="{{asset('assets/admin/js/notify.js')}}"></script>
<script src="{{asset('assets/admin/js/distawk.js')}}"></script>

@endsection
