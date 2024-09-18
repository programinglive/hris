@extends('layouts.vertical', ['title' => 'Dismissible', 'sub_title' => 'Component', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
        <div class="space-y-6">
            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h4 class="card-title">Dismissible</h4>

                        <div class="flex items-center gap-2">
                            <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="DismissableHtml">
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
                    <div id="dismiss-example" class="border bg-info/10 text-info border-info/20 rounded px-4 py-3 flex justify-between items-center">
                        <p>
                            <span class="font-medium">Alert:</span>
                            You can dismiss this alert by, simply click on close button
                        </p>
                        <button class="flex-shrink-0" data-fc-dismiss="dismiss-example" type="button">
                            <i class="mgc_close_line text-xl"></i>
                        </button>
                    </div>
                    <div id="DismissableHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <pre class="language-html h-56">
                        <code>
                            &lt;div id=&quot;dismiss-example&quot; class=&quot;border bg-info/10 text-info border-info/20 rounded px-4 py-3 flex justify-between items-center&quot;&gt;
                                &lt;p&gt;
                                    &lt;span class=&quot;font-medium&quot;&gt;Alert:&lt;/span&gt;
                                    You can dismiss this alert by, simply click on close button
                                &lt;/p&gt;
                                &lt;button class=&quot;flex-shrink-0&quot; data-fc-dismiss=&quot;dismiss-example&quot;
                                    type=&quot;button&quot;&gt;
                                    &lt;i class=&quot;mgc_close_line text-xl&quot;&gt;&lt;/i&gt;
                                &lt;/button&gt;
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
                    <h4 class="card-title">Card Dismissible</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="CardDismissibleHtml">
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
                <div class="card shadow-md max-w-xs relative transition-all duration-300" id="dismiss-card">
                    <div class="absolute end-2 top-2">
                        <button data-fc-dismiss="dismiss-card" type="button" id="dismiss-test" class="ms-auto h-8 w-8 rounded-full bg-gray-500/20 flex justify-center items-center ">
                            <i class="mgc_close_line text-xl"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                            Card title
                        </h3>
                        <p class="mt-1 text-xs font-medium uppercase text-gray-500 dark:text-gray-500">
                            Card subtitle
                        </p>
                        <p class="mt-2 text-gray-800 dark:text-gray-400">
                            Some quick example text to build on the card title and make up the bulk of the
                            card's content.
                        </p>
                        <a class="inline-flex items-center gap-2 mt-5 text-sm font-medium text-primary hover:text-sky-700" href="#">
                            Card link
                            <i class="msr text-xl">chevron_right</i>
                        </a>
                    </div>
                </div>

                <div id="CardDismissibleHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div class=&quot;card shadow-md max-w-xs relative transition-all duration-300&quot; id=&quot;dismiss-card&quot;&gt;
                            &lt;div class=&quot;absolute end-2 top-2&quot;&gt;
                                &lt;button data-fc-dismiss=&quot;dismiss-card&quot; type=&quot;button&quot; id=&quot;dismiss-test&quot;
                                    class=&quot;ms-auto h-8 w-8 rounded-full bg-gray-200 flex justify-center items-center&quot;&gt;
                                    &lt;i class=&quot;mgc_close_line text-xl&quot;&gt;&lt;/i&gt;
                                &lt;/button&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;p-4&quot;&gt;
                                &lt;h3 class=&quot;text-lg font-bold text-gray-800 dark:text-white&quot;&gt;
                                    Card title
                                &lt;/h3&gt;
                                &lt;p class=&quot;mt-1 text-xs font-medium uppercase text-gray-500 dark:text-gray-500&quot;&gt;
                                    Card subtitle
                                &lt;/p&gt;
                                &lt;p class=&quot;mt-2 text-gray-800 dark:text-gray-400&quot;&gt;
                                    Some quick example text to build on the card title and make up the bulk of the
                                    card's content.
                                &lt;/p&gt;
                                &lt;a class=&quot;inline-flex items-center gap-2 mt-5 text-sm font-medium text-primary hover:text-sky-700&quot;
                                    href=&quot;#&quot;&gt;
                                    Card link
                                    &lt;i class=&quot;msr text-xl&quot;&gt;chevron_right&lt;/i&gt;
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
    @vite(['resources/js/pages/highlight.js'])
@endsection
