@extends('layouts.vertical', ['title' => 'Dropdowns', 'sub_title' => 'Component', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid 2xl:grid-cols-2 grid-cols-1 gap-6">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Default</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="DefaultDropdownHtml">
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
                    <button data-fc-type="dropdown" type="button"
                        class="py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white">
                        Actions <i class="mgc_down_line text-base ms-1"></i>
                    </button>

                    <div
                        class="hidden fc-dropdown-open:opacity-100 opacity-0 z-50 transition-all duration-300 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700">
                        <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                            href="#">
                            Action
                        </a>
                        <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                            href="#">
                            Another action
                        </a>
                        <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                            href="#">
                            Something else here
                        </a>
                    </div>
                </div>
                <div id="DefaultDropdownHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;button data-fc-type=&quot;dropdown&quot; type=&quot;button&quot; class=&quot;py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white&quot;&gt;
                            Actions  &lt;i class=&quot;mgc_down_line text-base ms-1&quot;&gt;&lt;/i&gt;
                        &lt;/button&gt;

                        &lt;div class=&quot;hidden fc-dropdown-open:opacity-100 opacity-0 z-50 transition-all duration-300 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700&quot;&gt;
                            &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                Action
                            &lt;/a&gt;
                            &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                Another action
                            &lt;/a&gt;
                            &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                Something else here
                            &lt;/a&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Dropdown Color Variant</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse"
                            data-fc-target="ColorVariantDefaultDropdownHtml">
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
                        <button data-fc-type="dropdown" type="button"
                            class="py-2 px-3 inline-flex bg-primary text-white justify-center items-center text-sm gap-2 rounded-md font-medium shadow-sm align-middle transition-all">
                            Primary <i class="mgc_down_line text-base"></i>
                        </button>

                        <div
                            class="hidden fc-dropdown-open:opacity-100 opacity-0 z-50 transition-all duration-300 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700">
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Another action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Something else here
                            </a>
                        </div>
                    </div>

                    <div>
                        <button data-fc-type="dropdown" type="button"
                            class="py-2 px-3 inline-flex bg-secondary text-white justify-center items-center text-sm gap-2 rounded-md font-medium shadow-sm align-middle transition-all">
                            Secondary <i class="mgc_down_line text-lg"></i>
                        </button>

                        <div
                            class="hidden fc-dropdown-open:opacity-100 opacity-0 z-50 transition-all duration-300 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700">
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Another action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Something else here
                            </a>
                        </div>
                    </div>

                    <div>
                        <button data-fc-type="dropdown" type="button"
                            class="py-2 px-3 inline-flex bg-success text-white justify-center items-center text-sm gap-2 rounded-md font-medium shadow-sm align-middle transition-all">
                            Success <i class="mgc_down_line text-lg"></i>
                        </button>

                        <div
                            class="hidden fc-dropdown-open:opacity-100 opacity-0 z-50 transition-all duration-300 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700">
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Another action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Something else here
                            </a>
                        </div>
                    </div>

                    <div>
                        <button data-fc-type="dropdown" type="button"
                            class="py-2 px-3 inline-flex bg-warning text-white justify-center items-center text-sm gap-2 rounded-md font-medium shadow-sm align-middle transition-all">
                            Warning <i class="mgc_down_line text-lg"></i>
                        </button>

                        <div
                            class="hidden fc-dropdown-open:opacity-100 opacity-0 z-50 transition-all duration-300 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700">
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Another action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Something else here
                            </a>
                        </div>
                    </div>

                    <div>
                        <button data-fc-type="dropdown" type="button"
                            class="py-2 px-3 inline-flex bg-danger text-white justify-center items-center text-sm gap-2 rounded-md font-medium shadow-sm align-middle transition-all">
                            Danger <i class="mgc_down_line text-lg"></i>
                        </button>

                        <div
                            class="hidden fc-dropdown-open:opacity-100 opacity-0 z-50 transition-all duration-300 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700">
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Another action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Something else here
                            </a>
                        </div>
                    </div>
                </div>

                <div id="ColorVariantDefaultDropdownHtml"
                    class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div&gt;
                            &lt;button data-fc-type=&quot;dropdown&quot; type=&quot;button&quot; class=&quot;py-2 px-3 inline-flex bg-primary text-white justify-center items-center text-sm gap-2 rounded-md font-medium shadow-sm align-middle transition-all&quot;&gt;
                                Primary &lt;i class=&quot;mgc_down_line text-base&quot;&gt;&lt;/i&gt;
                            &lt;/button&gt;

                            &lt;div class=&quot;hidden fc-dropdown-open:opacity-100 opacity-0 z-50 transition-all duration-300 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700&quot;&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                    Action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                    Another action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                    Something else here
                                &lt;/a&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button data-fc-type=&quot;dropdown&quot; type=&quot;button&quot; class=&quot;py-2 px-3 inline-flex bg-secondary text-white justify-center items-center text-sm gap-2 rounded-md font-medium shadow-sm align-middle transition-all&quot;&gt;
                                Secondary &lt;i class=&quot;mgc_down_line text-lg&quot;&gt;&lt;/i&gt;
                            &lt;/button&gt;

                            &lt;div class=&quot;hidden fc-dropdown-open:opacity-100 opacity-0 z-50 transition-all duration-300 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700&quot;&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                    Action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                    Another action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                    Something else here
                                &lt;/a&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button data-fc-type=&quot;dropdown&quot; type=&quot;button&quot; class=&quot;py-2 px-3 inline-flex bg-success text-white justify-center items-center text-sm gap-2 rounded-md font-medium shadow-sm align-middle transition-all&quot;&gt;
                                Success &lt;i class=&quot;mgc_down_line text-lg&quot;&gt;&lt;/i&gt;
                            &lt;/button&gt;

                            &lt;div class=&quot;hidden fc-dropdown-open:opacity-100 opacity-0 z-50 transition-all duration-300 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700&quot;&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                    Action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                    Another action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                    Something else here
                                &lt;/a&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button data-fc-type=&quot;dropdown&quot; type=&quot;button&quot; class=&quot;py-2 px-3 inline-flex bg-warning text-white justify-center items-center text-sm gap-2 rounded-md font-medium shadow-sm align-middle transition-all&quot;&gt;
                                Warning &lt;i class=&quot;mgc_down_line text-lg&quot;&gt;&lt;/i&gt;
                            &lt;/button&gt;

                            &lt;div class=&quot;hidden fc-dropdown-open:opacity-100 opacity-0 z-50 transition-all duration-300 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700&quot;&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                    Action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                    Another action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                    Something else here
                                &lt;/a&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button data-fc-type=&quot;dropdown&quot; type=&quot;button&quot; class=&quot;py-2 px-3 inline-flex bg-danger text-white justify-center items-center text-sm gap-2 rounded-md font-medium shadow-sm align-middle transition-all&quot;&gt;
                                Danger &lt;i class=&quot;mgc_down_line text-lg&quot;&gt;&lt;/i&gt;
                            &lt;/button&gt;

                            &lt;div class=&quot;hidden fc-dropdown-open:opacity-100 opacity-0 z-50 transition-all duration-300 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700&quot;&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                    Action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                    Another action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                    Something else here
                                &lt;/a&gt;
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
                    <h4 class="card-title">Hover event</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse"
                            data-fc-target="HoverEventDropdownHTML">
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
                    <button data-fc-type="dropdown" type="button" data-fc-offset="0" data-fc-trigger="hover"
                        class="py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white">
                        Hover Actions <i class="mgc_down_line text-lg"></i>
                    </button>

                    <div
                        class="hidden fc-dropdown-open:opacity-100 opacity-0 z-50 transition-all duration-300 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700">
                        <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                            href="#">
                            Action
                        </a>
                        <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                            href="#">
                            Another action
                        </a>
                        <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                            href="#">
                            Something else here
                        </a>
                    </div>
                </div>
                <div id="HoverEventDropdownHTML" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;button data-fc-type=&quot;dropdown&quot; type=&quot;button&quot; data-fc-offset=&quot;0&quot; data-fc-trigger=&quot;hover&quot; class=&quot;py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white&quot;&gt;
                            Hover Actions &lt;i class=&quot;mgc_down_line text-lg&quot;&gt;&lt;/i&gt;
                        &lt;/button&gt;

                        &lt;div class=&quot;hidden fc-dropdown-open:opacity-100 opacity-0 z-50 transition-all duration-300 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700&quot;&gt;
                            &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                Action
                            &lt;/a&gt;
                            &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                Another action
                            &lt;/a&gt;
                            &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot; href=&quot;#&quot;&gt;
                                Something else here
                            &lt;/a&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Dividers</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse"
                            data-fc-target="DividerDropdownHTML">
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
                    <button data-fc-type="dropdown" type="button"
                        class="py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white">
                        Actions <i class="mgc_down_line text-lg"></i>
                    </button>

                    <div
                        class="hidden fc-dropdown-open:opacity-100 opacity-0 z-50 transition-all duration-300 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700">
                        <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                            href="#">
                            Action
                        </a>
                        <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                            href="#">
                            Another action
                        </a>
                        <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                            href="#">
                            Something else here
                        </a>
                        <div class="h-px bg-black/10 dark:bg-gray-700 my-2 -mx-2"></div>
                        <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                            href="#">
                            Separated link
                        </a>
                    </div>
                </div>
                <div id="DividerDropdownHTML" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;button data-fc-type=&quot;dropdown&quot; type=&quot;button&quot;
                            class=&quot;py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white&quot;&gt;
                            Actions &lt;i class=&quot;mgc_down_line text-lg&quot;&gt;&lt;/i&gt;
                        &lt;/button&gt;

                        &lt;div
                            class=&quot;hidden fc-dropdown-open:opacity-100 opacity-0 z-50 transition-all duration-300 bg-white border shadow-md rounded-lg p-2 dark:bg-slate-800 dark:border-slate-700&quot;&gt;
                            &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                href=&quot;#&quot;&gt;
                                Action
                            &lt;/a&gt;
                            &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                href=&quot;#&quot;&gt;
                                Another action
                            &lt;/a&gt;
                            &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                href=&quot;#&quot;&gt;
                                Something else here
                            &lt;/a&gt;
                            &lt;div class=&quot;h-px bg-black/10 dark:bg-gray-700 my-2 -mx-2&quot;&gt;&lt;/div&gt;
                            &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                href=&quot;#&quot;&gt;
                                Separated link
                            &lt;/a&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Nested Dropdown</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse"
                            data-fc-target="NestedDropdownHTML">
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
                        <button data-fc-type="dropdown" type="button"
                            class="py-2 px-3 inline-flex justify-center items-center rounded-lg border font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white">
                            Two Level Dropdown <i class="mgc_down_line text-lg"></i>
                        </button>

                        <div id="dropdown-target"
                            class="hidden bg-white  shadow rounded-lg border p-2 px-2 dark:bg-gray-800 dark:border-slate-700">
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="javascript:void(0)">
                                Action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="javascript:void(0)">
                                Another Action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="javascript:void(0)">
                                Something else here
                            </a>
                            <div>
                                <a class="flex items-center justify-between py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 cursor-pointer"
                                    data-fc-offset="8" data-fc-placement="right-start" data-fc-trigger="hover"
                                    data-fc-type="dropdown" type="button">
                                    Actions
                                    <span class="ms-2 mgc_right_line text-lg/none"></span>
                                </a>

                                <div
                                    class="-ms-2 hidden w-48 bg-white shadow-md rounded-lg border p-2 px-2 dark:bg-gray-800 dark:border-slate-700">
                                    <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Action
                                    </a>
                                    <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Another action
                                    </a>
                                    <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Something else here
                                    </a>
                                    <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Separated link
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="NestedDropdownHTML" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                <code>
                    &lt;div&gt;
                        &lt;button data-fc-type=&quot;dropdown&quot; type=&quot;button&quot;
                            class=&quot;py-2 px-3 inline-flex justify-center items-center rounded-lg border font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white&quot;&gt;
                            Three Level Dropdown &lt;i class=&quot;mgc_down_line text-lg&quot;&gt;&lt;/i&gt;
                        &lt;/button&gt;

                        &lt;div id=&quot;dropdown-target&quot;
                            class=&quot;hidden bg-white  shadow rounded-lg border p-2 px-2 dark:bg-gray-800 dark:border-slate-700&quot;&gt;
                            &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                href=&quot;javascript:void(0)&quot;&gt;
                                Action
                            &lt;/a&gt;
                            &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                href=&quot;javascript:void(0)&quot;&gt;
                                Another Action
                            &lt;/a&gt;
                            &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                href=&quot;javascript:void(0)&quot;&gt;
                                Something else here
                            &lt;/a&gt;
                            &lt;div&gt;
                                &lt;a class=&quot;flex items-center justify-between py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 cursor-pointer&quot;
                                    data-fc-offset=&quot;8&quot; data-fc-placement=&quot;right-start&quot;
                                    data-fc-trigger=&quot;hover&quot; data-fc-type=&quot;dropdown&quot; type=&quot;button&quot;&gt;
                                    Actions
                                    &lt;span
                                        class=&quot;ms-2 material-symbols-rounded -rotate-90 text-lg/none&quot;&gt;expand_more&lt;/span&gt;
                                &lt;/a&gt;

                                &lt;div
                                    class=&quot;-ms-2 hidden w-48 bg-white shadow-md rounded-lg border p-2 px-2 dark:bg-gray-800 dark:border-slate-700&quot;&gt;
                                    &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                        href=&quot;javascript:void(0)&quot;&gt;
                                        Action
                                    &lt;/a&gt;
                                    &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                        href=&quot;javascript:void(0)&quot;&gt;
                                        Another action
                                    &lt;/a&gt;
                                    &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                        href=&quot;javascript:void(0)&quot;&gt;
                                        Something else here
                                    &lt;/a&gt;
                                    &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                        href=&quot;javascript:void(0)&quot;&gt;
                                        Separated link
                                    &lt;/a&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;

                    &lt;div&gt;
                        &lt;button data-fc-type=&quot;dropdown&quot; type=&quot;button&quot;
                            class=&quot;py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white&quot;&gt;
                            Three level Dropdown &lt;i class=&quot;mgc_down_line text-lg&quot;&gt;&lt;/i&gt;
                        &lt;/button&gt;

                        &lt;div id=&quot;dropdown-target&quot;
                            class=&quot;hidden bg-white  shadow rounded-lg border p-2 px-2 dark:bg-gray-800 dark:border-slate-700&quot;&gt;
                            &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                href=&quot;javascript:void(0)&quot;&gt;
                                Action
                            &lt;/a&gt;
                            &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                href=&quot;javascript:void(0)&quot;&gt;
                                Another Action
                            &lt;/a&gt;
                            &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                href=&quot;javascript:void(0)&quot;&gt;
                                Something else here
                            &lt;/a&gt;
                            &lt;div&gt;
                                &lt;a class=&quot;flex items-center justify-between py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 cursor-pointer&quot;
                                    data-fc-offset=&quot;8&quot; data-fc-placement=&quot;right-start&quot;
                                    data-fc-trigger=&quot;hover&quot; data-fc-type=&quot;dropdown&quot; type=&quot;button&quot;&gt;
                                    Actions
                                    &lt;span
                                        class=&quot;ms-2 material-symbols-rounded -rotate-90 text-lg/none&quot;&gt;expand_more&lt;/span&gt;
                                &lt;/a&gt;

                                &lt;div
                                    class=&quot;-ms-2 hidden w-48 bg-white shadow-md rounded-lg border p-2 px-2 dark:bg-gray-800 dark:border-slate-700&quot;&gt;
                                    &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                        href=&quot;javascript:void(0)&quot;&gt;
                                        Action
                                    &lt;/a&gt;
                                    &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                        href=&quot;javascript:void(0)&quot;&gt;
                                        Another action
                                    &lt;/a&gt;
                                    &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                        href=&quot;javascript:void(0)&quot;&gt;
                                        Something else here
                                    &lt;/a&gt;
                                    &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                        href=&quot;javascript:void(0)&quot;&gt;
                                        Separated link
                                    &lt;/a&gt;
                                &lt;/div&gt;
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
                    <h4 class="card-title">Alignment options</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse"
                            data-fc-target="AlignmentDropdownHTML">
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
                        <button data-fc-type="dropdown" data-fc-placement="right-start" type="button"
                            class="py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white">
                            Dropdown Right <i class="mgc_down_line text-lg"></i>
                        </button>

                        <div
                            class="fc-dropdown-open:opacity-100 hidden opacity-0 w-44 min-w-[120px] p-2 shadow-md rounded-lg z-50 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800">
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Another action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Something else here
                            </a>
                        </div>
                    </div>

                    <div>
                        <button data-fc-type="dropdown" data-fc-placement="left-start" type="button"
                            class="py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white">
                            Dropdown left <i class="mgc_down_line text-lg"></i>
                        </button>

                        <div
                            class="fc-dropdown-open:opacity-100 hidden opacity-0 w-44 min-w-[120px] p-2 shadow-md rounded-lg z-50 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800">
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Another action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Something else here
                            </a>
                        </div>
                    </div>

                    <div>
                        <button data-fc-type="dropdown" data-fc-placement="top" type="button"
                            class="py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white">
                            Dropdown Top <i class="mgc_down_line text-lg"></i>
                        </button>

                        <div
                            class="fc-dropdown-open:opacity-100 hidden opacity-0 w-44 min-w-[120px] p-2 shadow-md rounded-lg z-50 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800">
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Another action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Something else here
                            </a>
                        </div>
                    </div>

                    <div>
                        <button data-fc-type="dropdown" data-fc-placement="bottom" type="button"
                            class="py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white">
                            Dropdown Bottom <i class="mgc_down_line text-lg"></i>
                        </button>

                        <div
                            class="fc-dropdown-open:opacity-100 hidden opacity-0 w-44 min-w-[120px] p-2 shadow-md rounded-lg z-50 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800">
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Another action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Something else here
                            </a>
                        </div>
                    </div>

                    <div>
                        <button data-fc-type="dropdown" data-fc-placement="top-start" type="button"
                            class="py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white">
                            Top Start <i class="mgc_down_line text-lg"></i>
                        </button>

                        <div
                            class="fc-dropdown-open:opacity-100 hidden opacity-0 w-44 min-w-[120px] p-2 shadow-md rounded-lg z-50 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800">
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Another action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Something else here
                            </a>
                        </div>
                    </div>

                    <div>
                        <button data-fc-type="dropdown" data-fc-placement="top-end" type="button"
                            class="py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white">
                            Top End <i class="mgc_down_line text-lg"></i>
                        </button>

                        <div
                            class="fc-dropdown-open:opacity-100 hidden opacity-0 w-44 min-w-[120px] p-2 shadow-md rounded-lg z-50 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800">
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Another action
                            </a>
                            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                href="#">
                                Something else here
                            </a>
                        </div>
                    </div>
                </div>

                <div id="AlignmentDropdownHTML" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div&gt;
                            &lt;button data-fc-type=&quot;dropdown&quot; data-fc-placement=&quot;right-start&quot; type=&quot;button&quot;
                                class=&quot;py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white&quot;&gt;
                                Dropdown Right &lt;i class=&quot;mgc_down_line text-lg&quot;&gt;&lt;/i&gt;
                            &lt;/button&gt;

                            &lt;div
                                class=&quot;fc-dropdown-open:opacity-100 hidden opacity-0 w-44 min-w-[120px] p-2 shadow-md rounded-lg z-50 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800&quot;&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                    href=&quot;#&quot;&gt;
                                    Action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                    href=&quot;#&quot;&gt;
                                    Another action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                    href=&quot;#&quot;&gt;
                                    Something else here
                                &lt;/a&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button data-fc-type=&quot;dropdown&quot; data-fc-placement=&quot;left-start&quot; type=&quot;button&quot;
                                class=&quot;py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white&quot;&gt;
                                Dropdown left &lt;i class=&quot;mgc_down_line text-lg&quot;&gt;&lt;/i&gt;
                            &lt;/button&gt;

                            &lt;div
                                class=&quot;fc-dropdown-open:opacity-100 hidden opacity-0 w-44 min-w-[120px] p-2 shadow-md rounded-lg z-50 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800&quot;&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                    href=&quot;#&quot;&gt;
                                    Action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                    href=&quot;#&quot;&gt;
                                    Another action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                    href=&quot;#&quot;&gt;
                                    Something else here
                                &lt;/a&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button data-fc-type=&quot;dropdown&quot; data-fc-placement=&quot;top&quot; type=&quot;button&quot;
                                class=&quot;py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white&quot;&gt;
                                Dropdown Top &lt;i class=&quot;mgc_down_line text-lg&quot;&gt;&lt;/i&gt;
                            &lt;/button&gt;

                            &lt;div
                                class=&quot;fc-dropdown-open:opacity-100 hidden opacity-0 w-44 min-w-[120px] p-2 shadow-md rounded-lg z-50 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800&quot;&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                    href=&quot;#&quot;&gt;
                                    Action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                    href=&quot;#&quot;&gt;
                                    Another action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                    href=&quot;#&quot;&gt;
                                    Something else here
                                &lt;/a&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button data-fc-type=&quot;dropdown&quot; data-fc-placement=&quot;bottom&quot; type=&quot;button&quot;
                                class=&quot;py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white&quot;&gt;
                                Dropdown Bottom &lt;i class=&quot;mgc_down_line text-lg&quot;&gt;&lt;/i&gt;
                            &lt;/button&gt;

                            &lt;div
                                class=&quot;fc-dropdown-open:opacity-100 hidden opacity-0 w-44 min-w-[120px] p-2 shadow-md rounded-lg z-50 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800&quot;&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                    href=&quot;#&quot;&gt;
                                    Action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                    href=&quot;#&quot;&gt;
                                    Another action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                    href=&quot;#&quot;&gt;
                                    Something else here
                                &lt;/a&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button data-fc-type=&quot;dropdown&quot; data-fc-placement=&quot;top-start&quot; type=&quot;button&quot;
                                class=&quot;py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white&quot;&gt;
                                Top Start &lt;i class=&quot;mgc_down_line text-lg&quot;&gt;&lt;/i&gt;
                            &lt;/button&gt;

                            &lt;div
                                class=&quot;fc-dropdown-open:opacity-100 hidden opacity-0 w-44 min-w-[120px] p-2 shadow-md rounded-lg z-50 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800&quot;&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                    href=&quot;#&quot;&gt;
                                    Action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                    href=&quot;#&quot;&gt;
                                    Another action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                    href=&quot;#&quot;&gt;
                                    Something else here
                                &lt;/a&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button data-fc-type=&quot;dropdown&quot; data-fc-placement=&quot;top-end&quot; type=&quot;button&quot;
                                class=&quot;py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white&quot;&gt;
                                Top End &lt;i class=&quot;mgc_down_line text-lg&quot;&gt;&lt;/i&gt;
                            &lt;/button&gt;

                            &lt;div
                                class=&quot;fc-dropdown-open:opacity-100 hidden opacity-0 w-44 min-w-[120px] p-2 shadow-md rounded-lg z-50 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800&quot;&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                    href=&quot;#&quot;&gt;
                                    Action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                    href=&quot;#&quot;&gt;
                                    Another action
                                &lt;/a&gt;
                                &lt;a class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;
                                    href=&quot;#&quot;&gt;
                                    Something else here
                                &lt;/a&gt;
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
                    <h4 class="card-title">Dropdown With Form Components</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse"
                            data-fc-target="FormDropdownHTML">
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
                        <button data-fc-type="dropdown" type="button"
                            class="py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white">
                            Radio <i class="mgc_down_line text-lg"></i>
                        </button>

                        <div
                            class="fc-dropdown-open:opacity-100 hidden opacity-0 w-44 min-w-[120px] p-2 shadow-md rounded-lg z-50 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800">
                            <div
                                class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                <div class="flex">
                                    <input type="radio" name="default-radio" class="shrink-0 form-radio rounded"
                                        id="default-radio">
                                    <label for="default-radio"
                                        class="text-sm text-gray-500 ms-2 dark:text-gray-400">Default
                                        radio</label>
                                </div>
                            </div>
                            <div
                                class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                <div class="flex">
                                    <input type="radio" name="default-radio" class="shrink-0 form-radio rounded"
                                        id="checked-radio" checked>
                                    <label for="checked-radio"
                                        class="text-sm text-gray-500 ms-2 dark:text-gray-400">Checked
                                        radio</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button data-fc-type="dropdown" type="button"
                            class="py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white">
                            CheckBox <i class="mgc_down_line text-lg"></i>
                        </button>

                        <div
                            class="fc-dropdown-open:opacity-100 hidden opacity-0 w-52 min-w-[120px] p-2 shadow-md rounded-lg z-50 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800">
                            <div
                                class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                <div class="flex">
                                    <input type="checkbox" class="shrink-0 form-checkbox rounded" id="default-checkbox">
                                    <label for="default-checkbox"
                                        class="text-sm text-gray-500 ms-3 dark:text-gray-400">Default
                                        checkbox</label>
                                </div>
                            </div>
                            <div
                                class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                <div class="flex">
                                    <input type="checkbox" class="shrink-0 form-checkbox rounded" id="checked-checkbox"
                                        checked>
                                    <label for="checked-checkbox"
                                        class="text-sm text-gray-500 ms-3 dark:text-gray-400">Checked
                                        checkbox</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button data-fc-type="dropdown" data-fc-placement="top" type="button"
                            class="py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white">
                            Form <i class="mgc_down_line text-lg"></i>
                        </button>

                        <div
                            class="fc-dropdown-open:opacity-100 hidden opacity-0 w-72 p-4 shadow-md rounded-lg z-50 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800">
                            <form>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1"
                                        class="text-gray-800 text-sm font-medium inline-block mb-2">Email
                                        address</label>
                                    <input type="email" class="form-input" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter email">
                                    <small id="emailHelp"
                                        class="form-text text-sm text-slate-700 dark:text-slate-400">We'll
                                        never share your email
                                        with anyone else.</small>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1"
                                        class="text-gray-800 text-sm font-medium inline-block mb-2">Password</label>
                                    <input type="password" class="form-input" id="exampleInputPassword1"
                                        placeholder="Password">
                                </div>
                                <div class="flex items-center gap-2 mb-3">
                                    <input type="checkbox" class="form-checkbox rounded border border-gray-200"
                                        id="checkmeout0">
                                    <label class="text-gray-800 text-sm font-medium inline-block" for="checkmeout0">Check
                                        me out !</label>
                                </div>
                                <button type="submit" class="btn bg-primary text-white">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="FormDropdownHTML" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div&gt;
                            &lt;button data-fc-type=&quot;dropdown&quot; type=&quot;button&quot;
                                class=&quot;py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white&quot;&gt;
                                Radio &lt;i class=&quot;mgc_down_line text-lg&quot;&gt;&lt;/i&gt;
                            &lt;/button&gt;

                            &lt;div
                                class=&quot;fc-dropdown-open:opacity-100 hidden opacity-0 w-44 min-w-[120px] p-2 shadow-md rounded-lg z-50 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800&quot;&gt;
                                &lt;div
                                    class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;&gt;
                                    &lt;div class=&quot;flex&quot;&gt;
                                        &lt;input type=&quot;radio&quot; name=&quot;default-radio&quot;
                                            class=&quot;shrink-0 form-checkbox rounded&quot;
                                            id=&quot;default-radio&quot;&gt;
                                        &lt;label for=&quot;default-radio&quot;
                                            class=&quot;text-sm text-gray-500 ms-2 dark:text-gray-400&quot;&gt;Default
                                            radio&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                                &lt;div
                                    class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;&gt;
                                    &lt;div class=&quot;flex&quot;&gt;
                                        &lt;input type=&quot;radio&quot; name=&quot;default-radio&quot;
                                            class=&quot;shrink-0 form-checkbox rounded&quot;
                                            id=&quot;checked-radio&quot; checked&gt;
                                        &lt;label for=&quot;checked-radio&quot;
                                            class=&quot;text-sm text-gray-500 ms-2 dark:text-gray-400&quot;&gt;Checked
                                            radio&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button data-fc-type=&quot;dropdown&quot; type=&quot;button&quot;
                                class=&quot;py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white&quot;&gt;
                                CheckBox &lt;i class=&quot;mgc_down_line text-lg&quot;&gt;&lt;/i&gt;
                            &lt;/button&gt;

                            &lt;div
                                class=&quot;fc-dropdown-open:opacity-100 hidden opacity-0 w-52 min-w-[120px] p-2 shadow-md rounded-lg z-50 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800&quot;&gt;
                                &lt;div
                                    class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;&gt;
                                    &lt;div class=&quot;flex&quot;&gt;
                                        &lt;input type=&quot;checkbox&quot;
                                            class=&quot;shrink-0 form-checkbox rounded&quot;
                                            id=&quot;default-checkbox&quot;&gt;
                                        &lt;label for=&quot;default-checkbox&quot;
                                            class=&quot;text-sm text-gray-500 ms-3 dark:text-gray-400&quot;&gt;Default
                                            checkbox&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                                &lt;div
                                    class=&quot;flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300&quot;&gt;
                                    &lt;div class=&quot;flex&quot;&gt;
                                        &lt;input type=&quot;checkbox&quot;
                                            class=&quot;shrink-0 form-checkbox rounded&quot;
                                            id=&quot;checked-checkbox&quot; checked&gt;
                                        &lt;label for=&quot;checked-checkbox&quot;
                                            class=&quot;text-sm text-gray-500 ms-3 dark:text-gray-400&quot;&gt;Checked
                                            checkbox&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;div&gt;
                            &lt;button data-fc-type=&quot;dropdown&quot; data-fc-placement=&quot;top&quot; type=&quot;button&quot;
                                class=&quot;py-2 px-3 inline-flex justify-center items-center rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 transition-all text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white&quot;&gt;
                                Form &lt;i class=&quot;mgc_down_line text-lg&quot;&gt;&lt;/i&gt;
                            &lt;/button&gt;

                            &lt;div
                                class=&quot;fc-dropdown-open:opacity-100 hidden opacity-0 w-72 p-4 shadow-md rounded-lg z-50 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800&quot;&gt;
                                &lt;form&gt;
                                    &lt;div class=&quot;mb-3&quot;&gt;
                                        &lt;label for=&quot;exampleInputEmail1&quot;
                                            class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Email
                                            address&lt;/label&gt;
                                        &lt;input type=&quot;email&quot; class=&quot;form-input&quot; id=&quot;exampleInputEmail1&quot;
                                            aria-describedby=&quot;emailHelp&quot; placeholder=&quot;Enter email&quot;&gt;
                                        &lt;small id=&quot;emailHelp&quot;
                                            class=&quot;form-text text-sm text-slate-700 dark:text-slate-400&quot;&gt;We'll
                                            never share your email
                                            with anyone else.&lt;/small&gt;
                                    &lt;/div&gt;
                                    &lt;div class=&quot;mb-3&quot;&gt;
                                        &lt;label for=&quot;exampleInputPassword1&quot;
                                            class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Password&lt;/label&gt;
                                        &lt;input type=&quot;password&quot; class=&quot;form-input&quot; id=&quot;exampleInputPassword1&quot;
                                            placeholder=&quot;Password&quot;&gt;
                                    &lt;/div&gt;
                                    &lt;div class=&quot;flex items-center gap-2 mb-3&quot;&gt;
                                        &lt;input type=&quot;checkbox&quot;
                                            class=&quot;form-checkbox rounded border border-gray-200&quot;
                                            id=&quot;checkmeout0&quot;&gt;
                                        &lt;label class=&quot;text-gray-800 text-sm font-medium inline-block&quot;
                                            for=&quot;checkmeout0&quot;&gt;Check me out !&lt;/label&gt;
                                    &lt;/div&gt;
                                    &lt;button type=&quot;submit&quot; class=&quot;btn bg-primary text-white&quot;&gt;Submit&lt;/button&gt;
                                &lt;/form&gt;
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
