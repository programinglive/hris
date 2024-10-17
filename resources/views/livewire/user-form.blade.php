<form wire:submit.prevent="{{$actionForm}}">
	<div class="flex flex-col gap-4">
		<div class="flex justify-between gap-6">
			<div class="flex flex-col gap-4 flex-1">
				<h2 class="mb-1 text-2xl">User Account</h2>
				<div class="flex flex-col gap-3">
					<label for="name" class="block text-sm font-medium text-gray-700">Name</label>
					<input
						wire:model="name"
						type="text"
						id="name"
						class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500
										block w-full sm:text-sm border border-gray-300 rounded-md p-2"
					>
					@error('name')
					<div
						class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg
										dark:bg-red-200 dark:text-red-800"
					     role="alert"
					>
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
						class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500
										block w-full sm:text-sm border border-gray-300 rounded-md p-2"
					>
					@error('email')
					<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg
												dark:bg-red-200 dark:text-red-800"
					     role="alert"
					>
						<span class="font-medium">Error!</span> {{ $message }}
					</div>
					@enderror
				</div>
				<div class="flex flex-col gap-3">
					<label
						for="password"
						class="block text-sm font-medium text-gray-700"
					>
						Password
					</label>
					<input
						wire:model="password"
						type="password"
						id="password"
						class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500
						block w-full sm:text-sm border border-gray-300 rounded-md p-2"
					>
					@error('password')
					<div
						class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg
										dark:bg-red-200 dark:text-red-800"
					     role="alert"
					>
						<span class="font-medium">Error!</span> {{ $message }}
					</div>
					@enderror
				</div>
				<div class="flex flex-col gap-3">
					<label
						for="password_confirmation"
						class="block text-sm font-medium text-gray-700">
						Password Confirmation
					</label>
					<input
						wire:model="password_confirmation"
						type="password"
						id="password_confirmation"
						class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500
										block w-full sm:text-sm border border-gray-300 rounded-md p-2"
					>
					@error('password_confirmation')
					<div
						class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg
										dark:bg-red-200 dark:text-red-800"
					     role="alert"
					>
						<span class="font-medium">Error!</span> {{ $message }}
					</div>
					@enderror
				</div>
			</div>
			<div class="flex flex-col gap-4 flex-1">
				<div class="flex justify-between">
					<h2 class="mb-1 text-2xl">Organization</h2>
					<button
						type="button"
						class="btn btn-outline-danger float-end"
						wire:click="$dispatch('clearUserForm')"
					>
						Cancel
					</button>
				</div>
				<livewire:form-company-option />
				<livewire:form-branch-option />
				<livewire:form-department-option />
				<livewire:form-division-option />
				<livewire:form-level-option />
				<livewire:form-position-option />
			</div>
		</div>
		<livewire:user-detail-form />
		
		<div class="flex flex-col gap-4 flex-1">
			@error('errorMessage')
			<div
				class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
				role="alert"
			>
				<span class="font-medium">Error!</span> {{ $message }}
				<button
					type="button"
					class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-full
									focus:ring-2 focus:ring-red-500 p-1.5 hover:bg-red-200 inline-flex h-5 w-5 float-right"
					wire:click="resetError"
				>
					<span class="sr-only">Dismiss</span>
					<svg
						aria-hidden="true"
						class="w-5 h-5"
						fill="currentColor"
						viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
						<path
							fill-rule="evenodd"
							d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1
							0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
							clip-rule="evenodd"></path>
					</svg>
				</button>
			</div>
			@enderror
		</div>
		<div>
			<button type="submit" class="btn bg-primary text-white float-end">Save</button>
		</div>
	</div>
</form>