<form wire:submit.prevent="{{$actionForm}}">
	<div class="flex flex-col gap-4">
		<div class="flex flex-col gap-3">
			<label for="date" class="block text-sm font-medium text-gray-700">Date</label>
			<input
				wire:model="date"
				type="date"
				id="date"
				class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500
								block w-full sm:text-sm border border-gray-300 rounded-md p-2"
			>
			@error('date')
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
			<label for="type" class="block text-sm font-medium text-gray-700">Type</label>
			<select
				wire:model="type"
				id="type"
				class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500
								block w-full sm:text-sm border border-gray-300 rounded-md p-2"
			>
				<option value="">Select Type</option>
				<option value="working day">Working Day</option>
				<option value="holiday">Holiday</option>
				<option value="event">Event</option>
			</select>
			@error('type')
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
			<label for="description" class="block text-sm font-medium text-gray-700">
				Description
			</label>
			<textarea
				wire:model="description"
				id="description"
				name="description"
				rows="4"
				class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block
								w-full sm:text-sm border border-gray-300 rounded-md p-2"
			></textarea>
			@error('description')
			<div
				class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg
								dark:bg-red-200 dark:text-red-800"
				role="alert"
			>
				<span class="font-medium">Error!</span> {{ $message }}
			</div>
			@enderror
		</div>
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
		<div>
			<button type="submit" class="btn bg-primary text-white float-end">Save</button>
		</div>
	</div>
</form>