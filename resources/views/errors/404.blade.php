@extends('layouts.front')

@push('css')

@endpush

@section('contents')

  <!-- Breadcrumb Area Start -->
  <div class="breadcrumb-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="pagetitle">
            {{ __("404") }}
          </h1>

          <ul class="pages">
                
              <li>
                <a href="{{ route('frontend.index') }}">
                  {{ __("Home") }}
                </a>
              </li>
              <li>
                <a href="javascript:;">
                  {{ __("404") }}
                </a>
              </li>

          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb Area End -->


<section class="fourzerofour">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="content">
            <img src="{{ asset('assets/images/'.$gs->error_photo)}}" alt="">

              <p>{!! $gs->error_title !!}</p>
              <p>{!! $gs->error_text !!}</p>
            <a class="mybtn1 pt-3" href="{{ route('frontend.index') }}">{{ __("Back To Home Page") }}</a>
          </div>
        </div>
      </div>
    </div>
  </section>


@endsection