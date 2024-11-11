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
		
		<div
			class="flex items-center gap-2
							justify-between w-4/6 relative"
		>
			<livewire:download-user />
			<livewire:import-user />
			<input
				wire:model.live="search"
				type="text"
				id="search"
				class="form-input pr-10 w-2/3"
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
	<div class="relative overflow-x-auto flex flex-col gap-4" x-show="!open">
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
					Username
				</th>
				<th scope="col" class="px-4 py-2 text-left font-medium text-gray-500 uppercase  whitespace-nowrap">
					Email
				</th>
				<th scope="col" class="px-4 py-2 text-left font-medium text-gray-500 uppercase  whitespace-nowrap">
					Phone
				</th>
				<th scope="col" class="px-4 py-2 text-left font-medium text-gray-500 uppercase  whitespace-nowrap">
					First Name
				</th>
				<th scope="col" class="px-4 py-2 text-left font-medium text-gray-500 uppercase  whitespace-nowrap">
					Last Name
				</th>
				<th scope="col" class="px-4 py-2 text-left font-medium text-gray-500 uppercase  whitespace-nowrap">
					Department
				</th>
				<th scope="col" class="px-4 py-2 text-left font-medium text-gray-500 uppercase  whitespace-nowrap">
					Division
				</th>
				<th scope="col" class="px-4 py-2 text-left font-medium text-gray-500 uppercase  whitespace-nowrap">
					Sub Division
				</th>
				<th scope="col" class="px-4 py-2 text-left font-medium text-gray-500 uppercase  whitespace-nowrap">
					Level
				</th>
				<th scope="col" class="px-4 py-2 text-left font-medium text-gray-500 uppercase  whitespace-nowrap">
					Position
				</th>
				<th scope="col" class="px-4 py-2 text-left font-medium text-gray-500 uppercase  whitespace-nowrap">
		      Date In
				</th>
				<th scope="col" class="px-4 py-2 text-left font-medium text-gray-500 uppercase  whitespace-nowrap">
			    Date Out
				</th>
				<th scope="col" class="px-4 py-2 text-end font-medium text-gray-500 uppercase whitespace-nowrap">
					Action
				</th>
			</tr>
			</thead>
			<tbody class="divide-y divide-gray-200">
			@forelse($employees as $employee)
				<tr>
					<td class="px-4 py-2 whitespace-nowrap text-gray-500">
						{{ $employee->company?->name }}
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-gray-500">
						{{ $employee->branch?->name }}
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-gray-500 truncate max-w-[150px]">
						{{ $employee->nik }}
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-blue-600 truncate max-w-[150px]">
						<a href="{{ route('profile', ['nik' => $employee->nik]) }}">{{ $employee->user?->name }}</a>
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-gray-500 truncate max-w-[150px]">
						{{ $employee->user?->email }}
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-gray-500 truncate max-w-[150px]">
						{{ $employee->phone }}
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-gray-500">
						{{ $employee->first_name }}
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-gray-500 truncate max-w-[120px]">
						{{ $employee->last_name }}
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-gray-500 truncate max-w-[150px]">
						{{ $employee->department?->name }}
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-gray-500 truncate max-w-[150px]">
						{{ $employee->division?->name }}
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-gray-500 truncate max-w-[150px]">
						{{ $employee->subDivision?->name }}
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-gray-500 truncate max-w-[150px]">
						{{ $employee->level?->name }}
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-gray-500 truncate max-w-[150px]">
						{{ $employee->position?->name }}
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-gray-500">
						{{ $employee->date_in ? date('Y-m-d' , strtotime($employee->date_in)) : ''}}
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-gray-500">
						{{ $employee->date_out ? date('Y-m-d' , strtotime($employee->date_out)) : ''}}
					</td>
					<td class="px-4 py-2 whitespace-nowrap text-end flex flex-col space-y-2">
						
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
									wire:click="$dispatch('edit', { nik: '{{ $employee->nik }}'}); open = false"
									class="block w-full text-gray-500 hover:text-sky-700 text-end"
								>
									Edit
								</button>
								<button
									wire:click="$dispatch('delete', { nik: '{{ $employee->nik }}'}); open = false"
									class="block w-full text-gray-500 hover:text-sky-700 text-end"
								>
									Delete
								</button>
							</div>
						</div>
					</td>
				</tr>
			@empty
				<tr>
					<td colspan="13" class="text-center text-gray-500 pt-4">Empty Data</td>
				</tr>
			@endforelse
			</tbody>
		</table>
		{{ $employees->links() }}
	</div>
</div>