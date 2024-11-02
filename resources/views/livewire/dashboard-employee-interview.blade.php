<div class="col-span-2 bg-white p-6 rounded-lg shadow">
	<h3 class="text-xl">Interview</h3>
	<div id='calendar'></div>
</div>

@push('scripts')
	<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
	
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			let calendarEl = document.getElementById('calendar');
			let calendar = new FullCalendar.Calendar(calendarEl, {
				initialView: 'timeGridDay',
				headerToolbar: {
					left: 'prev,next today',
					right: 'timeGridDay,timeGridWeek'
				}});
			calendar.render();
		});
	</script>
@endpush