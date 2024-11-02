<div class="flex flex-col gap-4">
	<div class="flex gap-3">
		<livewire:dashboard-employee-count />
		<livewire:dashboard-on-boarding-count />
		<livewire:dashboard-off-boarding-count />
		<livewire:dashboard-probation-count />
	</div>
	<div class="bg-white p-6 rounded-lg shadow">
		<h3 class="text-xl">Employee History</h3>
		<canvas id="myChart" width="400" height="200"></canvas>
	</div>
</div>

@push('scripts')
	
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	
	<script>
		window.addEventListener('DOMContentLoaded', () => {
			const ctx = document.getElementById('myChart');
	
			new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
					datasets: [{
						label: '# of Votes',
						data: [12, 19, 3, 5, 2, 3],
						borderWidth: 1
					}]
				},
				options: {
					scales: {
						y: {
							beginAtZero: true
						}
					}
				}
			});
		});
	</script>
@endpush