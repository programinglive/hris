<div class="h-screen w-screen flex justify-center items-center">
	<div class="2xl:w-1/4 lg:w-1/3 md:w-1/2 w-full">
		<div class="card overflow-hidden sm:rounded-md rounded-none">
			<div class="p-6">
				<a href="#" class="block mb-4 align-middle text-center">
					<img class="h-6 block dark:hidden mx-auto" src="{{ asset('assets/images/hris_logo.svg')}}" alt="">
					<img class="h-6 hidden dark:block mx-auto" src="{{ asset('assets/images/hris_logo.svg')}}" alt="">
					HRIS
				</a>
				
				<form wire:submit.prevent="login">
					@csrf
					
					<div class="mb-4">
						<label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="email">Email Address or Username</label>
						<input wire:model="loginAccount" id="loginAccount"  type="text" placeholder="Enter your Email or username" name="loginAccount">
						@error('loginAccount') <span class="text-red-300">{{ $message }}</span> @enderror
					</div>
					
					<div class="mb-4">
						<label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="password">Password</label>
						<input wire:model="password" id="password"  type="password" placeholder="Enter your password" name="password">
						@error('password') <span class="text-red-300">{{ $message }}</span> @enderror
					</div>
					
					<div class="flex items-center justify-between mb-4">
						<div class="flex items-center">
							<input type="checkbox" class="form-checkbox rounded" id="checkbox-signin">
							<label class="ms-2" for="checkbox-signin">Remember me</label>
						</div>
						<a href="#"
						   class="text-sm text-primary border-b border-dashed border-primary">Forget Password ?</a>
					</div>
					
					<div class="text-center mb-4">
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