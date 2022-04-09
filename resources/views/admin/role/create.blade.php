@extends('layouts.admin')

@section('content')

            <div class="content-area">
                <div class="mr-breadcrumb">
                    <div class="row">
                      <div class="col-lg-12">
                          <h4 class="heading">{{ __('Add Role') }} <a class="add-btn" href="{{route('admin.role.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                          <ul class="links">
                            <li>
                              <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                            </li>
                            <li>
                              <a href="{{ route('admin.role.index') }}">{{ __('Manage Roles') }}</a>
                            </li>
                            <li>
                              <a href="{{ route('admin.role.create') }}">{{ __('Add Role') }}</a>
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
                      <form id="geniusform" action="{{route('admin.role.store')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
            
                        <div class="row">
                          <div class="col-lg-2">
                            <div class="left-area">
                                <h4 class="heading">{{ __("Name") }} *</h4>
                                <p class="sub-heading">{{ __("(In Any Language)") }}</p>
                            </div>
                          </div>
                          <div class="col-lg-10">
                            <input type="text" class="input-field" name="name" placeholder="{{ __('Name') }}" value="">
                          </div>
                        </div>

                        <hr>
                        <h5 class="text-center">{{ __('Permissions') }}</h5>
                        <hr>

                        <div class="row justify-content-center">
                          <div class="col-lg-4 d-flex justify-content-between">
                            <label class="control-label">{{ __('Menu Builder') }} *</label>
                            <label class="switch">
                              <input type="checkbox" name="section[]" value="menu_builder" >
                              <span class="slider round"></span>
                            </label>
                          </div>
                          <div class="col-lg-2"></div>
                          <div class="col-lg-4 d-flex justify-content-between">
                            
                          </div>
                      </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Pages') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="pages" >
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Categories') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="categories">
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>


                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Add Post') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="add_post" >
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Add Gallery') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="add_gallery">
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Posts') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="posts" >
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Schedule Post') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="schedule_post">
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Drafts') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="drafts" >
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Rss Feeds') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="rss_feeds">
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Polls') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="polls" >
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Widgets') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="widgets">
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-4 d-flex justify-content-between">
                            <label class="control-label">{{ __('Create Ads') }} *</label>
                            <label class="switch">
                              <input type="checkbox" name="section[]" value="create_ads" >
                              <span class="slider round"></span>
                            </label>
                          </div>
                          <div class="col-lg-2"></div>
                          <div class="col-lg-4 d-flex justify-content-between">
                            <label class="control-label">{{ __('NewsLetter') }} *</label>
                            <label class="switch">
                              <input type="checkbox" name="section[]" value="newsLetter">
                              <span class="slider round"></span>
                            </label>
                          </div>
                      </div>

                      <div class="row justify-content-center">
                        <div class="col-lg-4 d-flex justify-content-between">
                          <label class="control-label">{{ __('Contact Messages') }} *</label>
                          <label class="switch">
                            <input type="checkbox" name="section[]" value="contact_messages" >
                            <span class="slider round"></span>
                          </label>
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4 d-flex justify-content-between">
                          <label class="control-label">{{ __('Languages') }} *</label>
                          <label class="switch">
                            <input type="checkbox" name="section[]" value="languages">
                            <span class="slider round"></span>
                          </label>
                        </div>
                    </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('General Settings') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="general_settings" >
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Social Settings') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="social_settings">
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-4 d-flex justify-content-between">
                            <label class="control-label">{{ __('SEO Tools') }} *</label>
                            <label class="switch">
                              <input type="checkbox" name="section[]" value="seo_tools">
                              <span class="slider round"></span>
                            </label>
                          </div>

                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Email Settings') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="emails_settings">
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-4 d-flex justify-content-between">
                            <label class="control-label">{{ __('Role Management') }} *</label>
                            <label class="switch">
                              <input type="checkbox" name="section[]" value="role_management" >
                              <span class="slider round"></span>
                            </label>
                          </div>

                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Font Option') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="font_option">
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('User Management') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="user_management">
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Cache Management') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="cache_management">
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-4 d-flex justify-content-between">
                            <label class="control-label">{{ __('Administration Management') }} *</label>
                            <label class="switch">
                              <input type="checkbox" name="section[]" value="administration_management">
                              <span class="slider round"></span>
                            </label>
                          </div>
                          <div class="col-lg-2"></div>
                          <div class="col-lg-4 d-flex justify-content-between">
                            
                          </div>
                       </div>

                        <div class="row">
                          <div class="col-lg-5">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Create Role') }}</button>
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