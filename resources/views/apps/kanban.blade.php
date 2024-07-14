@extends('layouts.vertical', ['title' => 'Kanban', 'sub_title' => 'Apps', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
<div class="grid h-full w-full">
	<div class="overflow-hidden text-gray-700 dark:text-slate-400">
		<div class="flex overflow-x-auto custom-scroll gap-6 pb-4">
			<div class="flex flex-col flex-shrink-0 w-72 border rounded-md overflow-hidden border-gray-200 dark:border-gray-700">
				<div class="flex items-center flex-shrink-0 h-10 p-4 bg-white dark:bg-slate-800">
					<span class="block text-sm font-semibold uppercase">In progress (6)</span>
				</div>
				<div class="flex flex-col gap-4 overflow-auto p-4 h-[calc(100vh-300px)] kanban-board custom-scroll" id="kanbanborad-two">
					<div class="card p-4 cursor-pointer">
						<div class="flex justify-between items-center">
							<h4 class="flex justify-between items-center h-6 px-3 text-xs font-semibold text-danger bg-danger/25 rounded-full">Design</h4>
							<div class="text-xs">13 Jul 2023</div>
						</div>

						<h4 class="mt-3 text-sm">iOS App home page</h4>
						<div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
							<div class="flex items-center">
								<i class="mgc_chat_3_line text-base"></i>
								<span class="ms-1 leading-none">12</span>
							</div>
							<div class="flex items-center ms-4">
								<i class="mgc_attachment_line rotate-45 text-base"></i>
								<span class="ms-1 leading-none">12</span>
							</div>
							<img class="w-6 h-6 ms-auto rounded-full" src="/images/users/avatar-8.jpg">
						</div>
					</div>

					<div class="card p-4 cursor-pointer">
						<div class="flex justify-between items-center">
							<h4 class="flex justify-between items-center h-6 px-3 text-xs font-semibold text-gray-400 bg-gray-400/25 rounded-full">Web</h4>

							<div class="text-xs">15 Jul 2023</div>
						</div>

						<h4 class="mt-3 text-sm">Topnav layout design</h4>
						<div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
							<div class="flex items-center">
								<i class="mgc_chat_3_line text-base"></i>
								<span class="ms-1 leading-none">4</span>
							</div>
							<div class="flex items-center ms-4">
								<i class="mgc_attachment_line rotate-45 text-base"></i>
								<span class="ms-1 leading-none">1</span>
							</div>
							<img class="w-6 h-6 ms-auto rounded-full" src="/images/users/avatar-4.jpg">
						</div>
					</div>

					<div class="card p-4 cursor-pointer">
						<div class="flex justify-between items-center">
							<h4 class="flex justify-between items-center h-6 px-3 text-xs font-semibold text-success bg-success/25 rounded-full">Backend</h4>

							<div class="text-xs">12 Jul 2023</div>
						</div>

						<h4 class="mt-3 text-sm">Invite user to a project</h4>
						<div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
							<div class="flex items-center">
								<i class="mgc_chat_3_line text-base"></i>
								<span class="ms-1 leading-none">8</span>
							</div>
							<div class="flex items-center ms-4">
								<i class="mgc_attachment_line rotate-45 text-base"></i>
								<span class="ms-1 leading-none">6</span>
							</div>
							<img class="w-6 h-6 ms-auto rounded-full" src="/images/users/avatar-2.jpg">
						</div>
					</div>
				</div>
			</div>

			<div class="flex flex-col flex-shrink-0 w-72 border rounded-md overflow-hidden border-gray-200 dark:border-gray-700">
				<div class="flex items-center flex-shrink-0 h-10 p-4 bg-white dark:bg-slate-800">
					<span class="block text-sm font-semibold uppercase">Todo (6)</span>
				</div>
				<div class="flex flex-col gap-4 overflow-auto p-4 h-[calc(100vh-300px)] kanban-board custom-scroll" id="kanbanborad-one">
					<div class="card p-4 cursor-pointer">
						<div class="flex justify-between items-center">
							<h4 class="flex justify-between items-center h-6 px-3 text-xs font-semibold text-info bg-info/25 rounded-full">Product</h4>

							<div class="text-xs">14 Jul 2023</div>
						</div>

						<h4 class="mt-3 text-sm">Write a release note</h4>
						<div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
							<div class="flex items-center">
								<i class="mgc_chat_3_line text-base"></i>
								<span class="ms-1 leading-none">6</span>
							</div>
							<div class="flex items-center ms-4">
								<i class="mgc_attachment_line rotate-45 text-base"></i>
								<span class="ms-1 leading-none">7</span>
							</div>
							<img class="w-6 h-6 ms-auto rounded-full" src="/images/users/avatar-4.jpg">
						</div>
					</div>

					<div class="card p-4 cursor-pointer">
						<div class="flex justify-between items-center">
							<h4 class="flex justify-between items-center h-6 px-3 text-xs font-semibold text-cyan-500 bg-cyan-500/25 rounded-full">Checking</h4>

							<div class="text-xs">18 Jul 2023</div>
						</div>

						<h4 class="mt-3 text-sm">Create a Graph of Sketch</h4>
						<div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
							<div class="flex items-center">
								<i class="mgc_chat_3_line text-base"></i>
								<span class="ms-1 leading-none">8</span>
							</div>
							<div class="flex items-center ms-4">
								<i class="mgc_attachment_line rotate-45 text-base"></i>
								<span class="ms-1 leading-none">10</span>
							</div>
							<img class="w-6 h-6 ms-auto rounded-full" src="/images/users/avatar-5.jpg">
						</div>
					</div>

					<div class="card p-4 cursor-pointer">
						<div class="flex justify-between items-center">
							<h4 class="flex justify-between items-center h-6 px-3 text-xs font-semibold text-warning bg-warning/25 rounded-full">Shopify</h4>

							<div class="text-xs">15 Jul 2023</div>
						</div>

						<h4 class="mt-3 text-sm">Enable analytics tracking</h4>
						<div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
							<div class="flex items-center">
								<i class="mgc_chat_3_line text-base"></i>
								<span class="ms-1 leading-none">5</span>
							</div>
							<div class="flex items-center ms-4">
								<i class="mgc_attachment_line rotate-45 text-base"></i>
								<span class="ms-1 leading-none">14</span>
							</div>
							<img class="w-6 h-6 ms-auto rounded-full" src="/images/users/avatar-7.jpg">
						</div>
					</div>
				</div>
			</div>

			<div class="flex flex-col flex-shrink-0 w-72 border rounded-md overflow-hidden border-gray-200 dark:border-gray-700">
				<div class="flex items-center flex-shrink-0 h-10 p-4 bg-white dark:bg-slate-800">
					<span class="block text-sm font-semibold uppercase">Review (6)</span>
				</div>
				<div class="flex flex-col gap-4 overflow-auto p-4 h-[calc(100vh-300px)] kanban-board custom-scroll" id="kanbanborad-three">
					<div class="card p-4 cursor-pointer">
						<div class="flex justify-between items-center">
							<h4 class="flex justify-between items-center h-6 px-3 text-xs font-semibold text-success bg-success/25 rounded-full">Wordpress</h4>

							<div class="text-xs">14 Jul 2023</div>
						</div>

						<h4 class="mt-3 text-sm">Kanban board design</h4>
						<div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
							<div class="flex items-center">
								<i class="mgc_chat_3_line text-base"></i>
								<span class="ms-1 leading-none">46</span>
							</div>
							<div class="flex items-center ms-4">
								<i class="mgc_attachment_line rotate-45 text-base"></i>
								<span class="ms-1 leading-none">17</span>
							</div>
							<img class="w-6 h-6 ms-auto rounded-full" src="/images/users/avatar-3.jpg">
						</div>
					</div>

					<div class="card p-4 cursor-pointer">
						<div class="flex justify-between items-center">
							<h4 class="flex justify-between items-center h-6 px-3 text-xs font-semibold text-danger bg-danger/25 rounded-full">Design</h4>

							<div class="text-xs">15 Jul 2023</div>
						</div>

						<h4 class="mt-3 text-sm">Code HTML email template</h4>
						<div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
							<div class="flex items-center">
								<i class="mgc_chat_3_line text-base"></i>
								<span class="ms-1 leading-none">24</span>
							</div>
							<div class="flex items-center ms-4">
								<i class="mgc_attachment_line rotate-45 text-base"></i>
								<span class="ms-1 leading-none">15</span>
							</div>
							<img class="w-6 h-6 ms-auto rounded-full" src="/images/users/avatar-4.jpg">
						</div>
					</div>
				</div>
			</div>

			<div class="flex flex-col flex-shrink-0 w-72 border rounded-md overflow-hidden border-gray-200 dark:border-gray-700">
				<div class="flex items-center flex-shrink-0 h-10 p-4 bg-white dark:bg-slate-800">
					<span class="block text-sm font-semibold uppercase">Done (1)</span>
				</div>
				<div class="flex flex-col gap-4 overflow-auto p-4 h-[calc(100vh-300px)] kanban-board custom-scroll" id="kanbanborad-four">
					<div class="card p-4 cursor-pointer">
						<div class="flex justify-between items-center">
							<h4 class="flex justify-between items-center h-6 px-3 text-xs font-semibold text-sky-500 bg-sky-500/25 rounded-full">App</h4>

							<div class="text-xs">16 Jul 2023</div>
						</div>

						<h4 class="mt-3 text-sm">Brand logo design</h4>
						<div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
							<div class="flex items-center">
								<i class="mgc_chat_3_line text-base"></i>
								<span class="ms-1 leading-none">34</span>
							</div>
							<div class="flex items-center ms-4">
								<i class="mgc_attachment_line rotate-45 text-base"></i>
								<span class="ms-1 leading-none">16</span>
							</div>
							<img class="w-6 h-6 ms-auto rounded-full" src="/images/users/avatar-6.jpg">
						</div>
					</div>

					<div class="card p-4 cursor-pointer">
						<div class="flex justify-between items-center">
							<h4 class="flex justify-between items-center h-6 px-3 text-xs font-semibold text-danger bg-danger/25 rounded-full">Design</h4>

							<div class="text-xs">15 Jul 2023</div>
						</div>

						<h4 class="mt-3 text-sm">Improve animation loader</h4>
						<div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
							<div class="flex items-center">
								<i class="mgc_chat_3_line text-base"></i>
								<span class="ms-1 leading-none">2</span>
							</div>
							<div class="flex items-center ms-4">
								<i class="mgc_attachment_line rotate-45 text-base"></i>
								<span class="ms-1 leading-none">15</span>
							</div>
							<img class="w-6 h-6 ms-auto rounded-full" src="/images/users/avatar-9.jpg">
						</div>
					</div>
				</div>
			</div>

			<div class="flex flex-col flex-shrink-0 w-72 border rounded-md overflow-hidden border-gray-200 dark:border-gray-700">
				<div class="flex items-center flex-shrink-0 h-10 p-4 bg-white dark:bg-slate-800">
					<span class="block text-sm font-semibold uppercase">Unassigned (1)</span>
				</div>
				<div class="flex flex-col gap-4 overflow-auto p-4 h-[calc(100vh-300px)] kanban-board custom-scroll" id="kanbanborad-five">
					<div class="card p-4 cursor-pointer">
						<div class="flex justify-between items-center">
							<h4 class="flex justify-between items-center h-6 px-3 text-xs font-semibold text-success bg-success/25 rounded-full">Web</h4>

							<div class="text-xs">16 Jul 2023</div>
						</div>

						<h4 class="mt-3 text-sm">Dashboard design</h4>
						<div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
							<div class="flex items-center">
								<i class="mgc_chat_3_line text-base"></i>
								<span class="ms-1 leading-none">14</span>
							</div>
							<div class="flex items-center ms-4">
								<i class="mgc_attachment_line rotate-45 text-base"></i>
								<span class="ms-1 leading-none">5</span>
							</div>
							<img class="w-6 h-6 ms-auto rounded-full" src="/images/users/avatar-2.jpg">
						</div>
					</div>

					<div class="card p-4 cursor-pointer">
						<div class="flex justify-between items-center">
							<h4 class="flex justify-between items-center h-6 px-3 text-xs font-semibold text-amber-500 bg-amber-500/25 rounded-full">Testing</h4>

							<div class="text-xs">17 Jul 2023</div>
						</div>

						<h4 class="mt-3 text-sm">Banner Design for FB & Twitter</h4>
						<div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
							<div class="flex items-center">
								<i class="mgc_chat_3_line text-base"></i>
								<span class="ms-1 leading-none">9</span>
							</div>
							<div class="flex items-center ms-4">
								<i class="mgc_attachment_line rotate-45 text-base"></i>
								<span class="ms-1 leading-none">41</span>
							</div>
							<img class="w-6 h-6 ms-auto rounded-full" src="/images/users/avatar-7.jpg">
						</div>
					</div>
				</div>
			</div>

			<div class="flex flex-col flex-shrink-0 w-72 border rounded-md overflow-hidden border-gray-200 dark:border-gray-700">
				<div class="flex items-center flex-shrink-0 h-10 p-4 bg-white dark:bg-slate-800">
					<span class="block text-sm font-semibold uppercase">New (1)</span>
				</div>
				<div class="flex flex-col gap-4 overflow-auto p-4 h-[calc(100vh-300px)] kanban-board custom-scroll" id="kanbanborad-six">
					<div class="card p-4 cursor-pointer">
						<div class="flex justify-between items-center">
							<h4 class="flex justify-between items-center h-6 px-3 text-xs font-semibold text-pink-500 bg-pink-500/25 rounded-full">Q&A</h4>

							<div class="text-xs">17 Jul 2023</div>
						</div>

						<h4 class="mt-3 text-sm">Create a Blog Template UI</h4>
						<div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
							<div class="flex items-center">
								<i class="mgc_chat_3_line text-base"></i>
								<span class="ms-1 leading-none">14</span>
							</div>
							<div class="flex items-center ms-4">
								<i class="mgc_attachment_line rotate-45 text-base"></i>
								<span class="ms-1 leading-none">5</span>
							</div>
							<img class="w-6 h-6 ms-auto rounded-full" src="/images/users/avatar-4.jpg">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
    @vite('resources/js/pages/apps-kanban.js')
@endsection