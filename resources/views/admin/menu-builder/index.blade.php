@extends('layouts.admin')

@section('styles')
<link href="{{asset('assets/admin/css/menu-sort.css')}}" rel="stylesheet"/>
@endsection
@section('content')
<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Menu Builder') }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}">{{ __('Menu Builder') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="product-area">
        @include('includes.admin.form-success')
        @include('includes.admin.flash-message')
        <div class="container box">
            <ul class="list-unstyled" id="page_list">
                @foreach ($menuBuilders as $category)
                    <li id="{{$category->id}}">{{$category->title}}</li>
                @endforeach
            </ul>
           </div>
    </div>
</div>


@endsection

@section('scripts')
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="{{asset('assets/admin/js/menu.js')}}"></script>

@endsection
