<div class="flex flex-col gap-4">
	<div class="flex gap-3">
		<livewire:dashboard-employee-count />
		<livewire:dashboard-on-boarding-count />
		<livewire:dashboard-off-boarding-count />
		<livewire:dashboard-probation-count />
	</div>
	<div class="grid grid-cols-2 gap-4">
		<livewire:dashboard-employee-history :filterYear="$filterYear"/>
		<livewire:dashboard-employee-turn-over :filterYear="$filterYear"/>
		<livewire:dashboard-employee-late :filterYear="$filterYear"/>
		<livewire:dashboard-employee-leave :filterYear="$filterYear"/>
	</div>
</div>