<div class="rounded bg-white flex flex-col gap-6 px-5 py-4"
     x-data="{
			open: $wire.entangle('showForm')
		}"
>
	<div class="flex justify-between pt-2" x-show="!open" >
		<div>
			<button
				type="button"
				class="btn bg-primary text-white"
				@click="open = true"
			>+</button>
		</div>
		<div
			class="flex items-center gap-2
		     justify-between w-2/4 relative"
		>
			<livewire:import-inventory />
			<input
				wire:model.live="search"
				type="text"
				id="search"
				class="form-input pr-10 w-2/3"
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
						fill="none"
						viewBox="0 0 24 24"
						stroke="currentColor"
					>
						<path
							stroke-linecap="round"
							stroke-linejoin="round"
							stroke-width="2"
							d="M6 18L18 6M6 6l12 12"
						></path>
					</svg>
				</button>
			@endif
		</div>
	</div>
	<div x-show="open">
		<livewire:inventory-form />
	</div>
	<div class="overflow-x-auto" x-show="!open">
		<div class="min-w-full inline-block align-middle">
			<div class="overflow-hidden">
				<table
					class="min-w-full divide-y divide-gray-200 dark:divide-gray-700"
				>
					<thead>
					<tr>
						<th
							scope="col"
							class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Company
						</th>
						<th
							scope="col"
							class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Branch
						</th>
						<th
							scope="col"
							class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Code
						</th>
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
							Price
						</th>
						<th
							scope="col"
							class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Description
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
					@forelse($inventories as $inventory)
						<tr>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $inventory->company_name }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $inventory->branch_name }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $inventory->code }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $inventory->name }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $inventory->price }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $inventory->description }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-end text-sm
												font-medium flex flex-col"
								style="width: 100px"
							>
								<button
									wire:click="$dispatch('edit', { code: '{{ $inventory->code }}'})"
									class="text-gray-500 hover:text-sky-700 text-end"
								>
									Edit
								</button>
								<button
									wire:click="$dispatch('delete', { code: '{{ $inventory->code }}'})"
									class="text-gray-500 hover:text-sky-700 text-end"
								>
									Delete
								</button>
							</td>
						</tr>
					@empty
						<tr>
							<td
								colspan="8"
								class="text-center text-gray-500 pt-4"
							>
								Empty Data
							</td>
						</tr>
					@endforelse
					</tbody>
				</table>
			</div>
		</div>
		<hr class="my-4 border-gray-300">
		{{ $inventories->links() }}
	</div>
</div>