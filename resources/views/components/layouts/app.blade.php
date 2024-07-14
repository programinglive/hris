<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>{{ $title ?? '' }} | {{ config('app.name') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="Beautyworld HRIS" name="description">
	<meta content="Beautyworld Team" name="author">
	
	<!-- App favicon -->
	<link rel="shortcut icon" href="{{ asset('/images/favicon.ico')}}">
	
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