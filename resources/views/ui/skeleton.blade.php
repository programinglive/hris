@extends('layouts.vertical', ['title' => 'Skeleton', 'sub_title' => 'Component', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid 2xl:grid-cols-2 grid-cols-1 gap-6">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Example</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="basictSkeletonHtml">
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
                <h3 class="h-4 bg-gray-200 rounded-md dark:bg-gray-700 w-2/5"></h3>
                <ul class="mt-5 space-y-3">
                    <li class="w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700"></li>
                    <li class="w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700"></li>
                    <li class="w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700"></li>
                    <li class="w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700"></li>
                </ul>

                <div id="basictSkeletonHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html">
                    <code>
                        &lt;h3 class=&quot;h-4 bg-gray-200 rounded-md dark:bg-gray-700 w-2/5&quot;&gt;&lt;/h3&gt;
                        &lt;ul class=&quot;mt-5 space-y-3&quot;&gt;
                            &lt;li class=&quot;w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700&quot;&gt;&lt;/li&gt;
                            &lt;li class=&quot;w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700&quot;&gt;&lt;/li&gt;
                            &lt;li class=&quot;w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700&quot;&gt;&lt;/li&gt;
                            &lt;li class=&quot;w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700&quot;&gt;&lt;/li&gt;
                        &lt;/ul&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Complex combination</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="complextSkeletonHtml">
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
                <h3 class="h-4 bg-gray-200 rounded-md dark:bg-gray-700 mb-3" style="width: 40%;"></h3>

                <div class="flex">
                    <div class="flex-shrink-0">
                        <span class="w-12 h-12 block bg-gray-200 rounded-full dark:bg-gray-700"></span>
                    </div>

                    <div class="ms-4 mt-2 w-full">
                        <h3 class="h-4 bg-gray-200 rounded-md dark:bg-gray-700" style="width: 40%;"></h3>
                        <ul class="mt-5 space-y-3">
                            <li class="w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700"></li>
                            <li class="w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700"></li>
                            <li class="w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700"></li>
                            <li class="w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700"></li>
                        </ul>
                    </div>
                </div>

                <div id="complextSkeletonHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div class=&quot;flex&quot;&gt;
                            &lt;div class=&quot;flex-shrink-0&quot;&gt;
                                &lt;span class=&quot;w-12 h-12 block bg-gray-200 rounded-full dark:bg-gray-700&quot;&gt;&lt;/span&gt;
                            &lt;/div&gt;

                            &lt;div class=&quot;ms-4 mt-2 w-full&quot;&gt;
                                &lt;h3 class=&quot;h-4 bg-gray-200 rounded-md dark:bg-gray-700&quot; style=&quot;width: 40%;&quot;&gt;&lt;/h3&gt;
                                &lt;ul class=&quot;mt-5 space-y-3&quot;&gt;
                                    &lt;li class=&quot;w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700&quot;&gt;&lt;/li&gt;
                                    &lt;li class=&quot;w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700&quot;&gt;&lt;/li&gt;
                                    &lt;li class=&quot;w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700&quot;&gt;&lt;/li&gt;
                                    &lt;li class=&quot;w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700&quot;&gt;&lt;/li&gt;
                                &lt;/ul&gt;
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
                    <h4 class="card-title">Active animation</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="animationSkeletonHtml">
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
                <div class="flex animate-pulse">
                    <div class="flex-shrink-0">
                        <span class="w-12 h-12 block bg-gray-200 rounded-full dark:bg-gray-700"></span>
                    </div>

                    <div class="ms-4 mt-2 w-full">
                        <h3 class="h-4 bg-gray-200 rounded-md dark:bg-gray-700" style="width: 40%;"></h3>
                        <ul class="mt-5 space-y-3">
                            <li class="w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700"></li>
                            <li class="w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700"></li>
                            <li class="w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700"></li>
                            <li class="w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700"></li>
                        </ul>
                    </div>
                </div>

                <div id="animationSkeletonHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div class=&quot;flex animate-pulse&quot;&gt;
                            &lt;div class=&quot;flex-shrink-0&quot;&gt;
                                &lt;span class=&quot;w-12 h-12 block bg-gray-200 rounded-full dark:bg-gray-700&quot;&gt;&lt;/span&gt;
                            &lt;/div&gt;

                            &lt;div class=&quot;ms-4 mt-2 w-full&quot;&gt;
                                &lt;h3 class=&quot;h-4 bg-gray-200 rounded-md dark:bg-gray-700&quot; style=&quot;width: 40%;&quot;&gt;&lt;/h3&gt;
                                &lt;ul class=&quot;mt-5 space-y-3&quot;&gt;
                                    &lt;li class=&quot;w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700&quot;&gt;&lt;/li&gt;
                                    &lt;li class=&quot;w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700&quot;&gt;&lt;/li&gt;
                                    &lt;li class=&quot;w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700&quot;&gt;&lt;/li&gt;
                                    &lt;li class=&quot;w-full h-4 bg-gray-200 rounded-md dark:bg-gray-700&quot;&gt;&lt;/li&gt;
                                &lt;/ul&gt;
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
