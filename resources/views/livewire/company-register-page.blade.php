<div class="flex flex-col gap-3">
	<livewire:page-header/>
	
	<main>
		<div class="flex justify-center items-center min-h-screen">
			<div class="flex justify-center items-center h-full w-1/2">
				{{-- Company Register Component --}}
				<form id="companyRegister" class="w-full bg-white p-6 rounded-lg shadow-md -mt-20" method="POST"
				      action="{{ route('company.store') }}">
					@csrf
					<h1 class="text-2xl font-bold mb-4 text-center">Register</h1>
					<div class="mb-4">
						<label class="block text-grey-darker text-sm font-bold mb-2" for="username">Username</label>
						<input
							class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
							type="text" name="username" id="username" required autofocus>
					</div>
					
					<div class="mb-6">
						<label class="block text-grey-darker text-sm font-bold mb-2" for="password">Password</label>
						<input
							class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
							type="password" name="password" id="password" required>
					</div>
					
					<div class="mb-6 flex items-center">
						<input class="mr-2 leading-tight" type="checkbox" name="remember" id="remember">
						<label class="block text-grey-darker text-sm font-bold" for="remember">Remember me</label>
					</div>
					
					<div class="flex items-center justify-between">
						<button
							class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
							type="submit">
							Register
						</button>
						
						<a href="/password/reset"
						   class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
							Forgot Password?
						</a>
					</div>
				</form>
				{{-- END Company Register Component.--}}
			</div>
		</div>
	</main>
	
	<livewire:page-footer/>
</div>
