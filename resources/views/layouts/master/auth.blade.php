<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>{{ $title }}</title>
		<!-- Base Url -->
		<base href="{{ url('/') }}" target="_self">
		<!-- Viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Meta Tag -->
		<meta name="keywords" content="{{ $meta_keywords }}">
		<meta name="description" content="{{ $meta_description }}">
		<!-- FB Meta Tag -->
		<meta property="og:title" content="{{ $title }}">
		<meta property="og:description" content="{{ $meta_description }}">
		<meta property="og:image" content="{{ $meta_images }}">
		<!-- Twitter Meta Tag -->
		<meta name="twitter:title" content="{{ $title }}">
		<meta name="twitter:description" content=" {{ $meta_description }}">
		<meta name="twitter:image" content="{{ $meta_images }}">
		<meta name="twitter:card" content="summary_large_image">
		<!-- Csrf Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Favicon -->
		<link href="{{ asset('images/logos/favicon.png') }}" rel="shortcut icon" type="image/png">    
		<!-- Style (CSS) -->
		@include('layouts.include.style')
	</head>
	<body>
		<div id="app">
			<!-- Content -->
			<main class="main" role="main" aria-label="main content">
				@yield('content')
			</main>
		</div>

		<!-- Script (JS) -->
		@include('layouts.include.script')
	</body>
</html>