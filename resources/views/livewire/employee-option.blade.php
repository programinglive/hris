<div>
	<h2 class="text-2xl font-bold mb-4">Employee Form</h2>
	<div class="flex flex-col gap-3">
		<label for="search">Search Employee</label>
		<input
			wire:model.live.debounce.500ms="search"
			type="text"
			id="search"
			class="form-input pr-10"
			placeholder="Search Employee..."
		>
	</div>
	@if ($employees)
		<ul class="list-none bg-gray-100">
			@foreach ($employees as $employee)
				<li class="px-4 py-2 hover:bg-gray-100">
					<a href="#" wire:click="selectEmployee('{{ $employee->id }}')">
						{{ $employee->name }}
					</a>
				</li>
			@endforeach
		</ul>
	@endif
</div>