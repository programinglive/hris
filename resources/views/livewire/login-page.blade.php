<div class="h-screen w-screen flex justify-center items-center">
	<div class="2xl:w-1/4 lg:w-1/3 md:w-1/2 w-full">
		<div class="card overflow-hidden sm:rounded-md rounded-none">
			<div class="p-6">
				<a href="#" class="block mb-4 align-middle text-center">
					<img class="h-6 block dark:hidden mx-auto" src="{{ asset('assets/images/hris_logo.svg')}}" alt="">
					<img class="h-6 hidden dark:block mx-auto" src="{{ asset('assets/images/hris_logo.svg')}}" alt="">
					HRIS
				</a>
				
				<form wire:submit.prevent="login" class="flex flex-col gap-4">
					@csrf
					
					<div>
						<label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email Address or Username</label>
						<input type="text" id="email" wire:model="loginAccount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter your Email or username" required>
						@error('loginAccount') <span class="text-red-300">{{ $message }}</span> @enderror
					</div>
					
					<div>
						<label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
						<input type="password" id="password" wire:model="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter your password" required>
						@error('password') <span class="text-red-300">{{ $message }}</span> @enderror
					</div>
					
					<div class="flex items-center justify-between">
						<div class="flex items-center">
							<input type="checkbox" class="form-checkbox rounded" id="checkbox-signin">
							<label class="ms-2" for="checkbox-signin">Remember me</label>
						</div>
						<a href="#"
						   class="text-sm text-primary border-b border-dashed border-primary">Forget Password ?</a>
					</div>
					
					<div class="text-center">
						<p class="text-sm text-gray-500 dark:text-gray-300">
							Don't have an account? <a href="{{ route('register_company') }}" class="text-primary">Register your company</a>
						</p>
					</div>
					
					<div class="flex justify-center mb-6">
						<button class="btn w-full text-white bg-primary"> Log In</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>