<div class="app-menu">
	
	<!-- Sidenav Brand Logo -->
	<a href="#" class="logo-box flex space-x-2">
		<!-- Light Brand Logo -->
		<div class="logo-light">
			<img src="{{ asset('/assets/images/hris_logo.svg') }}" class="logo-lg h-6" alt="Light logo">
			<img src="{{ asset('/assets/images/hris_logo.svg') }}" class="logo-sm" alt="Small logo">
		</div>
		
		<!-- Dark Brand Logo -->
		<div class="logo-dark">
			<img src="{{ asset('/assets/images/hris_logo.svg') }}" class="logo-lg h-6" alt="Dark logo">
			<img src="{{ asset('/assets/images/hris_logo.svg') }}" class="logo-sm" alt="Small logo">
		</div>
		
		<div>HRIS</div>
	</a>
	
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
				<a href="#" class="menu-link">
					<span class="menu-icon"><i class="mgc_home_3_line"></i></span>
					<span class="menu-text"> Dashboard </span>
				</a>
			</li>
			
			<li class="menu-title">Master Data</li>
			
			<li class="menu-item">
				<a href="#" data-fc-type="collapse" class="menu-link">
					<span class="menu-icon"><i class="mgc_building_2_line"></i></span>
					<span class="menu-text"> Employee </span>
					<span class="menu-arrow"></span>
				</a>
				
				<ul class="sub-menu hidden">
					<li class="menu-item">
						<a href="#" class="menu-link">
							<span class="menu-text">List</span>
						</a>
					</li>
					<li class="menu-item">
						<a href="#" class="menu-link">
							<span class="menu-text">Detail</span>
						</a>
					</li>
					<li class="menu-item">
						<a href="#" class="menu-link">
							<span class="menu-text">Create</span>
						</a>
					</li>
				</ul>
			</li>
			
			<li class="menu-title">Transaction Data</li>
			
			<li class="menu-item">
				<a href="#" data-fc-type="collapse" class="menu-link">
					<span class="menu-icon"><i class="mgc_user_3_line"></i></span>
					<span class="menu-text"> Auth Pages </span>
					<span class="menu-arrow"></span>
				</a>
				
				<ul class="sub-menu hidden">
					<li class="menu-item">
						<a href="#" class="menu-link">
							<span class="menu-text">Log In</span>
						</a>
					</li>
					<li class="menu-item">
						<a href="#" class="menu-link">
							<span class="menu-text">Register</span>
						</a>
					</li>
					<li class="menu-item">
						<a href="#" class="menu-link">
							<span class="menu-text">Recover Password</span>
						</a>
					</li>
					<li class="menu-item">
						<a href="#" class="menu-link">
							<span class="menu-text">Lock Screen</span>
						</a>
					</li>
				</ul>
			</li>
			
			<li class="menu-title">Settings</li>
			
			<li class="menu-item">
				<a href="#" data-fc-type="collapse" class="menu-link">
					<span class="menu-icon"><i class="mgc_layout_grid_line"></i></span>
					<span class="menu-text"> Tables </span>
					<span class="menu-arrow"></span>
				</a>
				
				<ul class="sub-menu hidden">
					<li class="menu-item">
						<a href="#" class="menu-link">
							<span class="menu-text">Basic Tables</span>
						</a>
					</li>
					<li class="menu-item">
						<a href="#" class="menu-link">
							<span class="menu-text">Data Tables</span>
						</a>
					</li>
				</ul>
			</li>
			
		</ul>
		
	</div>
</div>
<!-- Sidenav Menu End  -->