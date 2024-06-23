<div>
	@php
		$navbarBrand = 'HRIS';
		$navItems = [
			['name' => 'About', 'url' => '/about'],
			['name' => 'Register', 'url' => '/register'],
		];
	@endphp
	<nav class="w-full flex justify-between bg-blue-500 p-6">
		<div class="flex-shrink-0 text-white mr-6">
			<a href="#" class="flex align-items-center">
				<img src="{{ asset('assets/images/hris_logo.svg') }}" alt="Logo" class="h-8 w-auto">
				<span class="ml-2 text-2xl">{{ $navbarBrand }}</span>
			</a>
		</div>
		<div class="lg:flex lg:items-center lg:w-auto lg:justify-end">
			<div class="text-sm lg:flex-grow">
				@foreach($navItems as $item)
					<a href="{{ $item['url'] }}"
					   class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">{{ $item['name'] }}</a>
				@endforeach
			</div>
		</div>
	</nav>
</div>
