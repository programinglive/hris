@extends('layouts.vertical', ['title' => 'Tour', 'sub_title' => 'Extended', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
    <!--Swiper slider css-->
    @vite(['node_modules/shepherd.js/dist/css/shepherd.css'])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="flex justify-between items-center">
                <h4 class="card-title">Page Tour (Shepherdjs)</h4>

                <div class="flex items-center gap-2">
                    <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="pageTour">
                        <i class="mgc_eye_line text-lg"></i>
                        <span class="ms-2">Code</span>
                    </button>

                    <a href="https://shepherdjs.dev/" target="_blank" role="button" class="btn-code">
                        <i class="mgc_link_2_line text-base"></i>
                        <span class="ms-2">Link</span>
                    </a>

                    <button class="btn-code" data-clipboard-action="copy">
                        <i class="mgc_copy_line text-lg"></i>
                        <span class="ms-2">Copy</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- end card header -->

        <div class="p-6">

            <div class="">
                <div class="text-center mb-6">
                    <div class="inline-flex justify-center py-3 px-2" id="logo-tour">
                        <img src="/images/logo-dark.png" class="h-5 block dark:hidden" alt="logo">
                        <img src="/images/logo-light.png" class="h-5 hidden dark:block" alt="logo">
                    </div>
                    <h5 class="text-base">Responsive Admin Dashboard Template</h5>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 items-center gap-6">
                    <div class="p-6" id="tour-card-one">
                        <i class="mgc_cellphone_line text-4xl text-gray-800 dark:text-white"></i>
                        <div
                            class="bg-gradient-to-r from-gray-200 to-white/0 h-0.5 mt-6 dark:from-gray-700 dark:to-slate-900/0">
                            <div class="bg-gray-400 w-9 h-0.5"></div>
                        </div>
                        <div class="mt-5">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Responsive</h3>
                            <p class="mt-1 text-gray-600 dark:text-gray-400">Responsive, and mobile-first project on the web
                            </p>
                        </div>
                    </div>

                    <div class="p-6" id="tour-card-two">
                        <i class="mgc_settings_2_line text-4xl text-gray-800 dark:text-white"></i>
                        <div
                            class="bg-gradient-to-r from-gray-200 to-white/0 h-0.5 mt-6 dark:from-gray-700 dark:to-slate-900/0">
                            <div class="bg-gray-400 w-9 h-0.5"></div>
                        </div>
                        <div class="mt-5">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Customizable</h3>
                            <p class="mt-1 text-gray-600 dark:text-gray-400">Components are easily customized and extendable
                            </p>
                        </div>
                    </div>

                    <div class="p-6" id="tour-card-three">
                        <i class="mgc_document_2_line text-4xl text-gray-800 dark:text-white"></i>
                        <div
                            class="bg-gradient-to-r from-gray-200 to-white/0 h-0.5 mt-6 dark:from-gray-700 dark:to-slate-900/0">
                            <div class="bg-gray-400 w-9 h-0.5"></div>
                        </div>
                        <div class="mt-5">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Documentation</h3>
                            <p class="mt-1 text-gray-600 dark:text-gray-400">Every component and plugin is well documented
                            </p>
                        </div>
                    </div>

                    <div class="p-6" id="tour-card-four">
                        <div class="mgc_message_2_line text-4xl text-gray-800 dark:text-white"></div>
                        <div
                            class="bg-gradient-to-r from-gray-200 to-white/0 h-0.5 mt-6 dark:from-gray-700 dark:to-slate-900/0">
                            <div class="bg-gray-400 w-9 h-0.5"></div>
                        </div>
                        <div class="mt-5">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">24/7 Support</h3>
                            <p class="mt-1 text-gray-600 dark:text-gray-400">Contact us 24 hours a day, 7 days a week</p>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-8">
                    <button class="btn bg-success text-white" id="thankyou-tour">Thank you !</button>
                </div>
            </div>

            <div id="pageTour" class="hidden w-full overflow-hidden transition-[height] duration-300">
                <pre class="language-html">
                                <code>
                                    &lt;!-- Shepherd (Tour) css --&gt;
                                    &lt;link rel=&quot;stylesheet&quot; href=&quot;/libs/shepherd.js/css/shepherd.css&quot;&gt;
                                </code>
                            </pre>

                <pre class="language-html">
                                <code>
                                    &lt;!-- Tour js --&gt;
                                    &lt;script src=&quot;/libs/shepherd.js/js/shepherd.min.js&quot;&gt;&lt;/script&gt;
                                </code>
                            </pre>

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

                <pre class="language-javascript h-56">
                                <code>
                                        
var tour = new Shepherd.Tour({
    defaultStepOptions: {
        cancelIcon: {
            enabled: true
        },

        classes: 'card',
        scrollTo: {
            behavior: 'smooth',
            block: 'center'
        }
    },
    useModalOverlay: {
        enabled: true
    },
});

if (document.querySelector('#logo-tour'))
    tour.addStep({
        title: 'Logo Here',
        text: `You can find here status of user who's currently online.`,
        attachTo: {
            element: '#logo-tour',
            on: 'bottom'
        },
        buttons: [{
            text: 'Next',
            classes: 'btn btn-success',
            action: tour.next
        }]
    });

if (document.querySelector('#tour-card-one'))
    tour.addStep({
        title: 'Card One',
        text: `You can find here status of user who's currently online`,
        attachTo: {
            element: '#tour-card-one',
            on: 'bottom'
        },
        buttons: [{
            text: 'Back',
            classes: 'btn btn-light',
            action: tour.back
        },
        {
            text: 'Next',
            classes: 'btn btn-success',
            action: tour.next
        }
        ]
    });

if (document.querySelector('#tour-card-two'))
    tour.addStep({
        title: 'Card Two',
        text: `You can find here status of user who's currently online`,
        attachTo: {
            element: '#tour-card-two',
            on: 'bottom'
        },
        buttons: [{
            text: 'Back',
            classes: 'btn btn-light',
            action: tour.back
        },
        {
            text: 'Next',
            classes: 'btn btn-success',
            action: tour.next
        }
        ]
    });


if (document.querySelector('#tour-card-three'))
    tour.addStep({
        title: 'Card Three',
        text: `You can find here status of user who's currently online`,
        attachTo: {
            element: '#tour-card-three',
            on: 'bottom'
        },
        buttons: [{
            text: 'Back',
            classes: 'btn btn-light',
            action: tour.back
        },
        {
            text: 'Next',
            classes: 'btn btn-success',
            action: tour.next
        }
        ]
    });

if (document.querySelector('#tour-card-four'))
    tour.addStep({
        title: 'Card Four',
        text: `You can find here status of user who's currently online`,
        attachTo: {
            element: '#tour-card-four',
            on: 'bottom'
        },
        buttons: [{
            text: 'Back',
            classes: 'btn btn-light',
            action: tour.back
        },
        {
            text: 'Next',
            classes: 'btn btn-success',
            action: tour.next
        }
        ]
    });




if (document.querySelector('#thankyou-tour'))
    tour.addStep({
        title: 'Thank you !',
        text: 'Here you can change theme skins and other features.',
        attachTo: {
            element: '#thankyou-tour',
            on: 'bottom'
        },
        buttons: [{
            text: 'Back',
            classes: 'btn btn-light',
            action: tour.back
        },
        {
            text: 'Thank you !',
            classes: 'btn btn-primary',
            action: tour.complete
        }
        ]
    });

tour.start();
                                </code>
                            </pre>
            </div>
        </div>
    </div><!-- end card -->
@endsection

@section('script')
    <!-- Tour init js-->
    @vite(['resources/js/pages/extended-tour.js'])

    @vite(['resources/js/pages/highlight.js'])
@endsection
