@extends('layouts.vertical', ['title' => 'Nestable', 'sub_title' => 'Extended', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
<div class="flex flex-col gap-6">

	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Simple list example</h4>
				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="SimpalNestebalListHtml">
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
			<div id="example1" class="flex flex-col gap-3">
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 1</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 2</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 3</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 4</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 5</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 6</div>
			</div>

			<div id="SimpalNestebalListHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-auto">
								<code>
									&lt;div id=&quot;example1&quot; class=&quot;flex flex-col gap-3&quot;&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 1&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 2&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 3&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 4&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 5&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 6&lt;/div&gt;
									&lt;/div&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Shared lists</h4>
				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="ShredNestebalListHtml">
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
			<div class="grid md:grid-cols-2 gap-5">
				<div id="example2-left" class="flex flex-col gap-3">
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 1</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 2</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 3</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 4</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 5</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 6</div>
				</div>

				<div id="example2-right" class="flex flex-col gap-3">
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted">Item 1</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted">Item 2</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted">Item 3</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted">Item 4</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted">Item 5</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted">Item 6</div>
				</div>
			</div>

			<div id="ShredNestebalListHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-56">
								<code>
									&lt;div class=&quot;grid md:grid-cols-2 gap-5&quot;&gt;
										&lt;div id=&quot;example2-left&quot; class=&quot;flex flex-col gap-3&quot;&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 1&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 2&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 3&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 4&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 5&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 6&lt;/div&gt;
										&lt;/div&gt;
		
										&lt;div id=&quot;example2-right&quot; class=&quot;flex flex-col gap-3&quot;&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted&quot;&gt;Item 1&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted&quot;&gt;Item 2&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted&quot;&gt;Item 3&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted&quot;&gt;Item 4&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted&quot;&gt;Item 5&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted&quot;&gt;Item 6&lt;/div&gt;
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
				<h4 class="card-title">Cloning</h4>
				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="CloningNestebalListHtml">
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
			<p class="text-gray-400 mb-4">Try dragging from one list to another. The item you drag will be cloned and the clone will stay in the original list.</p>
			<div class="grid md:grid-cols-2 gap-5">
				<div id="example3-left" class="flex flex-col gap-3">
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 1</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 2</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 3</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 4</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 5</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 6</div>
				</div>

				<div id="example3-right" class="flex flex-col gap-3">
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted">Item 1</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted">Item 2</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted">Item 3</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted">Item 4</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted">Item 5</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted">Item 6</div>
				</div>
			</div>

			<div id="CloningNestebalListHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-56">
								<code>
									&lt;div class=&quot;grid md:grid-cols-2 gap-5&quot;&gt;
										&lt;div id=&quot;example3-left&quot; class=&quot;flex flex-col gap-3&quot;&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 1&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 2&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 3&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 4&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 5&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 6&lt;/div&gt;
										&lt;/div&gt;

										&lt;div id=&quot;example3-right&quot; class=&quot;flex flex-col gap-3&quot;&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted&quot;&gt;Item 1&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted&quot;&gt;Item 2&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted&quot;&gt;Item 3&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted&quot;&gt;Item 4&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted&quot;&gt;Item 5&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted&quot;&gt;Item 6&lt;/div&gt;
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
				<h4 class="card-title">Disabling Sorting</h4>
				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="DisablingSortingNestebalListHtml">
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
			<p class="text-gray-400 mb-4">Try sorting the list on the left. It is not possible because it has it's
				<code>sort</code>
				option set to false. However, you can still drag from the list on the left to the list on the right.</p>
			<div class="grid md:grid-cols-2 gap-5">
				<div id="example4-left" class="flex flex-col gap-3">
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 1</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 2</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 3</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 4</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 5</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 6</div>
				</div>

				<div id="example4-right" class="flex flex-col gap-3">
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted">Item 1</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted">Item 2</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted">Item 3</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted">Item 4</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted">Item 5</div>
					<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted">Item 6</div>
				</div>
			</div>

			<div id="DisablingSortingNestebalListHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-56">
								<code>
									&lt;div class=&quot;grid md:grid-cols-2 gap-5&quot;&gt;
										&lt;div id=&quot;example4-left&quot; class=&quot;flex flex-col gap-3&quot;&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 1&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 2&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 3&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 4&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 5&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 6&lt;/div&gt;
										&lt;/div&gt;

										&lt;div id=&quot;example4-right&quot; class=&quot;flex flex-col gap-3&quot;&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted&quot;&gt;Item 1&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted&quot;&gt;Item 2&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted&quot;&gt;Item 3&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted&quot;&gt;Item 4&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted&quot;&gt;Item 5&lt;/div&gt;
											&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 tinted&quot;&gt;Item 6&lt;/div&gt;
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
				<h4 class="card-title">Handle With Icon</h4>
				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="HandleNestebalListHtml">
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
			<div id="example5" class="flex flex-col gap-3">
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">
					<i class="mgc_move_line handle"></i>&nbsp;&nbsp;Item 1</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">
					<i class="mgc_move_line handle"></i>&nbsp;&nbsp;Item 2</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">
					<i class="mgc_move_line handle"></i>&nbsp;&nbsp;Item 3</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">
					<i class="mgc_move_line handle"></i>&nbsp;&nbsp;Item 4</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">
					<i class="mgc_move_line handle"></i>&nbsp;&nbsp;Item 5</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">
					<i class="mgc_move_line handle"></i>&nbsp;&nbsp;Item 6</div>
			</div>

			<div id="HandleNestebalListHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-auto">
								<code>
									&lt;div id=&quot;example5&quot; class=&quot;flex flex-col gap-3&quot;&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;&lt;i class=&quot;mgc_move_line handle&quot;&gt;&lt;/i&gt;&amp;nbsp;&amp;nbsp;Item 1&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;&lt;i class=&quot;mgc_move_line handle&quot;&gt;&lt;/i&gt;&amp;nbsp;&amp;nbsp;Item 2&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;&lt;i class=&quot;mgc_move_line handle&quot;&gt;&lt;/i&gt;&amp;nbsp;&amp;nbsp;Item 3&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;&lt;i class=&quot;mgc_move_line handle&quot;&gt;&lt;/i&gt;&amp;nbsp;&amp;nbsp;Item 4&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;&lt;i class=&quot;mgc_move_line handle&quot;&gt;&lt;/i&gt;&amp;nbsp;&amp;nbsp;Item 5&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;&lt;i class=&quot;mgc_move_line handle&quot;&gt;&lt;/i&gt;&amp;nbsp;&amp;nbsp;Item 6&lt;/div&gt;
									&lt;/div&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Filter</h4>
				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="FilterNestebalListHtml">
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
			<p class="text-gray-400 mb-4">Try dragging the item with a red background. It cannot be done, because that item is filtered out using the
				<code>filter</code>
				option.</p>
			<div id="example6" class="flex flex-col gap-3">
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 1</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 2</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 3</div>
				<div class="rounded-md border px-6 py-3 bg-danger filtered text-white border-gray-200 dark:border-gray-700">Filtered</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 4</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 5</div>
			</div>

			<div id="FilterNestebalListHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-auto">
								<code>
									&lt;div id=&quot;example6&quot; class=&quot;flex flex-col gap-3&quot;&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 1&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 2&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 3&lt;/div&gt;
										&lt;div class=&quot;rounded-md border px-6 py-3 bg-danger filtered border-gray-200 dark:border-gray-700&quot;&gt;Filtered&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 4&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 5&lt;/div&gt;
									&lt;/div&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Grid Example</h4>
				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="GridNestebalListHtml">
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
			<div id="gridDemo" class="flex flex-wrap gap-4">
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 1</div>
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 2</div>
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 3</div>
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 4</div>
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 5</div>
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 6</div>
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 7</div>
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 8</div>
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 9</div>
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 10</div>
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 11</div>
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 12</div>
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 13</div>
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 14</div>
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 15</div>
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 16</div>
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 17</div>
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 18</div>
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 19</div>
				<div class="w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700">Item 20</div>
			</div>

			<div id="GridNestebalListHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-56">
								<code>
									&lt;div id=&quot;gridDemo&quot; class=&quot;flex flex-wrap gap-4&quot;&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 1&lt;/div&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 2&lt;/div&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 3&lt;/div&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 4&lt;/div&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 5&lt;/div&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 6&lt;/div&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 7&lt;/div&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 8&lt;/div&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 9&lt;/div&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 10&lt;/div&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 11&lt;/div&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 12&lt;/div&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 13&lt;/div&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 14&lt;/div&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 15&lt;/div&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 16&lt;/div&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 17&lt;/div&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 18&lt;/div&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 19&lt;/div&gt;
										&lt;div class=&quot;w-24 h-24 flex items-center justify-center text-slate-900 dark:text-slate-200 rounded border shadow border-gray-200 dark:border-gray-700&quot;&gt;Item 20&lt;/div&gt;
									&lt;/div&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Nested Sortables Example</h4>
				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="SortableNestebalListHtml">
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
			<p class="text-gray-400 mb-4">NOTE: When using nested Sortables with animation, it is recommended that the
				<code>fallbackOnBody</code>
				option is set to true.
				<br>It is also always recommended that either the
				<code>invertSwap</code>
				option is set to true, or the
				<code>swapThreshold</code>
				option is lower than the default value of 1 (eg
				<code>0.65</code>).</p>
			<div id="nestedDemo" class="flex flex-col gap-3 nested-sortable">
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-1">
					<div class="pb-3">Item 1.1</div>
					<div class="list-group nested-sortable">
						<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-2">Item 2.1</div>
						<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-2">Item 2.2
							<div class="list-group nested-sortable">
								<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-3">Item 3.1</div>
								<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-3">Item 3.2</div>
								<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-3">Item 3.3</div>
								<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-3">Item 3.4</div>
							</div>
						</div>
						<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-2">Item 2.3</div>
						<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-2">Item 2.4</div>
					</div>
				</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-1">Item 1.2</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-1">Item 1.3</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-1">Item 1.4
					<div class="list-group nested-sortable">
						<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-2">Item 2.1</div>
						<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-2">Item 2.2</div>
						<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-2">Item 2.3</div>
						<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-2">Item 2.4</div>
					</div>
				</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-1">Item 1.5</div>
			</div>

			<div id="SortableNestebalListHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-56">
								<code>
									&lt;div id=&quot;nestedDemo&quot; class=&quot;flex flex-col gap-3 nested-sortable&quot;&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-1&quot;&gt;Item 1.1
											&lt;div class=&quot;list-group nested-sortable&quot;&gt;
												&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-2&quot;&gt;Item 2.1&lt;/div&gt;
												&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-2&quot;&gt;Item 2.2
													&lt;div class=&quot;list-group nested-sortable&quot;&gt;
														&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-3&quot;&gt;Item 3.1&lt;/div&gt;
														&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-3&quot;&gt;Item 3.2&lt;/div&gt;
														&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-3&quot;&gt;Item 3.3&lt;/div&gt;
														&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-3&quot;&gt;Item 3.4&lt;/div&gt;
													&lt;/div&gt;
												&lt;/div&gt;
												&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-2&quot;&gt;Item 2.3&lt;/div&gt;
												&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-2&quot;&gt;Item 2.4&lt;/div&gt;
											&lt;/div&gt;
										&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-1&quot;&gt;Item 1.2&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-1&quot;&gt;Item 1.3&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-1&quot;&gt;Item 1.4
											&lt;div class=&quot;list-group nested-sortable&quot;&gt;
												&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-2&quot;&gt;Item 2.1&lt;/div&gt;
												&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-2&quot;&gt;Item 2.2&lt;/div&gt;
												&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-2&quot;&gt;Item 2.3&lt;/div&gt;
												&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-2&quot;&gt;Item 2.4&lt;/div&gt;
											&lt;/div&gt;
										&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700 nested-1&quot;&gt;Item 1.5&lt;/div&gt;
									&lt;/div&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">MultiDrag</h4>
				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="MultiDragNestebalListHtml">
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
			<p class="text-gray-400 mb-4">The
				<a target="_blank" href="https://github.com/SortableJS/Sortable/tree/master/plugins/MultiDrag">MultiDrag</a>
				plugin allows for multiple items to be dragged at a time. You can click to "select" multiple items, and then drag them as one item.</p>
			<div id="multiDragDemo" class="flex flex-col gap-3">
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 1</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 2</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 3</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 4</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 5</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 6</div>
			</div>

			<div id="MultiDragNestebalListHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-56">
								<code>
									&lt;div id=&quot;multiDragDemo&quot; class=&quot;flex flex-col gap-3&quot;&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 1&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 2&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 3&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 4&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 5&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 6&lt;/div&gt;
									&lt;/div&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Swap</h4>
				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="SwapNestebalListHtml">
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
			<p class="text-gray-400 mb-4">The
				<a target="_blank" href="https://github.com/SortableJS/Sortable/tree/master/plugins/Swap">Swap</a>
				plugin changes the behaviour of Sortable to allow for items to be swapped with eachother rather than sorted.</p>
			<div id="swapDemo" class="flex flex-col gap-3">
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 1</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 2</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 3</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 4</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 5</div>
				<div class="card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700">Item 6</div>
			</div>

			<div id="SwapNestebalListHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-auto">
								<code>
									&lt;div id=&quot;swapDemo&quot; class=&quot;flex flex-col gap-3&quot;&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 1&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 2&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 3&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 4&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 5&lt;/div&gt;
										&lt;div class=&quot;card cursor-grab px-6 py-3 border border-gray-200 dark:border-gray-700&quot;&gt;Item 6&lt;/div&gt;
									&lt;/div&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<!-- Dragula Demo Component js -->
@vite(['resources/js/pages/extended-sortable.js'])
@vite(['resources/js/pages/highlight.js'])
@endsection