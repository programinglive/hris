<form wire:submit.prevent="{{$actionForm}}">
	<div class="flex flex-col gap-4">
		<livewire:form-company-option
			:companyCode="$companyCode"
		/>
		<div class="flex flex-col gap-3">
			<label for="code" class="block text-sm font-medium text-gray-700">Code</label>
			<input
				wire:model.live="code"
				type="text"
				id="code"
				class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
			>
			@error('code')
			<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
				<span class="font-medium">Error!</span> {{ $message }}
			</div>
			@enderror
		</div>
		<div class="flex flex-col gap-3">
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
		<div class="flex flex-col gap-3">
			<label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
			<input
				wire:model="phone"
				type="text"
				id="phone"
				class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
			>
			@error('phone')
			<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
				<span class="font-medium">Error!</span> {{ $message }}
			</div>
			@enderror
		</div>
		<div class="flex flex-col gap-3">
			<label for="address" class="block text-sm font-medium text-gray-700">Address</label>
			<textarea
				wire:model="address"
				id="address"
				name="address"
				rows="4"
				class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
			></textarea>
			@error('address')
			<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
				<span class="font-medium">Error!</span> {{ $message }}
			</div>
			@enderror
		</div>
		<div class="flex flex-col gap-3">
			<label for="type" class="block text-sm font-medium text-gray-700">Type</label>
			<select wire:model="type" id="type" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2">
				<option value="branch">Branch</option>
				<option value="partner">Partner</option>
			</select>
			@error('type')
			<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
				<span class="font-medium">Error!</span> {{ $message }}
			</div>
			@enderror
		</div>
		<div class="flex justify-end gap-2">
			<button
				wire:click="$dispatch('hide-form')"
				type="button"
				class="btn btn-outline-danger"
			>
				Cancel
			</button>
			<button
				type="submit"
				class="btn bg-primary text-white float-end"
			>
				Save
			</button>
		</div>
	</div>
</form>