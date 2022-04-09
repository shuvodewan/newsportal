@extends('layouts.admin')

@section('content')
<div class="content-area">
    <div class="row row-cards-one">
        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bg1">
                <div class="left">
                    <h5 class="title">{{ __('Post') }} </h5>
                    @php
                        $user = Auth::guard('admin')->user()->role;
                    @endphp
                    @if ($user->name != 'admin' && $user->name != 'moderator')
                        <span class="number">{{ $author_post }}</span>
                    @else 
                        <span class="number">{{ $total_post }}</span>
                    @endif
                    <a href="{{ route('post.index') }}" class="link">{{ __('View All') }}</a>
                </div>
                <div class="right d-flex align-self-center">
                    <div class="icon">
                        <i class="fab fa-blogger-b"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bg2">
                <div class="left">
                    <h5 class="title">{{ __('Pending Post') }}</h5>
                    @if ($user->name != 'admin' && $user->name != 'moderator')
                        <span class="number">{{ $author_pending }}</span>
                    @else 
                        <span class="number">{{ $pending_posts }}</span>
                    @endif
                    <a href="{{ route('pending.index') }}" class="link">{{ __('View All') }}</a>
                </div>
                <div class="right d-flex align-self-center">
                    <div class="icon">
                        <i class="fas fa-hourglass"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bg3">
                <div class="left">
                    <h5 class="title">{{ __('Draft') }}</h5>
                    <span class="number">{{ $drafts }}</span>
                    <a href="{{ route('draft.index') }}" class="link">{{ __('View All') }}</a>
                </div>
                <div class="right d-flex align-self-center">
                    <div class="icon">
                        <i class="fas fa-pen-square"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bg4">
                <div class="left">
                    <h5 class="title">{{ __('Schedule Post') }}</h5>
                    <span class="number">{{ $schedules }}</span>
                    <a href="{{ route('schedule.index') }}" class="link">{{ __('View All') }}</a>
                </div>
                <div class="right d-flex align-self-center">
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bg5">
                <div class="left">
                    <h5 class="title">{{ __('Rss Feeds') }}</h5>
                    <span class="number">{{ $rss}}</span>
                    <a href="{{ route('rss.index') }}" class="link">{{ __('View All') }}</a>
                </div>
                <div class="right d-flex align-self-center">
                    <div class="icon">
                        <i class="fas fa-rss"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bg6">
                <div class="left">
                    <h5 class="title">{{ __('Polls') }}</h5>
                    <span class="number">{{ $polls}}</span>
                    <a href="{{ route('addPolls.index') }}" class="link">{{ __('View All') }}</a>
                </div>
                <div class="right d-flex align-self-center">
                    <div class="icon">
                        <i class="fas fa-poll"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')

@endsection