<div class="app-menu w-100">
	
	<!-- Sidenav Brand Logo -->
	<livewire:dashboard-logo />
	
	<!-- Sidenav Menu Toggle Button -->
	<button id="button-hover-toggle" class="absolute top-5 end-2 rounded-full p-1.5">
		<span class="sr-only">Menu Toggle Button</span>
		<i class="mgc_round_line text-xl"></i>
	</button>
	
	<!--- Menu -->
	<div class="scrollbar" data-simplebar>
		<ul class="menu" data-fc-type="accordion">
			<li class="menu-title">Menu</li>
			
			<li class="menu-item">
				<a href="{{ route('dashboard') }}" class="menu-link">
					<span class="menu-icon"><i class="mgc_home_3_line"></i></span>
					<span class="menu-text"> Dashboard </span>
				</a>
			</li>
			
			<li class="menu-title">Master Data</li>
			
			<livewire:master-base-data-menu />
			
			<livewire:master-organisation-menu />
			
			<livewire:master-employee-menu />
			
			<li class="menu-title">Transaction Data</li>
			
			<livewire:transaction-announcement-menu />
			<livewire:transaction-recruitment-menu />
			<livewire:transaction-attendance-menu />
			<livewire:transaction-business-trip-menu />
			<livewire:transaction-asset-menu />
			<livewire:transaction-payroll-menu />
			
			<li class="menu-title">Setting</li>
			
			<livewire:setting-menu />
		
		</ul>
	
	</div>
</div>
<!-- Sidenav Menu End  -->