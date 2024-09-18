<form wire:submit.prevent="{{$actionForm}}">
	<div class="flex flex-col gap-4">
		<livewire:form-company-option />
		<div class="flex flex-col gap-3">
			<label for="title" class="block text-sm font-medium text-gray-700">Title</label>
			<input
				wire:model="title"
				type="text"
				id="title"
				class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
			>
			@error('title')
			<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
				<span class="font-medium">Error!</span> {{ $message }}
			</div>
			@enderror
		</div>
		<div class="flex flex-col gap-3">
			<label for="content" class="block text-sm font-medium text-gray-700">Content</label>
			<textarea
				wire:model="content"
				id="content"
				name="content"
				rows="4"
				class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
			></textarea>
			@error('content')
			<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
				<span class="font-medium">Error!</span> {{ $message }}
			</div>
			@enderror
		</div>
		<div>
			<button type="submit" class="btn bg-primary text-white float-end">Save</button>
		</div>
	</div>
</form>