@extends('layouts.front')

@push('css')

@endpush

@section('contents')
    	<!-- Breadcrumb Area Start -->
	<div class="breadcrumb-area">
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
								{{ $gallery->album_name }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Breadcrumb Area Start -->








<!-- Gallery Shuffle Starts -->
 <div class="container">
<!-- partial:index.partial.html -->

<!-- Filtering buttons -->
<div class="button-area filters">
    @if (count($gallery->categories)>0)
        @foreach ($gallery->categories as $category)
            <label class="button">
            <input type="checkbox" value="group{{$category->id}}" />{{$category->name}}
            </label>
        @endforeach
    @endif
  </div>
  
  <!-- Masonry contents -->
  <div id="mnsry_container">
    @foreach ($gallery->categories as $category)
        @foreach ($category->galleries as $gallery)
            <article class="item group{{$category->id}}">
                <a class="d-block single-item" href="{{asset('assets/images/image-gallery/'.$gallery->gallery)}}" title="{{$category->name}}">
                    <h1>{{$category->name}}</h1>
                    <img src="{{asset('assets/images/image-gallery/'.$gallery->gallery)}}" />
                </a>
            </article>
        @endforeach
    @endforeach
  </div>
  
  <!--Loading message -->
  <div id="loading_msg">{{__('Loading')}}...</div>
  <!-- partial -->
 </div> 
  <!-- Gallery Shuffle Ends -->
@endsection

@push('js')
    <script src="{{asset('assets/front/js/go-masonry.js')}}"></script>
    <script src="{{asset('assets/front/js/magnific-popup.js')}}"></script>
    <script src="{{asset('assets/front/js/multipleFilterMasonry.js')}}"></script>
    <script src="{{asset('assets/front/js/masonry.pkgd.min.js')}}"></script>

@endpush