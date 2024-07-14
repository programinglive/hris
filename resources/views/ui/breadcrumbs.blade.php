@extends('layouts.vertical', ['title' => 'Breadcrumbs', 'sub_title' => 'Component', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid 2xl:grid-cols-2 grid-cols-1 gap-6">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Simple</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="SimaplBreadcrumbHtml">
                            <i class="mgc_eye_line text-lg"></i>
                            <span class="ms-2">Code</span>
                        </button>

                        <button class="btn-code" data-clipboard-action="copy">
                            <i class="mgc_copy_line text-lg"></i>
                            <span class="ms-2">Copy</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol role="list" class="flex items-center text-sm font-semibold space-x-4">
                        <li>
                            <div class="flex items-center">
                                <a href="#" class="text-gray-400 hover:text-gray-500">
                                    <i class="mgc_home_4_line text-lg flex-shrink-0 align-middle"></i>
                                    <span class="sr-only">Home</span>
                                </a>
                            </div>
                        </li>

                        <li>
                            <div class="flex items-center">
                                <i class="mgc_right_line text-lg flex-shrink-0 text-gray-400"></i>
                                <a href="#" class="ms-4 text-sm font-medium text-gray-500 hover:text-gray-700">Apps</a>
                            </div>
                        </li>

                        <li>
                            <div class="flex items-center">
                                <i class="mgc_right_line text-lg flex-shrink-0 text-gray-400"></i>
                                <a href="#" class="ms-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page">Calendar</a>
                            </div>
                        </li>
                    </ol>
                </nav>

                <div id="SimaplBreadcrumbHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;nav class=&quot;flex&quot; aria-label=&quot;Breadcrumb&quot;&gt;
										&lt;ol role=&quot;list&quot; class=&quot;flex items-center text-sm font-semibold space-x-4&quot;&gt;
											&lt;li&gt;
												&lt;div class=&quot;flex items-center&quot;&gt;
													&lt;a href=&quot;#&quot; class=&quot;text-gray-400 hover:text-gray-500&quot;&gt;
														&lt;i class=&quot;mgc_home_4_line text-lg flex-shrink-0 align-middle&quot;&gt;&lt;/i&gt;
														&lt;span class=&quot;sr-only&quot;&gt;Home&lt;/span&gt;
													&lt;/a&gt;
												&lt;/div&gt;
											&lt;/li&gt;
				
											&lt;li&gt;
												&lt;div class=&quot;flex items-center&quot;&gt;
													&lt;i class=&quot;mgc_right_line text-lg flex-shrink-0 text-gray-400&quot;&gt;&lt;/i&gt;
													&lt;a href=&quot;#&quot; class=&quot;ms-4 text-sm font-medium text-gray-500 hover:text-gray-700&quot;&gt;Apps&lt;/a&gt;
												&lt;/div&gt;
											&lt;/li&gt;
				
											&lt;li&gt;
												&lt;div class=&quot;flex items-center&quot;&gt;
													&lt;i class=&quot;mgc_right_line text-lg flex-shrink-0 text-gray-400&quot;&gt;&lt;/i&gt;
													&lt;a href=&quot;#&quot; class=&quot;ms-4 text-sm font-medium text-gray-500 hover:text-gray-700&quot; aria-current=&quot;page&quot;&gt;Calendar&lt;/a&gt;
												&lt;/div&gt;
											&lt;/li&gt;
										&lt;/ol&gt;
									&lt;/nav&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Example</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="ExampleBreadcrumbHtml">
                            <i class="mgc_eye_line text-lg"></i>
                            <span class="ms-2">Code</span>
                        </button>

                        <button class="btn-code" data-clipboard-action="copy">
                            <i class="mgc_copy_line text-lg"></i>
                            <span class="ms-2">Copy</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <ol class="flex items-center whitespace-nowrap min-w-0" aria-label="Breadcrumb">
                    <li class="text-sm text-gray-600 dark:text-gray-400">
                        <a class="flex items-center hover:text-primary" href="#">
                            Home
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400 dark:text-gray-600 mx-2" width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M6 13L10 3" stroke="currentColor" stroke-linecap="round">
                            </svg>
                        </a>
                    </li>
                    </li>
                    <li class="text-sm text-gray-600 dark:text-gray-400">
                        <a class="flex items-center hover:text-primary" href="#">
                            App Center
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400 dark:text-gray-600 mx-2" width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M6 13L10 3" stroke="currentColor" stroke-linecap="round">
                            </svg>
                        </a>
                    </li>
                    </li>
                    <li class="text-sm font-semibold text-gray-800 truncate dark:text-gray-200" aria-current="page">
                        Application
                    </li>
                </ol>

                <div id="ExampleBreadcrumbHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;ol class=&quot;flex items-center whitespace-nowrap min-w-0&quot; aria-label=&quot;Breadcrumb&quot;&gt;
										&lt;li class=&quot;text-sm text-gray-600 dark:text-gray-400&quot;&gt;
											&lt;a class=&quot;flex items-center hover:text-primary&quot; href=&quot;#&quot;&gt;
												Home
												&lt;svg class=&quot;flex-shrink-0 h-5 w-5 text-gray-400 dark:text-gray-600 mx-2&quot; width=&quot;16&quot; height=&quot;16&quot; viewBox=&quot;0 0 16 16&quot; fill=&quot;none&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; aria-hidden=&quot;true&quot;&gt;
													&lt;path d=&quot;M6 13L10 3&quot; stroke=&quot;currentColor&quot; stroke-linecap=&quot;round&quot; &gt;
												&lt;/svg&gt;
											&lt;/a&gt;
										&lt;/li&gt;
		
										&lt;li class=&quot;text-sm text-gray-600 dark:text-gray-400&quot;&gt;
											&lt;a class=&quot;flex items-center hover:text-primary&quot; href=&quot;#&quot;&gt;
												App Center
												&lt;svg class=&quot;flex-shrink-0 h-5 w-5 text-gray-400 dark:text-gray-600 mx-2&quot; width=&quot;16&quot; height=&quot;16&quot; viewBox=&quot;0 0 16 16&quot; fill=&quot;none&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; aria-hidden=&quot;true&quot;&gt;
													&lt;path d=&quot;M6 13L10 3&quot; stroke=&quot;currentColor&quot; stroke-linecap=&quot;round&quot; &gt;
												&lt;/svg&gt;
											&lt;/a&gt;
										&lt;/li&gt;
		
										&lt;li class=&quot;text-sm font-semibold text-gray-800 truncate dark:text-gray-200&quot; aria-current=&quot;page&quot;&gt;
											Application
										&lt;/li&gt;
									&lt;/ol&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    @vite(['resources/js/pages/highlight.js'])
@endsection
