@extends('layouts.load')
@section('content')


    <div class="add-product-content p-0 shadow-none">
        @include('includes.admin.form-both')
        <div class="row">
            <div class="col-lg-12">
                <div class="product-description">
                    <div class="body-area  shadow-none">
                    <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                    <form id="geniusformdata" action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="row">
                            <div class="col-lg-12">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Staff Profile Image') }} *</h4>
                            </div>
                            </div>
                            <div class="col-lg-12">
                            <div class="img-upload">
                                <div id="image-preview" class="img-preview" style="background: url({{ asset('assets/images/noimage.png') }});">
                                    <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ __('Upload Image') }}</label>
                                    <input type="file" name="photo" class="img-upload" id="image-upload">
                                    </div>
                            </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                        <h4 class="heading">{{ __('Name') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <input type="text" class="input-field" name="name" placeholder="{{ __("User Name") }}" required="" value="">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                        <h4 class="heading">{{ __("Email") }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <input type="email" class="input-field" name="email" placeholder="{{ __("Email Address") }}" required="" value="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                        <h4 class="heading">{{ __("Phone") }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <input type="text" class="input-field" name="phone" placeholder="{{ __("Phone Number") }}" required="" value="">
                            </div>
                        </div>


                        <div class="row">
                                <div class="col-lg-12">
                                    <div class="left-area">
                                            <h4 class="heading">{{ __("Role") }} *</h4>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                        <select  name="role_id" required="">
                                        <option value="">{{ __('Select Role') }}</option>
                                            @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="left-area">
                                        <h4 class="heading">{{ __("Password") }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <input type="password" class="input-field" name="password" placeholder="{{ __("Password") }}" required="" value="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                            <button class="addProductSubmit-btn" type="submit">{{ __("Create Staff") }}</button>
                            </div>
                        </div>

                    </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection