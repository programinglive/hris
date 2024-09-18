@extends('layouts.vertical', ['title' => 'Alerts', 'sub_title' => 'Component', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid 2xl:grid-cols-2 grid-cols-1 gap-6">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Basic Alert</h4>
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
                <div class="space-y-4">
                    <div class="bg-primary text-sm text-white rounded-md p-4" role="alert">
                        <span class="font-bold">Primary</span>
                        alert! You should check in on some of those
                        fields below.
                    </div>
                    <div class="bg-secondary text-sm text-white rounded-md p-4" role="alert">
                        <span class="font-bold">Secondary</span>
                        alert! You should check in on some of those
                        fields below.
                    </div>
                    <div class="bg-info text-sm text-white rounded-md p-4" role="alert">
                        <span class="font-bold">Info</span>
                        alert! You should check in on some of those
                        fields below.
                    </div>
                    <div class="bg-success text-sm text-white rounded-md p-4" role="alert">
                        <span class="font-bold">Success</span>
                        alert! You should check in on some of those
                        fields below.
                    </div>
                    <div class="bg-danger text-sm text-white rounded-md p-4" role="alert">
                        <span class="font-bold">Danger</span>
                        alert! You should check in on some of those
                        fields below.
                    </div>
                    <div class="bg-warning  text-sm text-white rounded-md p-4" role="alert">
                        <span class="font-bold">Warning</span>
                        alert! You should check in on some of those
                        fields below.
                    </div>
                    <div class="bg-dark text-sm text-white rounded-md p-4" role="alert">
                        <span class="font-bold">Dark</span>
                        alert! You should check in on some of those
                        fields below.
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
                    <h4 class="card-title">Soft color variants Alert</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="alertSoftHtml">
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
                    <div class="bg-primary/25 text-primary text-sm rounded-md p-4" role="alert">
                        <span class="font-bold">Primary</span>
                        alert! You should check in on some of those
                        fields below.
                    </div>
                    <div class="bg-secondary/25 text-secondary text-sm rounded-md p-4" role="alert">
                        <span class="font-bold">Secondary</span>
                        alert! You should check in on some of those
                        fields below.
                    </div>
                    <div class="bg-info/25 text-info text-sm rounded-md p-4" role="alert">
                        <span class="font-bold">Info</span>
                        alert! You should check in on some of those
                        fields below.
                    </div>
                    <div class="bg-success/25 text-success text-sm rounded-md p-4" role="alert">
                        <span class="font-bold">Success</span>
                        alert! You should check in on some of those
                        fields below.
                    </div>
                    <div class="bg-danger/25 text-danger text-sm rounded-md p-4" role="alert">
                        <span class="font-bold">Danger</span>
                        alert! You should check in on some of those
                        fields below.
                    </div>
                    <div class="bg-warning/25 text-warning  text-sm rounded-md p-4" role="alert">
                        <span class="font-bold">Warning</span>
                        alert! You should check in on some of those
                        fields below.
                    </div>
                    <div class="bg-dark/25 text-slate-900 dark:text-slate-200 text-sm rounded-md p-4" role="alert">
                        <span class="font-bold">Dark</span>
                        alert! You should check in on some of those
                        fields below.
                    </div>
                </div>
                <div id="alertSoftHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                                    <code>
                                        &lt;div class=&quot;bg-primary/25 text-primary text-sm rounded-md p-4&quot; role=&quot;alert&quot;&gt;
                                                &lt;span class=&quot;font-bold&quot;&gt;Primary&lt;/span&gt; alert! You should check in on some of those fields below.
                                            &lt;/div&gt;
                                            &lt;div class=&quot;bg-secondary/25 text-secondary text-sm rounded-md p-4&quot; role=&quot;alert&quot;&gt;
                                                &lt;span class=&quot;font-bold&quot;&gt;Secondary&lt;/span&gt; alert! You should check in on some of those fields below.
                                            &lt;/div&gt;
                                            &lt;div class=&quot;bg-info/25 text-info text-sm rounded-md p-4&quot; role=&quot;alert&quot;&gt;
                                                &lt;span class=&quot;font-bold&quot;&gt;Info&lt;/span&gt; alert! You should check in on some of those fields below.
                                            &lt;/div&gt;
                                            &lt;div class=&quot;bg-success/25 text-success text-sm rounded-md p-4&quot; role=&quot;alert&quot;&gt;
                                                &lt;span class=&quot;font-bold&quot;&gt;Success&lt;/span&gt; alert! You should check in on some of those fields below.
                                            &lt;/div&gt;
                                            &lt;div class=&quot;bg-danger/25 text-danger text-sm rounded-md p-4&quot; role=&quot;alert&quot;&gt;
                                                &lt;span class=&quot;font-bold&quot;&gt;Danger&lt;/span&gt; alert! You should check in on some of those fields below.
                                            &lt;/div&gt;
                                            &lt;div class=&quot;bg-warning/25 text-warning  text-sm rounded-md p-4&quot; role=&quot;alert&quot;&gt;
                                                &lt;span class=&quot;font-bold&quot;&gt;Warning&lt;/span&gt; alert! You should check in on some of those fields below.
                                            &lt;/div&gt;
                                            &lt;div class=&quot;bg-dark/25 text-slate-900 dark:text-slate-200 text-sm rounded-md p-4&quot; role=&quot;alert&quot;&gt;
                                                &lt;span class=&quot;font-bold&quot;&gt;Dark&lt;/span&gt; alert! You should check in on some of those fields below.
                                            &lt;/div&gt;
                                    </code>
                                </pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">With description Alert</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="alertDescriptionHtml">
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
                    <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4" role="alert">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="mgc_information_line text-xl"></i>
                            </div>
                            <div class="ms-4">
                                <h3 class="text-sm text-yellow-800 font-semibold">
                                    Cannot connect to the database
                                </h3>
                                <div class="mt-1 text-sm text-yellow-700">
                                    We are unable to save any progress at this time.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="alertDescriptionHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                                    <code>
                                        &lt;div class=&quot;bg-yellow-50 border border-yellow-200 rounded-md p-4&quot; role=&quot;alert&quot;&gt;
                                            &lt;div class=&quot;flex&quot;&gt;
                                                &lt;div class=&quot;flex-shrink-0&quot;&gt;
                                                    &lt;i class=&quot;mgc_information_line text-xl&quot;&gt;&lt;/i&gt;
                                                &lt;/div&gt;
                                                &lt;div class=&quot;ms-4&quot;&gt;
                                                    &lt;h3 class=&quot;text-sm text-yellow-800 font-semibold&quot;&gt;
                                                        Cannot connect to the database
                                                    &lt;/h3&gt;
                                                    &lt;div class=&quot;mt-1 text-sm text-yellow-700&quot;&gt;
                                                        We are unable to save any progress at this time.
                                                    &lt;/div&gt;
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
                    <h4 class="card-title">Actions</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="alertActionsHtml">
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
                <div class="bg-sky-50 border border-sky-200 rounded-md p-4" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="mgc_information_line text-xl"></i>
                        </div>
                        <div class="ms-4">
                            <h3 class="text-gray-800 font-semibold">
                                YouTube would like you to send notifications
                            </h3>
                            <div class="mt-2 text-sm text-gray-600">
                                Notifications may include alerts, sounds and icon badges. These can be
                                configured in Settings.
                            </div>
                            <div class="mt-4">
                                <div class="flex space-x-3">
                                    <button type="button" class="inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-medium text-primary hover:underline focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all text-sm">
                                        Don't allow
                                    </button>
                                    <button type="button" class="inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-medium text-primary hover:underline focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all text-sm">
                                        Allow
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="alertActionsHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div class=&quot;bg-sky-50 border border-sky-200 rounded-md p-4&quot; role=&quot;alert&quot;&gt;
                            &lt;div class=&quot;flex&quot;&gt;
                                &lt;div class=&quot;flex-shrink-0&quot;&gt;
                                    &lt;i class=&quot;mgc_information_line text-xl&quot;&gt;&lt;/i&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;ms-4&quot;&gt;
                                    &lt;h3 class=&quot;text-gray-800 font-semibold&quot;&gt;
                                        YouTube would like you to send notifications
                                    &lt;/h3&gt;
                                    &lt;div class=&quot;mt-2 text-sm text-gray-600&quot;&gt;
                                        Notifications may include alerts, sounds and icon badges. These can be configured in Settings.
                                    &lt;/div&gt;
                                    &lt;div class=&quot;mt-4&quot;&gt;
                                        &lt;div class=&quot;flex space-x-3&quot;&gt;
                                            &lt;button type=&quot;button&quot; class=&quot;inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-medium text-primary hover:underline focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all text-sm&quot;&gt;
                                                Don't allow
                                            &lt;/button&gt;
                                            &lt;button type=&quot;button&quot; class=&quot;inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-medium text-primary hover:underline focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all text-sm&quot;&gt;
                                                Allow
                                            &lt;/button&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;
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
                    <h4 class="card-title">Link on right</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="alertLinkHtml">
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
                <div class="bg-gray-50 border border-gray-200 rounded-md p-4" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="mgc_information_line text-xl"></i>
                        </div>
                        <div class="flex-1 md:flex md:justify-between ms-4">
                            <p class="text-sm text-gray-700">
                                A new software update is available. See what's new in version 3.0.7
                            </p>
                            <p class="text-sm mt-3 md:mt-0 md:ms-6">
                                <a class="text-gray-700 hover:text-gray-500 font-medium whitespace-nowrap" href="#">Details</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div id="alertLinkHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div class=&quot;flex&quot;&gt;
                            &lt;div class=&quot;flex-shrink-0&quot;&gt;
                                &lt;i class=&quot;mgc_information_line text-xl&quot;&gt;&lt;/i&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;flex-1 md:flex md:justify-between ms-4&quot;&gt;
                                &lt;p class=&quot;text-sm text-gray-700&quot;&gt;
                                    A new software update is available. See what's new in version 3.0.7
                                &lt;/p&gt;
                                &lt;p class=&quot;text-sm mt-3 md:mt-0 md:ms-6&quot;&gt;
                                    &lt;a class=&quot;text-gray-700 hover:text-gray-500 font-medium whitespace-nowrap&quot; href=&quot;#&quot;&gt;Details&lt;/a&gt;
                                &lt;/p&gt;
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
                    <h4 class="card-title">Dismiss button</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="alertDismissHtml">
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
                <div id="dismiss-alert" class="transition duration-300 bg-teal-50 border border-teal-200 rounded-md p-4" role="alert">
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0">
                            <i class="mgc_-badge-check text-xl"></i>
                        </div>
                        <div class="flex-grow">
                            <div class="text-sm text-teal-800 font-medium">
                                File has been successfully uploaded.
                            </div>
                        </div>
                        <button data-fc-dismiss="dismiss-alert" type="button" id="dismiss-test" class="ms-auto h-8 w-8 rounded-full bg-gray-200 flex justify-center items-center">
                            <i class="mgc_close_line text-xl"></i>
                        </button>
                    </div>
                </div>
                <div id="alertDismissHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div id=&quot;dismiss-alert&quot; class=&quot;transition duration-300 bg-teal-50 border border-teal-200 rounded-md p-4&quot; role=&quot;alert&quot;&gt;
                            &lt;div class=&quot;flex items-center gap-3&quot;&gt;
                                &lt;div class=&quot;flex-shrink-0&quot;&gt;
                                    &lt;i class=&quot;mgc_-badge-check text-xl&quot;&gt;&lt;/i&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;flex-grow&quot;&gt;
                                    &lt;div class=&quot;text-sm text-teal-800 font-medium&quot;&gt;
                                        File has been successfully uploaded.
                                    &lt;/div&gt;
                                &lt;/div&gt;
                                &lt;button data-fc-dismiss=&quot;dismiss-alert&quot; type=&quot;button&quot; id=&quot;dismiss-test&quot; class=&quot;ms-auto h-8 w-8 rounded-full bg-gray-200 flex justify-center items-center&quot;&gt;
                                    &lt;i class=&quot;mgc_close_line text-xl&quot;&gt;&lt;/i&gt;
                                &lt;/button&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

    </div>
    <!-- end grid--
    >
@endsection
@section('script')
    @vite(['resources/js/pages/highlight.js'])
@endsection
