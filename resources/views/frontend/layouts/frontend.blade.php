<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    @php
        $general = \App\Models\General::latest('created_at')->first();
    @endphp

	<!-- Favicons-->
	<link rel="shortcut icon" href="{{ (!empty($general ? $general->logo_favicon : '')) ? asset('uploads/general_images/'.$general->logo_favicon) : asset('frontend/img/logo.png') }}" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="{{ (!empty($general ? $general->logo_favicon : '')) ? asset('uploads/general_images/'.$general->logo_favicon) : asset('frontend/img/logo.png') }}">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{ (!empty($general ? $general->logo_favicon : '')) ? asset('uploads/general_images/'.$general->logo_favicon) : asset('frontend/img/logo.png') }}">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
		href="{{ (!empty($general ? $general->logo_favicon : '')) ? asset('uploads/general_images/'.$general->logo_favicon) : asset('frontend/img/logo.png') }}">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
		href="{{ (!empty($general ? $general->logo_favicon : '')) ? asset('uploads/general_images/'.$general->logo_favicon) : asset('frontend/img/logo.png') }}">

	<!-- GOOGLE WEB FONT -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Lora:ital@1&amp;family=Poppins:wght@400;500;600;700&amp;display=swap"
		rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
		integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

	<!-- BASE CSS -->
	<link href="{{ asset('frontend/css/vendors.min.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

	<!-- SPECIFIC CSS -->
	<link href="{{ asset('frontend/css/wizard.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/blog.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/shop.css') }}" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">

	<!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

	<!-- Include Flutterwave library -->
    <script src="https://checkout.flutterwave.com/v3.js"></script>

    <!-- Sweetalert included -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body>
    <!-- Scroll Bar Style -->
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

    <style>
        ::-webkit-scrollbar {
           width: 10px;
        }
        ::-webkit-scrollbar-thumb {
          border-radius: 30px;
          background: -webkit-gradient(linear,left top,left bottom,from(#e6e6e6),to(#cacaca));
          }
        ::-webkit-scrollbar-track {
          background-color: #fff;
          border-radius:10px;
        }
    </style>

	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div>

	<!-- Sweetalert included -->
	@include('sweetalert::alert')

	{{-- Header start --}}
    @include('frontend.partials.header')
	{{-- Header end --}}

	<main>
		@if (!Route::is('home', 'get.blog'))
		<div class="hero_single inner_pages background-image mb-4" data-background="url({{ asset('frontend/img/hero_general.jpg') }})">
			<div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
				<div class="container">
					<div class="row justify-content-center">
						@yield('breadcrumb')
					</div>
				</div>
			</div>
			<div class="frame gray"></div>
		</div>
		@endif

        @yield('content')
    </main>

	{{-- Header start --}}
    @include('frontend.partials.footer')
	{{-- Header end --}}

	<div id="toTop"></div>

	<script>
		document.addEventListener("DOMContentLoaded", function () {
			document.querySelectorAll('a[href^="#"]').forEach(anchor => {
				anchor.addEventListener("click", function (e) {
					e.preventDefault();

					const targetId = this.getAttribute("href").substring(1);
					const targetElement = document.getElementById(targetId);

					if (targetElement) {
						window.scrollTo({
							top: targetElement.offsetTop,
							behavior: "smooth"
						});
					}
				});
			});
		});
    </script>

    <!-- COMMON SCRIPTS -->
	<script src="{{ asset('frontend/js/common_scripts.min.js') }}"></script>
	<script src="{{ asset('frontend/js/slider.js') }}"></script>
	<script src="{{ asset('frontend/js/common_func.js') }}"></script>
	<script src="{{ asset('frontend/phpmailer/validate.js') }}"></script>


	<!-- SPECIFIC SCRIPTS (wizard form) -->
	<script src="{{ asset('frontend/js/wizard/wizard_scripts.min.js') }}"></script>
	<script src="{{ asset('frontend/js/wizard/wizard_func.js') }}"></script>

	<!-- SPECIFIC SCRIPTS -->
	<script src="{{ asset('frontend/js/specific_shop.js') }}"></script>
    <!-- Page Specific JS File -->
    @yield('scripts')
</body>

</html>
