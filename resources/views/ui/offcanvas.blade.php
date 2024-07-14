@extends('layouts.vertical', ['title' => 'Offcanvas', 'sub_title' => 'Component', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Default</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="DefualOffcanvasHtml">
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
                <button class="bg-primary text-white hover:bg-primary-600 py-2 px-4 rounded transition-all" data-fc-target="default-offcanvas" data-fc-type="offcanvas">
                    Open Offcanvas
                </button>
                <div id="default-offcanvas" class="fc-offcanvas-open:translate-x-0 hidden -translate-x-full fixed top-0 left-0 transition-all duration-300 transform h-full max-w-xs w-full z-50 bg-white border-r dark:bg-gray-800 dark:border-gray-700" tabindex="-1">
                    <div class="flex justify-between items-center py-2 px-4 border-b dark:border-gray-700">
                        <h3 class="font-medium">
                            Offcanvas title
                        </h3>
                        <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700  text-sm dark:text-gray-500 dark:hover:text-gray-400" data-fc-dismiss type="button">
                            <span class="material-symbols-rounded">close</span>
                        </button>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-800 dark:text-gray-400">
                            Some text as placeholder. In real life you can have the elements you have
                            chosen. Like, text, images, lists, etc.
                        </p>
                    </div>
                </div>
                <div id="DefualOffcanvasHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;button class=&quot;bg-primary text-white hover:bg-primary-600 py-2 px-4 rounded transition-all&quot; data-fc-target=&quot;default-offcanvas&quot; data-fc-type=&quot;offcanvas&quot;&gt;
                            Open Offcanvas
                        &lt;/button&gt;
                        &lt;div id=&quot;default-offcanvas&quot; class=&quot;fc-offcanvas-open:translate-x-0 hidden -translate-x-full fixed top-0 left-0 transition-all duration-300 transform h-full max-w-xs w-full z-50 bg-white border-r dark:bg-gray-800 dark:border-gray-700&quot; tabindex=&quot;-1&quot;&gt;
                            &lt;div class=&quot;flex justify-between items-center py-2 px-4 border-b dark:border-gray-700&quot;&gt;
                                &lt;h3 class=&quot;font-medium&quot;&gt;
                                    Offcanvas title
                                &lt;/h3&gt;
                                &lt;button class=&quot;inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700  text-sm dark:text-gray-500 dark:hover:text-gray-400&quot; data-fc-dismiss type=&quot;button&quot;&gt;
                                    &lt;span class=&quot;material-symbols-rounded&quot;&gt;close&lt;/span&gt;
                                &lt;/button&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;p-4&quot;&gt;
                                &lt;p class=&quot;text-gray-800 dark:text-gray-400&quot;&gt;
                                    Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
                                &lt;/p&gt;
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
                    <h4 class="card-title">Auto Targeting</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="AutoTargetOffcanvasHtml">
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
                <div>
                    <button class="bg-primary text-white hover:bg-primary-600 py-2 px-4 rounded transition-all" data-fc-type="offcanvas">
                        Open Offcanvas
                    </button>
                    <div class="fc-offcanvas-open:translate-x-0 hidden -translate-x-full fixed top-0 left-0 transition-all duration-300 transform h-full max-w-xs w-full z-50 bg-white border-r dark:bg-gray-800 dark:border-gray-700" tabindex="-1">
                        <div class="flex justify-between items-center py-2 px-4 border-b dark:border-gray-700">
                            <h3 class="font-medium">
                                Offcanvas title
                            </h3>
                            <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700  text-sm dark:text-gray-500 dark:hover:text-gray-400" data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="p-4">
                            <p class="text-gray-800 dark:text-gray-400">
                                Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
                            </p>
                        </div>
                    </div>
                </div>

                <div id="AutoTargetOffcanvasHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;button class=&quot;bg-primary text-white hover:bg-primary-600 py-2 px-4 rounded transition-all&quot; data-fc-type=&quot;offcanvas&quot;&gt;
                            Open Offcanvas
                        &lt;/button&gt;
                        &lt;div class=&quot;fc-offcanvas-open:translate-x-0 hidden -translate-x-full fixed top-0 left-0 transition-all duration-300 transform h-full max-w-xs w-full z-50 bg-white border-r dark:bg-gray-800 dark:border-gray-700&quot;
                            tabindex=&quot;-1&quot;&gt;
                            &lt;div class=&quot;flex justify-between items-center py-2 px-4 border-b dark:border-gray-700&quot;&gt;
                                &lt;h3 class=&quot;font-medium&quot;&gt;
                                    Offcanvas title
                                &lt;/h3&gt;
                                &lt;button class=&quot;inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700  text-sm dark:text-gray-500 dark:hover:text-gray-400&quot; data-fc-dismiss type=&quot;button&quot;&gt;
                                    &lt;span class=&quot;material-symbols-rounded&quot;&gt;close&lt;/span&gt;
                                &lt;/button&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;p-4&quot;&gt;
                                &lt;p class=&quot;text-gray-800 dark:text-gray-400&quot;&gt;
                                    Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
                                &lt;/p&gt;
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
                    <h4 class="card-title">Positions</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="PositionsOffcanvasHtml">
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
                <div class="flex flex-wrap gap-4">
                    <button class="btn bg-primary text-white" data-fc-type="offcanvas">
                        Left
                    </button>
                    <div class="fc-offcanvas-open:translate-x-0 hidden -translate-x-full fixed top-0 left-0 transition-all duration-300 transform h-full max-w-xs w-full z-50 bg-white border-r dark:bg-gray-800 dark:border-gray-700" tabindex="-1">
                        <div class="flex justify-between items-center py-2 px-4 border-b dark:border-gray-700">
                            <h3 class="font-medium">
                                Offcanvas title
                            </h3>
                            <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700  text-sm dark:text-gray-500 dark:hover:text-gray-400" data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="p-4">
                            <p class="text-gray-800 dark:text-gray-400">
                                Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
                            </p>
                        </div>
                    </div>

                    <button class="btn bg-primary text-white" data-fc-type="offcanvas">
                        Top
                    </button>
                    <div class="fc-offcanvas-open:translate-y-0 -translate-y-full fixed top-0 inset-x-0 transition-all duration-300 transform max-h-40 h-full w-full z-50 bg-white border-b dark:bg-gray-800 dark:border-gray-700 hidden">
                        <div class="flex justify-between items-center py-2 px-4 border-b dark:border-gray-700">
                            <h3 class="font-medium">
                                Offcanvas title
                            </h3>
                            <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700  text-sm dark:text-gray-500 dark:hover:text-gray-400" data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="p-4">
                            <p class="text-gray-800 dark:text-gray-400">
                                Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
                            </p>
                        </div>
                    </div>

                    <button class="btn bg-primary text-white" data-fc-type="offcanvas">
                        Right
                    </button>
                    <div class="fc-offcanvas-open:translate-x-0 translate-x-full fixed top-0 right-0 transition-all duration-300 transform h-full max-w-xs w-full  z-50 bg-white border-l dark:bg-gray-800 dark:border-gray-700 hidden">
                        <div class="flex justify-between items-center py-2 px-4 border-b dark:border-gray-700">
                            <h3 class="font-medium">
                                Offcanvas title
                            </h3>
                            <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700  text-sm dark:text-gray-500 dark:hover:text-gray-400" data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="p-4">
                            <p class="text-gray-800 dark:text-gray-400">
                                Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
                            </p>
                        </div>
                    </div>

                    <button class="btn bg-primary text-white" data-fc-type="offcanvas">
                        Bottom
                    </button>
                    <div class="fc-offcanvas-open:translate-y-0 translate-y-full fixed bottom-0 inset-x-0 transition-all duration-300 transform max-h-40 h-full w-full z-50 bg-white border-b dark:bg-gray-800 dark:border-gray-700 hidden">
                        <div class="flex justify-between items-center py-2 px-4 border-b dark:border-gray-700">
                            <h3 class="font-medium">
                                Offcanvas title
                            </h3>
                            <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700  text-sm dark:text-gray-500 dark:hover:text-gray-400" data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="p-4">
                            <p class="text-gray-800 dark:text-gray-400">
                                Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
                            </p>
                        </div>
                    </div>
                </div>
                <div id="PositionsOffcanvasHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-type=&quot;offcanvas&quot;&gt;
                            Left
                        &lt;/button&gt;
                        &lt;div class=&quot;fc-offcanvas-open:translate-x-0 hidden -translate-x-full fixed top-0 left-0 transition-all duration-300 transform h-full max-w-xs w-full z-50 bg-white border-r dark:bg-gray-800 dark:border-gray-700&quot;
                            tabindex=&quot;-1&quot;&gt;
                            &lt;div class=&quot;flex justify-between items-center py-2 px-4 border-b dark:border-gray-700&quot;&gt;
                                &lt;h3 class=&quot;font-medium&quot;&gt;
                                    Offcanvas title
                                &lt;/h3&gt;
                                &lt;button class=&quot;inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700  text-sm dark:text-gray-500 dark:hover:text-gray-400&quot; data-fc-dismiss type=&quot;button&quot;&gt;
                                    &lt;span class=&quot;material-symbols-rounded&quot;&gt;close&lt;/span&gt;
                                &lt;/button&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;p-4&quot;&gt;
                                &lt;p class=&quot;text-gray-800 dark:text-gray-400&quot;&gt;
                                    Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
                                &lt;/p&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
    
                        &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-type=&quot;offcanvas&quot;&gt;
                            Top
                        &lt;/button&gt;
                        &lt;div class=&quot;fc-offcanvas-open:translate-y-0 -translate-y-full fixed top-0 inset-x-0 transition-all duration-300 transform max-h-40 h-full w-full z-50 bg-white border-b dark:bg-gray-800 dark:border-gray-700 hidden&quot;&gt;
                            &lt;div class=&quot;flex justify-between items-center py-2 px-4 border-b dark:border-gray-700&quot;&gt;
                                &lt;h3 class=&quot;font-medium&quot;&gt;
                                    Offcanvas title
                                &lt;/h3&gt;
                                &lt;button class=&quot;inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700  text-sm dark:text-gray-500 dark:hover:text-gray-400&quot; data-fc-dismiss type=&quot;button&quot;&gt;
                                    &lt;span class=&quot;material-symbols-rounded&quot;&gt;close&lt;/span&gt;
                                &lt;/button&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;p-4&quot;&gt;
                                &lt;p class=&quot;text-gray-800 dark:text-gray-400&quot;&gt;
                                    Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
                                &lt;/p&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
    
                        &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-type=&quot;offcanvas&quot;&gt;
                            Right
                        &lt;/button&gt;
                        &lt;div class=&quot;fc-offcanvas-open:translate-x-0 translate-x-full fixed top-0 right-0 transition-all duration-300 transform h-full max-w-xs w-full  z-50 bg-white border-l dark:bg-gray-800 dark:border-gray-700 hidden&quot;&gt;
                            &lt;div class=&quot;flex justify-between items-center py-2 px-4 border-b dark:border-gray-700&quot;&gt;
                                &lt;h3 class=&quot;font-medium&quot;&gt;
                                    Offcanvas title
                                &lt;/h3&gt;
                                &lt;button class=&quot;inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700  text-sm dark:text-gray-500 dark:hover:text-gray-400&quot; data-fc-dismiss type=&quot;button&quot;&gt;
                                    &lt;span class=&quot;material-symbols-rounded&quot;&gt;close&lt;/span&gt;
                                &lt;/button&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;p-4&quot;&gt;
                                &lt;p class=&quot;text-gray-800 dark:text-gray-400&quot;&gt;
                                    Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
                                &lt;/p&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
    
                        &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-type=&quot;offcanvas&quot;&gt;
                            Bottom
                        &lt;/button&gt;
                        &lt;div class=&quot;fc-offcanvas-open:translate-y-0 translate-y-full fixed bottom-0 inset-x-0 transition-all duration-300 transform max-h-40 h-full w-full z-50 bg-white border-b dark:bg-gray-800 dark:border-gray-700 hidden&quot;&gt;
                            &lt;div class=&quot;flex justify-between items-center py-2 px-4 border-b dark:border-gray-700&quot;&gt;
                                &lt;h3 class=&quot;font-medium&quot;&gt;
                                    Offcanvas title
                                &lt;/h3&gt;
                                &lt;button class=&quot;inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700  text-sm dark:text-gray-500 dark:hover:text-gray-400&quot; data-fc-dismiss type=&quot;button&quot;&gt;
                                    &lt;span class=&quot;material-symbols-rounded&quot;&gt;close&lt;/span&gt;
                                &lt;/button&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;p-4&quot;&gt;
                                &lt;p class=&quot;text-gray-800 dark:text-gray-400&quot;&gt;
                                    Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
                                &lt;/p&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

    </div><!-- end grid-->
@endsection
@section('script')
    @vite(['resources/js/pages/highlight.js'])
@endsection
