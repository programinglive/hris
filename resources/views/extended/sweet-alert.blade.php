@extends('layouts.vertical', ['title' => 'Sweet Alert', 'sub_title' => 'Extended', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@vite(['node_modules/sweetalert2/dist/sweetalert2.min.css'])
@endsection

@section('content')
<div class="grid 2xl:grid-cols-2 grid-cols-1 gap-6">
	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Basic Message</h4>

				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="basicSweetAlert">
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
			<button type="button" class="btn bg-primary text-white" id="sweetalert-basic">Click me</button>

			<div id="basicSweetAlert" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-auto">
								<code>
									&lt;button type=&quot;button&quot; class=&quot;btn bg-primary text-white&quot; id=&quot;sweetalert-basic&quot;&gt;Click me&lt;/button&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Title with a Text Under</h4>

				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="TitleSweetAlert">
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
			<button type="button" class="btn bg-primary text-white" id="sweetalert-title">Click me</button>
			<div id="TitleSweetAlert" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-auto">
								<code>
									&lt;button type=&quot;button&quot; class=&quot;btn bg-primary text-white&quot; id=&quot;sweetalert-basic&quot;&gt;Click me&lt;/button&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Message Alert</h4>

				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="MessageSweetAlert">
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
			<button type="button" class="btn bg-success text-white" id="sweetalert-success">Success</button>
			<button type="button" class="btn bg-warning text-white" id="sweetalert-warning">Warning</button>
			<button type="button" class="btn bg-info text-white" id="sweetalert-info">Info</button>
			<button type="button" class="btn bg-danger text-white" id="sweetalert-error">Error</button>

			<div id="MessageSweetAlert" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-auto">
								<code>
									&lt;button type=&quot;button&quot; class=&quot;btn bg-success text-white&quot; id=&quot;sweetalert-success&quot;&gt;Success&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-warning text-white&quot; id=&quot;sweetalert-warning&quot;&gt;Warning&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-info text-white&quot; id=&quot;sweetalert-info&quot;&gt;Info&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-danger text-white&quot; id=&quot;sweetalert-error&quot;&gt;Error&lt;/button&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Long Content</h4>

				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="LongContentSweetAlert">
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
			<button type="button" class="btn bg-primary text-white" id="sweetalert-longcontent">Click me</button>
			<div id="LongContentSweetAlert" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-auto">
								<code>
									&lt;button type=&quot;button&quot; class=&quot;btn bg-primary text-white&quot; id=&quot;sweetalert-longcontent&quot;&gt;Click me&lt;/button&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>


	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Warning Message</h4>

				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="WarningSweetAlert">
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
			<button type="button" class="btn bg-primary text-white" id="sweetalert-params">Click me</button>

			<div id="WarningSweetAlert" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-auto">
								<code>
									&lt;button type=&quot;button&quot; class=&quot;btn bg-primary text-white&quot; id=&quot;sweetalert-longcontent&quot;&gt;Click me&lt;/button&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>
</div>
<!-- end card -->
@endsection

@section('script')
<!-- Sweet alert init js-->
@vite(['resources/js/pages/extended-sweetalert.js'])

@vite(['resources/js/pages/highlight.js'])
@endsection