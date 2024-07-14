@extends('layouts.vertical', ['title' => 'Badges', 'sub_title' => 'Component', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid 2xl:grid-cols-2 grid-cols-1 gap-6">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Default Badge</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="defaultBadgeHtml">
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
                <div class="flex flex-wrap items-end gap-2">
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-black text-white">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-500 text-white">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-500 text-white">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-500 text-white">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-500 text-white">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-primary text-white">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-indigo-500 text-white">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-purple-500 text-white">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-pink-500 text-white">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-white text-gray-600">Badge</span>
                </div>

                <div id="defaultBadgeHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-black text-white&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-500 text-white&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-500 text-white&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-500 text-white&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-500 text-white&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-primary text-white&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-indigo-500 text-white&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-purple-500 text-white&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-pink-500 text-white&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-white text-gray-600&quot;&gt;Badge&lt;/span&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div><!-- end card -->

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Soft color variants Badge</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="SoftBadgesHtml">
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
                <div class="flex flex-wrap items-end gap-2">
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-primary/25 text-sky-800">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-white/[.1] text-gray-600 dark:text-gray-400">Badge</span>
                </div>
                <div id="SoftBadgesHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-100 text-gray-800&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-primary/25 text-sky-800&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-purple-100 text-purple-800&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-white/[.1] text-gray-600 dark:text-gray-400&quot;&gt;Badge&lt;/span&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div><!-- end card -->

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Rounded Badge</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="RoundedBadgesHtml">
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
                <div class="flex flex-wrap items-end gap-2">
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-gray-100 text-gray-800">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-red-100 text-red-800">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-yellow-100 text-yellow-800">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-green-100 text-green-800">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-primary/25 text-sky-800">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-indigo-100 text-indigo-800">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-purple-100 text-purple-800">Badge</span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-white/[.1] text-gray-600 dark:text-gray-400">Badge</span>
                </div>
                <div id="RoundedBadgesHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-gray-100 text-gray-800&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-red-100 text-red-800&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-yellow-100 text-yellow-800&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-green-100 text-green-800&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-primary/25 text-sky-800&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-indigo-100 text-indigo-800&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-purple-100 text-purple-800&quot;&gt;Badge&lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-white/[.1] text-gray-600 dark:text-gray-400&quot;&gt;Badge&lt;/span&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div><!-- end card -->

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Badge with indicator</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="IndicatorBadgesHtml">
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
                <div class="flex flex-wrap items-end gap-2">
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        <span class="w-1.5 h-1.5 inline-block bg-gray-400 rounded-full"></span>
                        Badge
                    </span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        <span class="w-1.5 h-1.5 inline-block bg-red-400 rounded-full"></span>
                        Badge
                    </span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <span class="w-1.5 h-1.5 inline-block bg-yellow-400 rounded-full"></span>
                        Badge
                    </span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <span class="w-1.5 h-1.5 inline-block bg-green-400 rounded-full"></span>
                        Badge
                    </span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-primary/25 text-sky-800">
                        <span class="w-1.5 h-1.5 inline-block bg-sky-400 rounded-full"></span>
                        Badge
                    </span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        <span class="w-1.5 h-1.5 inline-block bg-indigo-400 rounded-full"></span>
                        Badge
                    </span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                        <span class="w-1.5 h-1.5 inline-block bg-purple-400 rounded-full"></span>
                        Badge
                    </span>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-white/[.1] text-gray-600 dark:text-gray-400">
                        <span class="w-1.5 h-1.5 inline-block bg-gray-600 dark:text-gray-400 rounded-full"></span>
                        Badge
                    </span>
                </div>
                <div id="IndicatorBadgesHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-100 text-gray-800&quot;&gt;
                            &lt;span class=&quot;w-1.5 h-1.5 inline-block bg-gray-400 rounded-full&quot;&gt;&lt;/span&gt;
                            Badge
                        &lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800&quot;&gt;
                            &lt;span class=&quot;w-1.5 h-1.5 inline-block bg-red-400 rounded-full&quot;&gt;&lt;/span&gt;
                            Badge
                        &lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800&quot;&gt;
                            &lt;span class=&quot;w-1.5 h-1.5 inline-block bg-yellow-400 rounded-full&quot;&gt;&lt;/span&gt;
                            Badge
                        &lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800&quot;&gt;
                            &lt;span class=&quot;w-1.5 h-1.5 inline-block bg-green-400 rounded-full&quot;&gt;&lt;/span&gt;
                            Badge
                        &lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-primary/25 text-sky-800&quot;&gt;
                            &lt;span class=&quot;w-1.5 h-1.5 inline-block bg-sky-400 rounded-full&quot;&gt;&lt;/span&gt;
                            Badge
                        &lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800&quot;&gt;
                            &lt;span class=&quot;w-1.5 h-1.5 inline-block bg-indigo-400 rounded-full&quot;&gt;&lt;/span&gt;
                            Badge
                        &lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-purple-100 text-purple-800&quot;&gt;
                            &lt;span class=&quot;w-1.5 h-1.5 inline-block bg-purple-400 rounded-full&quot;&gt;&lt;/span&gt;
                            Badge
                        &lt;/span&gt;
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-white/[.1] text-gray-600 dark:text-gray-400&quot;&gt;
                            &lt;span
                                class=&quot;w-1.5 h-1.5 inline-block bg-gray-600 dark:text-gray-400 rounded-full&quot;&gt;&lt;/span&gt;
                            Badge
                        &lt;/span&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div><!-- end card -->

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Badge with indicator</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="CloseIndicatorBadgesHtml">
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
                <div class="flex flex-wrap items-end gap-2">
                    <span class="inline-flex items-center gap-1.5 py-1.5 ps-3 pe-2 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        Badge
                        <button type="button" class="flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-gray-600 hover:bg-gray-200 hover:text-gray-500 focus:outline-none focus:bg-gray-200 focus:text-gray-500">
                            <span class="sr-only">Remove badge</span>
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                            </svg>
                        </button>
                    </span>

                    <span class="inline-flex items-center gap-1.5 py-1.5 ps-3 pe-2 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        Badge
                        <button type="button" class="flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-red-600 hover:bg-red-200 hover:text-red-500 focus:outline-none focus:bg-red-200 focus:text-red-500">
                            <span class="sr-only">Remove badge</span>
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                            </svg>
                        </button>
                    </span>

                    <span class="inline-flex items-center gap-1.5 py-1.5 ps-3 pe-2 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        Badge
                        <button type="button" class="flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-yellow-600 hover:bg-yellow-200 hover:text-yellow-600 focus:outline-none focus:bg-yellow-200 focus:text-yellow-500">
                            <span class="sr-only">Remove badge</span>
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                            </svg>
                        </button>
                    </span>

                    <span class="inline-flex items-center gap-1.5 py-1.5 ps-3 pe-2 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Badge
                        <button type="button" class="flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-green-600 hover:bg-green-200 hover:text-green-500 focus:outline-none focus:bg-green-200 focus:text-green-500">
                            <span class="sr-only">Remove badge</span>
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                            </svg>
                        </button>
                    </span>

                    <span class="inline-flex items-center gap-1.5 py-1.5 ps-3 pe-2 rounded-full text-xs font-medium bg-primary/25 text-sky-800">
                        Badge
                        <button type="button" class="flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-primary hover:bg-sky-200 hover:text-primary focus:outline-none focus:bg-sky-200 focus:text-primary">
                            <span class="sr-only">Remove badge</span>
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                            </svg>
                        </button>
                    </span>

                    <span class="inline-flex items-center gap-1.5 py-1.5 ps-3 pe-2 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        Badge
                        <button type="button" class="flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-indigo-600 hover:bg-indigo-200 hover:text-indigo-500 focus:outline-none focus:bg-indigo-200 focus:text-indigo-500">
                            <span class="sr-only">Remove badge</span>
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                            </svg>
                        </button>
                    </span>

                    <span class="inline-flex items-center gap-1.5 py-1.5 ps-3 pe-2 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                        Badge
                        <button type="button" class="flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-purple-600 hover:bg-purple-200 hover:text-purple-500 focus:outline-none focus:bg-purple-200 focus:text-purple-500">
                            <span class="sr-only">Remove badge</span>
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                            </svg>
                        </button>
                    </span>

                    <span class="inline-flex items-center gap-1.5 py-1.5 ps-3 pe-2 rounded-full text-xs font-medium bg-white text-gray-500">
                        Badge
                        <button type="button" class="flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-gray-600 hover:bg-light hover:text-gray-500 focus:outline-none focus:bg-white focus:text-gray-500">
                            <span class="sr-only">Remove badge</span>
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                            </svg>
                        </button>
                    </span>
                </div>
                <div id="CloseIndicatorBadgesHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 ps-3 pe-2 rounded-full text-xs font-medium bg-gray-100 text-gray-800&quot;&gt;
                            Badge
                            &lt;button type=&quot;button&quot; class=&quot;flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-gray-600 hover:bg-gray-200 hover:text-gray-500 focus:outline-none focus:bg-gray-200 focus:text-gray-500&quot;&gt;
                                &lt;span class=&quot;sr-only&quot;&gt;Remove badge&lt;/span&gt;
                                &lt;svg class=&quot;h-4 w-4&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;16&quot; height=&quot;16&quot; fill=&quot;currentColor&quot; viewBox=&quot;0 0 16 16&quot;&gt;
                                    &lt;path d=&quot;M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z&quot;&gt;
                                &lt;/svg&gt;
                            &lt;/button&gt;
                        &lt;/span&gt;

                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 ps-3 pe-2 rounded-full text-xs font-medium bg-red-100 text-red-800&quot;&gt;
                            Badge
                            &lt;button type=&quot;button&quot; class=&quot;flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-red-600 hover:bg-red-200 hover:text-red-500 focus:outline-none focus:bg-red-200 focus:text-red-500&quot;&gt;
                                &lt;span class=&quot;sr-only&quot;&gt;Remove badge&lt;/span&gt;
                                &lt;svg class=&quot;h-4 w-4&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;16&quot; height=&quot;16&quot; fill=&quot;currentColor&quot; viewBox=&quot;0 0 16 16&quot;&gt;
                                    &lt;path d=&quot;M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z&quot;&gt;
                                &lt;/svg&gt;
                            &lt;/button&gt;
                        &lt;/span&gt;

                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 ps-3 pe-2 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800&quot;&gt;
                            Badge
                            &lt;button type=&quot;button&quot; class=&quot;flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-yellow-600 hover:bg-yellow-200 hover:text-yellow-600 focus:outline-none focus:bg-yellow-200 focus:text-yellow-500&quot;&gt;
                                &lt;span class=&quot;sr-only&quot;&gt;Remove badge&lt;/span&gt;
                                &lt;svg class=&quot;h-4 w-4&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;16&quot; height=&quot;16&quot; fill=&quot;currentColor&quot; viewBox=&quot;0 0 16 16&quot;&gt;
                                    &lt;path d=&quot;M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z&quot;&gt;
                                &lt;/svg&gt;
                            &lt;/button&gt;
                        &lt;/span&gt;

                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 ps-3 pe-2 rounded-full text-xs font-medium bg-green-100 text-green-800&quot;&gt;
                            Badge
                            &lt;button type=&quot;button&quot; class=&quot;flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-green-600 hover:bg-green-200 hover:text-green-500 focus:outline-none focus:bg-green-200 focus:text-green-500&quot;&gt;
                                &lt;span class=&quot;sr-only&quot;&gt;Remove badge&lt;/span&gt;
                                &lt;svg class=&quot;h-4 w-4&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;16&quot; height=&quot;16&quot; fill=&quot;currentColor&quot; viewBox=&quot;0 0 16 16&quot;&gt;
                                    &lt;path d=&quot;M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z&quot;&gt;
                                &lt;/svg&gt;
                            &lt;/button&gt;
                        &lt;/span&gt;

                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 ps-3 pe-2 rounded-full text-xs font-medium bg-primary/25 text-sky-800&quot;&gt;
                            Badge
                            &lt;button type=&quot;button&quot; class=&quot;flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-primary hover:bg-sky-200 hover:text-primary focus:outline-none focus:bg-sky-200 focus:text-primary&quot;&gt;
                                &lt;span class=&quot;sr-only&quot;&gt;Remove badge&lt;/span&gt;
                                &lt;svg class=&quot;h-4 w-4&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;16&quot; height=&quot;16&quot; fill=&quot;currentColor&quot; viewBox=&quot;0 0 16 16&quot;&gt;
                                    &lt;path d=&quot;M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z&quot;&gt;
                                &lt;/svg&gt;
                            &lt;/button&gt;
                        &lt;/span&gt;

                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 ps-3 pe-2 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800&quot;&gt;
                            Badge
                            &lt;button type=&quot;button&quot; class=&quot;flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-indigo-600 hover:bg-indigo-200 hover:text-indigo-500 focus:outline-none focus:bg-indigo-200 focus:text-indigo-500&quot;&gt;
                                &lt;span class=&quot;sr-only&quot;&gt;Remove badge&lt;/span&gt;
                                &lt;svg class=&quot;h-4 w-4&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;16&quot; height=&quot;16&quot; fill=&quot;currentColor&quot; viewBox=&quot;0 0 16 16&quot;&gt;
                                    &lt;path d=&quot;M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z&quot;&gt;
                                &lt;/svg&gt;
                            &lt;/button&gt;
                        &lt;/span&gt;

                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 ps-3 pe-2 rounded-full text-xs font-medium bg-purple-100 text-purple-800&quot;&gt;
                            Badge
                            &lt;button type=&quot;button&quot; class=&quot;flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-purple-600 hover:bg-purple-200 hover:text-purple-500 focus:outline-none focus:bg-purple-200 focus:text-purple-500&quot;&gt;
                                &lt;span class=&quot;sr-only&quot;&gt;Remove badge&lt;/span&gt;
                                &lt;svg class=&quot;h-4 w-4&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;16&quot; height=&quot;16&quot; fill=&quot;currentColor&quot; viewBox=&quot;0 0 16 16&quot;&gt;
                                    &lt;path d=&quot;M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z&quot;&gt;
                                &lt;/svg&gt;
                            &lt;/button&gt;
                        &lt;/span&gt;

                        &lt;span class=&quot;inline-flex items-center gap-1.5 py-1.5 ps-3 pe-2 rounded-full text-xs font-medium bg-white text-gray-500&quot;&gt;
                            Badge
                            &lt;button type=&quot;button&quot; class=&quot;flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-gray-600 hover:bg-light hover:text-gray-500 focus:outline-none focus:bg-white focus:text-gray-500&quot;&gt;
                                &lt;span class=&quot;sr-only&quot;&gt;Remove badge&lt;/span&gt;
                                &lt;svg class=&quot;h-4 w-4&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;16&quot; height=&quot;16&quot; fill=&quot;currentColor&quot; viewBox=&quot;0 0 16 16&quot;&gt;
                                    &lt;path d=&quot;M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z&quot;&gt;
                                &lt;/svg&gt;
                            &lt;/button&gt;
                        &lt;/span&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div><!-- end card -->

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Max width Badge</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="max_width_BadgesHtml">
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
                <div class="flex flex-wrap items-end lg:gap-5 gap-">
                    <span class="max-w-[10rem] truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-md text-xs font-medium bg-gray-100 text-gray-800">This
                        content is a little bit longer.
                    </span>
                    <span class="max-w-[10rem] truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-md text-xs font-medium bg-red-100 text-red-800">This
                        content is a little bit longer.
                    </span>
                    <span class="max-w-[10rem] truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-md text-xs font-medium bg-yellow-100 text-yellow-800">This
                        content is a little bit longer.
                    </span>
                    <span class="max-w-[10rem] truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-md text-xs font-medium bg-green-100 text-green-800">This
                        content is a little bit longer.
                    </span>
                    <span class="max-w-[10rem] truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-md text-xs font-medium bg-primary/25 text-sky-800">This
                        content is a little bit longer.
                    </span>
                    <span class="max-w-[10rem] truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-md text-xs font-medium bg-indigo-100 text-indigo-800">This
                        content is a little bit longer.
                    </span>
                    <span class="max-w-[10rem] truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-md text-xs font-medium bg-purple-100 text-purple-800">This
                        content is a little bit longer.
                    </span>
                    <span class="max-w-[10rem] truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-md text-xs font-medium bg-white-100 text-gray-800">This
                        content is a little bit longer.
                    </span>
                </div>
                <div id="max_width_BadgesHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;span class=&quot;max-w-[10rem] truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-md text-xs font-medium bg-gray-100 text-gray-800&quot;&gt;This
                            content is a little bit longer.
                        &lt;/span&gt;
                        &lt;span class=&quot;max-w-[10rem] truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-md text-xs font-medium bg-red-100 text-red-800&quot;&gt;This
                            content is a little bit longer.
                        &lt;/span&gt;
                        &lt;span class=&quot;max-w-[10rem] truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-md text-xs font-medium bg-yellow-100 text-yellow-800&quot;&gt;This
                            content is a little bit longer.
                        &lt;/span&gt;
                        &lt;span class=&quot;max-w-[10rem] truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-md text-xs font-medium bg-green-100 text-green-800&quot;&gt;This
                            content is a little bit longer.
                        &lt;/span&gt;
                        &lt;span class=&quot;max-w-[10rem] truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-md text-xs font-medium bg-primary/25 text-sky-800&quot;&gt;This
                            content is a little bit longer.
                        &lt;/span&gt;
                        &lt;span class=&quot;max-w-[10rem] truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-md text-xs font-medium bg-indigo-100 text-indigo-800&quot;&gt;This
                            content is a little bit longer.
                        &lt;/span&gt;
                        &lt;span class=&quot;max-w-[10rem] truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-md text-xs font-medium bg-purple-100 text-purple-800&quot;&gt;This
                            content is a little bit longer.
                        &lt;/span&gt;
                        &lt;span class=&quot;max-w-[10rem] truncate whitespace-nowrap inline-block py-1.5 px-3 rounded-md text-xs font-medium bg-white-100 text-gray-800&quot;&gt;This
                            content is a little bit longer.
                        &lt;/span&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div><!-- end card -->

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">With button</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="Button_BadgesHtml">
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
                <div class="flex flex-wrap items-end lg:gap-5 gap-">
                    <a class="relative py-2.5 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-primary text-white hover:bg-primary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800" href="#">
                        Notifications
                        <span class="inline-flex items-center py-0.5 px-1.5 rounded-full text-xs font-medium bg-indigo-800 text-white">5</span>
                    </a>
                </div>
                <div id="Button_BadgesHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;a class=&quot;relative py-2.5 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-primary text-white hover:bg-primary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800&quot; href=&quot;#&quot;&gt;
                            Notifications
                            &lt;span class=&quot;inline-flex items-center py-0.5 px-1.5 rounded-full text-xs font-medium bg-indigo-800 text-white&quot;&gt;5&lt;/span&gt;
                        &lt;/a&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div><!-- end card -->

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Positioned</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="Posinited_BadgesHtml">
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
                <div class="flex flex-wrap gap-x-7 gap-y-3">
                    <a class="relative inline-flex flex-shrink-0 justify-center items-center h-[3.375rem] w-[3.375rem] rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-primary transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800" href="#">
                        <i class="mgc_notification_line text-2xl"></i>
                        <span class="absolute top-0 end-0 inline-flex items-center py-0.5 px-1.5 rounded-full text-xs font-medium transform -translate-y-1/2 translate-x-1/2 bg-rose-500 text-white">99+</span>
                    </a>

                    <a href="javascript:void(0)" class="relative inline-flex flex-shrink-0 justify-center items-center h-[3.375rem] w-[3.375rem] rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-primary transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
                        <i class="mgc_notification_line text-2xl"></i>
                        <span class="absolute top-0 end-0 inline-flex items-center w-3.5 h-3.5 rounded-full border-2 border-white text-xs font-medium transform -translate-y-1/2 translate-x-1/2 bg-green-500 text-white"></span>
                    </a>
                </div>
                <div id="Posinited_BadgesHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;a class=&quot;relative inline-flex flex-shrink-0 justify-center items-center h-[3.375rem] w-[3.375rem] rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-primary transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800&quot; href=&quot;#&quot;&gt;
                            &lt;i class=&quot;mgc_notification_line text-2xl&quot;&gt;&lt;/i&gt;
                            &lt;span class=&quot;absolute top-0 end-0 inline-flex items-center py-0.5 px-1.5 rounded-full text-xs font-medium transform -translate-y-1/2 translate-x-1/2 bg-rose-500 text-white&quot;&gt;99+&lt;/span&gt;
                        &lt;/a&gt;

                        &lt;a href=&quot;javascript:void(0)&quot; class=&quot;relative inline-flex flex-shrink-0 justify-center items-center h-[3.375rem] w-[3.375rem] rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-primary transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800&quot;&gt;
                            &lt;i class=&quot;mgc_notification_line text-2xl&quot;&gt;&lt;/i&gt;
                            &lt;span class=&quot;absolute top-0 end-0 inline-flex items-center w-3.5 h-3.5 rounded-full border-2 border-white text-xs font-medium transform -translate-y-1/2 translate-x-1/2 bg-green-500 text-white&quot;&gt;&lt;/span&gt;
                        &lt;/a&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div><!-- end card -->

    </div>
@endsection
@section('script')
    @vite(['resources/js/pages/highlight.js'])
@endsection
