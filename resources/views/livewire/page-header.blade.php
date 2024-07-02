<div>
	<nav class="w-full flex flex-col lg:flex-row justify-between bg-blue-500 p-6 shadow-md">
		<div class="flex items-center lg:items-start flex-shrink-0 text-white lg:mb-0">
			<a href="#" class="flex align-items-center">
				<img src="{{ asset('assets/images/hris_logo.svg') }}" alt="Logo" class="h-8 w-auto">
				<span class="ml-2 text-2xl">{{ $navbarBrand }}</span>
			</a>
			<button id="burger" @click="toggleNav()" class="lg:hidden ml-auto inline-flex p-3 hover:bg-blue-700 rounded-lg">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
					<path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16M4 18h16"/>
				</svg>
			</button>
		</div>
		<div class="lg:flex lg:items-center lg:w-auto lg:justify-end" id="navbar">
			<div id="nav-content" class="lg:flex-grow">
				@foreach($navItems as $item)
					<a href="{{ $item['url'] }}"
					   class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">{{ $item['name'] }}</a>
				@endforeach
			</div>
		</div>
	</nav>
</div>

@push('styles')
  <style>
      @media only screen and (max-width: 1028px) {
          #nav-content {
              display: none;
          }
      }

      @media only screen
      and (min-device-width: 768px)
      and (max-device-width: 1024px) {
          #nav-content {
              display: none;
          }
      }

      @media only screen
      and (min-device-width: 1024px)
      and (max-device-width: 1366px) {
          #nav-content {
              display: block;
          }
      }
      
  </style>
@endpush

@push('scripts')
	<script>
		function toggleNav() {
			const navContent = document.getElementById("nav-content");
			if (navContent.style.display === "none") {
				navContent.style.display = "block";
			} else {
				navContent.style.display = "none";
			}
		}
	</script>
@endpush