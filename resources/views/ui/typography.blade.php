@extends('layouts.vertical', ['title' => 'Typography', 'sub_title' => 'Component', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
        <div class="col-span-2">
            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h4 class="card-title">Heading Examples</h4>
                        <div class="flex items-center gap-2">
                            <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="HeadingHtml">
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
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
                        <div class="space-y-4">
                            <h1 class="text-xs">text-xs <span class="text-base">(12px)</span></h1>
                            <h1 class="text-sm">text-sm <span class="text-base">(14px)</span></h1>
                            <h1 class="text-base">text-base (16px)</h1>
                            <h1 class="text-lg">text-lg <span class="text-base">(18px)</span></h1>
                            <h1 class="text-xl">text-xl <span class="text-base">(20px)</span></h1>
                            <h1 class="text-2xl">text-2xl <span class="text-base">(24px)</span></h1>
                            <h1 class="text-3xl">text-3xl <span class="text-base">(30px)</span></h1>
                            <h1 class="text-4xl">text-4xl <span class="text-base">(36px)</span></h1>
                            <h1 class="text-5xl">text-5xl <span class="text-base">(48px)</span></h1>
                        </div>
                        <div class="space-y-4">
                            <h1 class="text-6xl">text-6xl <span class="text-base">(60px)</span></h1>
                            <h1 class="text-7xl">text-7xl <span class="text-base"> (72px)</span></h1>
                            <h1 class="text-8xl">text-8xl <span class="text-base">(96px)</span></h1>
                            <h1 class="text-9xl">text-9xl<span class="text-base">(128px)</span></h1>
                        </div>
                    </div>

                    <div id="HeadingHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <pre class="language-html h-56">
                        <code>
                            &lt;div class=&quot;space-y-4&quot;&gt;
                                &lt;h1 class=&quot;text-xs&quot;&gt;text-xs &lt;span class=&quot;text-base&quot;&gt;(12px)&lt;/span&gt;&lt;/h1&gt;
                                &lt;h1 class=&quot;text-sm&quot;&gt;text-sm &lt;span class=&quot;text-base&quot;&gt;(14px)&lt;/span&gt;&lt;/h1&gt;
                                &lt;h1 class=&quot;text-base&quot;&gt;text-base (16px)&lt;/h1&gt;
                                &lt;h1 class=&quot;text-lg&quot;&gt;text-lg &lt;span class=&quot;text-base&quot;&gt;(18px)&lt;/span&gt;&lt;/h1&gt;
                                &lt;h1 class=&quot;text-xl&quot;&gt;text-xl &lt;span class=&quot;text-base&quot;&gt;(20px)&lt;/span&gt;&lt;/h1&gt;
                                &lt;h1 class=&quot;text-2xl&quot;&gt;text-2xl &lt;span class=&quot;text-base&quot;&gt;(24px)&lt;/span&gt;&lt;/h1&gt;
                                &lt;h1 class=&quot;text-3xl&quot;&gt;text-3xl &lt;span class=&quot;text-base&quot;&gt;(30px)&lt;/span&gt;&lt;/h1&gt;
                                &lt;h1 class=&quot;text-4xl&quot;&gt;text-4xl &lt;span class=&quot;text-base&quot;&gt;(36px)&lt;/span&gt;&lt;/h1&gt;
                                &lt;h1 class=&quot;text-5xl&quot;&gt;text-5xl &lt;span class=&quot;text-base&quot;&gt;(48px)&lt;/span&gt;&lt;/h1&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;space-y-4&quot;&gt;
                                &lt;h1 class=&quot;text-6xl&quot;&gt;text-6xl &lt;span class=&quot;text-base&quot;&gt;(60px)&lt;/span&gt;&lt;/h1&gt;
                                &lt;h1 class=&quot;text-7xl&quot;&gt;text-7xl &lt;span class=&quot;text-base&quot;&gt; (72px)&lt;/span&gt;&lt;/h1&gt;
                                &lt;h1 class=&quot;text-8xl&quot;&gt;text-8xl &lt;span class=&quot;text-base&quot;&gt;(96px)&lt;/span&gt;&lt;/h1&gt;
                                &lt;h1 class=&quot;text-9xl&quot;&gt;text-9xl&lt;span class=&quot;text-base&quot;&gt;(128px)&lt;/span&gt;&lt;/h1&gt;
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
                    <h4 class="card-title">Text Colored Examples</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="TextColorHtml">
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
                <div class="space-y-4">
                    <h1 class="text-primary text-lg">The quick brown fox jumps over the lazy dog.</h1>
                    <h1 class="text-secondary text-lg">The quick brown fox jumps over the lazy dog.</h1>
                    <h1 class="text-success text-lg">The quick brown fox jumps over the lazy dog.</h1>
                    <h1 class="text-info text-lg">The quick brown fox jumps over the lazy dog.</h1>
                    <h1 class="text-danger text-lg">The quick brown fox jumps over the lazy dog.</h1>
                </div>
                <div id="TextColorHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;h1 class=&quot;text-primary text-lg&quot;&gt;The quick brown fox jumps over the lazy dog.&lt;/h1&gt;
                        &lt;h1 class=&quot;text-secondary text-lg&quot;&gt;The quick brown fox jumps over the lazy dog.&lt;/h1&gt;
                        &lt;h1 class=&quot;text-success text-lg&quot;&gt;The quick brown fox jumps over the lazy dog.&lt;/h1&gt;
                        &lt;h1 class=&quot;text-info text-lg&quot;&gt;The quick brown fox jumps over the lazy dog.&lt;/h1&gt;
                        &lt;h1 class=&quot;text-danger text-lg&quot;&gt;The quick brown fox jumps over the lazy dog.&lt;/h1&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Text gradient Examples</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="TextgradientHtml">
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
                <div class="space-y-4">
                    <p class="text-3xl bg-gradient-to-r from-cyan-500 to-blue-500 bg-clip-text text-transparent">The quick brown fox jumps over the lazy dog.</p>
                    <p class="text-3xl bg-gradient-to-l from-primary to-info bg-clip-text font-semibold text-transparent">The quick brown fox jumps over the lazy dog.</p>
                    <p class="text-3xl bg-gradient-to-r from-danger to-success bg-clip-text font-semibold text-transparent">The quick brown fox jumps over the lazy dog.</p>
                    <p class="text-3xl bg-gradient-to-r from-fuchsia-500 to-pink-500 bg-clip-text font-semibold text-transparent">The quick brown fox jumps over the lazy dog.</p>
                </div>

                <div id="TextgradientHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;p class=&quot;text-3xl bg-gradient-to-r from-cyan-500 to-blue-500 bg-clip-text text-transparent&quot;&gt;The quick brown fox jumps over the lazy dog.&lt;/p&gt;
                        &lt;p class=&quot;text-3xl bg-gradient-to-l from-primary to-info bg-clip-text font-semibold text-transparent&quot;&gt;The quick brown fox jumps over the lazy dog.&lt;/p&gt;
                        &lt;p class=&quot;text-3xl bg-gradient-to-r from-danger to-success bg-clip-text font-semibold text-transparent&quot;&gt;The quick brown fox jumps over the lazy dog.&lt;/p&gt;
                        &lt;p class=&quot;text-3xl bg-gradient-to-r from-fuchsia-500 to-pink-500 bg-clip-text font-semibold text-transparent&quot;&gt;The quick brown fox jumps over the lazy dog.&lt;/p&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Text Colored Opacity Examples</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="TextColorOpacityHtml">
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
                <div class="space-y-4">
                    <h1 class="text-primary/90 text-lg">The quick brown fox jumps over the lazy dog.</h1>
                    <h1 class="text-primary/75 text-lg">The quick brown fox jumps over the lazy dog.</h1>
                    <h1 class="text-primary/50 text-lg">The quick brown fox jumps over the lazy dog.</h1>
                    <h1 class="text-primary/25 text-lg">The quick brown fox jumps over the lazy dog.</h1>
                    <h1 class="text-primary/10 text-lg">The quick brown fox jumps over the lazy dog.</h1>
                </div>

                <div id="TextColorOpacityHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;p class=&quot;text-3xl bg-gradient-to-r from-cyan-500 to-blue-500 bg-clip-text text-transparent&quot;&gt;The quick brown fox jumps over the lazy dog.&lt;/p&gt;
                        &lt;p class=&quot;text-3xl bg-gradient-to-l from-primary to-info bg-clip-text font-semibold text-transparent&quot;&gt;The quick brown fox jumps over the lazy dog.&lt;/p&gt;
                        &lt;p class=&quot;text-3xl bg-gradient-to-r from-danger to-success bg-clip-text font-semibold text-transparent&quot;&gt;The quick brown fox jumps over the lazy dog.&lt;/p&gt;
                        &lt;p class=&quot;text-3xl bg-gradient-to-r from-fuchsia-500 to-pink-500 bg-clip-text font-semibold text-transparent&quot;&gt;The quick brown fox jumps over the lazy dog.&lt;/p&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Text Decoration Examples</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="TextDecorationHtml">
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
                <div class="space-y-4">
                    <p class="text-lg underline">The quick brown fox jumps over the lazy dog.</p>
                    <p class="text-lg overline">The quick brown fox jumps over the lazy dog.</p>
                    <p class="text-lg line-through">
                        The quick brown fox jumps over the lazy dog.
                    </p>
                    <p class="text-lg no-underline">
                        The quick brown fox jumps over the lazy dog.
                    </p>
                </div>

                <div id="TextDecorationHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;p class=&quot;text-lg underline&quot;&gt;The quick brown fox jumps over the lazy dog.&lt;/p&gt;
                        &lt;p class=&quot;text-lg overline&quot;&gt;The quick brown fox jumps over the lazy dog.&lt;/p&gt;
                        &lt;p class=&quot;text-lg line-through&quot;&gt;
                            The quick brown fox jumps over the lazy dog.
                        &lt;/p&gt;
                        &lt;p class=&quot;text-lg no-underline&quot;&gt;
                            The quick brown fox jumps over the lazy dog.
                        &lt;/p&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Text Colored Decoration</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="TextDecorationColoredHtml">
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
                <div class="space-y-4">
                    <p class="text-lg underline decoration-primary">The quick brown fox jumps over the lazy dog.</p>
                    <p class="text-lg overline decoration-success decoration-2">The quick brown fox jumps over the lazy dog.</p>
                    <p class="text-lg line-through decoration-danger decoration-2">
                        The quick brown fox jumps over the lazy dog.
                    </p>
                    <p class="text-lg no-underline">
                        The quick brown fox jumps over the lazy dog.
                    </p>
                </div>

                <div id="TextDecorationColoredHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;p class=&quot;text-lg underline decoration-primary&quot;&gt;The quick brown fox jumps over the lazy dog.&lt;/p&gt;
                        &lt;p class=&quot;text-lg overline decoration-success decoration-2&quot;&gt;The quick brown fox jumps over the lazy dog.&lt;/p&gt;
                        &lt;p class=&quot;text-lg line-through decoration-danger decoration-2&quot;&gt;
                            The quick brown fox jumps over the lazy dog.
                        &lt;/p&gt;
                        &lt;p class=&quot;text-lg no-underline&quot;&gt;
                            The quick brown fox jumps over the lazy dog.
                        &lt;/p&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Text Decoration Style</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="TextDecorationStyleHtml">
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
                <div class="space-y-4">
                    <p class="text-lg underline decoration-solid">The quick brown fox jumps over the lazy dog.</p>
                    <p class="text-lg underline decoration-double">The quick brown fox jumps over the lazy dog.</p>
                    <p class="text-lg underline decoration-dotted">
                        The quick brown fox jumps over the lazy dog.
                    </p>
                    <p class="text-lg underline decoration-wavy">
                        The quick brown fox jumps over the lazy dog.
                    </p>
                </div>

                <div id="TextDecorationStyleHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;p class=&quot;text-lg underline decoration-solid&quot;&gt;The quick brown fox jumps over the lazy dog.&lt;/p&gt;
                        &lt;p class=&quot;text-lg underline decoration-double&quot;&gt;The quick brown fox jumps over the lazy dog.&lt;/p&gt;
                        &lt;p class=&quot;text-lg underline decoration-dotted&quot;&gt;
                            The quick brown fox jumps over the lazy dog.
                        &lt;/p&gt;
                        &lt;p class=&quot;text-lg underline decoration-wavy&quot;&gt;
                            The quick brown fox jumps over the lazy dog.
                        &lt;/p&gt;
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
