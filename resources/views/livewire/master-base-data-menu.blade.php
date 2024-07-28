<li class="menu-item">
	<a href="#" data-fc-type="collapse" class="menu-link">
		<span class="menu-icon"><i class="mgc_inbox_line"></i></span>
		<span class="menu-text"> Base Data </span>
		<span class="menu-arrow"></span>
	</a>
	
	<ul class="sub-menu hidden">
		<li class="menu-item">
			<a href="{{ route('master.roles') }}" class="menu-link">
				<span class="menu-text">Role</span>
			</a>
		</li>
		<li class="menu-item">
			<a href="{{ route('master.permissions') }}" class="menu-link">
				<span class="menu-text">Permission</span>
			</a>
		</li>
		<li class="menu-item">
			<a href="{{ route('master.users') }}" class="menu-link">
				<span class="menu-text">User</span>
			</a>
		</li>
		<li class="menu-item">
			<a href="{{ route('master.items') }}" class="menu-link">
				<span class="menu-text">Item</span>
			</a>
		</li>
	</ul>
</li>