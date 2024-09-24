<div class="relative">
	<button data-fc-type="dropdown" data-fc-placement="bottom-end" type="button" class="nav-link">
		<img src="{{ asset('/images/users/user-6.jpg') }}" alt="user-image" class="rounded-full h-10">
	</button>
	<div class="fc-dropdown fc-dropdown-open:opacity-100 hidden opacity-0 w-44 z-50 transition-[margin,opacity] duration-300 mt-2 bg-white shadow-lg border rounded-lg p-2 border-gray-200 dark:border-gray-700 dark:bg-gray-800">
		<a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="#">
			<i class="mgc_user_3_line  me-2"></i>
			<span>Profile</span>
		</a>
		<a
			class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800
								hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700
								dark:hover:text-gray-300"
			href="#"
		>
			<i class="mgc_settings_4_line  me-2"></i>
			<span>Settings</span>
		</a>
		<hr class="my-2 -mx-2 border-gray-200 dark:border-gray-700">
		<a
			wire:click="logout"
			class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800
									hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700
									dark:hover:text-gray-300"
			href="#"
		>
			<i class="mgc_exit_line  me-2"></i>
			<span>Log Out</span>
		</a>
	</div>
</div>