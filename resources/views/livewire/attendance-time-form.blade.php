<form wire:submit.prevent="{{$actionForm}}">
	<div class="flex flex-col gap-4">
		<livewire:employee-option />
		<div class="flex flex-col gap-3">
			<label
				for="date"
				class="block text-sm
								font-medium text-gray-700"
			>
				Date
			</label>
			<input
				wire:model="date"
				type="date"
				id="date"
				class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
			>
			@error('date')
			<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
				<span class="font-medium">Error!</span> {{ $message }}
			</div>
			@enderror
		</div>
		<div class="flex flex-col gap-3">
			<label
				for="in"
				class="block text-sm
								font-medium text-gray-700"
			>
				In
			</label>
			<input
				wire:model="in"
				type="time"
				id="in"
				class="mt-1 shadow-sm focus:ring-indigo-500
								focus:border-indigo-500 block w-full
								sm:text-sm border border-gray-300 rounded-md p-2"
			>
			@error('in')
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
				for="out"
				class="block text-sm font-medium text-gray-700"
			>
				Out
			</label>
			<input
				wire:model="out"
				type="time"
				id="out"
				class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500
								block w-full sm:text-sm border border-gray-300 rounded-md p-2"
			>
			@error('out')
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
				for="status"
				class="block text-sm font-medium text-gray-700"
			>
				Status
			</label>
			<select
				wire:model="status"
				id="status"
				class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
			>
				<option value="on_time">On time</option>
				<option value="late">Late</option>
				<option value="leave">Leave</option>
				<option value="time_off">Time off</option>
				<option value="no_info">No info</option>
			</select>
			@error('status')
			<div
				class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg
								dark:bg-red-200 dark:text-red-800"
				role="alert"
			>
				<span class="font-medium">Error!</span> {{ $message }}
			</div>
			@enderror
		</div>
		<div>
			<button
				type="submit"
				class="btn bg-primary text-white float-end"
			>
				Save
			</button>
		</div>
	</div>
</form>