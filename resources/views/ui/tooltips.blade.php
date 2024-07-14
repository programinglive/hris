@extends('layouts.vertical', ['title' => 'Tooltips', 'sub_title' => 'Component', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid 2xl:grid-cols-2 grid-cols-1 gap-6">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Placement Tooltips</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="PlacementTooltipsHtml">
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
                <div class="flex flex-wrap gap-2">
                    <div>
                        <button class="btn bg-primary text-white" data-fc-type="tooltip" data-fc-placement="bottom">
                            Tooltip Bottom
                        </button>
                        <div class="bg-slate-700 hidden mt-1 px-2 py-1 rounded transition-all text-white opacity-0 z-50" role="tooltip">
                            Bottom Tooltip
                            <div data-fc-arrow class="bg-slate-700 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]"></div>
                        </div>
                    </div>

                    <div>
                        <button class="btn bg-primary text-white" data-fc-type="tooltip" data-fc-placement="right">
                            Tooltip Right
                        </button>
                        <div class="bg-slate-700 hidden ms-1 px-2 py-1 rounded transition-all text-white opacity-0 z-50" role="tooltip">
                            Right Tooltip
                            <div data-fc-arrow class="bg-slate-700 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]"></div>
                        </div>
                    </div>

                    <div>
                        <button class="btn bg-primary text-white" data-fc-type="tooltip" data-fc-placement="top">
                            Tooltip Top
                        </button>
                        <div class="bg-slate-700 hidden px-2 py-1 rounded transition-all text-white opacity-0 z-50" role="tooltip">
                            Top Tooltip
                            <div data-fc-arrow class="bg-slate-700 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]"></div>
                        </div>
                    </div>

                    <div>
                        <button class="btn bg-primary text-white" data-fc-type="tooltip" data-fc-placement="left">
                            Tooltip Left
                        </button>
                        <div class="bg-slate-700 hidden me-1 px-2 py-1 rounded transition-all text-white opacity-0 z-50" role="tooltip">
                            Left Tooltip
                            <div data-fc-arrow class="bg-slate-700 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]"></div>
                        </div>
                    </div>
                </div>

                <div id="PlacementTooltipsHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div&gt;
                            &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-type=&quot;tooltip&quot; data-fc-placement=&quot;bottom&quot;&gt;
                                Tooltip Bottom
                            &lt;/button&gt;
                            &lt;div class=&quot;bg-slate-700 hidden mt-1 px-2 py-1 rounded transition-all text-white opacity-0 z-50&quot; role=&quot;tooltip&quot;&gt;
                            Bottom Tooltip
                                &lt;div data-fc-arrow class=&quot;bg-slate-700 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]&quot;&gt;&lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-type=&quot;tooltip&quot; data-fc-placement=&quot;right&quot;&gt;
                                Tooltip Right
                            &lt;/button&gt;
                            &lt;div class=&quot;bg-slate-700 hidden ms-1 px-2 py-1 rounded transition-all text-white opacity-0 z-50&quot; role=&quot;tooltip&quot;&gt;
                                Right Tooltip
                                &lt;div data-fc-arrow class=&quot;bg-slate-700 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]&quot;&gt;&lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-type=&quot;tooltip&quot; data-fc-placement=&quot;top&quot;&gt;
                                Tooltip Top
                            &lt;/button&gt;
                            &lt;div class=&quot;bg-slate-700 hidden px-2 py-1 rounded transition-all text-white opacity-0 z-50&quot; role=&quot;tooltip&quot;&gt;
                                Top Tooltip
                                &lt;div data-fc-arrow class=&quot;bg-slate-700 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]&quot;&gt;&lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-type=&quot;tooltip&quot; data-fc-placement=&quot;left&quot;&gt;
                                Tooltip Left
                            &lt;/button&gt;
                            &lt;div class=&quot;bg-slate-700 hidden me-1 px-2 py-1 rounded transition-all text-white opacity-0 z-50&quot; role=&quot;tooltip&quot;&gt;
                                Left Tooltip
                                &lt;div data-fc-arrow class=&quot;bg-slate-700 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]&quot;&gt;&lt;/div&gt;
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
                    <h4 class="card-title">Color Tooltips</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="ColoredTooltipsHtml">
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
                <div class="flex flex-wrap gap-2">
                    <div>
                        <button class="btn bg-primary text-white" data-fc-type="tooltip" data-fc-placement="top">
                            Primary
                        </button>
                        <div class="bg-primary hidden px-2 py-1 rounded transition-all text-white opacity-0 z-50" role="tooltip">
                            Primary Tooltip
                            <div data-fc-arrow class="bg-primary w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]"></div>
                        </div>
                    </div>

                    <div>
                        <button class="btn bg-danger text-white" data-fc-type="tooltip" data-fc-placement="top">
                            danger
                        </button>
                        <div class="bg-danger hidden px-2 py-1 rounded transition-all text-white opacity-0 z-50" role="tooltip">
                            danger Tooltip
                            <div data-fc-arrow class="bg-danger w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]"></div>
                        </div>
                    </div>

                    <div>
                        <button class="btn bg-success text-white" data-fc-type="tooltip" data-fc-placement="top">
                            success
                        </button>
                        <div class="bg-success hidden px-2 py-1 rounded transition-all text-white opacity-0 z-50" role="tooltip">
                            success Tooltip
                            <div data-fc-arrow class="bg-success w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]"></div>
                        </div>
                    </div>

                    <div>
                        <button class="btn bg-info text-white" data-fc-type="tooltip" data-fc-placement="top">
                            Info
                        </button>
                        <div class="bg-info hidden px-2 py-1 rounded transition-all text-white opacity-0 z-50" role="tooltip">
                            Info Tooltip
                            <div data-fc-arrow class="bg-info w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]"></div>
                        </div>
                    </div>
                </div>

                <div id="ColoredTooltipsHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div&gt;
                            &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-type=&quot;tooltip&quot; data-fc-placement=&quot;top&quot;&gt;
                                Primary
                            &lt;/button&gt;
                            &lt;div class=&quot;bg-primary hidden px-2 py-1 rounded transition-all text-white opacity-0 z-50&quot; role=&quot;tooltip&quot;&gt;
                                Primary Tooltip
                                &lt;div data-fc-arrow class=&quot;bg-primary w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]&quot;&gt;&lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button class=&quot;btn bg-danger text-white&quot; data-fc-type=&quot;tooltip&quot; data-fc-placement=&quot;top&quot;&gt;
                                danger
                            &lt;/button&gt;
                            &lt;div class=&quot;bg-danger hidden px-2 py-1 rounded transition-all text-white opacity-0 z-50&quot; role=&quot;tooltip&quot;&gt;
                                danger Tooltip
                                &lt;div data-fc-arrow class=&quot;bg-danger w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]&quot;&gt;&lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button class=&quot;btn bg-success text-white&quot; data-fc-type=&quot;tooltip&quot; data-fc-placement=&quot;top&quot;&gt;
                                success
                            &lt;/button&gt;
                            &lt;div class=&quot;bg-success hidden px-2 py-1 rounded transition-all text-white opacity-0 z-50&quot; role=&quot;tooltip&quot;&gt;
                                success Tooltip
                                &lt;div data-fc-arrow class=&quot;bg-success w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]&quot;&gt;&lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button class=&quot;btn bg-info text-white&quot; data-fc-type=&quot;tooltip&quot; data-fc-placement=&quot;top&quot;&gt;
                                Info
                            &lt;/button&gt;
                            &lt;div class=&quot;bg-info hidden px-2 py-1 rounded transition-all text-white opacity-0 z-50&quot; role=&quot;tooltip&quot;&gt;
                                Info Tooltip
                                &lt;div data-fc-arrow class=&quot;bg-info w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]&quot;&gt;&lt;/div&gt;
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
                    <h4 class="card-title">Real Example</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="RealTooltip">
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
                <div class="text-muted">
                    You can use frost
                    <span class="underline italic cursor-help" data-fc-type="tooltip">tooltip</span>
                    <span class="bg-slate-700 hidden px-2 py-1 rounded transition-all text-white opacity-0 z-50" role="tooltip"> Why you see at bottom
                        <span class="bg-slate-700 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]" data-fc-arrow></span>
                    </span>
                    to specify extra information. You can also use in
                    <span class="underline italic cursor-help" data-fc-placement="bottom" data-fc-type="tooltip">large</span>
                    <div class="hidden">
                        <div class="max-w-xs bg-white border border-gray-100 text-left rounded-lg dark:bg-gray-800 dark:border-gray-700 p-3">
                            <p class="block text-lg font-medium">Overview</p>
                            <div class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                                <img alt="images" class="mb-3 rounded" src="https://placehold.co/300x150">
                                <p>This is a popover body with supporting text below as a natural lead-in to additional
                                    content.</p>
                                <dl class="mt-3">
                                    <dt class="font-bold pt-3 first:pt-0 dark:text-white">Assigned to:</dt>
                                    <dd class="text-gray-600 dark:text-gray-400">Charles East</dd>
                                    <dt class="font-bold pt-3 first:pt-0 dark:text-white">Due:</dt>
                                    <dd class="text-gray-600 dark:text-gray-400">March 20, 2023</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    Tooltip
                </div>

                <div id="RealTooltip" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div class=&quot;text-muted&quot;&gt;
                            You can use frost
                            &lt;span class=&quot;underline italic cursor-help&quot; data-fc-type=&quot;tooltip&quot;&gt;tooltip&lt;/span&gt;
                            &lt;span class=&quot;bg-slate-700 hidden px-2 py-1 rounded transition-all text-white opacity-0 z-50&quot; role=&quot;tooltip&quot;&gt; Why you see at bottom
                                &lt;span class=&quot;bg-slate-700 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]&quot; data-fc-arrow&gt;&lt;/span&gt;
                            &lt;/span&gt;

                            to specify extra information. You can also use in
                            &lt;span class=&quot;underline italic cursor-help&quot; data-fc-placement=&quot;bottom&quot; data-fc-type=&quot;tooltip&quot;&gt;large&lt;/span&gt;
                            &lt;div class=&quot;hidden&quot;&gt;
                                &lt;div class=&quot;max-w-xs bg-white border border-gray-100 text-left rounded-lg dark:bg-gray-800 dark:border-gray-700 p-3&quot;&gt;
                                    &lt;p class=&quot;block text-lg font-medium&quot;&gt;Overview&lt;/p&gt;
                                    &lt;div class=&quot;text-sm text-gray-600 dark:text-gray-400 mt-2&quot;&gt;
                                        &lt;img alt=&quot;images&quot; class=&quot;mb-3 rounded&quot; src=&quot;https://placehold.co/300x150&quot;&gt;
                                        &lt;p&gt;This is a popover body with supporting text below as a natural lead-in to additional
                                            content.&lt;/p&gt;
                                        &lt;dl class=&quot;mt-3&quot;&gt;
                                            &lt;dt class=&quot;font-bold pt-3 first:pt-0 dark:text-white&quot;&gt;Assigned to:&lt;/dt&gt;
                                            &lt;dd class=&quot;text-gray-600 dark:text-gray-400&quot;&gt;Denish Navadiya&lt;/dd&gt;
                                            &lt;dt class=&quot;font-bold pt-3 first:pt-0 dark:text-white&quot;&gt;Due:&lt;/dt&gt;
                                            &lt;dd class=&quot;text-gray-600 dark:text-gray-400&quot;&gt;March 20, 2023&lt;/dd&gt;
                                        &lt;/dl&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                            tooltip
                        &lt;/div&gt;
                    </code>
                </pre>
                </div>
            </div> <!-- end p-6 -->
        </div> <!-- end card-->
    </div>
@endsection
@section('script')
    @vite(['resources/js/pages/highlight.js'])
@endsection
