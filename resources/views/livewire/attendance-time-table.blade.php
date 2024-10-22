<div class="rounded bg-white flex flex-col gap-4 px-5 pb-4"
     x-data="{
			open: $wire.entangle('showForm')
		}"
>
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
			
			<a
				href="{{ asset('attendance_time_data.xlsx') }}"
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
				<svg
					xmlns="http://www.w3.org/2000/svg"
					fill="none"
					viewBox="0 0 24 24"
					stroke-width="1.5"
					stroke="currentColor"
					class="w-6 h-6"
				>
					<path
						stroke-linecap="round"
						stroke-linejoin="round"
						d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021
			          18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"
					/>
				</svg>
				Attendance Time Template
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
				wire:click="importAttendanceTime"
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
		<livewire:attendance-time-form />
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
							Nik
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
							In
						</th>
						<th
							scope="col"
							class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Out
						</th>
						<th
							scope="col"
							class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Status
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
					@forelse($attendanceTimes as $attendanceTime)
						<tr>
							<td
								class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $attendanceTime->company_name }}
							</td>
							<td
								class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $attendanceTime->branch_name }}
							</td>
							<td
								class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $attendanceTime->employee_nik }}
							</td>
							<td
							    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500"
							>
							    {{ $attendanceTime->employee_name }}
							</td>
							<td
								class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $attendanceTime->in }}
							</td>
							<td
								class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $attendanceTime->out }}
							</td>
							<td
								class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $attendanceTime->status }}
							</td>
							<td
								class="px-6 py-4 whitespace-nowrap text-end text-sm
												font-medium flex flex-col"
								style="width: 100px"
							>
								<button
									wire:click="$dispatch('edit', { nik: '{{ $attendanceTime->nik }}'})"
									class="text-gray-500 hover:text-sky-700 text-end"
								>
									Edit
								</button>
								<button
									wire:click="$dispatch('delete', { nik: '{{ $attendanceTime->nik }}'})"
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
		{{ $attendanceTimes->links() }}
	</div>
</div>