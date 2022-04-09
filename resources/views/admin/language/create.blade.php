@extends('layouts.admin')

@section('styles')

<style type="text/css">
  
textarea.input-field {
  padding: 20px 20px 0px 20px;
  border-radius: 0px;
}

</style>

@endsection

@section('content')

            <div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{ __('Add Language') }} <a class="add-btn" href="{{route('admin.language.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                      <ul class="links">
                        <li>
                          <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li><a href="javascript:;">{{ __('Language Settings') }}</a></li>
                        <li>
                          <a href="{{ route('admin.language.index') }}">{{ __('Website Language') }}</a>
                        </li>
                        <li>
                          <a href="{{ route('admin.language.create') }}">{{ __('Add Language') }}</a>
                        </li>
                      </ul>
                  </div>
                </div>
              </div>
              <div class="add-product-content">
                <div class="row">
                  <div class="col-lg-12">
                    @include('includes.admin.form-error')
                    @include('includes.admin.form-success')
                    <div class="product-description">
                      <div class="body-area">
                      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                      <form id="geniusform" action="{{route('admin.language.store')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
            
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Language') }} *</h4>
                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="language" placeholder="{{ __('Language') }}" required="" value="English">
                          </div>
                        </div>
                        

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Language Direction') }} *</h4>

                            </div>
                          </div>
                          <div class="col-lg-7">
                            <select name="rtl" class="input-field" required="">
                              <option value="0">{{ __('Left To Right') }}</option>
                              <option value="1">{{ __('Right To Left') }}</option>
                            </select>
                          </div>
                        </div>
                      <hr>
                        
                        <h4 class="text-center">{{ __('SET LANGUAGE KEYS & VALUES') }}</h4>

                      <hr>
                        <div class="row">
                          <div class="col-lg-2">
                            <div class="left-area">

                            </div>
                          </div>
                         <div class="col-lg-8">
                            <div class="featured-keyword-area">
                              <div class="lang-tag-top-filds" id="lang-section">

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Search what you want</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Search what you want</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Trending Now!</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Trending Now!</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Login</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Login</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Register</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Register</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Dashboard</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Dashboard</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Logout</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Logout</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">FEATURED</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">FEATURED</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">RECENT</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">RECENT</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">TOP VIEWS</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">TOP VIEWS</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">CATEGORIES</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">CATEGORIES</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Follow Us</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Follow Us</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">TAGS</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">TAGS</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Poll</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Poll</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Previous Result</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Previous Result</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Vote</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Vote</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">View Result</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">View Result</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Newsletter</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Newsletter</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Subscribe to our newsletter to stay.</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Subscribe to our newsletter to stay.</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Enter Your Email Address</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Enter Your Email Address</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Subscribe</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Subscribe</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">TODAYS FEATURED NEWS</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">TODAYS FEATURED NEWS</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">View all</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">View all</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Image Gallery</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Image Gallery</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">More news</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">More news</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Load More</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Load More</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Sponsor Ad</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Sponsor Ad</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Home</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Home</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">News</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">News</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Leave A Comment</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Leave A Comment</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Read More</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Read More</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Share</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Share</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">This Category has no news.</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">This Category has no news.</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Writer Dashboard</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Writer Dashboard</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Follow</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Follow</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Followers</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Followers</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Post</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Post</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">This Author has no News.</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">This Author has no News.</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Member Since</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Member Since</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">This Search Key has no News.</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">This Search Key has no News.</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Loading</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Loading</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Login & Register</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Login & Register</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">LOGIN NOW</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">LOGIN NOW</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Type Email Address</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Type Email Address</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Type Password</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Type Password</textarea>
                                    </div>
                                  </div>
                                </div>


                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Remember Password</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Remember Password</textarea>
                                    </div>
                                  </div>
                                </div>


                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Or</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Or</textarea>
                                    </div>
                                  </div>
                                </div>


                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Sign In with social media</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Sign In with social media</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Signup Now</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Signup Now</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Full Name</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Full Name</textarea>
                                    </div>
                                  </div>
                                </div>


                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Email Address</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Email Address</textarea>
                                    </div>
                                  </div>
                                </div>


                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Phone Number</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Phone Number</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Password</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Password</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Confirm Password</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Confirm Password</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Enter Code</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Enter Code</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Correct Answer</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Correct Answer</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Wrong Answer</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Wrong Answer</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">This Date has no News.</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">This Date has no News.</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">This Sub Category has no News.</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">This Sub Category has no News.</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">This Tag has no News.</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">This Tag has no News.</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Loading</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Loading</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Loading</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Loading</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Loading</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Loading</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Loading</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Loading</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Loading</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Loading</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Loading</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Loading</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Loading</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Loading</textarea>
                                    </div>
                                  </div>
                                </div>

                                <div class="lang-area">
                                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <textarea name="keys[]" class="input-field" placeholder="Enter Language Key" required="">Loading</textarea>
                                    </div>

                                    <div class="col-lg-6">
                                      <textarea name="values[]" class="input-field" placeholder="Enter Language Value" required="">Loading</textarea>
                                    </div>
                                  </div>
                                </div>
                                
                              </div>
                              <a href="javascript:;" id="lang-btn" class="add-fild-btn"><i class="icofont-plus"></i> Add More Field</a>
                            </div>
                          </div>

                          <div class="col-lg-2">
                            <div class="left-area">

                            </div>
                          </div>

                        </div>
        
                        <hr>
                        <div class="row">
                          <div class="col-lg-5">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Create Language') }}</button>
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

<script type="text/javascript">
    "use strict";
    var lang = {
      'language_key':'{{ __('Enter Language Key') }}',
      'language_value':'{{ __('Enter Language Key') }}',
    }
</script>
<script src="{{asset('assets/admin/js/language.js')}}"></script>

@endsection