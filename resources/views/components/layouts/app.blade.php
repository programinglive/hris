<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>{{ $title ?? '' }} | {{ config('app.name') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="Beautyworld HRIS" name="description">
	<meta content="Beautyworld Team" name="author">
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	
	<!-- App favicon -->
	<link rel="shortcut icon" href="{{ asset('/images/favicon.ico')}}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('/apple-touch-icon.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('/favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('/favicon-16x16.png')}}">
	<link rel="manifest" href="{{asset('/site.webmanifest')}}">
	
	@vite(['resources/scss/app.scss', 'resources/scss/icons.scss'])
	@vite(['resources/js/head.js', 'resources/js/config.js'])
	@livewireStyles
</head>

<body>
<div class="bg-gradient-to-r from-rose-100 to-teal-100 dark:from-gray-700 dark:via-gray-900 dark:to-black">
	
	{{ $slot ?? '' }}

</div>
@livewireScripts
</body>
</html>