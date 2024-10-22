<li class="menu-item">
	<a href="#" data-fc-type="collapse" class="menu-link">
		<span class="menu-icon"><i class="mgc_calendar_time_add_line"></i></span>
		<span class="menu-text"> Attendance </span>
		<span class="menu-arrow"></span>
	</a>
	
	<ul class="sub-menu hidden">
		<li class="menu-item">
			<a href="{{ route('transaction.attendance_times') }}" class="menu-link">
				<span class="menu-text">Time</span>
			</a>
		</li>
		<li class="menu-item">
		    <a href="{{ route('transaction.attendance_overtimes') }}" class="menu-link">
		        <span class="menu-text">Overtime</span>
		    </a>
		</li>
		<li class="menu-item">
			<a href="{{ route('transaction.attendance_switch_offs') }}" class="menu-link">
				<span class="menu-text">Switch Off</span>
			</a>
		</li>
		<li class="menu-item">
			<a href="{{ route('transaction.attendance_leaves') }}" class="menu-link">
				<span class="menu-text">Leave</span>
			</a>
		</li>
		<li class="menu-item">
			<a href="{{ route('transaction.attendance_confirms') }}" class="menu-link">
				<span class="menu-text">Confirm</span>
			</a>
		</li>
	</ul>
</li>