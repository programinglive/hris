<div class="flex flex-col gap-4">
	<livewire:breadcrumb :moduleLabel="$moduleLabel" />
	<livewire:page-filter :companyCode="$companyCode" />
	<livewire:user-table :companyCode="$companyCode" />
</div>