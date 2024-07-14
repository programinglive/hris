@extends('layouts.vertical', ['title' => 'Tickets', 'sub_title' => 'Apps', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
<div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-6">
	<div class="card">
		<div class="p-5">
			<div class="flex justify-between">
				<div class="w-20 h-20 rounded-full inline-flex items-center justify-center bg-primary/25 ">
					<i class="mgc_tag_line text-4xl text-primary"></i>
				</div>
				<div class="text-right">
					<h3 class="text-gray-700 mt-1 text-2xl font-bold mb-5 dark:text-gray-300">3947</h3>
					<p class="text-gray-500 mb-1 truncate dark:text-gray-400">Total Tickets</p>
				</div>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="p-5">
			<div class="flex justify-between">
				<div class="w-20 h-20 rounded-full inline-flex items-center justify-center bg-yellow-100">
					<i class="mgc_alarm_2_line text-4xl text-yellow-500"></i>
				</div>
				<div class="text-right">
					<h3 class="text-gray-700 mt-1 text-2xl font-bold mb-5 dark:text-gray-300">624</h3>
					<p class="text-gray-500 mb-1 truncate dark:text-gray-400">Pending Tickets</p>
				</div>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="p-5">
			<div class="flex justify-between">
				<div class="w-20 h-20 rounded-full inline-flex items-center justify-center bg-green-100">
					<i class="mgc_check_line text-4xl text-green-500"></i>
				</div>
				<div class="text-right">
					<h3 class="text-gray-700 mt-1 text-2xl font-bold mb-5 dark:text-gray-300">3195</h3>
					<p class="text-gray-500 mb-1 truncate dark:text-gray-400">Closed Tickets</p>
				</div>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="p-5">
			<div class="flex justify-between">
				<div class="w-20 h-20 rounded-full inline-flex items-center justify-center bg-red-100">
					<i class="mgc_delete_line text-4xl text-red-500"></i>
				</div>
				<div class="text-right">
					<h3 class="text-gray-700 mt-1 text-2xl font-bold mb-5 dark:text-gray-300">128</h3>
					<p class="text-gray-500 mb-1 truncate dark:text-gray-400">Deleted Tickets</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="mt-6">
	<div class="card">
		<div class="flex flex-wrap justify-between items-center gap-2 p-6">
			<a href="javascript:void(0);" class="btn bg-danger/20 text-sm font-medium text-danger hover:text-white hover:bg-danger">
				<i class="mgc_add_circle_line me-3"></i>
				Add Customers</a>
			<div class="flex flex-wrap gap-2">
				<button type="button" class="btn bg-success/25 text-lg font-medium text-success hover:text-white hover:bg-success">
					<i class="mgc_settings_3_line"></i>
				</button>
				<button type="button" class="btn bg-dark/25 text-sm font-medium text-slate-900 dark:text-slate-200/70 hover:text-white hover:bg-dark/90">Import</button>
				<button type="button" class="btn bg-dark/25 text-sm font-medium text-slate-900 dark:text-slate-200/70 hover:text-white hover:bg-dark/90">Export</button>
			</div>
		</div>
		<div class="relative overflow-x-auto">
			<table class="w-full divide-y divide-gray-300 dark:divide-gray-700">
				<thead class="bg-slate-300 bg-opacity-20 border-t dark:bg-slate-800 divide-gray-300 dark:border-gray-700">
					<tr>
						<th scope="col" class="py-3.5 ps-4 pe-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">ID</th>
						<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">Requested By</th>
						<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">Subject</th>
						<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">Assignee</th>
						<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">Priority</th>
						<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">Status</th>
						<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">Created Date</th>
						<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">Due Date</th>
						<th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900 dark:text-gray-200">Action</th>
					</tr>
				</thead>
				<tbody class="divide-y divide-gray-200 dark:divide-gray-700 ">
					<tr>
						<td class="whitespace-nowrap py-4 ps-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
							<b>#1020</b>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm">
							<div class="flex items-center">
								<div class="h-10 w-10 flex-shrink-0">
									<img class="h-10 w-10 rounded-full" src="/images/users/avatar-9.jpg" alt="">
								</div>
								<div class="font-medium text-gray-900 dark:text-gray-200 ms-4">Lindsay Walton</div>
							</div>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">A new rating has been received</td>
						<td class="whitespace-nowrap py-4 px-3 text-sm">
							<img class="h-10 w-10 rounded-full" src="/images/users/avatar-9.jpg" alt="">
						</td>
						<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
							<div class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-primary/25 text-primary">Medium</div>
						</td>
						<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
							<div class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-dark/80 text-white">Closed</div>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">13/08/2011</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">30/08/2013</td>
						<td class="whitespace-nowrap py-4 px-3 text-center text-sm font-medium">
							<a href="javascript:void(0);" class="me-0.5">
								<i class="mgc_edit_line text-lg"></i>
							</a>
							<a href="javascript:void(0);" class="ms-0.5">
								<i class="mgc_delete_line text-xl"></i>
							</a>
						</td>
					</tr>

					<tr>
						<td class="whitespace-nowrap py-4 ps-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
							<b>#1254</b>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm">
							<div class="flex items-center">
								<div class="h-10 w-10 flex-shrink-0">
									<img class="h-10 w-10 rounded-full" src="/images/users/avatar-2.jpg" alt="">
								</div>
								<div class="font-medium text-gray-900 dark:text-gray-200 ms-4">Jhon Maryo</div>
							</div>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">Your application has been received!</td>
						<td class="whitespace-nowrap py-4 px-3 text-sm">
							<img class="h-10 w-10 rounded-full" src="/images/users/avatar-2.jpg" alt="">
						</td>
						<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
							<div class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-danger/25 text-danger">High</div>
						</td>
						<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
							<div class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-dark/80 text-white">Closed</div>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">01/04/2017</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">21/05/2017</td>
						<td class="whitespace-nowrap py-4 px-3 text-center text-sm font-medium">
							<a href="javascript:void(0);" class="me-0.5">
								<i class="mgc_edit_line text-lg"></i>
							</a>
							<a href="javascript:void(0);" class="ms-0.5">
								<i class="mgc_delete_line text-xl"></i>
							</a>
						</td>
					</tr>

					<tr>
						<td class="whitespace-nowrap py-4 ps-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
							<b>#1256</b>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm">
							<div class="flex items-center">
								<div class="h-10 w-10 flex-shrink-0">
									<img class="h-10 w-10 rounded-full" src="/images/users/avatar-3.jpg" alt="user">
								</div>
								<div class="font-medium text-gray-900 dark:text-gray-200 ms-4">Jerry Geiger</div>
							</div>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
							Support for theme</td>
						<td class="whitespace-nowrap py-4 px-3 text-sm">
							<img class="h-10 w-10 rounded-full" src="/images/users/avatar-3.jpg" alt="">
						</td>
						<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
							<div class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-dark/25 text-slate-900 dark:text-slate-200/90">Low</div>
						</td>
						<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
							<div class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-success/90 text-white">Open</div>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">28/07/2020</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">28/07/2020</td>
						<td class="whitespace-nowrap py-4 px-3 text-center text-sm font-medium">
							<a href="javascript:void(0);" class="me-0.5">
								<i class="mgc_edit_line text-lg"></i>
							</a>
							<a href="javascript:void(0);" class="ms-0.5">
								<i class="mgc_delete_line text-xl"></i>
							</a>
						</td>
					</tr>

					<tr>
						<td class="whitespace-nowrap py-4 ps-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
							<b>#1352</b>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm">
							<div class="flex items-center">
								<div class="h-10 w-10 flex-shrink-0">
									<img class="h-10 w-10 rounded-full" src="/images/users/avatar-4.jpg" alt="user">
								</div>
								<div class="font-medium text-gray-900 dark:text-gray-200 ms-4">Adam Thomas</div>
							</div>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">Question regarding your Tailwind Theme</td>
						<td class="whitespace-nowrap py-4 px-3 text-sm">
							<img class="h-10 w-10 rounded-full" src="/images/users/avatar-4.jpg" alt="">
						</td>
						<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
							<div class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-danger/25 text-danger">High</div>
						</td>
						<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
							<div class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-success/90 text-white">Open</div>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">01/04/2017</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">21/05/2017</td>
						<td class="whitespace-nowrap py-4 px-3 text-center text-sm font-medium">
							<a href="javascript:void(0);" class="me-0.5">
								<i class="mgc_edit_line text-lg"></i>
							</a>
							<a href="javascript:void(0);" class="ms-0.5">
								<i class="mgc_delete_line text-xl"></i>
							</a>
						</td>
					</tr>

					<tr>
						<td class="whitespace-nowrap py-4 ps-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
							<b>#2251</b>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm">
							<div class="flex items-center">
								<div class="h-10 w-10 flex-shrink-0">
									<img class="h-10 w-10 rounded-full" src="/images/users/avatar-5.jpg" alt="user">
								</div>
								<div class="font-medium text-gray-900 dark:text-gray-200 ms-4">Sara Lewis</div>
							</div>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">Verify your new email address!</td>
						<td class="whitespace-nowrap py-4 px-3 text-sm">
							<img class="h-10 w-10 rounded-full" src="/images/users/avatar-5.jpg" alt="">
						</td>
						<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
							<div class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-danger/25 text-danger">High</div>
						</td>
						<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
							<div class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-success/90 text-white">Open</div>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">20/04/2008</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">20/04/2008</td>
						<td class="whitespace-nowrap py-4 px-3 text-center text-sm font-medium">
							<a href="javascript:void(0);" class="me-0.5">
								<i class="mgc_edit_line text-lg"></i>
							</a>
							<a href="javascript:void(0);" class="ms-0.5">
								<i class="mgc_delete_line text-xl"></i>
							</a>
						</td>
					</tr>

					<tr>
						<td class="whitespace-nowrap py-4 ps-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
							<b>#2542</b>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm">
							<div class="flex items-center">
								<div class="h-10 w-10 flex-shrink-0">
									<img class="h-10 w-10 rounded-full" src="/images/users/avatar-6.jpg" alt="user">
								</div>
								<div class="font-medium text-gray-900 dark:text-gray-200 ms-4">Myrtle Johnson</div>
							</div>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">New submission on your website</td>
						<td class="whitespace-nowrap py-4 px-3 text-sm">
							<img class="h-10 w-10 rounded-full" src="/images/users/avatar-6.jpg" alt="">
						</td>
						<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
							<div class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-primary/25 text-primary">Medium</div>
						</td>
						<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
							<div class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-dark/80 text-white">Closed</div>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">20/04/2017</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">25/04/2017</td>
						<td class="whitespace-nowrap py-4 px-3 text-center text-sm font-medium">
							<a href="javascript:void(0);" class="me-0.5">
								<i class="mgc_edit_line text-lg"></i>
							</a>
							<a href="javascript:void(0);" class="ms-0.5">
								<i class="mgc_delete_line text-xl"></i>
							</a>
						</td>
					</tr>

					<tr>
						<td class="whitespace-nowrap py-4 ps-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
							<b>#3020</b>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm">
							<div class="flex items-center">
								<div class="h-10 w-10 flex-shrink-0">
									<img class="h-10 w-10 rounded-full" src="/images/users/avatar-7.jpg" alt="user">
								</div>
								<div class="font-medium text-gray-900 dark:text-gray-200 ms-4">Bryan Collier</div>
							</div>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">Verify your new email address!</td>
						<td class="whitespace-nowrap py-4 px-3 text-sm">
							<img class="h-10 w-10 rounded-full" src="/images/users/avatar-7.jpg" alt="">
						</td>
						<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
							<div class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-danger/25 text-danger">High</div>
						</td>
						<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
							<div class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-success/90 text-white">Open</div>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">02/06/2018</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">21/06/2018</td>
						<td class="whitespace-nowrap py-4 px-3 text-center text-sm font-medium">
							<a href="javascript:void(0);" class="me-0.5">
								<i class="mgc_edit_line text-lg"></i>
							</a>
							<a href="javascript:void(0);" class="ms-0.5">
								<i class="mgc_delete_line text-xl"></i>
							</a>
						</td>
					</tr>

					<tr>
						<td class="whitespace-nowrap py-4 ps-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
							<b>#3562</b>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm">
							<div class="flex items-center">
								<div class="h-10 w-10 flex-shrink-0">
									<img class="h-10 w-10 rounded-full" src="/images/users/avatar-8.jpg" alt="user">
								</div>
								<div class="font-medium text-gray-900 dark:text-gray-200 ms-4">Joshua Moody</div>
							</div>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">Security alert for my account</td>
						<td class="whitespace-nowrap py-4 px-3 text-sm">
							<img class="h-10 w-10 rounded-full" src="/images/users/avatar-8.jpg" alt="">
						</td>
						<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
							<div class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-dark/25 text-slate-900 dark:text-slate-200/90">Low</div>
						</td>
						<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
							<div class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-success/90 text-white">Open</div>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">28/07/2020</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">03/08/2020</td>
						<td class="whitespace-nowrap py-4 px-3 text-center text-sm font-medium">
							<a href="javascript:void(0);" class="me-0.5">
								<i class="mgc_edit_line text-lg"></i>
							</a>
							<a href="javascript:void(0);" class="ms-0.5">
								<i class="mgc_delete_line text-xl"></i>
							</a>
						</td>
					</tr>

					<tr>
						<td class="whitespace-nowrap py-4 ps-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">
							<b>#3652</b>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm">
							<div class="flex items-center">
								<div class="h-10 w-10 flex-shrink-0">
									<img class="h-10 w-10 rounded-full" src="/images/users/avatar-9.jpg" alt="user">
								</div>
								<div class="ms-4">
									<div class="font-medium text-gray-900 dark:text-gray-200">John Clune</div>
									<div class="text-gray-500"></div>
								</div>
							</div>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">Item Support Message sent</td>
						<td class="whitespace-nowrap py-4 px-3 text-sm">
							<img class="h-10 w-10 rounded-full" src="/images/users/avatar-9.jpg" alt="">
						</td>
						<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
							<div class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-primary/25 text-primary">Medium</div>
						</td>
						<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
							<div class="inline-flex items-center gap-1.5 py-1 px-3 rounded text-xs font-medium bg-dark/80 text-white">Closed</div>
						</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">26/10/2021</td>
						<td class="whitespace-nowrap py-4 pe-3 text-sm font-medium text-gray-900 dark:text-gray-200">30/10/2021</td>
						<td class="whitespace-nowrap py-4 px-3 text-center text-sm font-medium">
							<a href="javascript:void(0);" class="me-0.5">
								<i class="mgc_edit_line text-lg"></i>
							</a>
							<a href="javascript:void(0);" class="ms-0.5">
								<i class="mgc_delete_line text-xl"></i>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection