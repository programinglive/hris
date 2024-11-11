<div class="flex gap-2">
	<a
		href="{{ asset('company_data.xlsx') }}"
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
				d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0
								0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"
			/>
		</svg>
		Company Template
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
		wire:click="importCompany"
		type="button"
		class="btn bg-green-500 text-white inline"
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