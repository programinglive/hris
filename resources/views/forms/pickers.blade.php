@extends('layouts.vertical', ['title' => 'Pickers', 'sub_title' => 'Forms', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
    @vite([
    'node_modules/flatpickr/dist/flatpickr.min.css',
    'node_modules/@simonwep/pickr/dist/themes/classic.min.css',
    'node_modules/@simonwep/pickr/dist/themes/monolith.min.css',
    'node_modules/@simonwep/pickr/dist/themes/nano.min.css',
    ])
@endsection

@section('content')
    <div class="grid 2xl:grid-cols-2 grid-cols-1 gap-6">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Basic Example</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="BasicPickerHtml">
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
                <input type="text" class="form-input" id="datepicker-basic">

                <div id="BasicPickerHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
								<code>
									&lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;datepicker-basic&quot;&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">DateTime</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="DateTimePickerHtml">
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
                <input type="text" class="form-input" id="datepicker-datetime">

                <div id="DateTimePickerHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
								<code>
									&lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;datepicker-datetime&quot;&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Human-friendly Dates</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse"
                            data-fc-target="HumanFriendlyPickerHtml">
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
                <input type="text" class="form-input" id="datepicker-humanfd">

                <div id="HumanFriendlyPickerHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
								<code>
									&lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;datepicker-humanfd&quot;&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">MinDate and MaxDate</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="MinMaxPickerHtml">
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
                <input type="text" class="form-input" id="datepicker-minmax">
                <div id="MinMaxPickerHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
								<code>
									&lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;datepicker-minmax&quot;&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Disabling dates</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse"
                            data-fc-target="DisablingPickerHtml">
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
                <input type="text" class="form-input" id="datepicker-disable">
                <div id="DisablingPickerHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
								<code>
									&lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;datepicker-disable&quot;&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Selecting multiple dates</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse"
                            data-fc-target="MultipalPickerHtml">
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
                <input type="text" class="form-input" id="datepicker-multiple">
                <div id="MultipalPickerHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
								<code>
									&lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;datepicker-multiple&quot;&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Range</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse"
                            data-fc-target="RangePickerHtml">
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
                <input type="text" class="form-input" id="datepicker-range">
                <div id="RangePickerHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
								<code>
									&lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;datepicker-range&quot;&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Picker</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="PickerHtml">
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
                <input type="text" class="form-input" id="datepicker-timepicker">
                <div id="PickerHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
								<code>
									&lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;datepicker-timepicker&quot;&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="col-span-2">
            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h4 class="card-title">Colorpicker</h4>
                        <div class="flex items-center gap-2">
                            <button type="button" class="btn-code" data-fc-type="collapse"
                                data-fc-target="ColorPickerHtml">
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
                        <h5 class="text-base mb-3">Themes</h5>
                        <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-6">
                            <div class="bg-slate-100 p-4 rounded-md flex flex-col dark:bg-gray-700">
                                <h5 class="text-base text-gray-400 mb-2 shrink-0">Classic Demo</h5>
                                <p class="text-gray-400 grow">Use
                                    <code>classic-colorpicker</code>
                                    class to set
                                    classic colorpicker.
                                </p>
                                <div class="classic-colorpicker"></div>
                            </div>
                            <div class="bg-slate-100 p-4 rounded-md flex flex-col dark:bg-gray-700">
                                <h5 class="text-base text-gray-400 mb-2 shrink-0">Monolith Demo</h5>
                                <p class="text-gray-400 grow">Use
                                    <code>monolith-colorpicker</code>
                                    class to set
                                    monolith colorpicker.
                                </p>
                                <div class="monolith-colorpicker"></div>
                            </div>
                            <div class="bg-slate-100 p-4 rounded-md flex flex-col dark:bg-gray-700">
                                <h5 class="text-base text-gray-400 mb-2 shrink-0">Nano Demo</h5>
                                <p class="text-gray-400 grow">Use
                                    <code>nano-colorpicker</code>
                                    class to set nano
                                    colorpicker.
                                </p>
                                <div class="nano-colorpicker"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <h5 class="text-base mb-2">Options</h5>

                        <div class="grid lg:grid-cols-5 md:grid-cols-3 gap-6">
                            <div class="bg-slate-100 p-4 rounded-md flex flex-col dark:bg-gray-700">
                                <h5 class="text-base text-gray-400 mb-2 shrink-0">Demo</h5>
                                <p class="text-gray-400 grow">Use
                                    <code>colorpicker-demo</code>
                                    class to set demo
                                    option colorpicker.
                                </p>
                                <div class="colorpicker-demo"></div>
                            </div>

                            <div class="bg-slate-100 p-4 rounded-md flex flex-col dark:bg-gray-700">
                                <h5 class="text-base text-gray-400 mb-2 shrink-0">Picker with Opacity & Hue</h5>
                                <p class="text-gray-400 grow">Use
                                    <code>colorpicker-opacity-hue</code>
                                    class to set
                                    colorpicker with opacity & hue.
                                </p>
                                <div class="colorpicker-opacity-hue"></div>
                            </div>

                            <div class="bg-slate-100 p-4 rounded-md flex flex-col dark:bg-gray-700">
                                <h5 class="text-base text-gray-400 mb-2 shrink-0">Switches</h5>
                                <p class="text-gray-400 grow">Use
                                    <code>colorpicker-switch</code>
                                    class to set switch
                                    colorpicker.
                                </p>
                                <div class="colorpicker-switch"></div>
                            </div>

                            <div class="bg-slate-100 p-4 rounded-md flex flex-col dark:bg-gray-700">
                                <h5 class="text-base text-gray-400 mb-2 shrink-0">Picker with Input</h5>
                                <p class="text-gray-400 grow">Use
                                    <code>colorpicker-input</code>
                                    class to set
                                    colorpicker with input.
                                </p>
                                <div class="colorpicker-input"></div>
                            </div>

                            <div class="bg-slate-100 p-4 rounded-md flex flex-col dark:bg-gray-700">
                                <h5 class="text-base text-gray-400 mb-2 shrink-0">Color Format</h5>
                                <p class="text-gray-400 grow">Use
                                    <code>colorpicker-format</code>
                                    class to set
                                    colorpicker with format option.
                                </p>
                                <div class="colorpicker-format"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end preview -->

                    <div id="ColorPickerHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <pre class="language-html h-56">
									<code>
										&lt;div&gt;
											&lt;div class=&quot;grid lg:grid-cols-3 md:grid-cols-2 gap-6&quot;&gt;
												&lt;div class=&quot;bg-slate-100 p-4 rounded-md flex flex-col&quot;&gt;
													&lt;h5 class=&quot;text-base text-gray-400 mb-2 shrink-0&quot;&gt;Classic Demo&lt;/h5&gt;
													&lt;p class=&quot;text-gray-400 grow&quot;&gt;Use &lt;code&gt;classic-colorpicker&lt;/code&gt; class to set
														classic colorpicker.&lt;/p&gt;
													&lt;div class=&quot;classic-colorpicker&quot;&gt;&lt;/div&gt;
												&lt;/div&gt;
												&lt;div class=&quot;bg-slate-100 p-4 rounded-md flex flex-col&quot;&gt;
													&lt;h5 class=&quot;text-base text-gray-400 mb-2 shrink-0&quot;&gt;Monolith Demo&lt;/h5&gt;
													&lt;p class=&quot;text-gray-400 grow&quot;&gt;Use &lt;code&gt;monolith-colorpicker&lt;/code&gt; class to set
														monolith colorpicker.&lt;/p&gt;
													&lt;div class=&quot;monolith-colorpicker&quot;&gt;&lt;/div&gt;
												&lt;/div&gt;
												&lt;div class=&quot;bg-slate-100 p-4 rounded-md flex flex-col&quot;&gt;
													&lt;h5 class=&quot;text-base text-gray-400 mb-2 shrink-0&quot;&gt;Nano Demo&lt;/h5&gt;
													&lt;p class=&quot;text-gray-400 grow&quot;&gt;Use &lt;code&gt;nano-colorpicker&lt;/code&gt; class to set nano
														colorpicker.&lt;/p&gt;
													&lt;div class=&quot;nano-colorpicker&quot;&gt;&lt;/div&gt;
												&lt;/div&gt;
											&lt;/div&gt;
										&lt;/div&gt;
										&lt;div class=&quot;mt-5&quot;&gt;
											&lt;div class=&quot;grid lg:grid-cols-5 md:grid-cols-3 gap-6&quot;&gt;
												&lt;div class=&quot;bg-slate-100 p-4 rounded-md flex flex-col&quot;&gt;
													&lt;h5 class=&quot;text-base text-gray-400 mb-2 shrink-0&quot;&gt;Demo&lt;/h5&gt;
													&lt;p class=&quot;text-gray-400 grow&quot;&gt;Use &lt;code&gt;colorpicker-demo&lt;/code&gt; class to set demo
														option colorpicker.&lt;/p&gt;
													&lt;div class=&quot;colorpicker-demo&quot;&gt;&lt;/div&gt;
												&lt;/div&gt;
		
												&lt;div class=&quot;bg-slate-100 p-4 rounded-md flex flex-col&quot;&gt;
													&lt;h5 class=&quot;text-base text-gray-400 mb-2 shrink-0&quot;&gt;Picker with Opacity &amp; Hue&lt;/h5&gt;
													&lt;p class=&quot;text-gray-400 grow&quot;&gt;Use &lt;code&gt;colorpicker-opacity-hue&lt;/code&gt; class to set
														colorpicker with opacity &amp; hue.&lt;/p&gt;
													&lt;div class=&quot;colorpicker-opacity-hue&quot;&gt;&lt;/div&gt;
												&lt;/div&gt;
		
												&lt;div class=&quot;bg-slate-100 p-4 rounded-md flex flex-col&quot;&gt;
													&lt;h5 class=&quot;text-base text-gray-400 mb-2 shrink-0&quot;&gt;Switches&lt;/h5&gt;
													&lt;p class=&quot;text-gray-400 grow&quot;&gt;Use &lt;code&gt;colorpicker-switch&lt;/code&gt; class to set switch
														colorpicker.&lt;/p&gt;
													&lt;div class=&quot;colorpicker-switch&quot;&gt;&lt;/div&gt;
												&lt;/div&gt;
		
												&lt;div class=&quot;bg-slate-100 p-4 rounded-md flex flex-col&quot;&gt;
													&lt;h5 class=&quot;text-base text-gray-400 mb-2 shrink-0&quot;&gt;Picker with Input&lt;/h5&gt;
													&lt;p class=&quot;text-gray-400 grow&quot;&gt;Use &lt;code&gt;colorpicker-input&lt;/code&gt; class to set
														colorpicker with input.&lt;/p&gt;
													&lt;div class=&quot;colorpicker-input&quot;&gt;&lt;/div&gt;
												&lt;/div&gt;
		
												&lt;div class=&quot;bg-slate-100 p-4 rounded-md flex flex-col&quot;&gt;
													&lt;h5 class=&quot;text-base text-gray-400 mb-2 shrink-0&quot;&gt;Color Format&lt;/h5&gt;
													&lt;p class=&quot;text-gray-400 grow&quot;&gt;Use &lt;code&gt;colorpicker-format&lt;/code&gt; class to set
														colorpicker with format option.&lt;/p&gt;
													&lt;div class=&quot;colorpicker-format&quot;&gt;&lt;/div&gt;
												&lt;/div&gt;
											&lt;/div&gt;
										&lt;/div&gt;
									</code>
								</pre>
                    </div>
                </div>
                <!-- end p-6 -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection

@section('script')
    @vite(['resources/js/pages/highlight.js', 'resources/js/pages/form-flatpickr.js', 'resources/js/pages/form-color-pickr.js'])
@endsection
