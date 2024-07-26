<div class="rounded bg-white flex flex-col gap-6 px-5 py-4"
     x-data="{
			open: $wire.entangle('showForm')
		}"
>
	<div class="flex justify-between pt-2" x-show="!open" >
		<div>
			<button type="button" class="btn bg-primary text-white" @click="open = true">+</button>
		</div>
		<div class="w-1/4">
			<label for="search" class="hidden text-gray-800 text-sm font-medium mb-2">Search</label>
			<input type="text" id="search" class="form-input" placeholder="Search...">
		</div>
	</div>
	<div x-show="open">
		<livewire:company-form />
	</div>
	<div class="overflow-x-auto" x-show="!open">
		<div class="min-w-full inline-block align-middle">
			<div class="overflow-hidden">
				<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
					<thead>
						<tr>
							<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
							<th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase" style="width: 100px">Action</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-gray-200 dark:divide-gray-700">
					@forelse($companies as $company)
						<tr>
							<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
								<div class="flex justify-between">
									<div>Code</div>
									<div>{{ $company->code }}</div>
								</div>
								<div class="flex justify-between">
									<div>Name</div>
									<div>{{ $company->name }}</div>
								</div>
								<div class="flex justify-between">
									<div>Email</div>
									<div>{{ $company->email }}</div>
								</div>
								<div class="flex justify-between">
									<div>Address</div>
									<div>{{ $company->address }}</div>
								</div>
								<div class="flex justify-between">
									<div>Phone</div>
									<div>{{ $company->phone }}</div>
								</div>
							</td>
							<td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium flex flex-col" style="width: 100px">
								<button class="text-gray-500 hover:text-sky-700 text-end" wire:click="$dispatch('edit', { code: '{{ $company->code }}'})">Edit</button>
								<button class="text-gray-500 hover:text-sky-700 text-end" wire:click="$dispatch('delete', { code: '{{ $company->code }}'})">Delete</button>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="4" class="text-center text-gray-500 pt-4">Empty Data</td>
						</tr>
					@endforelse
					</tbody>
				</table>
			</div>
		</div>
		<hr class="my-4 border-gray-300">
		{{ $companies->links() }}
	</div>
</div>