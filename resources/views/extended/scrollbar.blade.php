@extends('layouts.vertical', ['title' => 'Scrollbar', 'sub_title' => 'Extended', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="flex flex-col gap-6">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Custom Scroll (CSS)</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="alertHeadingHtml">
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
                <div class="custom-scroll overflow-auto h-56">
                    <div class="max-w-full">
                        <p class="text-lg text-slate-700 dark:text-slate-400">Tailwind CSS works by scanning all of your
                            HTML files, JavaScript components, and any other templates for class names, generating the
                            corresponding styles and then writing them to a static CSS file.</p>
                        <p class="mt-4 text-lg text-slate-700 dark:text-slate-400">It's fast, flexible, and reliable — with
                            zero-runtime.</p>
                        <p class="mt-4 text-lg text-slate-700 dark:text-slate-400">Over 500+ professionally designed, fully
                            responsive, expertly crafted component examples you can drop into your Tailwind projects and
                            customize to your heart’s content.</p>
                        <p class="mt-4 text-lg text-slate-700 dark:text-slate-400">Tailwind CSS is incredibly performance
                            focused and aims to produce the smallest CSS file possible by only generating the CSS you are
                            actually using in your project.</p>
                        <p class="mt-4 text-lg text-slate-700 dark:text-slate-400">Combined with minification and network
                            compression, this usually leads to CSS files that are less than 10kB, even for large projects.
                            For example, Netflix uses Tailwind for
                            <a class="underline" target="_blank" href="https://top10.netflix.com/">Netflix Top 10</a>
                            and the entire website delivers only 6.5kB of CSS over the network.
                        </p>
                        <p class="mt-4 text-lg text-slate-700 dark:text-slate-400">With CSS files this small, you don’t have
                            to worry about complex solutions like code-splitting your CSS for each page, and can instead
                            just ship a single small CSS file that’s downloaded once and cached until you redeploy your
                            site.</p>
                    </div>
                </div>

                <div id="alertHeadingHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;div class=&quot;bg-gray-800 text-sm text-white rounded-md p-4 dark:bg-white dark:text-gray-800&quot; role=&quot;alert&quot;&gt;
										&lt;span class=&quot;font-bold&quot;&gt;Dark&lt;/span&gt; alert! You should check in on some of those fields below.
									&lt;/div&gt;
									&lt;div class=&quot;bg-gray-500 text-sm text-white rounded-md p-4&quot; role=&quot;alert&quot;&gt;
										&lt;span class=&quot;font-bold&quot;&gt;Secondary&lt;/span&gt; alert! You should check in on some of those fields below.
									&lt;/div&gt;
									&lt;div class=&quot;bg-primary text-sm text-white rounded-md p-4&quot; role=&quot;alert&quot;&gt;
										&lt;span class=&quot;font-bold&quot;&gt;Info&lt;/span&gt; alert! You should check in on some of those fields below.
									&lt;/div&gt;
									&lt;div class=&quot;bg-green-500 text-sm text-white rounded-md p-4&quot; role=&quot;alert&quot;&gt;
										&lt;span class=&quot;font-bold&quot;&gt;Success&lt;/span&gt; alert! You should check in on some of those fields below.
									&lt;/div&gt;
									&lt;div class=&quot;bg-red-500 text-sm text-white rounded-md p-4&quot; role=&quot;alert&quot;&gt;
										&lt;span class=&quot;font-bold&quot;&gt;Danger&lt;/span&gt; alert! You should check in on some of those fields below.
									&lt;/div&gt;
									&lt;div class=&quot;bg-primary  text-sm text-white rounded-md p-4&quot; role=&quot;alert&quot;&gt;
										&lt;span class=&quot;font-bold&quot;&gt;Warning&lt;/span&gt; alert! You should check in on some of those fields below.
									&lt;/div&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Simplebar Scroll</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="defaultButtonsHtml">
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
                <div class="h-56" data-simplebar>
                    <div class="prose max-w-full text-slate-700 dark:text-slate-400">
                        SimpleBar does only one thing: replace the browser's default scrollbar
                        with a custom CSS-styled one without losing performances.
                        Unlike some popular plugins, SimpleBar doesn't mimic scroll with
                        Javascript, causing janks and strange scrolling behaviours...
                        You keep the awesomeness of native scrolling...with a custom scrollbar!
                        <p>SimpleBar
                            <strong class="dark:text-white">does NOT implement a custom scroll
                                behaviour</strong>. It keeps the
                            <strong class="dark:text-white">native</strong>
                            <codeco>overflow: auto</code>
                                scroll and
                                <strong class="dark:text-white">only</strong>
                                replace
                                the scrollbar visual appearance.
                        </p>
                        <h5>Design it as you want</h5>
                        <p>SimpleBar uses pure CSS to style the scrollbar. You can easily
                            customize it as you want! Or even have multiple style on the same
                            page...or just keep the default style ("Mac OS" scrollbar style).
                        </p>
                        <h5>Lightweight and performant</h5>
                        <p>Only 6kb minified. SimpleBar doesn't use Javascript to handle
                            scrolling. You keep the performances/behaviours of the native
                            scroll.</p>
                        <h5>Supported everywhere</h5>
                        <p>SimpleBar has been tested on the following browsers: Chrome, Firefox,
                            Safari, Edge, IE11.</p>
                    </div>

                    <div id="alertHeadingHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <pre class="language-html h-56">
									<code>
										&lt;div class=&quot;bg-gray-800 text-sm text-white rounded-md p-4 dark:bg-white dark:text-gray-800&quot; role=&quot;alert&quot;&gt;
											&lt;span class=&quot;font-bold&quot;&gt;Dark&lt;/span&gt; alert! You should check in on some of those fields below.
										&lt;/div&gt;
										&lt;div class=&quot;bg-gray-500 text-sm text-white rounded-md p-4&quot; role=&quot;alert&quot;&gt;
											&lt;span class=&quot;font-bold&quot;&gt;Secondary&lt;/span&gt; alert! You should check in on some of those fields below.
										&lt;/div&gt;
										&lt;div class=&quot;bg-primary text-sm text-white rounded-md p-4&quot; role=&quot;alert&quot;&gt;
											&lt;span class=&quot;font-bold&quot;&gt;Info&lt;/span&gt; alert! You should check in on some of those fields below.
										&lt;/div&gt;
										&lt;div class=&quot;bg-green-500 text-sm text-white rounded-md p-4&quot; role=&quot;alert&quot;&gt;
											&lt;span class=&quot;font-bold&quot;&gt;Success&lt;/span&gt; alert! You should check in on some of those fields below.
										&lt;/div&gt;
										&lt;div class=&quot;bg-red-500 text-sm text-white rounded-md p-4&quot; role=&quot;alert&quot;&gt;
											&lt;span class=&quot;font-bold&quot;&gt;Danger&lt;/span&gt; alert! You should check in on some of those fields below.
										&lt;/div&gt;
										&lt;div class=&quot;bg-primary  text-sm text-white rounded-md p-4&quot; role=&quot;alert&quot;&gt;
											&lt;span class=&quot;font-bold&quot;&gt;Warning&lt;/span&gt; alert! You should check in on some of those fields below.
										&lt;/div&gt;
									</code>
								</pre>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">RTL Position</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="defaultButtonsHtml">
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
                <p class="text-sm mb-4 text-slate-700 dark:text-slate-400">Just use data attribute
                    <code>data-simplebar data-simplebar-direction='rtl'</code>
                    and add
                    <code>max-height: **px</code>
                    oh fix height
                </p>

                <div class="h-56" data-simplebar data-simplebar-direction='rtl'>
                    <div class="prose max-w-full text-slate-700 dark:text-slate-400">
                        SimpleBar does only one thing: replace the browser's default scrollbar
                        with a custom CSS-styled one without losing performances.
                        Unlike some popular plugins, SimpleBar doesn't mimic scroll with
                        Javascript, causing janks and strange scrolling behaviours...
                        You keep the awesomeness of native scrolling...with a custom scrollbar!
                        <p>SimpleBar
                            <strong class="dark:text-white">does NOT implement a custom scroll
                                behaviour</strong>. It keeps the
                            <strong class="dark:text-white">native</strong>
                            <code>overflow: auto</code>
                            scroll and
                            <strong class="dark:text-white">only</strong>
                            replace
                            the scrollbar visual appearance.
                        </p>
                        <h5>Design it as you want</h5>
                        <p>SimpleBar uses pure CSS to style the scrollbar. You can easily
                            customize it as you want! Or even have multiple style on the same
                            page...or just keep the default style ("Mac OS" scrollbar style).
                        </p>
                        <h5>Lightweight and performant</h5>
                        <p>Only 6kb minified. SimpleBar doesn't use Javascript to handle
                            scrolling. You keep the performances/behaviours of the native
                            scroll.</p>
                        <h5>Supported everywhere</h5>
                        <p>SimpleBar has been tested on the following browsers: Chrome, Firefox,
                            Safari, Edge, IE11.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Scroll Size</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="defaultButtonsHtml">
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
                <p class="text-sm mb-4 text-slate-700 dark:text-slate-400">Just use data attribute
                    <code>data-simplebar</code>
                    and add
                    <code>max-height: **px</code>
                    oh fix height
                </p>

                <div class="h-56" data-simplebar data-simplebar-lg>
                    <div class="prose-lg max-w-full text-slate-700 dark:text-slate-400">
                        SimpleBar does only one thing: replace the browser's default scrollbar
                        with a custom CSS-styled one without losing performances.
                        Unlike some popular plugins, SimpleBar doesn't mimic scroll with
                        Javascript, causing janks and strange scrolling behaviours...
                        You keep the awesomeness of native scrolling...with a custom scrollbar!
                        <p>SimpleBar
                            <strong class="dark:text-white">does NOT implement a custom scroll
                                behaviour</strong>. It keeps the
                            <strong class="dark:text-white">native</strong>
                            <code>overflow: auto</code>
                            scroll and
                            <strong class="dark:text-white">only</strong>
                            replace
                            the scrollbar visual appearance.
                        </p>
                        <h5>Design it as you want</h5>
                        <p>SimpleBar uses pure CSS to style the scrollbar. You can easily
                            customize it as you want! Or even have multiple style on the same
                            page...or just keep the default style ("Mac OS" scrollbar style).
                        </p>
                        <h5>Lightweight and performant</h5>
                        <p>Only 6kb minified. SimpleBar doesn't use Javascript to handle
                            scrolling. You keep the performances/behaviours of the native
                            scroll.</p>
                        <h5>Supported everywhere</h5>
                        <p>SimpleBar has been tested on the following browsers: Chrome, Firefox,
                            Safari, Edge, IE11.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Scroll Color</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse"
                            data-fc-target="defaultButtonsHtml">
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
                <p class="text-sm mb-4 text-slate-700 dark:text-slate-400">Just use data attribute
                    <code>data-simplebar data-simplebar-primary</code>
                    and add
                    <code>max-height: **px</code>
                    oh fix height
                </p>

                <div class="h-56" data-simplebar data-simplebar-primary>
                    <div class="prose max-w-full text-slate-700 dark:text-slate-400">
                        SimpleBar does only one thing: replace the browser's default scrollbar
                        with a custom CSS-styled one without losing performances.
                        Unlike some popular plugins, SimpleBar doesn't mimic scroll with
                        Javascript, causing janks and strange scrolling behaviours...
                        You keep the awesomeness of native scrolling...with a custom scrollbar!
                        <p>SimpleBar
                            <strong class="dark:text-white">does NOT implement a custom scroll
                                behaviour</strong>. It keeps the
                            <strong class="dark:text-white">native</strong>
                            <code>overflow: auto</code>
                            scroll and
                            <strong class="dark:text-white">only</strong>
                            replace
                            the scrollbar visual appearance.
                        </p>
                        <h5>Design it as you want</h5>
                        <p>SimpleBar uses pure CSS to style the scrollbar. You can easily
                            customize it as you want! Or even have multiple style on the same
                            page...or just keep the default style ("Mac OS" scrollbar style).
                        </p>
                        <h5>Lightweight and performant</h5>
                        <p>Only 6kb minified. SimpleBar doesn't use Javascript to handle
                            scrolling. You keep the performances/behaviours of the native
                            scroll.</p>
                        <h5>Supported everywhere</h5>
                        <p>SimpleBar has been tested on the following browsers: Chrome, Firefox,
                            Safari, Edge, IE11.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite(['resources/js/pages/highlight.js'])
@endsection
