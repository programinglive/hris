<div class="flex flex-col gap-3">
	<label for="branchCode" class="block text-sm font-medium text-gray-700">Branch</label>
	<select
		wire:model.live="branchCode"
		id="branchCode"
		class="mt-1 shadow-sm focus:ring-indigo-500
						focus:border-indigo-500 block w-full
						sm:text-sm border border-gray-300
						rounded-md p-2"
	>
		<option value="all">Select Branch</option>
		@if($branches)
			@foreach ($branches as $branch)
				<option value="{{ $branch->code }}">{{ $branch->name }}</option>
			@endforeach
		@endif
	</select>
	@error('branchCode')
	<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
		<span class="font-medium">Error!</span> {{ $message }}
	</div>
	@enderror
</div>