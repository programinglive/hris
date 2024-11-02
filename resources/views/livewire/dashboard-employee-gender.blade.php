<div class="bg-white p-6 rounded-lg shadow">
	<h3 class="text-xl">Gender</h3>
	<canvas id="employee-gender"></canvas>
</div>

@push('scripts')
	
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	
	<script>
		window.addEventListener('DOMContentLoaded', () => {
			const ctx = document.getElementById('employee-gender');

			new Chart(ctx, {
				type: 'doughnut',
				data: {
					labels: [
						'Male',
						'Female',
					],
					datasets: [{
						label: 'Demography',
						data: [Math.floor(Math.random() * 100), Math.floor(Math.random() * 100)],
						backgroundColor: [
							'rgb(255, 99, 132)',
							'rgb(54, 162, 235)',
						],
						hoverOffset: 4
					}]
				},
				options: {
					plugins: {
						responsive: true,
						maintainAspectRatio: false,
					}
				}
			});
		});
	</script>
@endpush