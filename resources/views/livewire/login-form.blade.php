{{-- Form Component --}}
<form id="login" class="w-full md:w-3/4 bg-white p-6 rounded-lg shadow-md -mt-20" method="POST" action="/login">
	@csrf
	<h1 class="text-2xl font-bold mb-4 text-center">Login</h1>
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
	
	<div class="flex justify-end">
		<button
			class="bg-blue-600 hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
			type="submit">
			Log in
		</button>
	</div>
	<div class="flex items-center justify-between mb-6 mt-4">
		<div class="flex items-center">
			<input class="mr-2 leading-tight" type="checkbox" name="remember" id="remember">
			<label class="block text-grey-darker text-sm font-bold" for="remember">Remember me</label>
		</div>
		<a href="/password/reset"
		   class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
			Forgot Password?
		</a>
	</div>
</form>
{{-- END Form Component.--}}