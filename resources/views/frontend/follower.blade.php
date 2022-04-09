@extends('layouts.front')

@push('css')

@endpush

@section('contents')
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bc-bg-img">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="pages">
                    <li>
                        <a href="#">
                            {{__('Home')}}
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            {{__('News')}}
                        </a>
                    </li>
                    <li class="active">
                        <a href="#">
                            {{__('follower')}}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area Start -->

<div class="vendor-profile-top">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="organize-by">
                    <div class="organizer-profile">
                        <div class="left">
                            @if ($admin->photo)
                            <img src="{{asset('assets/images/admin/'.$admin->photo)}}" alt="">
                            @endif
                        </div>
                        <div class="right">
                            <a href="#">
                                <h5 class="title">
                                    {{$admin->name}}
                                </h5>
                            </a>
                            <p class="date">
                                {{__('Member Since')}} {{$admin->created_at->format('Y')}}
                            </p>
                            <a href="#" class="btn btn-outline-primary btn-sm mr-1"><i class="fas fa-tachometer-alt"></i> Writer Dashboard</a>
                            <a href="{{ route('front.followerCreate',$admin->id) }}" class="btn btn-outline-success btn-sm mr-1">Follow</a>
                            <a href="{{ route('front.following',$admin->name)}}" class="btn btn-outline-info btn-sm ">Followers</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <div class="t-info-list">
                    <div class="pack-count">
                        {{ count($all_posts)}}
                        <small>{{__('Post')}}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="vendor-profile-top shadow-none">
    <div class="container">
        <div class="row">
            @foreach ($followers as $follower)
            @php
                $admin = \App\Models\Admin::find($follower->follower_id)
            @endphp
                @if ($admin)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="organize-by border p-3">
                            <div class="organizer-profile">
                                <div class="left">
                                    @if ($admin->photo)
                                        <img src="{{asset('assets/images/admin/'.$admin->photo)}}" alt="">
                                    @else 
                                        <img src="{{asset('assets/images/noimage.png/')}}" alt="">
                                    @endif
                                </div>
                                <div class="right">
                                    <a href="{{ route('front.authorProfile',$admin->name)}}">
                                        <h5 class="title">
                                            {{$admin->name}}
                                        </h5>
                                    </a>
                                    <p class="date">
                                        {{__('Member Since')}} {{$admin->created_at->format('Y')}}
                                    </p>
                                    <a href="{{ route('front.followerCreate',$admin->id) }}" class="btn btn-outline-success btn-sm mr-1">Follow</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush
