@extends('layouts.admin')

@section('content')

<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Widget Settings') }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}">{{ __('Widget Settings') }}</a>
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
                    @include('includes.admin.form-error')
                    <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                     <form id="geniusformdata" action="{{ route('widget.settings.update')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                    <div class="row justify-content-center">
                        <div class="col-lg-4 d-flex justify-content-between">
                            <label class="control-label">{{ __('Feature/Recent/Top News(home page)') }} *</label>
                            <label class="switch">
                            <input type="checkbox" name="feature_inhome" value="1" {{$data->feature_inhome == 1 ? 'checked': ''}}>
                            <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4 d-flex justify-content-between">
                            <label class="control-label">{{ __('Categories(home page)') }} *</label>
                            <label class="switch">
                            <input type="checkbox" name="category_inhome" value="1" {{$data->category_inhome == 1 ? 'checked': ''}}>
                            <span class="slider round"></span>
                            </label>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-4 d-flex justify-content-between">
                            <label class="control-label">{{ __('Follow Us(home page)') }} *</label>
                            <label class="switch">
                            <input type="checkbox" name="follow_inhome" value="1" {{$data->follow_inhome == 1 ? 'checked': ''}}>
                            <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4 d-flex justify-content-between">
                            <label class="control-label">{{ __('Tags(home page)') }} *</label>
                            <label class="switch">
                            <input type="checkbox" name="tag_inhome" value="1" {{$data->tag_inhome == 1 ? 'checked': ''}}>
                            <span class="slider round"></span>
                            </label>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-4 d-flex justify-content-between">
                            <label class="control-label">{{ __('Poll(home page)') }} *</label>
                            <label class="switch">
                            <input type="checkbox" name="poll_inhome" value="1" {{$data->poll_inhome == 1 ? 'checked': ''}}>
                            <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4 d-flex justify-content-between">
                            <label class="control-label">{{ __('Calendar(home page)') }} *</label>
                            <label class="switch">
                            <input type="checkbox" name="calendar_inhome" value="1" {{$data->calendar_inhome == 1 ? 'checked': ''}}>
                            <span class="slider round"></span>
                            </label>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-4 d-flex justify-content-between">
                            <label class="control-label">{{ __('NewsLetter(home page)') }} *</label>
                            <label class="switch">
                            <input type="checkbox" name="newsletter_inhome" value="1" {{$data->newsletter_inhome == 1 ? 'checked': ''}}>
                            <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4 d-flex justify-content-between">
                            <label class="control-label">{{ __('Category(category page)') }} *</label>
                            <label class="switch">
                            <input type="checkbox" name="category_incategory" value="1" {{$data->category_incategory == 1 ? 'checked': ''}}>
                            <span class="slider round"></span>
                            </label>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-4 d-flex justify-content-between">
                            <label class="control-label">{{ __('NewsLetter(category page)') }} *</label>
                            <label class="switch">
                            <input type="checkbox" name="newsletter_incategory" value="1" {{$data->newsletter_incategory == 1 ? 'checked': ''}}>
                            <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4 d-flex justify-content-between">
                            <label class="control-label">{{ __('Calendar(category page)') }} *</label>
                            <label class="switch">
                            <input type="checkbox" name="calendar_incategory" value="1" {{$data->calendar_incategory == 1 ? 'checked': ''}}>
                            <span class="slider round"></span>
                            </label>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-4 d-flex justify-content-between">
                            <label class="control-label">{{ __('Category(Details page)') }} *</label>
                            <label class="switch">
                            <input type="checkbox" name="category_indetails" value="1" {{$data->category_indetails == 1 ? 'checked': ''}}>
                            <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4 d-flex justify-content-between">
                            <label class="control-label">{{ __('NewsLetter(Details page)') }} *</label>
                            <label class="switch">
                            <input type="checkbox" name="newsletter_indetails" value="1" {{$data->newsletter_indetails == 1 ? 'checked': ''}}>
                            <span class="slider round"></span>
                            </label>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-4 d-flex justify-content-between">
                            <label class="control-label">{{ __('Calendar(Details page)') }} *</label>
                            <label class="switch">
                            <input type="checkbox" name="calendar_indetails" value="1" {{$data->calendar_indetails == 1 ? 'checked': ''}}>
                            <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4 d-flex justify-content-between"></div>
                    </div>


                    <div class="row">
                        <div class="col-lg-4">
                            <div class="left-area">

                            </div>
                        </div>
                        <div class="col-lg-7">
                            <button class="addProductSubmit-btn"
                                type="submit">{{ __('Update') }}</button>
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

@endsection
