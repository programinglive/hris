<div class="rounded bg-white flex flex-col gap-6 p-5"
     x-data="{ open: $wire.entangle('showForm') }"
>
	<div class="flex justify-between pt-2" x-show="!open">
		<div>
			<button
				type="button"
				class="btn bg-primary text-white"
				@click="open = true"
			>
				+
			</button>
		</div>
		<div class="w-full md:w-1/4 relative">
			<input
				wire:model.live="search"
				type="text"
				id="search"
				class="form-input w-full pr-10"
				placeholder="Search..."
			>
			@if($search)
				<button
					wire:click="clearSearch"
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
		<livewire:user-form />
	</div>
	<div class="relative overflow-x-auto" x-show="!open">
		<table class="w-full text-sm">
			<thead>
			<tr>
				<th scope="col" class="px-4 py-2 text-left font-medium text-gray-500 uppercase  whitespace-nowrap">
					Company
				</th>
				<th scope="col" class="px-4 py-2 text-left font-medium text-gray-500 uppercase  whitespace-nowrap">
					Branch
				</th>
				<th scope="col" class="px-4 py-2 text-left font-medium text-gray-500 uppercase  whitespace-nowrap">
					NIK
				</th>
				<th scope="col" class="px-4 py-2 text-left font-medium text-gray-500 uppercase  whitespace-nowrap">
					Name
				</th>
				<th scope="col" class="px-4 py-2 text-left font-medium text-gray-500 uppercase  whitespace-nowrap">
					Amount
				</th>
				<th scope="col" class="px-4 py-2 text-end font-medium text-gray-500 uppercase">
					Action
				</th>
			</tr>
			</thead>
			<tbody class="divide-y divide-gray-200">
			@forelse($employeeLeavePlafonds as $employee)
				<tr>
					<td class="px-4 py-2 whitespace-nowrap text-gray-500 truncate max-w-[150px]">
						{{ $employee->company?->name }}
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-gray-500 truncate max-w-[150px]">
						{{ $employee->branch?->name }}
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-gray-500 truncate max-w-[150px]">
						{{ $employee->details?->nik }}
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-gray-500 truncate max-w-[150px]">
						{{ $employee->name }}
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-gray-500 truncate max-w-[150px]">
					    {{ $employee->amount }}
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-end flex flex-col space-y-2">
						<button
							wire:click="$dispatch('edit', { nik: '{{ $employee->details?->nik }}'})"
							class="text-gray-500 hover:text-sky-700"
						>
							Edit
						</button>
						<button
							wire:click="$dispatch('delete', { nik: '{{ $employee->details?->nik }}'})"
							class="text-gray-500 hover:text-sky-700"
						>
							Delete
						</button>
					</td>
				</tr>
			@empty
				<tr>
					<td colspan="13" class="text-center text-gray-500 pt-4">Empty Data</td>
				</tr>
			@endforelse
			</tbody>
		</table>
		<hr class="my-4 border-gray-300">
		{{ $employeeLeavePlafonds->links() }}
	</div>
</div>