<div>
	@if(session('announcement'))
		<div class="p-4 mb-4" role="alert"
		     style="border-left: 4px solid
					     {{ session('announcement.type') === 'warning'
									? '#ffa500' : (session('announcement.type') === 'danger'
									? '#e3342f' : '#38a169')
							 }};
		     background-color:
		            {{ session('announcement.type') === 'warning'
										? '#fff3cd' : (session('announcement.type') === 'danger'
										? '#fce8e9' : '#d1fae5')
								}};
		     color:
		            {{ session('announcement.type') === 'warning'
										? '#856404' : (session('announcement.type') === 'danger'
										? '#721c24' : '#2f6f4f')
								}};
			">
			<p class="font-bold">{{ session('announcement.title') }}</p>
			<p>{{ session('announcement.message') }}</p>

			@if(session('announcement.url') && !route('master.branches'))
				<a href="{{ session('announcement.url') }}" target="_blank" class="text-blue-500 hover:text-blue-700 hover:underline">Click here</a>
			@endif
		</div>
	@endif
</div>