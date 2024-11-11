<div class="rounded bg-white flex flex-col gap-6 px-5 py-4"
     x-data="{
			open: $wire.entangle('showForm')
		}"
>
	<div class="grid grid-cols-2 gap-4 pt-2" x-show="!open" >
		<div class="col-span-1">
			<button
				type="button"
				class="btn bg-primary text-white"
				@click="open = true"
			>+</button>
		</div>
		<div class="col-span-1">
			<div class="grid grid-cols-2 gap-2">
				<div class="col-span-1">
					<livewire:import-working-calendar />
				</div>
				<div class="col-span-1">
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
		</div>
	</div>
	<div x-show="open">
		<livewire:working-calendar-form />
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
							class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Company
						</th>
						<th
							scope="col"
							class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Branch
						</th>
						<th
							scope="col"
							class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Date
						</th>
						<th
							scope="col"
							class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Type
						</th>
						<th
							scope="col"
							class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Description
						</th>
						<th
							scope="col"
							class="px-4 py-3 text-end text-xs font-medium text-gray-500 uppercase"
							style="width: 100px"
						>
							Action
						</th>
					</tr>
					</thead>
					<tbody class="divide-y divide-gray-200 dark:divide-gray-700">
					@forelse($workingCalendars as $working_calendar)
						<tr>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $working_calendar->company_name }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $working_calendar->branch_name }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $working_calendar->date }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $working_calendar->type }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $working_calendar->description }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-end text-sm
												font-medium flex flex-col"
								style="width: 100px"
							>
								<button
									wire:click="$dispatch('edit', { id: '{{ $working_calendar->id }}'})"
									class="text-gray-500 hover:text-sky-700 text-end"
								>
									Edit
								</button>
								<button
									wire:click="$dispatch('delete', { id: '{{ $working_calendar->id }}'})"
									class="text-gray-500 hover:text-sky-700 text-end"
								>
									Delete
								</button>
							</td>
						</tr>
					@empty
						<tr>
							<td
								colspan="6"
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
		{{ $workingCalendars->links() }}
	</div>
</div>