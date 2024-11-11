<div class="rounded bg-white flex flex-col gap-6 px-5 py-4 overflow-x-auto"
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
			
			<a
				href="{{ asset('vacancy_data.xlsx') }}"
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
				Vacancy Template
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
				wire:click="importVacancy"
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
	<div x-show="!open">
		<div class="inline-block align-middle">
			<table
					class="max-w-full divide-y divide-gray-200 dark:divide-gray-700"
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
							Code
						</th>
						<th
							scope="col"
							class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Title
						</th>
						<th
							scope="col"
							class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Description
						</th>
						<th
							scope="col"
							class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Location
						</th>
						<th
							scope="col"
							class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Job Type
						</th>
						<th
							scope="col"
							class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Category
						</th>
						<th
							scope="col"
							class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Experience Level
						</th>
						<th
							scope="col"
							class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Salary Range
						</th>
						<th
							scope="col"
							class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Posting Date
						</th>
						<th
							scope="col"
							class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase"
						>
							Closing Date
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
					@forelse($vacancies as $vacancy)
						<tr>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500 text-nowrap"
							>
								{{ $vacancy->company_name }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500 text-nowrap"
							>
								{{ $vacancy->branch_name }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500 text-nowrap"
							>
								{{ $vacancy->code }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-500 text-nowrap"
							>
								{{ $vacancy->name }}
							</td>
							<td
								class="px-4 py-2 whitespace-nowrap text-end text-sm
												font-medium flex flex-col"
								style="width: 100px"
							>
								<button
									wire:click="$dispatch('edit', { code: '{{ $vacancy->code }}'})"
									class="text-gray-500 hover:text-sky-700 text-end text-nowrap"
								>
									Edit
								</button>
								<button
									wire:click="$dispatch('delete', { code: '{{ $vacancy->code }}'})"
									class="text-gray-500 hover:text-sky-700 text-end text-nowrap"
								>
									Delete
								</button>
							</td>
						</tr>
					@empty
						<tr>
							<td
								colspan="11"
								class="text-center text-gray-500 pt-4"
							>
								Empty Data
							</td>
						</tr>
					@endforelse
					</tbody>
				</table>
		</div>
		<hr class="my-4 border-gray-300">
		{{ $vacancies->links() }}
	</div>
</div>