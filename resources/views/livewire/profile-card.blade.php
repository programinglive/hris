<div class="grid grid-cols-4 gap-4">
	<div class="col-span-1 bg-white shadow rounded">
		<div class="flex items-center gap-4 p-6">
			<img src="http://localhost:8000/images/users/user-6.jpg" alt="Profile" class="w-20 h-20 rounded-full">
			<div>
				<h2 class="text-lg font-bold text-gray-800 dark:text-white">{{ auth()->user()->name }}</h2>
				<p class="text-sm text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
			</div>
		</div>
	</div>
	<div class="col-span-3 bg-white shadow rounded">
		<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
			<ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
				<li class="me-2" role="presentation">
					<button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
				</li>
				<li class="me-2" role="presentation">
					<button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Attendance</button>
				</li>
				<li class="me-2" role="presentation">
					<button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-styled-tab" data-tabs-target="#styled-settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Schedule</button>
				</li>
				<li role="presentation">
					<button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-styled-tab" data-tabs-target="#styled-contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Assets</button>
				</li>
			</ul>
		</div>
		<div id="default-styled-tab-content">
			<div class="hidden p-4 rounded-lg dark:bg-gray-800" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
				<p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Profile tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
			</div>
			<div class="hidden p-4 rounded-lg dark:bg-gray-800" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
				<p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
			</div>
			<div class="hidden p-4 rounded-lg dark:bg-gray-800" id="styled-settings" role="tabpanel" aria-labelledby="settings-tab">
				<p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
			</div>
			<div class="hidden p-4 rounded-lg dark:bg-gray-800" id="styled-contacts" role="tabpanel" aria-labelledby="contacts-tab">
				<p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
			</div>
		</div>
	</div>
</div>

@push('scripts')
	<script>
		const tabsElement = document.getElementById('tabs-example');

		// create an array of objects with the id, trigger element (eg. button), and the content element
		const tabElements = [
			{
				id: 'profile',
				triggerEl: document.querySelector('#profile-tab-example'),
				targetEl: document.querySelector('#profile-example'),
			},
			{
				id: 'dashboard',
				triggerEl: document.querySelector('#dashboard-tab-example'),
				targetEl: document.querySelector('#dashboard-example'),
			},
			{
				id: 'settings',
				triggerEl: document.querySelector('#settings-tab-example'),
				targetEl: document.querySelector('#settings-example'),
			},
			{
				id: 'contacts',
				triggerEl: document.querySelector('#contacts-tab-example'),
				targetEl: document.querySelector('#contacts-example'),
			},
		];

		// options with default values
		const options = {
			defaultTabId: 'settings',
			activeClasses:
				'text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-400 border-blue-600 dark:border-blue-500',
			inactiveClasses:
				'text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300',
			onShow: () => {
				console.log('tab is shown');
			},
		};

		// instance options with default values
		const instanceOptions = {
			id: 'tabs-example',
			override: true
		};
	</script>
@endpush