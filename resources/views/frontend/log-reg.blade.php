@extends('layouts.front')


@section('contents')

<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="pages">
                    <li>
                        <a href="#">
                            {{__('Login & Register')}}
                        </a>
                    </li>
                    <li class="active">
                        <a href="#">
                            {{__('Login & Register')}}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area Start -->

<!-- Log & Register Area Start -->
<section class="login-signup">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <nav class="comment-log-reg-tabmenu core-nav">
                    <div class="full-container">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link login active" id="nav-log-tab" data-toggle="tab" href="#nav-log"
                                role="tab" aria-controls="nav-log" aria-selected="true">
                                {{__('Login')}}
                            </a>
                            <a class="nav-item nav-link" id="nav-reg-tab" data-toggle="tab" href="#nav-reg" role="tab"
                                aria-controls="nav-reg" aria-selected="false">
                                {{__('Register')}}
                            </a>
                        </div>
                    </div>
                </nav>
                <div class="dropdown-overlay"></div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-log" role="tabpanel" aria-labelledby="nav-log-tab">
                        <div class="login-area">
                            <div class="log-reg-header-area">
                                <h4 class="title">{{__('LOGIN NOW')}}</h4>
                            </div>
                            <div class="login-form signin-form">
                                <form class="mloginform" action="{{ route('front.login') }}" method="POST">
                                    @include('includes.validation.form_validation')
                                    @csrf
                                    <div class="form-input">
                                        <input type="email" name="email" value=""
                                            placeholder="{{__('Type Email Address')}}" required="">
                                        <i class="icofont-user-alt-5"></i>
                                    </div>
                                    <div class="form-input">
                                        <input type="password" class="Password" value="" name="password"
                                            placeholder="{{__('Type Password')}}" required="">
                                        <i class="icofont-ui-password"></i>
                                    </div>
                                    <div class="form-forgot-pass">
                                        <div class="left">
                                            <input type="checkbox" name="remember" id="mrp">
                                            <label for="mrp">{{__('Remember Password')}}</label>
                                        </div>
                                        <div class="right">
                                            <a href="https://geniusocean.com/demo/geniuscart/user/forgot">
                                                {{__('Forgot Password')}}?
                                            </a>
                                        </div>
                                    </div>
                                    {{-- <input type="hidden" name="modal" value="1"> --}}
                                    <input class="mauthdata" type="hidden" value="Authenticating...">
                                    <button type="submit" class="submit-btn">{{__('Login')}}</button>
                                    <div class="log-reg-social-area">
                                        <h3 class="title">{{__('Or')}}</h3>
                                        <p class="text">{{__('Sign In with social media')}}</p>
                                        <ul class="log-reg-social-links">
                                            <li>
                                                <a href="{{ route('social.provider','facebook') }}">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('social.provider','google') }}">
                                                    <i class="fab fa-google-plus-g"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-reg" role="tabpanel" aria-labelledby="nav-reg-tab">
                        <div class="login-area signup-area">
                            <div class="log-reg-header-area">
                                <h4 class="title">{{__('Signup Now')}}</h4>
                            </div>
                            <div class="login-form signup-form">
                                @include('includes.validation.form_validation')
                                <form class="registerform" action="{{ route('front.register') }}" method="POST">
                                    @csrf
                                    <div class="form-input">
                                        <input type="text" class="User Name" name="name" placeholder="{{__('Full Name')}}"
                                            required="">
                                        <i class="icofont-user-alt-5"></i>
                                    </div>

                                    <div class="form-input">
                                        <input type="email" class="User Name" name="email" placeholder="{{__('Email Address')}}"
                                            required="">
                                        <i class="icofont-email"></i>
                                    </div>

                                    <div class="form-input">
                                        <input type="text" class="User Name" name="phone" placeholder="{{__('Phone Number')}}"
                                            required="">
                                        <i class="icofont-phone"></i>
                                    </div>

                                    <div class="form-input">
                                        <input type="password" class="Password" name="password" placeholder="{{__('Password')}}"
                                            required="">
                                        <i class="icofont-ui-password"></i>
                                    </div>

                                    <div class="form-input">
                                        <input type="password" class="Password" name="password_confirmation"
                                            placeholder="{{__('Confirm Password')}}" required="">
                                        <i class="icofont-ui-password"></i>
                                    </div>


                                    <ul class="captcha-area">
                                        <li>
                                            <p><img class="codeimg1"
                                                    src="{{asset("assets/images/capcha_code.png")}}"
                                                    alt=""> <i class="fas fa-sync-alt pointer refresh_code"></i></p>
                                        </li>
                                    </ul>

                                    <div class="form-input">
                                        <input type="text" class="Password" name="codes" placeholder="{{__('Enter Code')}}"
                                            required="">
                                        <i class="icofont-refresh"></i>
                                    </div>

                                    <input class="mregdata" type="hidden" value="Registering...">
                                    <button type="submit" class="submit-btn">{{__('Register')}}</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
<!-- Log & Register Area End -->
@endsection

@push('js')
<script src="{{asset('assets/front/js/login.js')}}"></script>
@endpush
