@extends('layouts.vertical', ['title' => 'Spiners', 'sub_title' => 'Component', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid 2xl:grid-cols-2 grid-cols-1 gap-6">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Example</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="ExampleSpinner">
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
                <div class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-primary rounded-full" role="status" aria-label="loading">
                    <span class="sr-only">Loading...</span>
                </div>

                <div id="ExampleSpinner" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;div class=&quot;animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-primary rounded-full&quot; role=&quot;status&quot; aria-label=&quot;loading&quot;&gt;
                            &lt;span class=&quot;sr-only&quot;&gt;Loading...&lt;/span&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Color variants</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#ColorVariantsSpinners">
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
                <div class="flex flex-wrap gap-3">
                    <div class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-gray-800 rounded-full dark:text-white" role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-gray-400 rounded-full" role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-red-600 rounded-full" role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-yellow-600 rounded-full" role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-green-600 rounded-full" role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-primary rounded-full" role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-indigo-600 rounded-full" role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-purple-600 rounded-full" role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-pink-600 rounded-full" role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-orange-600 rounded-full" role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <div id="ColorVariantsSpinners" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div class=&quot;animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-gray-800 rounded-full dark:text-white&quot; role=&quot;status&quot; aria-label=&quot;loading&quot;&gt;
                            &lt;span class=&quot;sr-only&quot;&gt;Loading...&lt;/span&gt;
                        &lt;/div&gt;

                        &lt;div class=&quot;animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-gray-400 rounded-full&quot; role=&quot;status&quot; aria-label=&quot;loading&quot;&gt;
                            &lt;span class=&quot;sr-only&quot;&gt;Loading...&lt;/span&gt;
                        &lt;/div&gt;

                        &lt;div class=&quot;animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-red-600 rounded-full&quot; role=&quot;status&quot; aria-label=&quot;loading&quot;&gt;
                            &lt;span class=&quot;sr-only&quot;&gt;Loading...&lt;/span&gt;
                        &lt;/div&gt;

                        &lt;div class=&quot;animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-yellow-600 rounded-full&quot; role=&quot;status&quot; aria-label=&quot;loading&quot;&gt;
                            &lt;span class=&quot;sr-only&quot;&gt;Loading...&lt;/span&gt;
                        &lt;/div&gt;

                        &lt;div class=&quot;animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-green-600 rounded-full&quot; role=&quot;status&quot; aria-label=&quot;loading&quot;&gt;
                            &lt;span class=&quot;sr-only&quot;&gt;Loading...&lt;/span&gt;
                        &lt;/div&gt;

                        &lt;div class=&quot;animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-primary rounded-full&quot; role=&quot;status&quot; aria-label=&quot;loading&quot;&gt;
                            &lt;span class=&quot;sr-only&quot;&gt;Loading...&lt;/span&gt;
                        &lt;/div&gt;

                        &lt;div class=&quot;animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-indigo-600 rounded-full&quot; role=&quot;status&quot; aria-label=&quot;loading&quot;&gt;
                            &lt;span class=&quot;sr-only&quot;&gt;Loading...&lt;/span&gt;
                        &lt;/div&gt;

                        &lt;div class=&quot;animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-purple-600 rounded-full&quot; role=&quot;status&quot; aria-label=&quot;loading&quot;&gt;
                            &lt;span class=&quot;sr-only&quot;&gt;Loading...&lt;/span&gt;
                        &lt;/div&gt;

                        &lt;div class=&quot;animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-pink-600 rounded-full&quot; role=&quot;status&quot; aria-label=&quot;loading&quot;&gt;
                            &lt;span class=&quot;sr-only&quot;&gt;Loading...&lt;/span&gt;
                        &lt;/div&gt;

                        &lt;div class=&quot;animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-orange-600 rounded-full&quot; role=&quot;status&quot; aria-label=&quot;loading&quot;&gt;
                            &lt;span class=&quot;sr-only&quot;&gt;Loading...&lt;/span&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Sizes</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#SizeSpinners">
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
                <div class="space-x-2">
                    <div class="animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-primary rounded-full" role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-primary rounded-full" role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="animate-spin inline-block w-8 h-8 border-[3px] border-current border-t-transparent text-primary rounded-full" role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <div id="SizeSpinners" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div class=&quot;animate-spin inline-block w-4 h-4 border-[3px] border-current border-t-transparent text-primary rounded-full&quot; role=&quot;status&quot; aria-label=&quot;loading&quot;&gt;
                            &lt;span class=&quot;sr-only&quot;&gt;Loading...&lt;/span&gt;
                        &lt;/div&gt;

                        &lt;div class=&quot;animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-primary rounded-full&quot; role=&quot;status&quot; aria-label=&quot;loading&quot;&gt;
                            &lt;span class=&quot;sr-only&quot;&gt;Loading...&lt;/span&gt;
                        &lt;/div&gt;

                        &lt;div class=&quot;animate-spin inline-block w-8 h-8 border-[3px] border-current border-t-transparent text-primary rounded-full&quot; role=&quot;status&quot; aria-label=&quot;loading&quot;&gt;
                            &lt;span class=&quot;sr-only&quot;&gt;Loading...&lt;/span&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Customized description</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#CustommizeSpinners">
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
                <div class="relative">
                    <div class="bg-sky-50 border border-sky-200 rounded-md p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="mgc_safe_alert_line text-lg text-sky-400"></i>
                            </div>
                            <div class="ms-3">
                                <h3 class="text-sm text-sky-800 font-medium">
                                    Attention needed
                                </h3>
                                <div class="text-sm text-sky-700 mt-2">
                                    <span class="font-semibold">Holy guacamole!</span> You should check in on some of those fields below.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute top-0 start-0 w-full h-full bg-white/[.5] rounded-md dark:bg-gray-800/[.4]"></div>

                    <div class="absolute top-1/2 start-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        <div class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-primary rounded-full" role="status" aria-label="loading">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>

                <div id="CustommizeSpinners" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div class=&quot;relative&quot;&gt;
                            &lt;div class=&quot;bg-sky-50 border border-sky-200 rounded-md p-4&quot;&gt;
                                &lt;div class=&quot;flex&quot;&gt;
                                    &lt;div class=&quot;flex-shrink-0&quot;&gt;
                                        &lt;i class=&quot;mgc_safe_alert_line text-lg text-sky-400&quot;&gt;&lt;/i&gt;
                                    &lt;/div&gt;
                                    &lt;div class=&quot;ms-3&quot;&gt;
                                        &lt;h3 class=&quot;text-sm text-sky-800 font-medium&quot;&gt;
                                            Attention needed
                                        &lt;/h3&gt;
                                        &lt;div class=&quot;text-sm text-sky-700 mt-2&quot;&gt;
                                            &lt;span class=&quot;font-semibold&quot;&gt;Holy guacamole!&lt;/span&gt; You should check in on some of those fields below.
                                        &lt;/div&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;

                            &lt;div class=&quot;absolute top-0 start-0 w-full h-full bg-white/[.5] rounded-md dark:bg-gray-800/[.4]&quot;&gt;&lt;/div&gt;

                            &lt;div class=&quot;absolute top-1/2 start-1/2 transform -translate-x-1/2 -translate-y-1/2&quot;&gt;
                                &lt;div class=&quot;animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-primary rounded-full&quot; role=&quot;status&quot; aria-label=&quot;loading&quot;&gt;
                                    &lt;span class=&quot;sr-only&quot;&gt;Loading...&lt;/span&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Inside a card</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#InsideCardSpinners">
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
                <div class="min-h-[15rem] flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700 dark:shadow-slate-700/[.7]">
                    <div class="flex flex-auto flex-col justify-center items-center p-4 md:p-5">
                        <div class="flex justify-center">
                            <div class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-primary rounded-full" role="status" aria-label="loading">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="InsideCardSpinners" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div class=&quot;min-h-[15rem] flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700 dark:shadow-slate-700/[.7]&quot;&gt;
                            &lt;div class=&quot;flex flex-auto flex-col justify-center items-center p-4 md:p-5&quot;&gt;
                                &lt;div class=&quot;flex justify-center&quot;&gt;
                                    &lt;div class=&quot;animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-primary rounded-full&quot; role=&quot;status&quot; aria-label=&quot;loading&quot;&gt;
                                        &lt;span class=&quot;sr-only&quot;&gt;Loading...&lt;/span&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
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
