@extends('layouts.vertical', ['title' => 'Range', 'sub_title' => 'Forms', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
    @vite(['node_modules/nouislider/dist/nouislider.min.css'])
@endsection

@section('content')
    <div class="grid 2xl:grid-cols-2 grid-cols-1 gap-6">
        <div class="space-y-6">
            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h4 class="card-title">Basic Example</h4>
                        <div class="flex items-center gap-2">
                            <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="BasicRangeHtml">
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
                    <div id="slider"></div>

                    <div id="BasicRangeHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <pre class="language-html h-auto">
									<code>
										&lt;div id=&quot;slider&quot;&gt;&lt;/div&gt;
									</code>
								</pre>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h4 class="card-title">Using HTML5 input elements</h4>
                        <div class="flex items-center gap-2">
                            <button type="button" class="btn-code" data-fc-type="collapse"
                                data-fc-target="UsingInputRangeHtml">
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
                    <div id="html5"></div>
                    <div class="flex mt-3 gap-2">
                        <select id="input-select" class="form-select w-auto"></select>
                        <input type="number" class="form-input w-auto" min="-20" max="40" step="1"
                            id="input-number">
                    </div>

                    <div id="UsingInputRangeHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <pre class="language-html h-auto">
									<code>
										&lt;div id=&quot;html5&quot;&gt;&lt;/div&gt;
										&lt;div class=&quot;flex mt-3 gap-2&quot;&gt;
											&lt;select id=&quot;input-select&quot; class=&quot;form-select&quot;&gt;&lt;/select&gt;
											&lt;input type=&quot;number&quot; class=&quot;form-input&quot; min=&quot;-20&quot; max=&quot;40&quot; step=&quot;1&quot; id=&quot;input-number&quot;&gt;
										&lt;/div&gt;
									</code>
								</pre>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h4 class="card-title">Locking sliders together</h4>
                        <div class="flex items-center gap-2">
                            <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="LockRangeHtml">
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
                    <div class="">
                        <div class="slider" id="slider1"></div>
                        <span class="example-val text-gray-600 dark:text-zinc-100 mt-2" id="slider1-span"></span>

                        <div class="slider" id="slider2"></div>
                        <span class="example-val text-gray-600 dark:text-zinc-100 mt-2" id="slider2-span"></span>

                        <button id="lockbutton" class="btn bg-primary text-white">Lock</button>
                    </div>

                    <div id="LockRangeHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <pre class="language-html h-auto">
									<code>
										&lt;div class=&quot;slider&quot; id=&quot;slider1&quot;&gt;&lt;/div&gt;
										&lt;span class=&quot;example-val text-gray-600 dark:text-zinc-100 mt-2&quot; id=&quot;slider1-span&quot;&gt;&lt;/span&gt;
			
										&lt;div class=&quot;slider&quot; id=&quot;slider2&quot;&gt;&lt;/div&gt;
										&lt;span class=&quot;example-val text-gray-600 dark:text-zinc-100 mt-2&quot; id=&quot;slider2-span&quot;&gt;&lt;/span&gt;
			
										&lt;button id=&quot;lockbutton&quot; class=&quot;rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold leading-5 text-white hover:bg-indigo-500 float-right&quot;&gt;Lock&lt;/button&gt;
									</code>
								</pre>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h4 class="card-title">Only showing tooltips when sliding handle</h4>
                        <div class="flex items-center gap-2">
                            <button type="button" class="btn-code" data-fc-type="collapse"
                                data-fc-target="ShowingRangeHtml">
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
                    <div class="slider" id="slider-hide"></div>
                    <div id="ShowingRangeHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <pre class="language-html h-auto">
									<code>
										&lt;div class=&quot;slider&quot; id=&quot;slider-hide&quot;&gt;&lt;/div&gt;
									</code>
								</pre>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h4 class="card-title">Colored Connect Elements</h4>
                        <div class="flex items-center gap-2">
                            <button type="button" class="btn-code" data-fc-type="collapse"
                                data-fc-target="ColoredConnectRangeHtml">
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
                    <div class="slider" id="slider-color"></div>
                    <div id="ColoredConnectRangeHtml"
                        class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <pre class="language-html h-auto">
									<code>
										&lt;div class=&quot;slider&quot; id=&quot;slider-color&quot;&gt;&lt;/div&gt;
									</code>
								</pre>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h4 class="card-title">Colorpicker</h4>
                        <div class="flex items-center gap-2">
                            <button type="button" class="btn-code" data-fc-type="collapse"
                                data-fc-target="ColorRangeHtml">
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
                    <div class="sliders" id="red"></div>
                    <div class="sliders" id="green"></div>
                    <div class="sliders" id="blue"></div>

                    <div id="result"></div>

                    <div id="ColorRangeHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <pre class="language-html h-auto">
									<code>
										&lt;div class=&quot;sliders&quot; id=&quot;red&quot;&gt;&lt;/div&gt;
										&lt;div class=&quot;sliders&quot; id=&quot;green&quot;&gt;&lt;/div&gt;
										&lt;div class=&quot;sliders&quot; id=&quot;blue&quot;&gt;&lt;/div&gt;

										&lt;div id=&quot;result&quot;&gt;&lt;/div&gt;
									</code>
								</pre>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h4 class="card-title">Non linear slider</h4>
                        <div class="flex items-center gap-2">
                            <button type="button" class="btn-code" data-fc-type="collapse"
                                data-fc-target="NonLinerRangeHtml">
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
                    <div id="nonlinear"></div>
                    <span class="example-val text-gray-600 dark:text-zinc-100" id="lower-value"></span>
                    <span class="example-val text-gray-600 dark:text-zinc-100" id="upper-value"></span>

                    <div id="NonLinerRangeHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <pre class="language-html h-auto">
									<code>
										&lt;div id=&quot;nonlinear&quot;&gt;&lt;/div&gt;
										&lt;span class=&quot;example-val text-gray-600 dark:text-zinc-100&quot; id=&quot;lower-value&quot;&gt;&lt;/span&gt;
										&lt;span class=&quot;example-val text-gray-600 dark:text-zinc-100&quot; id=&quot;upper-value&quot;&gt;&lt;/span&gt;
									</code>
								</pre>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h4 class="card-title">Creating a toggle</h4>
                        <div class="flex items-center gap-2">
                            <button type="button" class="btn-code" data-fc-type="collapse"
                                data-fc-target="CreatToggleRangeHtml">
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
                    <div id="slider-toggle"></div>
                    <div id="CreatToggleRangeHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <pre class="language-html h-auto">
									<code>
										&lt;div id=&quot;slider-toggle&quot;&gt;&lt;/div&gt;
									</code>
								</pre>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h4 class="card-title">Soft limits</h4>
                        <div class="flex items-center gap-2">
                            <button type="button" class="btn-code" data-fc-type="collapse"
                                data-fc-target="SoftLimiteRangeHtml">
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
                    <div class="mb-8" id="soft"></div>
                    <div id="SoftLimiteRangeHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <pre class="language-html h-auto">
									<code>
										&lt;div class=&quot;mb-8&quot; id=&quot;soft&quot;&gt;&lt;/div&gt;
									</code>
								</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite(['resources/js/pages/highlight.js', 'resources/js/pages/form-rangeslider.js'])
@endsection
