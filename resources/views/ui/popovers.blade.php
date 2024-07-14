@extends('layouts.vertical', ['title' => 'Popovers', 'sub_title' => 'Component', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Default Popover</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#alertHeadingHtml">
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
                <button class="btn bg-primary text-white" data-fc-target="default-tooltip" data-fc-trigger="click" data-fc-type="tooltip">
                    Click me
                </button>
                <div id="default-tooltip" class="bg-slate-700 hidden mt-1 px-2 py-1 rounded transition-all text-white opacity-0 z-50">
                    Believe me! I'm Popover 😀
                    <div class="bg-slate-700 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]" data-fc-arrow></div>
                </div>

                <div id="alertHeadingHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html">
                    <code>
                        &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-target=&quot;default-tooltip&quot; data-fc-trigger=&quot;click&quot; data-fc-type=&quot;tooltip&quot;&gt;
                            Click me
                        &lt;/button&gt;
                        &lt;div id=&quot;default-tooltip&quot; class=&quot;bg-slate-700 hidden mt-1 px-2 py-1 rounded transition-all text-white opacity-0 z-50&quot;&gt;
                            Believe me! I'm Popover 😀
                            &lt;div class=&quot;bg-slate-700 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]&quot; data-fc-arrow&gt;&lt;/div&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Auto Targeting Popover</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#autoTargetingPopover">
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
                <button class="btn bg-primary text-white" data-fc-trigger="click" data-fc-type="tooltip">
                    Click me
                </button>
                <div class="bg-slate-700 hidden mt-1 px-2 py-1 rounded transition-all text-white opacity-0 z-50">
                    It's magic
                    <div class="bg-slate-700 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]" data-fc-arrow></div>
                </div>

                <div id="autoTargetingPopover" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html">
                    <code>
                        &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-trigger=&quot;click&quot; data-fc-type=&quot;tooltip&quot;&gt;
                            Click me
                        &lt;/button&gt;
                        &lt;div class=&quot;bg-slate-700 hidden mt-1 px-2 py-1 rounded transition-all text-white opacity-0 z-50&quot;&gt;
                            It's magic
                            &lt;div class=&quot;bg-slate-700 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]&quot; data-fc-arrow&gt;&lt;/div&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Four directions Popovers</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#withDirectionPopover">
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
                    <div>
                        <button type="button" data-fc-type="tooltip" data-fc-placement="top" data-fc-trigger="click" class="btn bg-primary/10 text-primary">
                            Popover on Top
                        </button>
                        <div class="bg-gray-400 hidden px-3 py-1 rounded-md transition-all text-white opacity-0 z-50">
                            Top popover
                            <div data-fc-arrow class="bg-gray-400 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]"></div>
                        </div>
                    </div>

                    <div>
                        <button type="button" data-fc-type="tooltip" data-fc-placement="bottom" data-fc-trigger="click" class="btn bg-primary/10 text-primary">
                            Popover on Bottom
                        </button>
                        <div class="bg-gray-400 hidden px-3 py-1 rounded-md transition-all text-white opacity-0 z-50">
                            Bottom popover
                            <div data-fc-arrow class="bg-gray-400 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]"></div>
                        </div>
                    </div>

                    <div>
                        <button type="button" data-fc-type="tooltip" data-fc-placement="left" data-fc-trigger="click" class="btn bg-primary/10 text-primary">
                            Popover on Left
                        </button>
                        <div class="bg-gray-400 hidden px-3 py-1 rounded-md transition-all text-white opacity-0 z-50">
                            <div data-fc-arrow class="bg-gray-400 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]"></div>
                            Left popover
                        </div>
                    </div>

                    <div>
                        <button type="button" data-fc-type="tooltip" data-fc-placement="right" data-fc-trigger="click" class="btn bg-primary/10 text-primary">
                            Popover on Right
                        </button>
                        <div class="bg-gray-400 hidden px-3 py-1 rounded-md transition-all text-white opacity-0 z-50">
                            Right popover
                            <div data-fc-arrow class="bg-gray-400 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]"></div>
                        </div>
                    </div>
                </div>

                <div id="withDirectionPopover" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div&gt;
                            &lt;button type=&quot;button&quot; data-fc-type=&quot;tooltip&quot; data-fc-placement=&quot;top&quot; data-fc-trigger=&quot;click&quot; class=&quot;btn bg-primary/10 text-primary&quot;&gt;
                                Popover on Top
                            &lt;/button&gt;
                            &lt;div class=&quot;bg-gray-400 hidden px-3 py-1 rounded-md transition-all text-white opacity-0 z-50&quot;&gt;
                                Top popover
                                &lt;div data-fc-arrow class=&quot;bg-gray-400 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]&quot;&gt;&lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button type=&quot;button&quot; data-fc-type=&quot;tooltip&quot; data-fc-placement=&quot;bottom&quot; data-fc-trigger=&quot;click&quot; class=&quot;btn bg-primary/10 text-primary&quot;&gt;
                                Popover on Bottom
                            &lt;/button&gt;
                            &lt;div class=&quot;bg-gray-400 hidden px-3 py-1 rounded-md transition-all text-white opacity-0 z-50&quot;&gt;
                                Bottom popover
                                &lt;div data-fc-arrow class=&quot;bg-gray-400 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]&quot;&gt;&lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button type=&quot;button&quot; data-fc-type=&quot;tooltip&quot; data-fc-placement=&quot;left&quot; data-fc-trigger=&quot;click&quot; class=&quot;btn bg-primary/10 text-primary&quot;&gt;
                                Popover on Left
                            &lt;/button&gt;
                            &lt;div class=&quot;bg-gray-400 hidden px-3 py-1 rounded-md transition-all text-white opacity-0 z-50&quot;&gt;
                                &lt;div data-fc-arrow class=&quot;bg-gray-400 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]&quot;&gt;&lt;/div&gt;
                                Left popover
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button type=&quot;button&quot; data-fc-type=&quot;tooltip&quot; data-fc-placement=&quot;right&quot; data-fc-trigger=&quot;click&quot; class=&quot;btn bg-primary/10 text-primary&quot;&gt;
                                Popover on Right
                            &lt;/button&gt;
                            &lt;div class=&quot;bg-gray-400 hidden px-3 py-1 rounded-md transition-all text-white opacity-0 z-50&quot;&gt;
                                Right popover
                                &lt;div data-fc-arrow class=&quot;bg-gray-400 w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px]&quot;&gt;&lt;/div&gt;
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
                    <h4 class="card-title">With content Popover</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#withContentPopover">
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
                    <div>
                        <button type="button" data-fc-type="tooltip" data-fc-placement="top" data-fc-trigger="click" class="btn bg-primary text-white">
                            Popover With Text
                        </button>
                        <div class="w-72 hidden z-50">
                            <div data-fc-arrow class="bg-white border border-gray-100 w-3 h-3 rotate-45 -z-10 rounded-[1px] dark:bg-gray-800 dark:border-gray-700"></div>
                            <div class="bg-white border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
                                <div class="px-4 py-3 border-b dark:border-gray-700">Popover title</div>
                                <div class="p-4">
                                    And here's some amazing content. It's very engaging. Right?
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="button" data-fc-type="tooltip" data-fc-placement="bottom" data-fc-trigger="click" class="btn bg-primary text-white">
                            Popover with Images
                        </button>

                        <div class="hidden z-50">
                            <div data-fc-arrow class="bg-white border border-gray-100 shadow-lg w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px] dark:bg-gray-800 dark:border-gray-700"></div>
                            <div class="max-w-xs bg-white border border-gray-100 text-left rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700" role="tooltip">
                                <span class="pt-3 px-4 block text-lg font-bold text-gray-800 dark:text-white">Overview</span>
                                <div class="py-3 px-4 text-sm text-gray-600 dark:text-gray-400">
                                    <img src="https://placehold.co/600x400" class="mb-3 rounded" alt="images">
                                    <p>This is a popover body with supporting text below as a natural lead-in to additional content.</p>
                                    <dl class="mt-3">
                                        <dt class="font-bold pt-3 first:pt-0 dark:text-white">Assigned to:</dt>
                                        <dd class="text-gray-600 dark:text-gray-400">Mark Welson</dd>
                                        <dt class="font-bold pt-3 first:pt-0 dark:text-white">Due:</dt>
                                        <dd class="text-gray-600 dark:text-gray-400">December 21, 2021</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="withContentPopover" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div&gt;
                            &lt;button type=&quot;button&quot; data-fc-type=&quot;tooltip&quot; data-fc-placement=&quot;top&quot; data-fc-trigger=&quot;click&quot; class=&quot;btn bg-primary text-white&quot;&gt;
                                Popover With Text
                            &lt;/button&gt;
                            &lt;div class=&quot;w-72 hidden z-50&quot;&gt;
                                &lt;div data-fc-arrow class=&quot;bg-white border border-gray-100 w-3 h-3 rotate-45 -z-10 rounded-[1px] dark:bg-gray-800 dark:border-gray-700&quot;&gt;&lt;/div&gt;
                                &lt;div class=&quot;bg-white border border-gray-100 dark:bg-gray-800 dark:border-gray-700&quot;&gt;
                                    &lt;div class=&quot;px-4 py-3 border-b dark:border-gray-700&quot;&gt;Popover title&lt;/div&gt;
                                    &lt;div class=&quot;p-4&quot;&gt;
                                        And here's some amazing content. It's very engaging. Right?
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button type=&quot;button&quot; data-fc-type=&quot;tooltip&quot; data-fc-placement=&quot;bottom&quot; data-fc-trigger=&quot;click&quot; class=&quot;btn bg-primary text-white&quot;&gt;
                                Popover with Images
                            &lt;/button&gt;

                            &lt;div class=&quot;hidden z-50&quot;&gt;
                                &lt;div data-fc-arrow class=&quot;bg-white border border-gray-100 shadow-lg w-2.5 h-2.5 rotate-45 -z-10 rounded-[1px] dark:bg-gray-800 dark:border-gray-700&quot;&gt;&lt;/div&gt;
                                &lt;div class=&quot;max-w-xs bg-white border border-gray-100 text-left rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700&quot; role=&quot;tooltip&quot;&gt;
                                    &lt;span class=&quot;pt-3 px-4 block text-lg font-bold text-gray-800 dark:text-white&quot;&gt;Overview&lt;/span&gt;
                                    &lt;div class=&quot;py-3 px-4 text-sm text-gray-600 dark:text-gray-400&quot;&gt;
                                        &lt;img src=&quot;https://placehold.co/600x400&quot; class=&quot;mb-3 rounded&quot; alt=&quot;images&quot;&gt;
                                        &lt;p&gt;This is a popover body with supporting text below as a natural lead-in to additional content.&lt;/p&gt;
                                        &lt;dl class=&quot;mt-3&quot;&gt;
                                            &lt;dt class=&quot;font-bold pt-3 first:pt-0 dark:text-white&quot;&gt;Assigned to:&lt;/dt&gt;
                                            &lt;dd class=&quot;text-gray-600 dark:text-gray-400&quot;&gt;Mark Welson&lt;/dd&gt;
                                            &lt;dt class=&quot;font-bold pt-3 first:pt-0 dark:text-white&quot;&gt;Due:&lt;/dt&gt;
                                            &lt;dd class=&quot;text-gray-600 dark:text-gray-400&quot;&gt;December 21, 2021&lt;/dd&gt;
                                        &lt;/dl&gt;
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
