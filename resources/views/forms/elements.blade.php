@extends('layouts.vertical', ['title' => 'Elements', 'sub_title' => 'Forms', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
<div class="flex flex-col gap-6">
	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Input</h4>

				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#FormInputsHtml">
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
			<p class="text-gray-400 mb-4">
				Most common form control, text-based input fields. Includes support for all HTML5
				                                types:
				<code class="text-primary">text</code>,
				<code class="text-primary">password</code>,
				<code class="text-primary">datetime</code>,
				<code class="text-primary">datetime-local</code>,
				<code class="text-primary">date</code>,
				<code class="text-primary">month</code>,
				<code class="text-primary">time</code>,
				<code class="text-primary">week</code>,
				<code class="text-primary">number</code>,
				<code class="text-primary">email</code>,
				<code class="text-primary">url</code>,
				<code class="text-primary">search</code>,
				<code class="text-primary">tel</code>, and
				<code class="text-primary">color</code>.
			</p>

			<div class="grid lg:grid-cols-3 gap-6">

				<div>
					<label for="simpleinput" class="text-gray-800 text-sm font-medium inline-block mb-2">Text</label>
					<input type="text" id="simpleinput" class="form-input">
				</div>

				<div>
					<label for="example-email" class="text-gray-800 text-sm font-medium inline-block mb-2">Email</label>
					<input type="email" id="example-email" name="example-email" class="form-input" placeholder="Email">
				</div>

				<div>
					<label for="example-password" class="text-gray-800 text-sm font-medium inline-block mb-2">Password</label>
					<input type="password" id="example-password" class="form-input" value="password">
				</div>

				<div>
					<label for="example-palaceholder" class="text-gray-800 text-sm font-medium inline-block mb-2">Placeholder</label>
					<input type="text" id="example-palaceholder" class="form-input" placeholder="placeholder">
				</div>

				<div>
					<label for="example-readonly" class="text-gray-800 text-sm font-medium inline-block mb-2">Readonly</label>
					<input type="text" id="example-readonly" class="form-input" readonly="" value="Readonly value">
				</div>

				<div>
					<label for="example-disable" class="text-gray-800 text-sm font-medium inline-block mb-2">Disabled</label>
					<input type="text" class="form-input" id="example-disable" disabled="" value="Disabled value">
				</div>

				<div>
					<label for="example-date" class="text-gray-800 text-sm font-medium inline-block mb-2">Date</label>
					<input class="form-input" id="example-date" type="date" name="date">
				</div>

				<div>
					<label for="example-month" class="text-gray-800 text-sm font-medium inline-block mb-2">Month</label>
					<input class="form-input" id="example-month" type="month" name="month">
				</div>

				<div>
					<label for="example-time" class="text-gray-800 text-sm font-medium inline-block mb-2">Time</label>
					<input class="form-input" id="example-time" type="time" name="time">
				</div>

				<div>
					<label for="example-week" class="text-gray-800 text-sm font-medium inline-block mb-2">Week</label>
					<input class="form-input" id="example-week" type="week" name="week">
				</div>

				<div>
					<label for="example-number" class="text-gray-800 text-sm font-medium inline-block mb-2">Number</label>
					<input class="form-input" id="example-number" type="number" name="number">
				</div>

				<div>
					<label for="example-color" class="text-gray-800 text-sm font-medium inline-block mb-2">Color</label>
					<input class="form-input h-10" id="example-color" type="color" name="color" value="#1E85FF">
				</div>

				<div>
					<label for="example-select" class="text-gray-800 text-sm font-medium inline-block mb-2">Input Select</label>
					<select class="form-select" id="example-select">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div>

				<div>
					<label for="example-multiselect" class="text-gray-800 text-sm font-medium inline-block mb-2">Multiple
						                                        Select</label>
					<select id="example-multiselect" multiple class="form-input">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div>
			</div>


			<div id="FormInputsHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-56">
                                    <code>
                                        &lt;div class=&quot;grid lg:grid-cols-3 gap-6&quot;&gt;
                                            &lt;div&gt;
                                                &lt;label for=&quot;simpleinput&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Text&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; id=&quot;simpleinput&quot; class=&quot;form-input&quot;&gt;
                                            &lt;/div&gt;
            
                                            &lt;div&gt;
                                                &lt;label for=&quot;example-email&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Email&lt;/label&gt;
                                                &lt;input type=&quot;email&quot; id=&quot;example-email&quot; name=&quot;example-email&quot; class=&quot;form-input&quot; placeholder=&quot;Email&quot;&gt;
                                            &lt;/div&gt;
            
                                            &lt;div&gt;
                                                &lt;label for=&quot;example-password&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Password&lt;/label&gt;
                                                &lt;input type=&quot;password&quot; id=&quot;example-password&quot; class=&quot;form-input&quot; value=&quot;password&quot;&gt;
                                            &lt;/div&gt;
            
                                            &lt;div&gt;
                                                &lt;label for=&quot;example-palaceholder&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Placeholder&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; id=&quot;example-palaceholder&quot; class=&quot;form-input&quot; placeholder=&quot;placeholder&quot;&gt;
                                            &lt;/div&gt;
            
                                            &lt;div&gt;
                                                &lt;label for=&quot;example-readonly&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Readonly&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; id=&quot;example-readonly&quot; class=&quot;form-input&quot; readonly=&quot;&quot; value=&quot;Readonly value&quot;&gt;
                                            &lt;/div&gt;
            
                                            &lt;div&gt;
                                                &lt;label for=&quot;example-disable&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Disabled&lt;/label&gt;
                                                &lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;example-disable&quot; disabled=&quot;&quot; value=&quot;Disabled value&quot;&gt;
                                            &lt;/div&gt;
            
                                            &lt;div&gt;
                                                &lt;label for=&quot;example-date&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Date&lt;/label&gt;
                                                &lt;input class=&quot;form-input&quot; id=&quot;example-date&quot; type=&quot;date&quot; name=&quot;date&quot;&gt;
                                            &lt;/div&gt;
            
                                            &lt;div&gt;
                                                &lt;label for=&quot;example-month&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Month&lt;/label&gt;
                                                &lt;input class=&quot;form-input&quot; id=&quot;example-month&quot; type=&quot;month&quot; name=&quot;month&quot;&gt;
                                            &lt;/div&gt;
            
                                            &lt;div&gt;
                                                &lt;label for=&quot;example-time&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Time&lt;/label&gt;
                                                &lt;input class=&quot;form-input&quot; id=&quot;example-time&quot; type=&quot;time&quot; name=&quot;time&quot;&gt;
                                            &lt;/div&gt;
            
                                            &lt;div&gt;
                                                &lt;label for=&quot;example-week&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Week&lt;/label&gt;
                                                &lt;input class=&quot;form-input&quot; id=&quot;example-week&quot; type=&quot;week&quot; name=&quot;week&quot;&gt;
                                            &lt;/div&gt;
            
                                            &lt;div&gt;
                                                &lt;label for=&quot;example-number&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Number&lt;/label&gt;
                                                &lt;input class=&quot;form-input&quot; id=&quot;example-number&quot; type=&quot;number&quot; name=&quot;number&quot;&gt;
                                            &lt;/div&gt;
            
                                            &lt;div&gt;
                                                &lt;label for=&quot;example-color&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Color&lt;/label&gt;
                                                &lt;input class=&quot;form-input h-10&quot; id=&quot;example-color&quot; type=&quot;color&quot; name=&quot;color&quot; value=&quot;#1E85FF&quot;&gt;
                                            &lt;/div&gt;
            
                                            &lt;div&gt;
                                                &lt;label for=&quot;example-select&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Input Select&lt;/label&gt;
                                                &lt;select class=&quot;form-select&quot; id=&quot;example-select&quot;&gt;
                                                    &lt;option&gt;1&lt;/option&gt;
                                                    &lt;option&gt;2&lt;/option&gt;
                                                    &lt;option&gt;3&lt;/option&gt;
                                                    &lt;option&gt;4&lt;/option&gt;
                                                    &lt;option&gt;5&lt;/option&gt;
                                                &lt;/select&gt;
                                            &lt;/div&gt;
            
                                            &lt;div&gt;
                                                &lt;label for=&quot;example-multiselect&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Multiple
                                                    Select&lt;/label&gt;
                                                &lt;select id=&quot;example-multiselect&quot; multiple class=&quot;form-input&quot;&gt;
                                                    &lt;option&gt;1&lt;/option&gt;
                                                    &lt;option&gt;2&lt;/option&gt;
                                                    &lt;option&gt;3&lt;/option&gt;
                                                    &lt;option&gt;4&lt;/option&gt;
                                                    &lt;option&gt;5&lt;/option&gt;
                                                &lt;/select&gt;
                                            &lt;/div&gt;
                                        &lt;/div&gt;
                                    </code>
                                </pre>
			</div>
		</div>
	</div>
	<!-- end card -->

	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Input Group</h4>

				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#FormInputGroupHtml">
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
			<p class="text-gray-400 mb-4">
				Easily extend form controls by adding text, buttons, or button groups on either side
				                                of textual inputs, custom selects, and custom file inputs
			</p>

			<div class="grid lg:grid-cols-3 gap-6">

				<div>
					<div class="flex">
						<div class="inline-flex items-center px-4 rounded-s border border-e-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400">
							@
						</div>
						<input type="text" placeholder="Username" class="form-input ltr:rounded-l-none rtl:rounded-r-none"/>
					</div>
				</div>
				<div>
					<div class="flex">
						<input type="text" placeholder="Recipient's username" class="form-input ltr:rounded-r-none rtl:rounded-l-none"/>
						<div class="inline-flex items-center px-4 rounded-e border border-s-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400">
							@example.com
						</div>
					</div>
				</div>
				<div>
					<div class="flex">
						<div class="inline-flex items-center px-4 rounded-s border border-e-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400">
							$
						</div>
						<input type="text" placeholder="" class="form-input rounded-none"/>
						<div class="inline-flex items-center px-4 rounded-e border border-s-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400">
							.00
						</div>
					</div>
				</div>

				<div>
					<div class="flex rounded-md shadow-sm -space-x-px">
						<span class="px-4 inline-flex items-center rounded-s border border-gray-200 bg-gray-50 text-sm text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400">Default</span>
						<input type="text" class="form-input rounded-s-none">
					</div>
				</div>

				<div>
					<div class="sm:flex rounded-md shadow-sm">
						<input type="text" class="form-input rounded-e-none">
						<input type="text" class="form-input rounded-s-none">
						<span class="inline-flex items-center whitespace-nowrap px-4 rounded-e border border-s-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400">First and last name</span>
					</div>
				</div>

				<div>
					<div class="relative">
						<input type="email" id="leading-icon" name="leading-icon" class="form-input ps-11" placeholder="you@site.com">
						<div class="absolute inset-y-0 start-4 flex items-center z-20">
							<i class="mgc_mail_line text-lg text-gray-400"></i>
						</div>
					</div>
				</div>

				<div>
					<div class="relative">
						<input type="text" id="input-with-leading-and-trailing-icon" name="input-with-leading-and-trailing-icon" class="form-input ps-11 pe-14" placeholder="0.00">
						<div class="absolute inset-y-0 start-4 flex items-center pointer-events-none z-20">
							<span class="text-gray-500">$</span>
						</div>
						<div class="absolute inset-y-0 end-4 flex items-center pointer-events-none z-20">
							<span class="text-gray-500">USD</span>
						</div>
					</div>
				</div>

				<div>
					<div class="flex rounded-md shadow-sm">
						<div class="px-4 inline-flex items-center min-w-fit rounded-l-md border border-r-0 border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-700">
							<span class="text-sm text-gray-500 dark:text-gray-400">$</span>
						</div>
						<div class="px-4 inline-flex items-center min-w-fit border border-r-0 border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-700">
							<span class="text-sm text-gray-500 dark:text-gray-400">0.00</span>
						</div>
						<input type="text" id="leading-multiple-add-on" name="inline-add-on" class="form-input rounded-s-none" placeholder="www.example.com">
					</div>
				</div>
				<div>
					<div class="flex rounded-md shadow-sm">
						<button type="button" class="btn btn-sm bg-primary text-white rounded-e-none">
							Button
						</button>
						<input type="text" id="leading-button-add-on" name="leading-button-add-on" class="form-input">
					</div>
				</div>

				<div>
					<div class="flex rounded-md shadow-sm">
						<button type="button" class="btn btn-sm bg-primary text-white rounded-e-none">
							Button
						</button>
						<button type="button" class="-me-px py-2.5 px-4 inline-flex justify-center items-center gap-2 border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-primary transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white">
							Button
						</button>
						<input type="text" id="leading-button-add-on-multiple-add-ons" name="leading-button-add-on-multiple-add-ons" class="form-input">
					</div>
				</div>

				<div>
					<div class="flex">
						<div class="inline-flex items-center whitespace-nowrap px-3 rounded-s border border-e-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400">
							With textarea
						</div>
						<textarea rows="4" class="form-textarea ltr:rounded-s-none rtl:rounded-e-none"></textarea>
					</div>
				</div>
			</div>

			<div id="FormInputGroupHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-56">
                    <code>
                        &lt;div class=&quot;grid lg:grid-cols-3 gap-6&quot;&gt;
                            &lt;div class=&quot;mb-5&quot;&gt;
                                &lt;div class=&quot;flex&quot;&gt;
                                    &lt;div class=&quot;inline-flex items-center px-4 rounded-s border border-e-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400&quot;&gt;
                                        @
                                    &lt;/div&gt;
                                    &lt;input type=&quot;text&quot; placeholder=&quot;Username&quot; class=&quot;form-input ltr:rounded-l-none rtl:rounded-r-none&quot; /&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;mb-5&quot;&gt;
                                &lt;div class=&quot;flex&quot;&gt;
                                    &lt;input type=&quot;text&quot; placeholder=&quot;Recipient's username&quot; class=&quot;form-input ltr:rounded-r-none rtl:rounded-l-none&quot; /&gt;
                                    &lt;div class=&quot;inline-flex items-center px-4 rounded-e border border-s-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400&quot;&gt;
                                        @example.com
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;mb-5&quot;&gt;
                                &lt;div class=&quot;flex&quot;&gt;
                                    &lt;div class=&quot;inline-flex items-center px-4 rounded-s border border-e-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400&quot;&gt;
                                        $
                                    &lt;/div&gt;
                                    &lt;input type=&quot;text&quot; placeholder=&quot;&quot; class=&quot;form-input rounded-none&quot; /&gt;
                                    &lt;div class=&quot;inline-flex items-center px-4 rounded-e border border-s-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400&quot;&gt;
                                        .00
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        
                            &lt;div&gt;
                                &lt;div class=&quot;flex rounded-md shadow-sm -space-x-px&quot;&gt;
                                    &lt;span class=&quot;px-4 inline-flex items-center rounded-s border border-gray-200 bg-gray-50 text-sm text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400&quot;&gt;Default&lt;/span&gt;
                                    &lt;input type=&quot;text&quot; class=&quot;form-input rounded-s-none&quot;&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;

                            &lt;div&gt;
                                &lt;div class=&quot;sm:flex rounded-md shadow-sm&quot;&gt;
                                    &lt;input type=&quot;text&quot; class=&quot;form-input rounded-e-none&quot;&gt;
                                    &lt;span class=&quot;py-2.5 px-4 inline-flex items-center min-w-fit w-full border border-gray-200 bg-gray-50 text-sm text-gray-500 -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:w-auto sm:first:rounded-l-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-tr-none sm:last:rounded-bl-none sm:last:rounded-r-lg dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400&quot;&gt;
                                        &lt;svg class=&quot;hidden sm:block h-4 w-4 text-gray-400&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;16&quot; height=&quot;16&quot; fill=&quot;currentColor&quot; viewBox=&quot;0 0 16 16&quot;&gt;
                                            &lt;path fill-rule=&quot;evenodd&quot; d=&quot;M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z&quot;&gt;
                                        &lt;/svg&gt;
                                        &lt;svg class=&quot;sm:hidden mx-auto h-4 w-4 text-gray-400&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;16&quot; height=&quot;16&quot; fill=&quot;currentColor&quot; viewBox=&quot;0 0 16 16&quot;&gt;
                                            &lt;path fill-rule=&quot;evenodd&quot; d=&quot;M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z&quot;&gt;
                                        &lt;/svg&gt;
                                    &lt;/span&gt;
                                    &lt;input type=&quot;text&quot; class=&quot;form-input rounded-s-none&quot;&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;

                            &lt;div&gt;
                                &lt;div class=&quot;sm:flex rounded-md shadow-sm&quot;&gt;
                                &lt;input type=&quot;text&quot; class=&quot;form-input rounded-e-none&quot;&gt;
                                &lt;input type=&quot;text&quot; class=&quot;form-input rounded-s-none&quot;&gt;
                                &lt;span class=&quot;inline-flex items-center whitespace-nowrap px-4 rounded-e border border-s-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400&quot;&gt;First and last name&lt;/span&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;

                            &lt;div&gt;
                                &lt;label for=&quot;simpleinput&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Email Address&lt;/label&gt;
                                &lt;div class=&quot;relative&quot;&gt;
                                    &lt;input type=&quot;email&quot; id=&quot;leading-icon&quot; name=&quot;leading-icon&quot; class=&quot;form-input ps-11&quot; placeholder=&quot;you@site.com&quot;&gt;
                                    &lt;div class=&quot;absolute inset-y-0 start-4 flex items-center z-20&quot;&gt;
                                        &lt;i class=&quot;mgc_mail_line text-lg text-gray-400&quot;&gt;&lt;/i&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;


                            &lt;div&gt;
                                &lt;label for=&quot;simpleinput&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Text&lt;/label&gt;
                                &lt;div class=&quot;relative&quot;&gt;
                                    &lt;input type=&quot;text&quot; id=&quot;input-with-leading-and-trailing-icon&quot; name=&quot;input-with-leading-and-trailing-icon&quot; class=&quot;form-input ps-11 pe-14&quot; placeholder=&quot;0.00&quot;&gt;
                                    &lt;div class=&quot;absolute inset-y-0 start-4 flex items-center pointer-events-none z-20&quot;&gt;
                                        &lt;span class=&quot;text-gray-500&quot;&gt;$&lt;/span&gt;
                                    &lt;/div&gt;
                                    &lt;div class=&quot;absolute inset-y-0 end-4 flex items-center pointer-events-none z-20&quot;&gt;
                                        &lt;span class=&quot;text-gray-500&quot;&gt;USD&lt;/span&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;

                            &lt;div&gt;
                                &lt;label for=&quot;simpleinput&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Text&lt;/label&gt;
                                &lt;div class=&quot;flex rounded-md shadow-sm&quot;&gt;
                                    &lt;div class=&quot;inline-flex items-center px-4 rounded-s border border-s-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400&quot;&gt;
                                        &lt;span class=&quot;text-sm text-gray-500 dark:text-gray-400&quot;&gt;http://&lt;/span&gt;
                                    &lt;/div&gt;
                                    &lt;input type=&quot;text&quot; name=&quot;input-with-add-on-url&quot; id=&quot;input-with-add-on-url&quot; class=&quot;form-input rounded-s-none&quot; placeholder=&quot;www.example.com&quot;&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;

                            &lt;div&gt;
                                &lt;label for=&quot;simpleinput&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Text&lt;/label&gt;
                                &lt;div class=&quot;flex rounded-md shadow-sm&quot;&gt;
                                    &lt;div class=&quot;px-4 inline-flex items-center min-w-fit rounded-l-md border border-r-0 border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-700&quot;&gt;
                                        &lt;span class=&quot;text-sm text-gray-500 dark:text-gray-400&quot;&gt;$&lt;/span&gt;
                                    &lt;/div&gt;
                                    &lt;div class=&quot;px-4 inline-flex items-center min-w-fit border border-r-0 border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-700&quot;&gt;
                                        &lt;span class=&quot;text-sm text-gray-500 dark:text-gray-400&quot;&gt;0.00&lt;/span&gt;
                                    &lt;/div&gt;
                                    &lt;input type=&quot;text&quot; id=&quot;leading-multiple-add-on&quot; name=&quot;inline-add-on&quot; class=&quot;form-input rounded-s-none&quot; placeholder=&quot;www.example.com&quot;&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;

                            &lt;div&gt;
                                &lt;label for=&quot;simpleinput&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Text&lt;/label&gt;
                                &lt;div class=&quot;flex rounded-md shadow-sm&quot;&gt;
                                    &lt;span class=&quot;inline-flex items-center px-4 rounded-s border border-s-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400&quot;&gt;
                                        &lt;span class=&quot;text-sm text-gray-500 dark:text-gray-400&quot;&gt;http://&lt;/span&gt;
                                    &lt;/span&gt;
                                    &lt;input type=&quot;text&quot; id=&quot;trailing-button-add-on-with-leading-and-trailing&quot; name=&quot;trailing-button-add-on-with-leading-and-trailing&quot; class=&quot;form-input rounded-none&quot;&gt;
                                    &lt;button type=&quot;button&quot; class=&quot;inline-flex items-center px-4 rounded-e bg-primary text-gray-100&quot;&gt;
                                        &lt;svg class=&quot;h-4 w-4&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;16&quot; height=&quot;16&quot; fill=&quot;currentColor&quot; viewBox=&quot;0 0 16 16&quot;&gt;
                                            &lt;path d=&quot;M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z&quot;&gt;
                                        &lt;/svg&gt;
                                    &lt;/button&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;

                            &lt;div&gt;
                                &lt;label for=&quot;simpleinput&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Text&lt;/label&gt;
                                &lt;div class=&quot;relative flex rounded-md shadow-sm&quot;&gt;
                                    &lt;input type=&quot;text&quot; id=&quot;trailing-button-add-on-with-icon-and-button&quot; name=&quot;trailing-button-add-on-with-icon-and-button&quot; class=&quot;form-input ps-11&quot;&gt;
                                    &lt;div class=&quot;absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4&quot;&gt;
                                        &lt;svg class=&quot;h-4 w-4 text-gray-400&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;16&quot; height=&quot;16&quot; fill=&quot;currentColor&quot; viewBox=&quot;0 0 16 16&quot;&gt;
                                            &lt;path d=&quot;M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z&quot;&gt;
                                        &lt;/svg&gt;
                                    &lt;/div&gt;
                                    &lt;button type=&quot;button&quot; class=&quot;btn btn-sm bg-primary text-white rounded-s-none&quot;&gt;Search&lt;/button&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;

                            &lt;div&gt;
                                &lt;label for=&quot;simpleinput&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Text&lt;/label&gt;
                                &lt;div class=&quot;flex rounded-md shadow-sm&quot;&gt;
                                    &lt;button type=&quot;button&quot; class=&quot;btn btn-sm bg-primary text-white rounded-e-none&quot;&gt;
                                        Button
                                    &lt;/button&gt;
                                    &lt;input type=&quot;text&quot; id=&quot;leading-button-add-on&quot; name=&quot;leading-button-add-on&quot; class=&quot;form-input&quot;&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;

                            &lt;div&gt;
                                &lt;label for=&quot;simpleinput&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Text&lt;/label&gt;
                                &lt;div class=&quot;flex rounded-md shadow-sm&quot;&gt;
                                    &lt;button type=&quot;button&quot; class=&quot;btn btn-sm bg-primary text-white rounded-e-none&quot;&gt;
                                        Button
                                    &lt;/button&gt;
                                    &lt;button type=&quot;button&quot; class=&quot;-me-px py-2.5 px-4 inline-flex justify-center items-center gap-2 border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-primary transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white&quot;&gt;
                                        Button
                                    &lt;/button&gt;
                                    &lt;input type=&quot;text&quot; id=&quot;leading-button-add-on-multiple-add-ons&quot; name=&quot;leading-button-add-on-multiple-add-ons&quot; class=&quot;form-input&quot;&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;

                            &lt;div&gt;
                                &lt;label for=&quot;simpleinput&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Text&lt;/label&gt;
                                &lt;div class=&quot;flex&quot;&gt;
                                    &lt;div class=&quot;inline-flex items-center whitespace-nowrap px-3 rounded-s border border-e-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400&quot;&gt;
                                        With textarea
                                    &lt;/div&gt;
                                    &lt;textarea rows=&quot;4&quot; class=&quot;form-textarea ltr:rounded-s-none rtl:rounded-e-none&quot;&gt;&lt;/textarea&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
            </div>
        </div>
    </div> <!-- end card -->

    <div class="grid lg:grid-cols-2 gap-6">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Checkbox</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#FormCheckboxHtml">
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
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <h6 class="text-sm mb-2">Default</h6>
                        <div class="flex flex-col gap-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-checkbox rounded text-primary" id="customCheck1">
                                <label class="ms-1.5" for="customCheck1">Check this checkbox</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-checkbox rounded text-primary" id="customCheck2">
                                <label class="ms-1.5" for="customCheck2">Check this checkbox</label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h6 class="text-sm mb-2">Disabled</h6>

                        <div class="flex flex-col gap-2">
                            <div class="opacity-75">
                                <input type="checkbox" class="form-checkbox rounded text-primary" id="customCheck5" checked disabled>
                                <label class="ms-1.5" for="customCheck5">Check this checkbox</label>
                            </div>
                            <div class="opacity-75">
                                <input type="checkbox" class="form-checkbox rounded text-primary" id="customCheck6" disabled>
                                <label class="ms-1.5" for="customCheck6">Check this checkbox</label>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3">
                        <div>
                            <input class="form-checkbox rounded text-primary" type="checkbox" id="customckeck1" checked>
                            <label class="ms-1.5" for="customckeck1">Primary</label>
                        </div>

                        <div>
                            <input class="form-checkbox rounded text-success" type="checkbox" id="customckeck2" checked>
                            <label class="ms-1.5" for="customckeck2">Success</label>
                        </div>

                        <div>
                            <input class="form-checkbox rounded text-danger" type="checkbox" id="customckeck3" checked>
                            <label class="ms-1.5" for="customckeck3">Danger</label>
                        </div>

                        <div>
                            <input class="form-checkbox rounded text-warning" type="checkbox" id="customckeck4" checked>
                            <label class="ms-1.5" for="customckeck4">Warning</label>
                        </div>

                        <div>
                            <input class="form-checkbox rounded text-pink-500" type="checkbox" id="checkBox5" checked>
                            <label class="ms-1.5" for="checkBox5">Pink</label>
                        </div>

                        <div>
                            <input class="form-checkbox rounded text-blue" type="checkbox" id="checkBox7" checked>
                            <label class="ms-1.5" for="checkBox7">Blue</label>
                        </div>

                        <div>
                            <input class="form-checkbox rounded text-info" type="checkbox" id="checkBox8" checked>
                            <label class="ms-1.5" for="checkBox8">Info</label>
                        </div>

                        <div>
                            <input class="form-checkbox rounded text-dark" type="checkbox" id="checkBox9" checked>
                            <label class="ms-1.5" for="checkBox9">Dark</label>
                        </div>
                    </div>


                    <div class="flex flex-col gap-3">
                        <div>
                            <input class="form-checkbox rounded-full text-primary" type="checkbox" id="checkBox10" checked>
                            <label class="ms-1.5" for="checkBox10">Primary</label>
                        </div>

                        <div>
                            <input class="form-checkbox rounded-full text-success" type="checkbox" id="checkBox11" checked>
                            <label class="ms-1.5" for="checkBox11">Success</label>
                        </div>

                        <div>
                            <input class="form-checkbox rounded-full text-danger" type="checkbox" id="checkBox12" checked>
                            <label class="ms-1.5" for="checkBox12">Danger</label>
                        </div>

                        <div>
                            <input class="form-checkbox rounded-full text-warning" type="checkbox" id="checkBox13" checked>
                            <label class="ms-1.5" for="checkBox13">Warning</label>
                        </div>

                        <div>
                            <input class="form-checkbox rounded-full text-pink-500" type="checkbox" id="customckec14" checked>
                            <label class="ms-1.5" for="customckec14">Pink</label>
                        </div>

                        <div>
                            <input class="form-checkbox rounded-full text-blue" type="checkbox" id="checkBox15" checked>
                            <label class="ms-1.5" for="checkBox15">Blue</label>
                        </div>

                        <div>
                            <input class="form-checkbox rounded-full text-info" type="checkbox" id="checkBox16" checked>
                            <label class="ms-1.5" for="checkBox16">Info</label>
                        </div>

                        <div>
                            <input class="form-checkbox rounded-full text-dark" type="checkbox" id="checkBox17" checked>
                            <label class="ms-1.5" for="checkBox17">Dark</label>
                        </div>
                    </div>
                </div>

                <div id="FormCheckboxHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                        <code>
                            &lt;div class=&quot;grid md:grid-cols-2 gap-6&quot;&gt;
                                &lt;div&gt;
                                    &lt;h6 class=&quot;text-sm mb-2&quot;&gt;Default&lt;/h6&gt;
                                    &lt;div class=&quot;flex flex-col gap-2&quot;&gt;
                                        &lt;div class=&quot;form-check&quot;&gt;
                                            &lt;input type=&quot;checkbox&quot; class=&quot;form-checkbox rounded text-primary&quot; id=&quot;customCheck1&quot;&gt;
                                            &lt;label class=&quot;ms-1.5&quot; for=&quot;customCheck1&quot;&gt;Check this checkbox&lt;/label&gt;
                                        &lt;/div&gt;
                                        &lt;div class=&quot;form-check&quot;&gt;
                                            &lt;input type=&quot;checkbox&quot; class=&quot;form-checkbox rounded text-primary&quot; id=&quot;customCheck2&quot;&gt;
                                            &lt;label class=&quot;ms-1.5&quot; for=&quot;customCheck2&quot;&gt;Check this checkbox&lt;/label&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;

                                &lt;div&gt;
                                    &lt;h6 class=&quot;text-sm mb-2&quot;&gt;Disabled&lt;/h6&gt;

                                    &lt;div class=&quot;flex flex-col gap-2&quot;&gt;
                                        &lt;div class=&quot;opacity-75&quot;&gt;
                                            &lt;input type=&quot;checkbox&quot; class=&quot;form-checkbox rounded text-primary&quot; id=&quot;customCheck5&quot; checked disabled&gt;
                                            &lt;label class=&quot;ms-1.5&quot; for=&quot;customCheck5&quot;&gt;Check this checkbox&lt;/label&gt;
                                        &lt;/div&gt;
                                        &lt;div class=&quot;opacity-75&quot;&gt;
                                            &lt;input type=&quot;checkbox&quot; class=&quot;form-checkbox rounded text-primary&quot; id=&quot;customCheck6&quot; disabled&gt;
                                            &lt;label class=&quot;ms-1.5&quot; for=&quot;customCheck6&quot;&gt;Check this checkbox&lt;/label&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;

                                &lt;div class=&quot;flex flex-col gap-3&quot;&gt;
                                    &lt;div&gt;
                                        &lt;input class=&quot;form-checkbox rounded text-primary&quot; type=&quot;checkbox&quot; id=&quot;customckeck1&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;customckeck1&quot;&gt;Primary&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-checkbox rounded text-success&quot; type=&quot;checkbox&quot; id=&quot;customckeck2&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;customckeck2&quot;&gt;Success&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-checkbox rounded text-danger&quot; type=&quot;checkbox&quot; id=&quot;customckeck3&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;customckeck3&quot;&gt;Danger&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-checkbox rounded text-warning&quot; type=&quot;checkbox&quot; id=&quot;customckeck4&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;customckeck4&quot;&gt;Warning&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-checkbox rounded text-pink-500&quot; type=&quot;checkbox&quot; id=&quot;checkBox5&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;checkBox5&quot;&gt;Pink&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-checkbox rounded text-blue&quot; type=&quot;checkbox&quot; id=&quot;checkBox7&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;checkBox7&quot;&gt;Blue&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-checkbox rounded text-info&quot; type=&quot;checkbox&quot; id=&quot;checkBox8&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;checkBox8&quot;&gt;Info&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-checkbox rounded text-dark&quot; type=&quot;checkbox&quot; id=&quot;checkBox9&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;checkBox9&quot;&gt;Dark&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;


                                &lt;div class=&quot;flex flex-col gap-3&quot;&gt;
                                    &lt;div&gt;
                                        &lt;input class=&quot;form-checkbox rounded-full text-primary&quot; type=&quot;checkbox&quot; id=&quot;checkBox10&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;checkBox10&quot;&gt;Primary&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-checkbox rounded-full text-success&quot; type=&quot;checkbox&quot; id=&quot;checkBox11&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;checkBox11&quot;&gt;Success&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-checkbox rounded-full text-danger&quot; type=&quot;checkbox&quot; id=&quot;checkBox12&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;checkBox12&quot;&gt;Danger&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-checkbox rounded-full text-warning&quot; type=&quot;checkbox&quot; id=&quot;checkBox13&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;checkBox13&quot;&gt;Warning&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-checkbox rounded-full text-pink-500&quot; type=&quot;checkbox&quot; id=&quot;customckec14&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;customckec14&quot;&gt;Pink&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-checkbox rounded-full text-blue&quot; type=&quot;checkbox&quot; id=&quot;checkBox15&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;checkBox15&quot;&gt;Blue&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-checkbox rounded-full text-info&quot; type=&quot;checkbox&quot; id=&quot;checkBox16&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;checkBox16&quot;&gt;Info&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-checkbox rounded-full text-dark&quot; type=&quot;checkbox&quot; id=&quot;checkBox17&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;checkBox17&quot;&gt;Dark&lt;/label&gt;
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
                    <h4 class="card-title">Radio Button</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#radioButton">
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
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <h6 class="text-sm mb-2">Default</h6>
                        <div class="flex flex-col gap-2">
                            <div class="form-check">
                                <input type="radio" class="form-radio text-primary" name="formRadio" id="formRadio01" checked>
                                <label class="ms-1.5" for="formRadio01">Check this radio</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-radio text-primary" name="formRadio" id="formRadio02">
                                <label class="ms-1.5" for="formRadio02">Check this radio</label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h6 class="text-sm mb-2">Disabled</h6>

                        <div class="flex flex-col gap-2">
                            <div class="opacity-75">
                                <input type="radio" class="form-radio text-primary" id="formRadio04" checked disabled>
                                <label class="ms-1.5" for="formRadio04">Check this radio</label>
                            </div>

                            <div class="opacity-75">
                                <input type="radio" class="form-radio text-primary" id="formRadio05" disabled>
                                <label class="ms-1.5" for="formRadio05">Check this radio</label>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3">
                        <div>
                            <input class="form-radio text-primary" type="radio" id="formRadio10" checked>
                            <label class="ms-1.5" for="formRadio10">Primary</label>
                        </div>

                        <div>
                            <input class="form-radio text-success" type="radio" id="formRadio11" checked>
                            <label class="ms-1.5" for="formRadio11">Success</label>
                        </div>

                        <div>
                            <input class="form-radio text-danger" type="radio" id="formRadio12" checked>
                            <label class="ms-1.5" for="formRadio12">Danger</label>
                        </div>

                        <div>
                            <input class="form-radio text-warning" type="radio" id="formRadio13" checked>
                            <label class="ms-1.5" for="formRadio13">Warning</label>
                        </div>

                        <div>
                            <input class="form-radio text-pink-500" type="radio" id="formRadio14" checked>
                            <label class="ms-1.5" for="formRadio14">Pink</label>
                        </div>

                        <div>
                            <input class="form-radio text-blue" type="radio" id="formRadio15" checked>
                            <label class="ms-1.5" for="formRadio15">Blue</label>
                        </div>

                        <div>
                            <input class="form-radio text-info" type="radio" id="formRadio16" checked>
                            <label class="ms-1.5" for="formRadio16">Info</label>
                        </div>

                        <div>
                            <input class="form-radio text-dark" type="radio" id="formRadio17" checked>
                            <label class="ms-1.5" for="formRadio17">Dark</label>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3">
                        <div>
                            <input class="form-radio rounded text-primary" type="radio" id="formRadio1" checked>
                            <label class="ms-1.5" for="formRadio1">Primary</label>
                        </div>

                        <div>
                            <input class="form-radio rounded text-success" type="radio" id="formRadio2" checked>
                            <label class="ms-1.5" for="formRadio2">Success</label>
                        </div>

                        <div>
                            <input class="form-radio rounded text-danger" type="radio" id="formRadio3" checked>
                            <label class="ms-1.5" for="formRadio3">Danger</label>
                        </div>

                        <div>
                            <input class="form-radio rounded text-warning" type="radio" id="formRadio4" checked>
                            <label class="ms-1.5" for="formRadio4">Warning</label>
                        </div>

                        <div>
                            <input class="form-radio rounded text-pink-500" type="radio" id="formRadio5" checked>
                            <label class="ms-1.5" for="formRadio5">Pink</label>
                        </div>

                        <div>
                            <input class="form-radio rounded text-blue" type="radio" id="formRadio7" checked>
                            <label class="ms-1.5" for="formRadio7">Blue</label>
                        </div>

                        <div>
                            <input class="form-radio rounded text-info" type="radio" id="formRadio8" checked>
                            <label class="ms-1.5" for="formRadio8">Info</label>
                        </div>

                        <div>
                            <input class="form-radio rounded text-dark" type="radio" id="formRadio9" checked>
                            <label class="ms-1.5" for="formRadio9">Dark</label>
                        </div>
                    </div>
                </div>

                <div id="radioButton" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                        <code>
                            &lt;div class=&quot;grid md:grid-cols-2 gap-6&quot;&gt;
                                &lt;div&gt;
                                    &lt;h6 class=&quot;text-sm mb-2&quot;&gt;Default&lt;/h6&gt;
                                    &lt;div class=&quot;flex flex-col gap-2&quot;&gt;
                                        &lt;div class=&quot;form-check&quot;&gt;
                                            &lt;input type=&quot;radio&quot; class=&quot;form-radio text-primary&quot; name=&quot;formRadio&quot; id=&quot;formRadio01&quot; checked&gt;
                                            &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio01&quot;&gt;Check this radio&lt;/label&gt;
                                        &lt;/div&gt;
                                        &lt;div class=&quot;form-check&quot;&gt;
                                            &lt;input type=&quot;radio&quot; class=&quot;form-radio text-primary&quot; name=&quot;formRadio&quot; id=&quot;formRadio02&quot;&gt;
                                            &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio02&quot;&gt;Check this radio&lt;/label&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;

                                &lt;div&gt;
                                    &lt;h6 class=&quot;text-sm mb-2&quot;&gt;Disabled&lt;/h6&gt;

                                    &lt;div class=&quot;flex flex-col gap-2&quot;&gt;
                                        &lt;div class=&quot;opacity-75&quot;&gt;
                                            &lt;input type=&quot;radio&quot; class=&quot;form-radio text-primary&quot; id=&quot;formRadio04&quot; checked disabled&gt;
                                            &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio04&quot;&gt;Check this radio&lt;/label&gt;
                                        &lt;/div&gt;

                                        &lt;div class=&quot;opacity-75&quot;&gt;
                                            &lt;input type=&quot;radio&quot; class=&quot;form-radio text-primary&quot; id=&quot;formRadio05&quot; disabled&gt;
                                            &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio05&quot;&gt;Check this radio&lt;/label&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;

                                &lt;div class=&quot;flex flex-col gap-3&quot;&gt;
                                    &lt;div&gt;
                                        &lt;input class=&quot;form-radio text-primary&quot; type=&quot;radio&quot; id=&quot;formRadio10&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio10&quot;&gt;Primary&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-radio text-success&quot; type=&quot;radio&quot; id=&quot;formRadio11&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio11&quot;&gt;Success&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-radio text-danger&quot; type=&quot;radio&quot; id=&quot;formRadio12&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio12&quot;&gt;Danger&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-radio text-warning&quot; type=&quot;radio&quot; id=&quot;formRadio13&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio13&quot;&gt;Warning&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-radio text-pink-500&quot; type=&quot;radio&quot; id=&quot;formRadio14&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio14&quot;&gt;Pink&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-radio text-blue&quot; type=&quot;radio&quot; id=&quot;formRadio15&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio15&quot;&gt;Blue&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-radio text-info&quot; type=&quot;radio&quot; id=&quot;formRadio16&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio16&quot;&gt;Info&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-radio text-dark&quot; type=&quot;radio&quot; id=&quot;formRadio17&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio17&quot;&gt;Dark&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;

                                &lt;div class=&quot;flex flex-col gap-3&quot;&gt;
                                    &lt;div&gt;
                                        &lt;input class=&quot;form-radio rounded text-primary&quot; type=&quot;radio&quot; id=&quot;formRadio1&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio1&quot;&gt;Primary&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-radio rounded text-success&quot; type=&quot;radio&quot; id=&quot;formRadio2&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio2&quot;&gt;Success&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-radio rounded text-danger&quot; type=&quot;radio&quot; id=&quot;formRadio3&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio3&quot;&gt;Danger&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-radio rounded text-warning&quot; type=&quot;radio&quot; id=&quot;formRadio4&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio4&quot;&gt;Warning&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-radio rounded text-pink-500&quot; type=&quot;radio&quot; id=&quot;formRadio5&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio5&quot;&gt;Pink&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-radio rounded text-blue&quot; type=&quot;radio&quot; id=&quot;formRadio7&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio7&quot;&gt;Blue&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-radio rounded text-info&quot; type=&quot;radio&quot; id=&quot;formRadio8&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio8&quot;&gt;Info&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;input class=&quot;form-radio rounded text-dark&quot; type=&quot;radio&quot; id=&quot;formRadio9&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;formRadio9&quot;&gt;Dark&lt;/label&gt;
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
                    <h4 class="card-title">Switch</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#formSwitchHTML">
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
                <div class="grid xl:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-3">
                        <h6 class="text-sm mb-2">Default</h6>
                        <div class="flex items-center">
                            <input class="form-switch" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="ms-1.5" for="flexSwitchCheckDefault">Default switch checkbox</label>
                        </div>
                        <div class="flex items-center">
                            <input class="form-switch" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                            <label class="ms-1.5" for="flexSwitchCheckChecked">Checked switch checkbox</label>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3">
                        <h6 class="text-sm mb-2">Disabled</h6>
                        <div class="flex items-center opacity-60">
                            <input class="form-switch" type="checkbox" role="switch" id="flexSwitchCheckDisabled" disabled>
                            <label class="ms-1.5" for="flexSwitchCheckDisabled">Disabled Switch</label>
                        </div>
                        <div class="flex items-center opacity-60">
                            <input class="form-switch" type="checkbox" role="switch" id="flexSwitchCheckCheckedDisabled" checked disabled>
                            <label class="ms-1.5" for="flexSwitchCheckCheckedDisabled">Disabled checked Switch</label>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3">
                        <h6 class="text-sm mb-2">Colored</h6>
                        <div class="flex items-center">
                            <input type="checkbox" id="formSwitch" class="form-switch text-primary" checked>
                            <label for="formSwitch" class="ms-1.5">Primary</label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="formSwitch2" class="form-switch text-warning" checked>
                            <label for="formSwitch2" class="ms-1.5">Warning</label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="formSwitch3" class="form-switch text-danger" checked>
                            <label for="formSwitch3" class="ms-1.5">Danger</label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="formSwitch4" class="form-switch text-success" checked>
                            <label for="formSwitch4" class="ms-1.5">Success</label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="formSwitch5" class="form-switch text-secondary" checked>
                            <label for="formSwitch5" class="ms-1.5">Secondary</label>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3">
                        <h6 class="text-sm mb-2">Square</h6>
                        <div class="flex items-center">
                            <input type="checkbox" id="formSwitch6" class="form-switch square text-primary" checked>
                            <label for="formSwitch6" class="ms-2">Primary</label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="formSwitch7" class="form-switch square text-warning" checked>
                            <label for="formSwitch7" class="ms-2">Warning</label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="formSwitch8" class="form-switch square text-danger" checked>
                            <label for="formSwitch8" class="ms-2">Danger</label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="formSwitch9" class="form-switch square text-success" checked>
                            <label for="formSwitch9" class="ms-2">Success</label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="formSwitch10" class="form-switch square text-secondary" checked>
                            <label for="formSwitch10" class="ms-2">Secondary</label>
                        </div>
                    </div>
                </div>
                <div id="formSwitchHTML" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                        <code>
                            &lt;div class=&quot;grid xl:grid-cols-2 gap-6&quot;&gt;
                                &lt;div class=&quot;flex flex-col gap-3&quot;&gt;
                                    &lt;h6 class=&quot;text-sm mb-2&quot;&gt;Default&lt;/h6&gt;
                                    &lt;div class=&quot;flex items-center&quot;&gt;
                                        &lt;input class=&quot;form-switch&quot; type=&quot;checkbox&quot; role=&quot;switch&quot; id=&quot;flexSwitchCheckDefault&quot;&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;flexSwitchCheckDefault&quot;&gt;Default switch checkbox&lt;/label&gt;
                                    &lt;/div&gt;
                                    &lt;div class=&quot;flex items-center&quot;&gt;
                                        &lt;input class=&quot;form-switch&quot; type=&quot;checkbox&quot; role=&quot;switch&quot; id=&quot;flexSwitchCheckChecked&quot; checked&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;flexSwitchCheckChecked&quot;&gt;Checked switch checkbox&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;

                                &lt;div class=&quot;flex flex-col gap-3&quot;&gt;
                                    &lt;h6 class=&quot;text-sm mb-2&quot;&gt;Disabled&lt;/h6&gt;
                                    &lt;div class=&quot;flex items-center opacity-60&quot;&gt;
                                        &lt;input class=&quot;form-switch&quot; type=&quot;checkbox&quot; role=&quot;switch&quot; id=&quot;flexSwitchCheckDisabled&quot; disabled&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;flexSwitchCheckDisabled&quot;&gt;Disabled Switch&lt;/label&gt;
                                    &lt;/div&gt;
                                    &lt;div class=&quot;flex items-center opacity-60&quot;&gt;
                                        &lt;input class=&quot;form-switch&quot; type=&quot;checkbox&quot; role=&quot;switch&quot; id=&quot;flexSwitchCheckCheckedDisabled&quot; checked disabled&gt;
                                        &lt;label class=&quot;ms-1.5&quot; for=&quot;flexSwitchCheckCheckedDisabled&quot;&gt;Disabled checked Switch&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;

                                &lt;div class=&quot;flex flex-col gap-3&quot;&gt;
                                    &lt;h6 class=&quot;text-sm mb-2&quot;&gt;Colored&lt;/h6&gt;
                                    &lt;div class=&quot;flex items-center&quot;&gt;
                                        &lt;input type=&quot;checkbox&quot; id=&quot;formSwitch&quot; class=&quot;form-switch text-primary&quot; checked&gt;
                                        &lt;label for=&quot;formSwitch&quot; class=&quot;ms-1.5&quot;&gt;Primary&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div class=&quot;flex items-center&quot;&gt;
                                        &lt;input type=&quot;checkbox&quot; id=&quot;formSwitch2&quot; class=&quot;form-switch text-warning&quot; checked&gt;
                                        &lt;label for=&quot;formSwitch2&quot; class=&quot;ms-1.5&quot;&gt;Warning&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div class=&quot;flex items-center&quot;&gt;
                                        &lt;input type=&quot;checkbox&quot; id=&quot;formSwitch3&quot; class=&quot;form-switch text-danger&quot; checked&gt;
                                        &lt;label for=&quot;formSwitch3&quot; class=&quot;ms-1.5&quot;&gt;Danger&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div class=&quot;flex items-center&quot;&gt;
                                        &lt;input type=&quot;checkbox&quot; id=&quot;formSwitch4&quot; class=&quot;form-switch text-success&quot; checked&gt;
                                        &lt;label for=&quot;formSwitch4&quot; class=&quot;ms-1.5&quot;&gt;Success&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div class=&quot;flex items-center&quot;&gt;
                                        &lt;input type=&quot;checkbox&quot; id=&quot;formSwitch5&quot; class=&quot;form-switch text-secondary&quot; checked&gt;
                                        &lt;label for=&quot;formSwitch5&quot; class=&quot;ms-1.5&quot;&gt;Secondary&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;

                                &lt;div class=&quot;flex flex-col gap-3&quot;&gt;
                                    &lt;h6 class=&quot;text-sm mb-2&quot;&gt;Square&lt;/h6&gt;
                                    &lt;div class=&quot;flex items-center&quot;&gt;
                                        &lt;input type=&quot;checkbox&quot; id=&quot;formSwitch6&quot; class=&quot;form-switch square text-primary&quot; checked&gt;
                                        &lt;label for=&quot;formSwitch6&quot; class=&quot;ms-2&quot;&gt;Primary&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div class=&quot;flex items-center&quot;&gt;
                                        &lt;input type=&quot;checkbox&quot; id=&quot;formSwitch7&quot; class=&quot;form-switch square text-warning&quot; checked&gt;
                                        &lt;label for=&quot;formSwitch7&quot; class=&quot;ms-2&quot;&gt;Warning&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div class=&quot;flex items-center&quot;&gt;
                                        &lt;input type=&quot;checkbox&quot; id=&quot;formSwitch8&quot; class=&quot;form-switch square text-danger&quot; checked&gt;
                                        &lt;label for=&quot;formSwitch8&quot; class=&quot;ms-2&quot;&gt;Danger&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div class=&quot;flex items-center&quot;&gt;
                                        &lt;input type=&quot;checkbox&quot; id=&quot;formSwitch9&quot; class=&quot;form-switch square text-success&quot; checked&gt;
                                        &lt;label for=&quot;formSwitch9&quot; class=&quot;ms-2&quot;&gt;Success&lt;/label&gt;
                                    &lt;/div&gt;

                                    &lt;div class=&quot;flex items-center&quot;&gt;
                                        &lt;input type=&quot;checkbox&quot; id=&quot;formSwitch10&quot; class=&quot;form-switch square text-secondary&quot; checked&gt;
                                        &lt;label for=&quot;formSwitch10&quot; class=&quot;ms-2&quot;&gt;Secondary&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        </code>
                    </pre>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    @vite(['resources/js/pages/highlight.js'])
@endsection