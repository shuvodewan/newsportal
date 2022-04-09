<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@if (request()->is('details/*'))
	@if ($data->meta_tag && $data->tags)
		<meta name="description" content="{{$data->meta_tag}}">
		<meta name="keywords" content="{{$data->tags}}">
	@endif
	@endif
	@if ($gs->title)
		<title> {{ $gs->title }}</title>
	@endif

	@if ($default_font->font_value)
		<link href="https://fonts.googleapis.com/css?family={{ $default_font->font_value }}&display=swap" rel="stylesheet">
	@else 
		<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
	@endif
	<!-- favicon -->
	<link rel="shortcut icon" href="{{asset('assets/images/'.$gs->favicon)}}" type="image/x-icon">
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
	<!-- Plugin css -->
	<link rel="stylesheet" href="{{asset('assets/front/css/plugin.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/go-masonry.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/magnific-popup.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/pignose.calender.css')}}">
	<!-- stylesheet -->
	<link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
	<!-- custom stylesheet -->
	<link rel="stylesheet" href="{{asset('assets/front/css/custom.css')}}">
	<!-- responsive -->
    <link rel="stylesheet" href="{{asset('assets/front/css/responsive.css')}}">
	{{-- <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css"> --}}

	@if(DB::table('languages')->where('is_default','=',1)->first()->rtl == 1)
		<link rel="stylesheet" href="{{asset('assets/front/css/rtl/style.css')}}">
	@endif
	<link rel="stylesheet" id="color" href="{{ asset('assets/front/css/color.php?base_color='.str_replace('#','', $gs->theme_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color)) }}">
	<link rel="stylesheet" id="color" href="{{ asset('assets/front/css/font.php?font_familly='.$default_font->font_family) }}">
    @stack('css')
</head>

<body>

    <!-- Header Part-->
    @include('partial.front.header')
    <!-- Header Part End-->

    <!--Content of each page-->
    @yield('contents')
	<!--Content of each page end-->

	<!-- Footer Area Start -->
	@include('partial.front.footer')
	<!-- Footer Area End -->

	<!-- Back to Top Start -->
	<div class="bottomtotop">
		<i class="fas fa-chevron-right"></i>
	</div>
	<!-- Back to Top End -->
	
	<script>
		var mainurl = "{{url('/')}}/";
		var gs      = "{{$gs}}";
	</script>
	
	<!-- jquery -->
	<script src="{{asset('assets/front/js/jquery.js')}}"></script>
	<!-- bootstrap -->
	<script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
	<!-- popper -->
	<script src="{{asset('assets/front/js/popper.min.js')}}"></script>
	<!-- Calender Js -->
	<script src="{{asset('assets/front/js/moment.min.js')}}"></script>
	<script src="{{asset('assets/front/js/pignose.calender.js')}}"></script>
	<!-- plugin js-->
	<script src="{{asset('assets/front/js/plugin.js')}}"></script>
	
	<script src="{{asset('assets/front/js/jquery.unveil.js')}}"></script>
	<!-- main -->
	<script src="{{asset('assets/front/js/main.js')}}"></script>
	
	<script src="{{asset('assets/front/js/custom.js')}}"></script>
	
	{{-- <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!} --}}

	<script>
		function updateClock ( ){
			var currentTime = new Date ( );
			var currentHours = currentTime.getHours ( );
			var currentMinutes = currentTime.getMinutes ( );
			var currentSeconds = currentTime.getSeconds ( );
			// Pad the minutes and seconds with leading zeros, if required
			currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
			currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
			// Choose either "AM" or "PM" as appropriate
			var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
			// Convert the hours component to 12-hour format if needed
			currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
			// Convert an hours component of "0" to "12"
			currentHours = ( currentHours == 0 ) ? 12 : currentHours;
			// Compose the string for display
			var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
			$(".time-now").html(currentTimeString);
		}

		$(document).ready(function()
		{
			setInterval('updateClock()', 1000);
		});
	</script>
	
    @stack('js')

</body>

</html>