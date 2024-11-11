<div class="rounded bg-white flex flex-col gap-6 px-5 py-4"
     x-data="{
			open: $wire.entangle('showForm')
		}"
>
	@error('errorMessage')
	<div
		x-data="{ showError: true }"
		x-show="showError"
		class="p-4 text-sm text-red-700 bg-red-100 rounded-lg
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
	<div class="flex justify-between" x-show="!open" >
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
				href="{{ asset('attendance_leave_data.xlsx') }}"
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
				Attendance Leave Template
			</a>
			<label for="import" class="inline">
				<input
					wire:model="import"
					type="file"
					id="import"
					name="import"
					accept=".csv,.xlsx"
					
				>
			</label>
			@error('import')
			<div class="text-red-500 inline">{{ $message }}</div>
			@enderror
			<button
				wire:click="importAttendanceLeave"
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
		<livewire:attendance-leave-form />
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
							Nik
						</th>
						<th
							scope="col"
							class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Name
						</th>
						<th
							scope="col"
							class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Phone
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
							Start Date
						</th>
						<th
							scope="col"
							class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
						    End Date
						</th>
						<th
						    scope="col"
						    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
						    Reason
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
					@forelse($attendanceLeaves as $attendanceLeave)
						<tr>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $attendanceLeave->company_name }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $attendanceLeave->branch_name }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $attendanceLeave->employee_nik }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $attendanceLeave->employee_name }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $attendanceLeave->phone }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $attendanceLeave->date }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500"
							>
								{{ $attendanceLeave->status }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-end text-sm
												font-medium flex flex-col"
								style="width: 100px"
							>
								<button
									wire:click="$dispatch('edit', { nik: '{{ $attendanceLeave->nik }}'})"
									class="text-gray-500 hover:text-sky-700 text-end"
								>
									Edit
								</button>
								<button
									wire:click="$dispatch('delete', { nik: '{{ $attendanceLeave->nik }}'})"
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
		{{ $attendanceLeaves->links() }}
	</div>
</div>