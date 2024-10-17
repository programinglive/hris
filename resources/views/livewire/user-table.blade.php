<div class="rounded bg-white flex flex-col gap-6 px-5 py-4"
     x-data="{
			open: $wire.entangle('showForm')
		}"
>
	@error('errorMessage')
	<div
		x-data="{ showError: true }"
		x-show="showError"
		class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg
						dark:bg-red-200 dark:text-red-800"
		role="alert"
	>
		<div class="flex justify-between">
			{{ $message }}
			<button
				type="button"
				@click="showError = false"
				class="ml-auto"
			>x</button>
		</div>
	</div>
	@enderror
	<div class="flex justify-between pt-2" x-show="!open" >
		<div>
			<button
				type="button"
				class="btn bg-primary text-white"
				@click="open = true; $wire.dispatch('disableFilter')"
			>+</button>
		</div>
		<div
			class="flex items-center gap-2
							justify-between w-2/4 relative"
		>
			<a
				href="{{ asset('employee_data.xlsx') }}"
				class="
          px-4 py-2
	        rounded-md
	        text-blue-500
	        hover:text-blue-600
	        focus:outline-none
	        focus:ring-2
	        focus:ring-blue-300
	        flex items-center gap-2
	        text-nowrap
        "
			>
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
					<path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
				</svg>
				Employee Template
			</a>
			<label for="import" class="inline">
				<input
					wire:model="import"
					type="file"
					id="import"
					name="import"
					accept=".csv,.xlsx"
					class="form-input"
				>
			</label>
			@error('import')
				<div class="text-red-500 inline">{{ $message }}</div>
			@enderror
			<button
				wire:click="importUser"
				type="button"
				class="btn bg-green-500 text-white inline"
			>
				<i class="mgc_upload_line"></i>
			</button>
			<input
				wire:model.live="search"
				type="text"
				id="search"
				class="form-input pr-10"
				placeholder="Search..."
			>
			@if($search)
				<button
					wire:click="$set('search',null)"
					type="button"
					class="absolute inset-y-0 right-0 flex items-center pr-3"
				>
					<svg
						class="h-3 w-3 text-gray-500"
						fill="none" viewBox="0 0 24 24" stroke="currentColor"
					>
						<path
							stroke-linecap="round"
							stroke-linejoin="round"
							stroke-width="2" d="M6 18L18 6M6 6l12 12"
						></path>
					</svg>
				</button>
			@endif
		</div>
	</div>
	<div x-show="open">
		<livewire:user-form />
	</div>
	<div class="overflow-x-auto" x-show="!open">
		<div class="min-w-full inline-block align-middle">
			<div>
				<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 mb-6">
					<thead>
					<tr>
						<th
							scope="col"
							class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Name
						</th>
						<th
							scope="col"
							class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							First Name
						</th>
						<th
							scope="col"
							class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Email
						</th>
						<th
							scope="col"
							class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Phone
						</th>
						<th
							scope="col"
							class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase"
							style="width: 100px"
						>
							Action
						</th>
					</tr>
					</thead>
					<tbody class="divide-y divide-gray-200 dark:divide-gray-700">
					@forelse($users as $user)
						@if($user->name != 'root')
							<tr>
								<td
									wire:click="$dispatch('edit', { name: '{{ $user->name }}'})"
									class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
								>
										{{ $user->name }}
								</td>
								<td
									wire:click="$dispatch('edit', { name: '{{ $user->name }}'})"
									class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
								>
									{{ $user->details?->first_name }}
								</td>
								<td
									wire:click="$dispatch('edit', { name: '{{ $user->name }}'})"
									class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
								>
									{{ $user->email }}
								</td>
								<td
									wire:click="$dispatch('edit', { name: '{{ $user->name }}'})"
									class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
								>
									{{ $user->details?->phone }}
								</td>
								<td
									class="px-6 py-4 whitespace-nowrap text-end
									text-sm font-medium flex flex-col"
									style="width: 100px"
								>
									<div x-data="{ open: false }" class="relative">
										<button
											@click="open = !open"
											class="text-gray-500 hover:text-sky-700 text-end"
										>
											...
										</button>
										<div
											style="z-index: 9999"
								      x-show="open"
											class="absolute right-0 top-0 bg-white
															dark:bg-slate-800 p-2 rounded-md shadow-lg "
											@click.outside="open = false"
										>
											<button
												wire:click="$dispatch('edit', { name: '{{ $user->name }}'})"
												class="block w-full text-gray-500 hover:text-sky-700 text-end"
											>
												Edit
											</button>
											<button
												wire:click="$dispatch('delete', { name: '{{ $user->name }}'})"
												class="block w-full text-gray-500 hover:text-sky-700 text-end"
											>
												Delete
											</button>
										</div>
									</div>
								</td>
							</tr>
						@endif
					@empty
						<tr>
							<td colspan="4" class="text-center text-gray-500 pt-4">Empty Data</td>
						</tr>
					@endforelse
					</tbody>
				</table>
			</div>
		</div>
		<div>
			{{ $users->links() }}
		</div>
	</div>
	<div wire:loading.class.remove="hidden" class="hidden">
		<div class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 opacity-75 flex flex-col items-center justify-center">
			<div class="animate-spin h-12 w-12 border-b-4 border-gray-900 mb-4"></div>
			<h2 class="text-center text-white text-xl font-semibold">Loading...</h2>
			<p class="w-1/3 text-center text-white">This may take a second, please don't close this page.</p>
		</div>
	</div>
</div>