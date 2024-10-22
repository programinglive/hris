<div class="flex gap-2 h-10 w-full">
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
		wire:click="importUser"
		type="button"
		class="btn bg-green-500 text-white"
	>
		<i class="mgc_upload_line"></i>
	</button>
	
	<div wire:loading.class.remove="hidden" class="hidden">
		<div class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 opacity-75 flex flex-col items-center justify-center">
			<div class="animate-spin h-12 w-12 border-b-4 border-gray-900 mb-4"></div>
			<h2 class="text-center text-white text-xl font-semibold">Loading...</h2>
			<p class="w-1/3 text-center text-white">This may take a second, please don't close this page.</p>
		</div>
	</div>
</div>