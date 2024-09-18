@extends('layouts.vertical', ['title' => 'Collapse', 'sub_title' => 'Component', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid 2xl:grid-cols-2 grid-cols-1 gap-6">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Collapse with Target</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="collapseWithTargetHTML">
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
                <button data-fc-type="collapse" data-fc-target="collapseWithTarget" type="button" class="btn bg-primary text-white">
                    Collapse <i class="mgc_down_line fc-collapse-open:rotate-180 ms-2 transition-all text-xl"></i>
                </button>

                <div id="collapseWithTarget" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <p class="pt-5 text-gray-800 dark:text-gray-200">
                        Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to
                        design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                    </p>
                </div>

                <div id="collapseWithTargetHTML" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;button data-fc-type=&quot;collapse&quot; data-fc-target=&quot;collapseWithTarget&quot; type=&quot;button&quot; class=&quot;btn bg-primary text-white&quot;&gt;
                            Collapse &lt;i class=&quot;mgc_down_line fc-collapse-open:rotate-180 ms-2 transition-all text-xl&quot;&gt;&lt;/i&gt;
                        &lt;/button&gt;

                        &lt;div id=&quot;collapseWithTarget&quot; class=&quot;hidden w-full overflow-hidden transition-[height] duration-300&quot;&gt;
                            &lt;p class=&quot;pt-5 text-gray-800 dark:text-gray-200&quot;&gt;
                                Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                            &lt;/p&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Auto Target Collapse</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="collapseAutoTargetHTML">
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
                <button data-fc-type="collapse" type="button" class="btn bg-primary text-white">
                    Collapse
                    <i class="mgc_down_line fc-collapse-open:rotate-180 ms-2 transition-all text-xl"></i>
                </button>

                <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <p class="pt-5 text-gray-800 dark:text-gray-200">
                        Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to
                        design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                    </p>
                </div>

                <div id="collapseAutoTargetHTML" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;button data-fc-type=&quot;collapse&quot; type=&quot;button&quot; class=&quot;btn bg-primary text-white&quot;&gt;
                            Collapse
                            &lt;i class=&quot;mgc_down_line fc-collapse-open:rotate-180 ms-2 transition-all text-xl&quot;&gt;&lt;/i&gt;
                        &lt;/button&gt;

                        &lt;div class=&quot;hidden w-full overflow-hidden transition-[height] duration-300&quot;&gt;
                            &lt;p class=&quot;pt-5 text-gray-800 dark:text-gray-200&quot;&gt;
                                Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                            &lt;/p&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center pe-[15px]">
                    <h4 class="card-title">Read More Collapse</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="collapseReadMoreHTML">
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
                <a href="#" data-fc-type="collapse" type="button" class="flex items-center text-primary">
                    Read&nbsp;
                    <span class="fc-collapse-open:hidden">more</span>
                    <span class="fc-collapse-open:block hidden">less</span>
                    <i class="mgc_down_line fc-collapse-open:rotate-180 ms-2 transition-all text-xl"></i>
                </a>

                <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <p class="pt-5 text-gray-800 dark:text-gray-200">
                        Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to
                        design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                    </p>
                </div>

                <div id="collapseReadMoreHTML" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;a href=&quot;#&quot; data-fc-type=&quot;collapse&quot; type=&quot;button&quot; class=&quot;flex items-center text-primary&quot;&gt;
                            Read&amp;nbsp;
                            &lt;span class=&quot;fc-collapse-open:hidden&quot;&gt;more&lt;/span&gt;
                            &lt;span class=&quot;fc-collapse-open:block hidden&quot;&gt;less&lt;/span&gt;
                            &lt;i class=&quot;mgc_down_line fc-collapse-open:rotate-180 ms-2 transition-all text-xl&quot;&gt;&lt;/i&gt;
                        &lt;/a&gt;

                        &lt;div class=&quot;hidden w-full overflow-hidden transition-[height] duration-300&quot;&gt;
                            &lt;p class=&quot;pt-5 text-gray-800 dark:text-gray-200&quot;&gt;
                                Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                            &lt;/p&gt;
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
