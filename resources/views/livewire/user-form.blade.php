<form wire:submit.prevent="{{$actionForm}}">
	<div class="flex flex-col gap-4">
		<div class="flex justify-between gap-3">
			<div class="flex flex-col gap-4 flex-1">
				<div class="flex flex-col gap-3">
					<label for="name" class="block text-sm font-medium text-gray-700">Name</label>
					<input
						wire:model="name"
						type="text"
						id="name"
						class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
					>
					@error('name')
					<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
					     role="alert">
						<span class="font-medium">Error!</span> {{ $message }}
					</div>
					@enderror
				</div>
				<div class="flex flex-col gap-3">
					<label for="email" class="block text-sm font-medium text-gray-700">Email</label>
					<input
						wire:model="email"
						type="text"
						id="email"
						class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
					>
					@error('email')
					<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
					     role="alert">
						<span class="font-medium">Error!</span> {{ $message }}
					</div>
					@enderror
				</div>
				<div class="flex flex-col gap-3">
					<label for="password" class="block text-sm font-medium text-gray-700">Password</label>
					<input
						wire:model="password"
						type="password"
						id="password"
						class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
					>
					@error('password')
					<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
					     role="alert">
						<span class="font-medium">Error!</span> {{ $message }}
					</div>
					@enderror
				</div>
				<div class="flex flex-col gap-3">
					<label for="password_confirmation" class="block text-sm font-medium text-gray-700">Password
						Confirmation</label>
					<input
						wire:model="password_confirmation"
						type="password"
						id="password_confirmation"
						class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
					>
					@error('password_confirmation')
					<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
					     role="alert">
						<span class="font-medium">Error!</span> {{ $message }}
					</div>
					@enderror
				</div>
			</div>
			<div class="flex flex-col gap-4 flex-1">
				<div class="flex flex-col gap-3">
					<label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
					<input
						wire:model="details.phone"
						type="text"
						id="phone"
						class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
					>
					@error('details.phone')
					<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
					     role="alert">
						<span class="font-medium">Error!</span> {{ $message }}
					</div>
					@enderror
				</div>
			</div>
		</div>
		<div>
			<button type="submit" class="btn bg-primary text-white float-end">Save</button>
		</div>
	</div>
</form>