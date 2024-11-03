<div class="flex flex-col gap-4">
	<div class="grid grid-cols-4 gap-4">
		<livewire:dashboard-employee-count />
		<livewire:dashboard-on-boarding-count />
		<livewire:dashboard-off-boarding-count />
		<livewire:dashboard-probation-count />
		<livewire:dashboard-employee-history :filterYear="$filterYear"/>
		<livewire:dashboard-employee-gender :filterYear="$filterYear"/>
		<livewire:dashboard-employee-birthday :filterYear="$filterYear"/>
		<div class="col-span-2 flex flex-col gap-4">
			<livewire:dashboard-employee-late :filterYear="$filterYear"/>
			<livewire:dashboard-employee-leave :filterYear="$filterYear"/>
		</div>
		<livewire:dashboard-employee-interview :filterYear="$filterYear"/>
		<livewire:dashboard-employee-turn-over :filterYear="$filterYear"/>
		<livewire:dashboard-employee-request :filterYear="$filterYear"/>
	</div>
</div>