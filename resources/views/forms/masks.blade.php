@extends('layouts.vertical', ['title' => 'Masks', 'sub_title' => 'Forms', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="flex justify-between items-center">
                <h4 class="card-title">Input Masks</h4>
                <div class="flex items-center gap-2">
                    <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="InputMaskHtml">
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
            <p class="text-sm text-slate-700 dark:text-slate-400 mb-4">A Java-Script Plugin to make masks on form fields and
                HTML elements.</p>
            <div class="grid 2xl:grid-cols-2 grid-cols-1 gap-6">
                <div>
                    <form action="#">
                        <div class="mb-3">
                            <label class="text-gray-800 text-sm font-medium inline-block mb-2">Date</label>
                            <input type="text" class="form-input" data-toggle="input-mask" data-mask-format="00/00/0000" placeholder="DD/MM/YYYY">
                            <p class="text-xs mt-1">Add attribute
                                <code class="text-primary">data-toggle="input-mask" data-mask-format="00/00/0000"</code>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="text-gray-800 text-sm font-medium inline-block mb-2">Hour</label>
                            <input type="text" class="form-input" data-toggle="input-mask" data-mask-format="00:00:00" placeholder="HH:MM:SS">
                            <p class="text-xs mt-1">Add attribute
                                <code class="text-primary">data-toggle="input-mask" data-mask-format="00:00:00"</code>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="text-gray-800 text-sm font-medium inline-block mb-2">Date & Hour</label>
                            <input type="text" class="form-input" data-toggle="input-mask" data-mask-format="00/00/0000 00:00:00" placeholder="DD/MM/YYYY HH:MM:SS">
                            <p class="text-xs mt-1">Add attribute
                                <code class="text-primary">data-toggle="input-mask"
                                    data-mask-format="00/00/0000 00:00:00"</code>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="text-gray-800 text-sm font-medium inline-block mb-2">ZIP Code</label>
                            <input type="text" class="form-input" data-toggle="input-mask" data-mask-format="00000-000" placeholder="xxxxx-xxx">
                            <p class="text-xs mt-1">Add attribute
                                <code class="text-primary">data-toggle="input-mask" data-mask-format="00000-000"</code>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="text-gray-800 text-sm font-medium inline-block mb-2">Crazy Zip Code</label>
                            <input type="text" class="form-input" data-toggle="input-mask" data-mask-format="0-00-00-00" placeholder="x-xx-xx-xx">
                            <p class="text-xs mt-1">Add attribute
                                <code class="text-primary">data-toggle="input-mask" data-mask-format="0-00-00-00"</code>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="text-gray-800 text-sm font-medium inline-block mb-2">Money</label>
                            <input type="text" class="form-input" data-toggle="input-mask" data-mask-format="000.000.000.000.000,00" data-reverse="true" placeholder="Your money">
                            <p class="text-xs mt-1">Add attribute
                                <code class="text-primary">data-mask-format="000.000.000.000.000,00"
                                    data-reverse="true"</code>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="text-gray-800 text-sm font-medium inline-block mb-2">Money 2</label>
                            <input type="text" class="form-input" data-toggle="input-mask" data-mask-format="#.##0,00" data-reverse="true" placeholder="#.##0,00">
                            <p class="text-xs mt-1">Add attribute
                                <code class="text-primary">data-toggle="input-mask" data-mask-format="#.##0,00"
                                    data-reverse="true"</code>
                            </p>
                        </div>

                    </form>
                </div>

                <div>
                    <form action="#">
                        <div class="mb-3">
                            <label class="text-gray-800 text-sm font-medium inline-block mb-2">Telephone</label>
                            <input type="text" class="form-input" data-toggle="input-mask" data-mask-format="0000-0000" placeholder="xxxx-xxxx">
                            <p class="text-xs mt-1">Add attribute
                                <code class="text-primary">data-toggle="input-mask" data-mask-format="0000-0000"</code>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="text-gray-800 text-sm font-medium inline-block mb-2">Telephone with Code
                                Area</label>
                            <input type="text" class="form-input" data-toggle="input-mask" data-mask-format="(00) 0000-0000" placeholder="(xx) xxxx-xxxx">
                            <p class="text-xs mt-1">Add attribute
                                <code class="text-primary">data-toggle="input-mask"
                                    data-mask-format="(00) 0000-0000"</code>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="text-gray-800 text-sm font-medium inline-block mb-2">US Telephone</label>
                            <input type="text" class="form-input" data-toggle="input-mask" data-mask-format="(000) 000-0000" placeholder="(xxx) xxx-xxxx">
                            <p class="text-xs mt-1">Add attribute
                                <code class="text-primary">data-toggle="input-mask"
                                    data-mask-format="(000) 000-0000"</code>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="text-gray-800 text-sm font-medium inline-block mb-2">São Paulo Celphones</label>
                            <input type="text" class="form-input" data-toggle="input-mask" data-mask-format="(00) 00000-0000" placeholder="(xx) xxxxx-xxxx">
                            <p class="text-xs mt-1">Add attribute
                                <code class="text-primary">data-toggle="input-mask"
                                    data-mask-format="(00) 00000-0000"</code>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="text-gray-800 text-sm font-medium inline-block mb-2">CPF</label>
                            <input type="text" class="form-input" data-toggle="input-mask" data-mask-format="000.000.000-00" data-reverse="true" placeholder="xxx.xxx.xxxx-xx">
                            <p class="text-xs mt-1">Add attribute
                                <code class="text-primary">data-mask-format="000.000.000-00" data-reverse="true"</code>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="text-gray-800 text-sm font-medium inline-block mb-2">CNPJ</label>
                            <input type="text" class="form-input" data-toggle="input-mask" data-mask-format="00.000.000/0000-00" data-reverse="true" placeholder="xx.xxx.xxx/xxxx-xx">
                            <p class="text-xs mt-1">Add attribute
                                <code class="text-primary">data-toggle="input-mask" data-mask-format="00.000.000/0000-00"
                                    data-reverse="true"</code>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="text-gray-800 text-sm font-medium inline-block mb-2">IP Address</label>
                            <input type="text" class="form-input" data-toggle="input-mask" data-mask-format="099.099.099.099" data-reverse="true" placeholder="xxx.xxx.xxx.xxx">
                            <p class="text-xs mt-1">Add attribute
                                <code class="text-primary">data-toggle="input-mask" data-mask-format="099.099.099.099"
                                    data-reverse="true"</code>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
            <div id="InputMaskHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                <pre class="language-html h-56">
							<code class="text-primary">
								&lt;div class=&quot;grid 2xl:grid-cols-2 grid-cols-1 gap-6&quot;&gt;
									&lt;div&gt;
										&lt;form action=&quot;#&quot;&gt;
											&lt;div class=&quot;mb-3&quot;&gt;
												&lt;label class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Date&lt;/label&gt;
												&lt;input type=&quot;text&quot; class=&quot;form-input&quot; data-toggle=&quot;input-mask&quot; data-mask-format=&quot;00/00/0000&quot; placeholder=&quot;DD/MM/YYYY&quot;&gt;
												&lt;p class=&quot;text-xs mt-1&quot;&gt;Add attribute &lt;code class=&quot;text-primary&quot;&gt;data-toggle=&quot;input-mask&quot; data-mask-format=&quot;00/00/0000&quot;&lt;/code&gt;&lt;/p&gt;
											&lt;/div&gt;
											&lt;div class=&quot;mb-3&quot;&gt;
												&lt;label class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Hour&lt;/label&gt;
												&lt;input type=&quot;text&quot; class=&quot;form-input&quot; data-toggle=&quot;input-mask&quot; data-mask-format=&quot;00:00:00&quot; placeholder=&quot;HH:MM:SS&quot;&gt;
												&lt;p class=&quot;text-xs mt-1&quot;&gt;Add attribute &lt;code class=&quot;text-primary&quot;&gt;data-toggle=&quot;input-mask&quot; data-mask-format=&quot;00:00:00&quot;&lt;/code&gt;&lt;/p&gt;
											&lt;/div&gt;
											&lt;div class=&quot;mb-3&quot;&gt;
												&lt;label class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Date &amp; Hour&lt;/label&gt;
												&lt;input type=&quot;text&quot; class=&quot;form-input&quot; data-toggle=&quot;input-mask&quot; data-mask-format=&quot;00/00/0000 00:00:00&quot; placeholder=&quot;DD/MM/YYYY HH:MM:SS&quot;&gt;
												&lt;p class=&quot;text-xs mt-1&quot;&gt;Add attribute &lt;code class=&quot;text-primary&quot;&gt;data-toggle=&quot;input-mask&quot; data-mask-format=&quot;00/00/0000 00:00:00&quot;&lt;/code&gt;&lt;/p&gt;
											&lt;/div&gt;
											&lt;div class=&quot;mb-3&quot;&gt;
												&lt;label class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;ZIP Code&lt;/label&gt;
												&lt;input type=&quot;text&quot; class=&quot;form-input&quot; data-toggle=&quot;input-mask&quot; data-mask-format=&quot;00000-000&quot; placeholder=&quot;xxxxx-xxx&quot;&gt;
												&lt;p class=&quot;text-xs mt-1&quot;&gt;Add attribute &lt;code class=&quot;text-primary&quot;&gt;data-toggle=&quot;input-mask&quot; data-mask-format=&quot;00000-000&quot;&lt;/code&gt;&lt;/p&gt;
											&lt;/div&gt;
											&lt;div class=&quot;mb-3&quot;&gt;
												&lt;label class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Crazy Zip Code&lt;/label&gt;
												&lt;input type=&quot;text&quot; class=&quot;form-input&quot; data-toggle=&quot;input-mask&quot; data-mask-format=&quot;0-00-00-00&quot; placeholder=&quot;x-xx-xx-xx&quot;&gt;
												&lt;p class=&quot;text-xs mt-1&quot;&gt;Add attribute &lt;code class=&quot;text-primary&quot;&gt;data-toggle=&quot;input-mask&quot; data-mask-format=&quot;0-00-00-00&quot;&lt;/code&gt;&lt;/p&gt;
											&lt;/div&gt;
											&lt;div class=&quot;mb-3&quot;&gt;
												&lt;label class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Money&lt;/label&gt;
												&lt;input type=&quot;text&quot; class=&quot;form-input&quot; data-toggle=&quot;input-mask&quot; data-mask-format=&quot;000.000.000.000.000,00&quot; data-reverse=&quot;true&quot; placeholder=&quot;Your money&quot;&gt;
												&lt;p class=&quot;text-xs mt-1&quot;&gt;Add attribute &lt;code class=&quot;text-primary&quot;&gt;data-mask-format=&quot;000.000.000.000.000,00&quot; data-reverse=&quot;true&quot;&lt;/code&gt;&lt;/p&gt;
											&lt;/div&gt;
											&lt;div class=&quot;mb-3&quot;&gt;
												&lt;label class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Money 2&lt;/label&gt;
												&lt;input type=&quot;text&quot; class=&quot;form-input&quot; data-toggle=&quot;input-mask&quot; data-mask-format=&quot;#.##0,00&quot; data-reverse=&quot;true&quot; placeholder=&quot;#.##0,00&quot;&gt;
												&lt;p class=&quot;text-xs mt-1&quot;&gt;Add attribute &lt;code class=&quot;text-primary&quot;&gt;data-toggle=&quot;input-mask&quot; data-mask-format=&quot;#.##0,00&quot; data-reverse=&quot;true&quot;&lt;/code&gt;&lt;/p&gt;
											&lt;/div&gt;

										&lt;/form&gt;
									&lt;/div&gt;

									&lt;div&gt;
										&lt;form action=&quot;#&quot;&gt;
											&lt;div class=&quot;mb-3&quot;&gt;
												&lt;label class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Telephone&lt;/label&gt;
												&lt;input type=&quot;text&quot; class=&quot;form-input&quot; data-toggle=&quot;input-mask&quot; data-mask-format=&quot;0000-0000&quot; placeholder=&quot;xxxx-xxxx&quot;&gt;
												&lt;p class=&quot;text-xs mt-1&quot;&gt;Add attribute &lt;code class=&quot;text-primary&quot;&gt;data-toggle=&quot;input-mask&quot; data-mask-format=&quot;0000-0000&quot;&lt;/code&gt;&lt;/p&gt;
											&lt;/div&gt;
											&lt;div class=&quot;mb-3&quot;&gt;
												&lt;label class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Telephone with Code Area&lt;/label&gt;
												&lt;input type=&quot;text&quot; class=&quot;form-input&quot; data-toggle=&quot;input-mask&quot; data-mask-format=&quot;(00) 0000-0000&quot; placeholder=&quot;(xx) xxxx-xxxx&quot;&gt;
												&lt;p class=&quot;text-xs mt-1&quot;&gt;Add attribute &lt;code class=&quot;text-primary&quot;&gt;data-toggle=&quot;input-mask&quot; data-mask-format=&quot;(00) 0000-0000&quot;&lt;/code&gt;&lt;/p&gt;
											&lt;/div&gt;
											&lt;div class=&quot;mb-3&quot;&gt;
												&lt;label class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;US Telephone&lt;/label&gt;
												&lt;input type=&quot;text&quot; class=&quot;form-input&quot; data-toggle=&quot;input-mask&quot; data-mask-format=&quot;(000) 000-0000&quot; placeholder=&quot;(xxx) xxx-xxxx&quot;&gt;
												&lt;p class=&quot;text-xs mt-1&quot;&gt;Add attribute &lt;code class=&quot;text-primary&quot;&gt;data-toggle=&quot;input-mask&quot; data-mask-format=&quot;(000) 000-0000&quot;&lt;/code&gt;&lt;/p&gt;
											&lt;/div&gt;
											&lt;div class=&quot;mb-3&quot;&gt;
												&lt;label class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;S&atilde;o Paulo Celphones&lt;/label&gt;
												&lt;input type=&quot;text&quot; class=&quot;form-input&quot; data-toggle=&quot;input-mask&quot; data-mask-format=&quot;(00) 00000-0000&quot; placeholder=&quot;(xx) xxxxx-xxxx&quot;&gt;
												&lt;p class=&quot;text-xs mt-1&quot;&gt;Add attribute &lt;code class=&quot;text-primary&quot;&gt;data-toggle=&quot;input-mask&quot; data-mask-format=&quot;(00) 00000-0000&quot;&lt;/code&gt;&lt;/p&gt;
											&lt;/div&gt;
											&lt;div class=&quot;mb-3&quot;&gt;
												&lt;label class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;CPF&lt;/label&gt;
												&lt;input type=&quot;text&quot; class=&quot;form-input&quot; data-toggle=&quot;input-mask&quot; data-mask-format=&quot;000.000.000-00&quot; data-reverse=&quot;true&quot; placeholder=&quot;xxx.xxx.xxxx-xx&quot;&gt;
												&lt;p class=&quot;text-xs mt-1&quot;&gt;Add attribute &lt;code class=&quot;text-primary&quot;&gt;data-mask-format=&quot;000.000.000-00&quot; data-reverse=&quot;true&quot;&lt;/code&gt;&lt;/p&gt;
											&lt;/div&gt;
											&lt;div class=&quot;mb-3&quot;&gt;
												&lt;label class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;CNPJ&lt;/label&gt;
												&lt;input type=&quot;text&quot; class=&quot;form-input&quot; data-toggle=&quot;input-mask&quot; data-mask-format=&quot;00.000.000/0000-00&quot; data-reverse=&quot;true&quot; placeholder=&quot;xx.xxx.xxx/xxxx-xx&quot;&gt;
												&lt;p class=&quot;text-xs mt-1&quot;&gt;Add attribute &lt;code class=&quot;text-primary&quot;&gt;data-toggle=&quot;input-mask&quot; data-mask-format=&quot;00.000.000/0000-00&quot; data-reverse=&quot;true&quot;&lt;/code&gt;&lt;/p&gt;
											&lt;/div&gt;
											&lt;div class=&quot;mb-3&quot;&gt;
												&lt;label class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;IP Address&lt;/label&gt;
												&lt;input type=&quot;text&quot; class=&quot;form-input&quot; data-toggle=&quot;input-mask&quot; data-mask-format=&quot;099.099.099.099&quot; data-reverse=&quot;true&quot; placeholder=&quot;xxx.xxx.xxx.xxx&quot;&gt;
												&lt;p class=&quot;text-xs mt-1&quot;&gt;Add attribute &lt;code class=&quot;text-primary&quot;&gt;data-toggle=&quot;input-mask&quot; data-mask-format=&quot;099.099.099.099&quot; data-reverse=&quot;true&quot;&lt;/code&gt;&lt;/p&gt;
											&lt;/div&gt;
										&lt;/form&gt;
									&lt;/div&gt;
								&lt;/div&gt;
							</code>
						</pre>
            </div>
        </div>

    </div>
@endsection

@section('script')
    @vite(['resources/js/pages/highlight.js', 'resources/js/pages/form-inputmask.js'])
@endsection
