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
	@livewireStyles
</head>

<body>

<div class="flex wrapper">
	@livewire('dashboard-sidebar')
	
	<div class="page-content">
		@livewire('dashboard-top-bar')
		
		<main class="flex-grow p-6 bg-gray-100">
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