@extends('layouts.vertical', ['title' => 'Tippy Tooltips', 'sub_title' => 'Extended', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
<!--Swiper slider css-->
@vite(['node_modules/tippy.js/dist/tippy.css'])
@endsection

@section('content')
<div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Placement Tooltips</h4>

				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="PlacementTooltips">
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
			<p class="sub-header">A highly customizable vanilla JS tooltip & popover library</p>
			<p class="text-sm text-slate-700 dark:text-slate-400 mb-3">
				The default tippy tooltip looks like this when given no options. It has a nifty backdrop filling animation!
			</p>
			<div class="flex flex-wrap gap-2">
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-placement="top">Top</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-placement="bottom">Bottom</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-placement="left">Left</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-placement="right">Right</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-placement="top-start">Top-Start</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-placement="top-end">Top-End</span>
			</div>

			<div id="PlacementTooltips" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-auto">
								<code>
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-placement=&quot;top&quot;&gt;Top&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-placement=&quot;bottom&quot;&gt;Bottom&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-placement=&quot;left&quot;&gt;Left&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-placement=&quot;right&quot;&gt;Right&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-placement=&quot;top-start&quot;&gt;Top-Start&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-placement=&quot;top-end&quot;&gt;Top-End&lt;/span&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Arrows Tooltips</h4>

				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="ArrowTooltips">
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
			<p class="text-sm text-slate-700 dark:text-slate-400 mb-3">
				Arrows point toward the reference element.
			</p>
			<div class="flex flex-wrap gap-2">
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-arrow="true" data-tippy-animation="fade">Default</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-arrow="true" data-tippy-arrowtype="round" data-tippy-animation="fade">Round</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-arrow="true" data-tippy-arrowtransform="scaleX(1.5)" data-tippy-animation="fade">Wide</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-arrow="true" data-tippy-arrowtransform="scaleX(0.75)" data-tippy-animation="fade">Skinny</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-arrow="true" data-tippy-arrowtransform="scale(0.75)" data-tippy-animation="fade">Small</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-arrow="true" data-tippy-arrowtransform="scale(1.35)" data-tippy-animation="fade">Large</span>
			</div>

			<div id="ArrowTooltips" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-auto">
								<code>
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-arrow=&quot;true&quot; data-tippy-animation=&quot;fade&quot;&gt;Default&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-arrow=&quot;true&quot; data-tippy-arrowType=&quot;round&quot; data-tippy-animation=&quot;fade&quot;&gt;Round&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-arrow=&quot;true&quot; data-tippy-arrowTransform=&quot;scaleX(1.5)&quot; data-tippy-animation=&quot;fade&quot;&gt;Wide&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-arrow=&quot;true&quot; data-tippy-arrowTransform=&quot;scaleX(0.75)&quot; data-tippy-animation=&quot;fade&quot;&gt;Skinny&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-arrow=&quot;true&quot; data-tippy-arrowTransform=&quot;scale(0.75)&quot; data-tippy-animation=&quot;fade&quot;&gt;Small&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-arrow=&quot;true&quot; data-tippy-arrowTransform=&quot;scale(1.35)&quot; data-tippy-animation=&quot;fade&quot;&gt;Large&lt;/span&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Interactivity Tooltips</h4>

				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="InteractivityTooltip">
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
			<p class="text-sm text-slate-700 dark:text-slate-400 mb-3">
				Tooltips can be interactive, meaning they won't hide when you hover over or click on them.
			</p>
			<div class="flex flex-wrap gap-2">
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-interactive="true">Interactive (hover)</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-interactive="true" data-tippy-trigger="click">Interactive (click)</span>
			</div>
			<div id="InteractivityTooltip" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-auto">
								<code>
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-interactive=&quot;true&quot;&gt;Interactive (hover)&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-interactive=&quot;true&quot; data-tippy-trigger=&quot;click&quot;&gt;Interactive (click)&lt;/span&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Duration Tooltips</h4>

				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="DurationTooltip">
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
			<p class="text-sm text-slate-700 dark:text-slate-400 mb-3">
				A tippy can have different transition durations.
			</p>
			<div class="flex flex-wrap gap-2">
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-duration="0">0ms</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-duration="200">200ms</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-duration="1000">1000ms</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-duration="[500, 200]">[500ms, 200ms]</span>
			</div>
			<div id="DurationTooltip" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-auto">
								<code>
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-duration=&quot;0&quot;&gt;0ms&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-duration=&quot;200&quot;&gt;200ms&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-duration=&quot;1000&quot;&gt;1000ms&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-duration=&quot;[500, 200]&quot;&gt;[500ms, 200ms]&lt;/span&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>
	<!-- end col-->


	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Animations Tooltips</h4>

				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="AnimationsTooltip">
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
			<p class="text-sm text-slate-700 dark:text-slate-400 mb-3">
				Tooltips can have different types of animations.
			</p>
			<div class="flex flex-wrap gap-2">
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-animation="shift-away" data-tippy-arrow="true">Shift away</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-animation="shift-toward" data-tippy-arrow="true">Shift toward</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-animation="fade" data-tippy-arrow="true">Fade</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-animation="scale" data-tippy-arrow="true">Scale</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-animation="perspective" data-tippy-arrow="true">Perspective</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-animation="shift-away" data-tippy-inertia="true" data-tippy-duration="[600, 300]" data-tippy-arrow="true">Inertia (shift-away)</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-animation="shift-toward" data-tippy-inertia="true" data-tippy-duration="[600, 300]" data-tippy-arrow="true">Inertia (shift-toward)</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-animation="scale" data-tippy-inertia="true" data-tippy-duration="[600, 300]" data-tippy-arrow="true">Inertia (scale)</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-animation="perspective" data-tippy-inertia="true" data-tippy-duration="[600, 300]" data-tippy-arrow="true">Inertia (perspective)</span>
			</div>

			<div id="AnimationsTooltip" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-auto">
								<code>
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-animation=&quot;shift-away&quot; data-tippy-arrow=&quot;true&quot;&gt;Shift away&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-animation=&quot;shift-toward&quot; data-tippy-arrow=&quot;true&quot;&gt;Shift toward&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-animation=&quot;fade&quot; data-tippy-arrow=&quot;true&quot;&gt;Fade&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-animation=&quot;scale&quot; data-tippy-arrow=&quot;true&quot;&gt;Scale&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-animation=&quot;perspective&quot; data-tippy-arrow=&quot;true&quot;&gt;Perspective&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-animation=&quot;shift-away&quot; data-tippy-inertia=&quot;true&quot; data-tippy-duration=&quot;[600, 300]&quot; data-tippy-arrow=&quot;true&quot;&gt;Inertia (shift-away)&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-animation=&quot;shift-toward&quot; data-tippy-inertia=&quot;true&quot; data-tippy-duration=&quot;[600, 300]&quot; data-tippy-arrow=&quot;true&quot;&gt;Inertia (shift-toward)&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-animation=&quot;scale&quot; data-tippy-inertia=&quot;true&quot; data-tippy-duration=&quot;[600, 300]&quot; data-tippy-arrow=&quot;true&quot;&gt;Inertia (scale)&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;I&amp;#39;m a Tippy tooltip!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-animation=&quot;perspective&quot; data-tippy-inertia=&quot;true&quot; data-tippy-duration=&quot;[600, 300]&quot; data-tippy-arrow=&quot;true&quot;&gt;Inertia (perspective)&lt;/span&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Themes Tooltips</h4>

				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="ThemesTooltips">
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
			<p class="text-sm text-slate-700 dark:text-slate-400 mb-3">
				A tippy can have any kind of theme you want! Creating a custom theme is a breeze.
			</p>
			<div class="flex flex-wrap gap-2">
				<span class="btn btn-sm bg-primary text-white" title="See-through!" tabindex="0" data-plugin="tippy" data-tippy-theme="translucent">Translucent</span>
				<span class="btn btn-sm bg-primary text-white" title="A light Tooltip !" tabindex="0" data-plugin="tippy" data-tippy-theme="light" data-tippy-arrow="true">Light</span>
				<span class="btn btn-sm bg-primary text-white" title="Awesome Gradient !" tabindex="0" data-plugin="tippy" data-tippy-theme="gradient">Gradient</span>
			</div>

			<div id="ThemesTooltips" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-auto">
								<code>
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;See-through!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-theme=&quot;translucent&quot;&gt;Translucent&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;A light Tooltip !&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-theme=&quot;light&quot; data-tippy-arrow=&quot;true&quot;&gt;Light&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;Awesome Gradient !&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-theme=&quot;gradient&quot;&gt;Gradient&lt;/span&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Misc Tooltips</h4>

				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="MiscTooltip">
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
			<p class="text-sm text-slate-700 dark:text-slate-400 mb-3">
				Tippy has a ton of features, and it's constantly improving.
			</p>
			<div class="flex flex-wrap gap-2">
				<span class="btn btn-sm bg-primary text-white" title="How cool&#39;s this?!" tabindex="0" data-plugin="tippy" data-tippy-followcursor="true" data-tippy-arrow="true" data-tippy-animation="fade">Follow cursor</span>
				<span class="btn btn-sm bg-primary text-white" title="You&#39;ll need a touch device for this one." tabindex="0" data-plugin="tippy" data-tippy-touchhold="true">Touch &amp; Hold</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m hugging the tooltip!" tabindex="0" data-plugin="tippy" data-tippy-distance="0" data-tippy-animation="fade">Distance</span>
				<span class="btn btn-sm bg-primary text-white" title="10px x-axis, 50px y-axis offset" tabindex="0" data-plugin="tippy" data-tippy-offset="10, 50">Offset</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-size="small">Small</span>
				<span class="btn btn-sm bg-primary text-white" title="I&#39;m a Tippy tooltip!" tabindex="0" data-plugin="tippy" data-tippy-size="large">Large</span>
			</div>

			<div id="MiscTooltip" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-auto">
								<code>
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;See-through!&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-theme=&quot;translucent&quot;&gt;Translucent&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;A light Tooltip !&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-theme=&quot;light&quot; data-tippy-arrow=&quot;true&quot;&gt;Light&lt;/span&gt;
									&lt;span class=&quot;btn btn-sm bg-primary text-white&quot; title=&quot;Awesome Gradient !&quot; tabindex=&quot;0&quot; data-plugin=&quot;tippy&quot; data-tippy-theme=&quot;gradient&quot;&gt;Gradient&lt;/span&gt;
								</code>
							</pre>
			</div>
		</div>

	</div>
	<!-- end col-->
</div>
@endsection

@section('script')
<!-- Tippy Demo js-->
@vite(['resources/js/pages/extended-tippy.js'])
@vite(['resources/js/pages/highlight.js'])
@endsection