<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset("/assets/images/apple-touch-icon.png")}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset("/assets/images/favicon-32x32.png")}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset("/assets/images/favicon-16x16.png")}}">
	<link rel="manifest" href="{{asset("/assets/images/site.webmanifest")}}">
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
	
	<title>{{ config('app.name') }}</title>
	
	@livewireStyles
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	@stack('styles')
</head>
<body class="bg-blue-50">
    {{ $slot }}
	@livewireScripts
	@stack('scripts')
</body>
</html>
