<nav>
	<!-- Topbar Start -->
	<header class="app-header flex items-center px-4 gap-3">
		<!-- Sidenav Menu Toggle Button -->
		<button id="button-toggle-menu" class="nav-link p-2">
			<span class="sr-only">Menu Toggle Button</span>
			<span class="flex items-center justify-center h-6 w-6">
            <i class="mgc_menu_line text-xl"></i>
        </span>
		</button>
		
		<!-- Topbar Brand Logo -->
		<livewire:dashboard-logo />
		
		<!-- Topbar Search Modal Button -->
		<button type="button" data-fc-type="modal" data-fc-target="topbar-search-modal" class="nav-link p-2 me-auto">
			<span class="sr-only">Search</span>
			<span class="flex items-center justify-center h-6 w-6">
            <i class="mgc_search_line text-2xl"></i>
        </span>
		</button>
		
		<!-- Company and Branch Selected -->
		<div class="flex items-center gap-2">
			<div class="w-[180px] px-2">
				<select
					id="companyCode"
					class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
					wire:model="companyCode"
				>
					<option value="all">Select Company</option>
					@foreach ($companies as $company)
						<option value="{{ $company->code }}">{{ $company->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="w-[180px] px-2">
				<select
					id="branchCode"
					class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
					wire:model="branchCode"
				>
					<option value="all">Select Branch</option>
					@if($branches)
						@foreach ($branches as $branch)
							<option value="{{ $branch->code }}">{{ $branch->name }}</option>
						@endforeach
					@endif
				</select>
			</div>
		</div>
		
		<!-- Notification Bell Button -->
		<livewire:notification-bell />
		
		<!-- Profile Dropdown Button -->
		<livewire:profile-dropdown />
	</header>
	<!-- Topbar End -->
	
	<!-- Topbar Search Modal -->
	<livewire:top-bar-search-modal />
</nav>