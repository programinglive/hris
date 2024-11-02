<!DOCTYPE html>
<html lang="en" data-sidenav-view="{{ $sidenav ?? 'default' }}">

<head>
	<title>{{ $title ?? '' }} | {{ config('app.name') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	<meta content="Beautyworld HRIS" name="description">
	<meta content="Beautyworld Team" name="author">
	
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- App favicon -->
	<link rel="shortcut icon" href="{{ asset('/images/favicon.ico')}}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('/apple-touch-icon.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('/favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('/favicon-16x16.png')}}">
	<link rel="manifest" href="{{asset('/site.webmanifest')}}">
	
	@yield('css')
	
	@vite(['resources/scss/app.scss', 'resources/scss/icons.scss'])
	@vite(['resources/js/head.js', 'resources/js/config.js'])
	@stack('styles')
	@stack('scripts')
	@livewireStyles
</head>

<body>

<div class="grid grid-cols-6 wrapper">
	@livewire('dashboard-sidebar')
	
	<div class="page-content col-span-5">
		@livewire('dashboard-top-bar')

		<main class="flex-grow p-6 bg-gray-100">
			<livewire:announcement-widget />
			{{ $slot ?? '' }}
		</main>
		
		@livewire('dashboard-footer')
	</div>
</div>

@include('layouts.shared/customizer')

@include('layouts.shared/footer-scripts')

@vite(['resources/js/app.js'])

@livewireScripts
</body>

</html>