<div class="relative md:flex hidden">
	<button data-fc-type="dropdown" data-fc-placement="bottom-end" type="button" class="nav-link p-2">
		<span class="sr-only">View notifications</span>
		<span class="flex items-center justify-center h-6 w-6">
        <i class="mgc_notification_line text-2xl"></i>
      </span>
	</button>
	<div class="fc-dropdown fc-dropdown-open:opacity-100 hidden opacity-0 w-80 z-50 mt-2 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700 rounded-lg">
		
		<div class="p-2 border-b border-dashed border-gray-200 dark:border-gray-700">
			<div class="flex items-center justify-between">
				<h6 class="text-sm"> Notification</h6>
				<a href="#" class="text-gray-500 underline">
					<small>Clear All</small>
				</a>
			</div>
		</div>
		
		<div class="p-4 h-80" data-simplebar>
			
			<h5 class="text-xs text-gray-500 mb-2">Today</h5>
			
			<a href="#" class="block mb-4">
				<div class="card-body">
					<div class="flex items-center">
						<div class="flex-shrink-0">
							<div class="flex justify-center items-center h-9 w-9 rounded-full bg text-white bg-primary">
								<i class="mgc_message_3_line text-lg"></i>
							</div>
						</div>
						<div class="flex-grow truncate ms-2">
							<h5 class="text-sm font-semibold mb-1">Data corp <small class="font-normal text-gray-500 ms-1">1 min ago</small></h5>
							<small class="notification-item-subtitle text-muted">Caleb Flake commented on Admin</small>
						</div>
					</div>
				</div>
			</a>
			
			<a href="#" class="block mb-4">
				<div class="card-body">
					<div class="flex items-center">
						<div class="flex-shrink-0">
							<div class="flex justify-center items-center h-9 w-9 rounded-full bg-info text-white">
								<i class="mgc_user_add_line text-lg"></i>
							</div>
						</div>
						<div class="flex-grow truncate ms-2">
							<h5 class="text-sm font-semibold mb-1">Admin <small class="font-normal text-gray-500 ms-1">1 hr ago</small></h5>
							<small class="notification-item-subtitle text-muted">New user registered</small>
						</div>
					</div>
				</div>
			</a>
			
			<a href="#" class="block mb-4">
				<div class="card-body">
					<div class="flex items-center">
						<div class="flex-shrink-0">
							<img src="{{ asset('/images/users/avatar-2.jpg') }}" class="rounded-full h-9 w-9" alt="">
						</div>
						<div class="flex-grow truncate ms-2">
							<h5 class="text-sm font-semibold mb-1">Cristina Pride <small class="font-normal text-gray-500 ms-1">1 day ago</small></h5>
							<small class="notification-item-subtitle text-muted">Hi, How are you? What about our next meeting</small>
						</div>
					</div>
				</div>
			</a>
			
			<h5 class="text-xs text-gray-500 mb-2">Yesterday</h5>
			
			<a href="#" class="block mb-4">
				<div class="card-body">
					<div class="flex items-center">
						<div class="flex-shrink-0">
							<div class="flex justify-center items-center h-9 w-9 rounded-full bg-primary text-white">
								<i class="mgc_message_1_line text-lg"></i>
							</div>
						</div>
						<div class="flex-grow truncate ms-2">
							<h5 class="text-sm font-semibold mb-1">Data corp</h5>
							<small class="notification-item-subtitle text-muted">Caleb Flake commented on Admin</small>
						</div>
					</div>
				</div>
			</a>
			
			<a href="#" class="block">
				<div class="card-body">
					<div class="flex items-center">
						<div class="flex-shrink-0">
							<img src="{{ asset('/images/users/avatar-4.jpg') }}" class="rounded-full h-9 w-9" alt="">
						</div>
						<div class="flex-grow truncate ms-2">
							<h5 class="text-sm font-semibold mb-1">Karen Robinson</h5>
							<small class="notification-item-subtitle text-muted">Wow ! this admin looks good and awesome design</small>
						</div>
					</div>
				</div>
			</a>
		</div>
		
		<a href="#" class="p-2 border-t border-dashed border-gray-200 dark:border-gray-700 block text-center text-primary underline font-semibold">
			View All
		</a>
	</div>
</div>