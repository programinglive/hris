
@extends('layouts.vertical', ['title' => 'Lightbox', 'sub_title' => 'Extended', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
<!-- Glightbox css -->
@vite(['node_modules/glightbox/dist/css/glightbox.min.css'])
@endsection

@section('content')
<div class="grid grid-cols-1 gap-6">
	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Single Image Lightbox</h4>
				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="singleImageLightbox">
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
			<div class="grid lg:grid-cols-4 gap-5">
				<div>
					<a href="/images/small/img-1.jpg" class="image-popup">
						<img src="/images/small/img-1.jpg" alt="work-thumbnail" class="rounded-lg">
					</a>
				</div>
				<div>
					<a href="/images/small/img-2.jpg" class="image-popup">
						<img src="/images/small/img-2.jpg" alt="work-thumbnail" class="rounded-lg">
					</a>
				</div>
				<div>
					<a href="/images/small/img-4.jpg" class="image-popup">
						<img src="/images/small/img-4.jpg" alt="work-thumbnail" class="rounded-lg">
					</a>
				</div>
				<div>
					<a href="/images/small/img-5.jpg" class="image-popup">
						<img src="/images/small/img-5.jpg" alt="work-thumbnail" class="rounded-lg">
					</a>
				</div>
			</div>

			<div id="singleImageLightbox" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-56">
					<code>
						&lt;div class=&quot;grid lg:grid-cols-4 gap-5&quot;&gt;
							&lt;div&gt;
								&lt;a href=&quot;/images/small/img-1.jpg&quot; class=&quot;image-popup&quot;&gt;
									&lt;img src=&quot;/images/small/img-1.jpg&quot; alt=&quot;work-thumbnail&quot; class=&quot;rounded-lg&quot;&gt;
								&lt;/a&gt;
							&lt;/div&gt;
							&lt;div&gt;
								&lt;a href=&quot;/images/small/img-2.jpg&quot; class=&quot;image-popup&quot;&gt;
									&lt;img src=&quot;/images/small/img-2.jpg&quot; alt=&quot;work-thumbnail&quot; class=&quot;rounded-lg&quot;&gt;
								&lt;/a&gt;
							&lt;/div&gt;
							&lt;div&gt;
								&lt;a href=&quot;/images/small/img-4.jpg&quot; class=&quot;image-popup&quot;&gt;
									&lt;img src=&quot;/images/small/img-4.jpg&quot; alt=&quot;work-thumbnail&quot; class=&quot;rounded-lg&quot;&gt;
								&lt;/a&gt;
							&lt;/div&gt;
							&lt;div&gt;
								&lt;a href=&quot;/images/small/img-5.jpg&quot; class=&quot;image-popup&quot;&gt;
									&lt;img src=&quot;/images/small/img-5.jpg&quot; alt=&quot;work-thumbnail&quot; class=&quot;rounded-lg&quot;&gt;
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
				<h4 class="card-title">Images with Description</h4>
				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="ImageDescriptionLightbox">
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
			<div class="grid lg:grid-cols-3 gap-5">
				<div>
					<a href="/images/small/img-4.jpg" class="image-popup-desc" data-glightbox='title:Description Bottom; description: You can set the position of the description &lt;a href="http://google.com"&gt;with a link to Google&lt;/a&gt;'>
						<img src="/images/small/img-4.jpg" alt="work-thumbnail">
					</a>
				</div>

				<div>
					<a href="/images/small/img-5.jpg" class="image-popup-desc" data-glightbox="title: Description Right; description: .custom-desc1; descPosition: right;">
						<img src="/images/small/img-5.jpg" alt="work-thumbnail">
					</a>

					<div class="glightbox-desc custom-desc1">
						<p>
							You can set the position of the description in different ways for example
							<strong style="text-decoration: underline">top, bottom, left or right</strong>
						</p>
						<p>
							<a href="http://google.com" target="_blank" style="text-decoration: underline; font-weight: bold">Example Google link</a>
							ipsum vehicula eros ultrices lacinia Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Duis quis ipsum vehicula eros ultrices lacinia.
																									Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
						</p>
						<p>
							Primis pharetra facilisis lorem quis penatibus ad nulla inceptos, dui per tempor taciti aliquet consequat sodales, curae tristique gravida auctor interdum malesuada sagittis.
																									Felis pretium eros ligula natoque ad ante rutrum himenaeos, adipiscing urna mauris porta quam efficitur odio, sagittis morbi tellus nisi molestie mus faucibus.
						</p>
						<p>
							Primis pharetra facilisis lorem quis penatibus ad nulla inceptos, dui per tempor taciti aliquet consequat sodales, curae tristique gravida auctor interdum malesuada sagittis.
																									Felis pretium eros ligula natoque ad ante rutrum himenaeos, adipiscing urna mauris porta quam efficitur odio, sagittis morbi tellus nisi molestie mus faucibus.
						</p>
					</div>
				</div>

				<div>
					<a href="/images/small/img-1.jpg" class="image-popup-desc" data-glightbox="title: Description Left; description: .custom-desc2; descPosition: left;">
						<img src="/images/small/img-1.jpg" alt="work-thumbnail">
					</a>
					<div class="glightbox-desc custom-desc2">
						<p>You can set the position of the description in different ways for example top, bottom, left or right</p>
						<p>Duis quis ipsum vehicula eros ultrices lacinia. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae</p>
					</div>
				</div>
			</div>

			<div id="ImageDescriptionLightbox" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-56">
								<code>
									&lt;div class=&quot;grid lg:grid-cols-3 gap-5&quot;&gt;
										&lt;div&gt;
											&lt;a href=&quot;/images/small/img-4.jpg&quot; class=&quot;image-popup-desc&quot; data-glightbox='title:Description Bottom; description: You can set the position of the description &amp;lt;a href=&quot;http://google.com&quot;&amp;gt;with a link to Google&amp;lt;/a&amp;gt;'&gt;
												&lt;img src=&quot;/images/small/img-4.jpg&quot; alt=&quot;work-thumbnail&quot;&gt;
											&lt;/a&gt;
										&lt;/div&gt;
		
										&lt;div&gt;
											&lt;a href=&quot;/images/small/img-5.jpg&quot; class=&quot;image-popup-desc&quot; data-glightbox=&quot;title: Description Right; description: .custom-desc1; descPosition: right;&quot;&gt;
												&lt;img src=&quot;/images/small/img-5.jpg&quot; alt=&quot;work-thumbnail&quot;&gt;
											&lt;/a&gt;
		
											&lt;div class=&quot;glightbox-desc custom-desc1&quot;&gt;
												&lt;p&gt;
													You can set the position of the description in different ways for example
													&lt;strong style=&quot;text-decoration: underline&quot;&gt;top, bottom, left or right&lt;/strong&gt;
												&lt;/p&gt;
												&lt;p&gt;
													&lt;a href=&quot;http://google.com&quot; target=&quot;_blank&quot; style=&quot;text-decoration: underline; font-weight: bold&quot;&gt;Example Google link&lt;/a&gt;
													ipsum vehicula eros ultrices lacinia Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Duis quis ipsum vehicula eros ultrices lacinia.
													Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
												&lt;/p&gt;
												&lt;p&gt;
													Primis pharetra facilisis lorem quis penatibus ad nulla inceptos, dui per tempor taciti aliquet consequat sodales, curae tristique gravida auctor interdum malesuada sagittis.
													Felis pretium eros ligula natoque ad ante rutrum himenaeos, adipiscing urna mauris porta quam efficitur odio, sagittis morbi tellus nisi molestie mus faucibus.
												&lt;/p&gt;
												&lt;p&gt;
													Primis pharetra facilisis lorem quis penatibus ad nulla inceptos, dui per tempor taciti aliquet consequat sodales, curae tristique gravida auctor interdum malesuada sagittis.
													Felis pretium eros ligula natoque ad ante rutrum himenaeos, adipiscing urna mauris porta quam efficitur odio, sagittis morbi tellus nisi molestie mus faucibus.
												&lt;/p&gt;
											&lt;/div&gt;
										&lt;/div&gt;
		
										&lt;div&gt;
											&lt;a href=&quot;/images/small/img-1.jpg&quot; class=&quot;image-popup-desc&quot; data-glightbox=&quot;title: Description Left; description: .custom-desc2; descPosition: left;&quot;&gt;
												&lt;img src=&quot;/images/small/img-1.jpg&quot; alt=&quot;work-thumbnail&quot;&gt;
											&lt;/a&gt;
											&lt;div class=&quot;glightbox-desc custom-desc2&quot;&gt;
												&lt;p&gt;You can set the position of the description in different ways for example top, bottom, left or right&lt;/p&gt;
												&lt;p&gt;Duis quis ipsum vehicula eros ultrices lacinia. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae&lt;/p&gt;
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
				<h4 class="card-title">Popup with Video or Map</h4>
				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="VideoLightbox">
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
			<div
				class="flex flex-wrap gap-4">
				<!-- Youtube Video -->
				<a href="https://www.youtube.com/watch?v=0O2aH4XLbto" class="image-popup-video-button rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold leading-5 text-white hover:bg-indigo-500" data-title="YouTube Video" data-description="YouTube Video Popup">
					Open YouTube Video
				</a>

				<!-- Vimeo Video -->
				<a href="https://vimeo.com/45830194" class="image-popup-video-button rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold leading-5 text-white hover:bg-indigo-500" data-title="Vimeo Video" data-description="Vimeo Video Popup">
					Open Vimeo Video
				</a>
			</div>

			<div id="VideoLightbox" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-56">
								<code>
									&lt;div class=&quot;flex flex-wrap gap-4&quot;&gt;
										&lt;!-- Youtube Video --&gt;
										&lt;a href=&quot;https://www.youtube.com/watch?v=0O2aH4XLbto&quot; class=&quot;image-popup-video-button rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold leading-5 text-white hover:bg-indigo-500&quot; data-title=&quot;YouTube Video&quot; data-description=&quot;YouTube Video Popup&quot;&gt;
											Open YouTube Video
										&lt;/a&gt;

										&lt;!-- Vimeo Video --&gt;
										&lt;a href=&quot;https://vimeo.com/45830194&quot; class=&quot;image-popup-video-button rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold leading-5 text-white hover:bg-indigo-500&quot; data-title=&quot;Vimeo Video&quot; data-description=&quot;Vimeo Video Popup&quot;&gt;
											Open Vimeo Video
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
				<h4 class="card-title">Videos Gallery</h4>
				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="VideoGalleryLightbox">
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
				You can add videos with optional autoplay for
				<strong>Vimeo</strong>
				,
				<strong>Youtube</strong>
				and
				<strong>self hosted videos</strong>
				. You can specify a default width for the videos or set different widths to each video in your gallery. The videos are 100% responsive and will play correctly on mobile devices.
			</p>

			<div class="grid lg: grid-cols-3 gap-4">
				<div>
					<div>
						<a href="https://vimeo.com/115041822" class="image-popup-video">
							<img src="/images/small/img-1.jpg" alt="image">
						</a>
					</div>
				</div>
				<div>
					<div>
						<a href="https://www.youtube-nocookie.com/embed/Ga6RYejo6Hk" class="image-popup-video">
							<img src="/images/small/img-2.jpg" alt="image">
						</a>
					</div>
				</div>
				<div>
					<div>
						<a href="/images/lightbox-video.mp4" class="image-popup-video">
							<img src="/images/small/img-12.jpg" alt="image">
						</a>
					</div>
				</div>
			</div>

			<div id="VideoGalleryLightbox" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-56">
								<code>
									&lt;div class=&quot;grid lg: grid-cols-3 gap-4&quot;&gt;
										&lt;div&gt;
											&lt;div&gt;
												&lt;a href=&quot;https://vimeo.com/115041822&quot; class=&quot;image-popup-video&quot;&gt;
													&lt;img src=&quot;/images/small/img-1.jpg&quot; alt=&quot;image&quot; &gt;
												&lt;/a&gt;
											&lt;/div&gt;
										&lt;/div&gt;
										&lt;div&gt;
											&lt;div&gt;
												&lt;a href=&quot;https://www.youtube-nocookie.com/embed/Ga6RYejo6Hk&quot; class=&quot;image-popup-video&quot;&gt;
													&lt;img src=&quot;/images/small/img-2.jpg&quot; alt=&quot;image&quot; &gt;
												&lt;/a&gt;
											&lt;/div&gt;
										&lt;/div&gt;
										&lt;div&gt;
											&lt;div&gt;
												&lt;a href=&quot;/images/lightbox-video.mp4&quot; class=&quot;image-popup-video&quot;&gt;
													&lt;img src=&quot;/images/small/img-12.jpg&quot; alt=&quot;image&quot; &gt;
												&lt;/a&gt;
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
				<h4 class="card-title">Iframes and Inline Elements</h4>
				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="IframeLightbox">
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
			<p class="text-gray-400 mb-4">You can easily add iframes by simply entering the url, it could be a web page, a video, google maps, etc. also you can display any div of your page by entering the ID in the href attribute.</p>

			<div class="grid lg: grid-cols-3 gap-4">
				<div>
					<a href="https://tailwindcss.com/" class="image-iframe-elements">
						<img src="/images/small/img-5.jpg" alt="image">
					</a>
				</div>
				<div>
					<a class="image-iframe-elements" href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12085.977306439116!2d-73.96648875371474!3d40.77314541916876!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258bf08488f6b%3A0x618706a9142daa0d!2sUpper+East+Side%2C+Nueva+York%2C+EE.+UU.!5e0!3m2!1ses-419!2smx!4v1511830027642">
						<img src="/images/small/img-7.jpg" alt="image">
					</a>
				</div>
			</div>

			<div id="IframeLightbox" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-56">
								<code>
									&lt;div class=&quot;grid lg: grid-cols-3 gap-4&quot;&gt;
										&lt;div&gt;
											&lt;a href=&quot;https://tailwindcss.com/&quot; class=&quot;image-iframe-elements&quot;&gt;
												&lt;img src=&quot;/images/small/img-5.jpg&quot; alt=&quot;image&quot; &gt;
											&lt;/a&gt;
										&lt;/div&gt;
										&lt;div&gt;
											&lt;a class=&quot;image-iframe-elements&quot; href=&quot;https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12085.977306439116!2d-73.96648875371474!3d40.77314541916876!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258bf08488f6b%3A0x618706a9142daa0d!2sUpper+East+Side%2C+Nueva+York%2C+EE.+UU.!5e0!3m2!1ses-419!2smx!4v1511830027642&quot;&gt;
												&lt;img src=&quot;/images/small/img-7.jpg&quot; alt=&quot;image&quot; &gt;
											&lt;/a&gt;
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
@vite(['resources/js/pages/extended-lightbox.js'])
@vite(['resources/js/pages/highlight.js'])
@endsection