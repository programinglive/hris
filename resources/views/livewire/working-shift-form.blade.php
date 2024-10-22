<form wire:submit.prevent="{{$actionForm}}">
	<div class="flex flex-col gap-4">
		<div class="flex gap-2 justify-between">
			<div class="flex flex-col gap-3 flex-1">
				<label for="name" class="block text-sm font-medium text-gray-700">Name</label>
				<input
					wire:model="name"
					type="text"
					id="name"
					class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
				>
				@error('name')
				<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
					<span class="font-medium">Error!</span> {{ $message }}
				</div>
				@enderror
			</div>
			<div class="flex flex-col gap-3 flex-1">
			    <label for="startTime" class="block text-sm font-medium text-gray-700">Start Time</label>
			    <input
			        wire:model="startTime"
			        type="time"
			        id="startTime"
			        class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
			    >
			    @error('startTime')
			    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
			        <span class="font-medium">Error!</span> {{ $message }}
			    </div>
			    @enderror
			</div>
			<div class="flex flex-col gap-3 flex-1">
				<label for="endTime" class="block text-sm font-medium text-gray-700">End Time</label>
				<input
					wire:model="endTime"
					type="time"
					id="endTime"
					class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
				>
				@error('endTime')
				<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
					<span class="font-medium">Error!</span> {{ $message }}
				</div>
				@enderror
			</div>
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