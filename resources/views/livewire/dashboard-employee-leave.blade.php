<div class="col-span-2 bg-white p-6 rounded-lg shadow">
	<h3 class="text-xl">Leave</h3>
	<canvas id="employee-leave" width="400" height="150"></canvas>
</div>

@push('scripts')
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	
	<script>
		window.addEventListener('DOMContentLoaded', () => {
			const ctx = document.getElementById('employee-leave');

			new Chart(ctx, {
				type: 'line',
				data: {
					labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
					datasets: [{
						label: '# of Leave',
						data: Array.from({ length: 12 }, () => Math.floor(Math.random() * 100) + 1),
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