<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="img/fav.png">
	<meta name="description" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="shortcut icon" href="/assets/img/fav.png">
	<meta charset="UTF-8">
	<title>{{ $title }}</title>
	<link rel="stylesheet" href="/assets/css/linearicons.css?v=1">
	<link rel="stylesheet" href="/assets/css/font-awesome.min.css?v=1">
	<link rel="stylesheet" href="/assets/css/themify-icons.css">
	<link rel="stylesheet" href="/assets/css/bootstrap.css">
	<link rel="stylesheet" href="/assets/css/owl.carousel.css">
	<link rel="stylesheet" href="/assets/css/nice-select.css?v=12">
	<link rel="stylesheet" href="/assets/css/nouislider.min.css?v=2">
	<link rel="stylesheet" href="/assets/css/ion.rangeSlider.css" />
	<link rel="stylesheet" href="/assets/css/ion.rangeSlider.skinFlat.css" />
	<link rel="stylesheet" href="/assets/css/magnific-popup.css">
	<link rel="stylesheet" href="/assets/css/main.css?v=14">
	<script src="/assets/js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MERCHANT_CLIENT_KEY') }}"></script>
</head>

<body>

	@include('components.navbar')

  	@yield('content')

	@include('components.footer')
	
	<script src="/assets/js/vendor/bootstrap.min.js"></script>
	<script src="/assets/js/jquery.ajaxchimp.min.js"></script>
	<script src="/assets/js/jquery.nice-select.min.js?v=4"></script>
	<script src="/assets/js/jquery.sticky.js"></script>
	<script src="/assets/js/nouislider.min.js?v=1"></script>
	<script src="/assets/js/countdown.js"></script>
	<script src="/assets/js/jquery.magnific-popup.min.js"></script>
	<script src="/assets/js/owl.carousel.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="/assets/js/gmaps.min.js"></script>
	<script src="/assets/js/main.js?v=6"></script>

	@include('vendor.alert')

</body>

</html>