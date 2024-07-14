<!DOCTYPE html>
<html lang="en" data-sidenav-view="{{ $sidenav ?? 'default' }}">

<head>
	<title>{{ $title ?? '' }} | {{ config('app.name') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="Beautyworld HRIS" name="description">
	<meta content="Beautyworld Team" name="author">
	
	@yield('css')
	
	@vite(['resources/scss/app.scss', 'resources/scss/icons.scss'])
	@vite(['resources/js/head.js', 'resources/js/config.js'])
</head>

<body>

<div class="flex wrapper">
	
	@include('layouts.shared/sidebar')
	
	<div class="page-content">
		
		@include('layouts.shared/topbar')
		
		<main class="flex-grow p-6">
			
			@yield('content')
		
		</main>
		
		@include('layouts.shared/footer')
	
	</div>

</div>

@include('layouts.shared/customizer')

@include('layouts.shared/footer-scripts')

@vite(['resources/js/app.js'])

</body>

</html>