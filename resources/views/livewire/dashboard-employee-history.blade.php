<div class="col-span-2 bg-white p-6 rounded-lg shadow">
	<div class="flex justify-between">
		<h3 class="text-xl">History </h3>
		<h3 class="text-xl">
			{{ $filterYear }}
		</h3>
	</div>
	<canvas id="employee-history" width="400" height="200"></canvas>
</div>

@push('scripts')
	
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	
	<script>
		window.addEventListener('DOMContentLoaded', () => {
			const ctx = document.getElementById('employee-history');

			new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
					datasets: [{
						label: '# of Employee',
						data: Array.from({ length: 12 }, () => Math.floor(Math.random() * 10) + 1),
						borderWidth: 1,
						barThickness: 3,
					}]
				},
				options: {
					layout: {
						padding: {
							left: 0,
							right: 0,
							top: 0,
							bottom: 0,
						},
					},
					scales: {
						y: {
							beginAtZero: true,
						}
					}
				}
			});
		});
	</script>
@endpush