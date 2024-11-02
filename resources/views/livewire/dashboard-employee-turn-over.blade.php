<div class="flex-1 bg-white p-6 rounded-lg shadow">
	<h3 class="text-xl">Employee Turn Over</h3>
	<canvas id="employee-turn-over" width="400" height="200"></canvas>
</div>

@push('scripts')
	
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	
	<script>
		window.addEventListener('DOMContentLoaded', () => {
			const ctx = document.getElementById('employee-turn-over');

			new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
					datasets: [{
						label: '# of Votes',
						data: [12, 19, 3, 5, 2, 3],
						borderWidth: 1,
						barThickness: 3,
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