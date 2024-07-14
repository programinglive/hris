@extends('layouts.vertical', ['title' => 'Accordion', 'sub_title' => 'Component', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid 2xl:grid-cols-2 grid-cols-1 gap-6">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Default Accordion</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="defaultAccordionHTML">
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
                <div data-fc-type="accordion">
                    <!-- Accordion item one -->
                    <button data-fc-type="collapse" class="fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                        Accordion #1
                        <i class="mgc_add_line block fc-collapse-open:hidden"></i>
                        <i class="mgc_minimize_line hidden fc-collapse-open:block"></i>
                    </button>
                    <div class="w-full overflow-hidden transition-[height] duration-300">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary
                            to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                        </p>
                    </div>

                    <!-- Accordion item two -->
                    <button data-fc-type="collapse" class="fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                        Accordion #2
                        <i class="mgc_add_line block fc-collapse-open:hidden"></i>
                        <i class="mgc_minimize_line hidden fc-collapse-open:block"></i>
                    </button>
                    <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary
                            to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                        </p>
                    </div>

                    <!-- Accordion item three -->
                    <button data-fc-type="collapse" class="fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                        Accordion #3
                        <i class="mgc_add_line block fc-collapse-open:hidden"></i>
                        <i class="mgc_minimize_line hidden fc-collapse-open:block"></i>
                    </button>
                    <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary
                            to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                        </p>
                    </div>
                </div>

                <div id="defaultAccordionHTML" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;div data-fc-type=&quot;accordion&quot;&gt;
										&lt;!-- Accordion item one --&gt;
										&lt;button data-fc-type=&quot;collapse&quot; class=&quot;fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
											Accordion #1
											&lt;i class=&quot;mgc_add_line block fc-collapse-open:hidden&quot;&gt;&lt;/i&gt;
											&lt;i class=&quot;mgc_minimize_line hidden fc-collapse-open:block&quot;&gt;&lt;/i&gt;
										&lt;/button&gt;
										&lt;div class=&quot;w-full overflow-hidden transition-[height] duration-300&quot;&gt;
											&lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
												Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
											&lt;/p&gt;
										&lt;/div&gt;

										&lt;!-- Accordion item two --&gt;
										&lt;button data-fc-type=&quot;collapse&quot; class=&quot;fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
											Accordion #2
											&lt;i class=&quot;mgc_add_line block fc-collapse-open:hidden&quot;&gt;&lt;/i&gt;
											&lt;i class=&quot;mgc_minimize_line hidden fc-collapse-open:block&quot;&gt;&lt;/i&gt;
										&lt;/button&gt;
										&lt;div class=&quot;hidden w-full overflow-hidden transition-[height] duration-300&quot;&gt;
											&lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
												Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
											&lt;/p&gt;
										&lt;/div&gt;

										&lt;!-- Accordion item three --&gt;
										&lt;button data-fc-type=&quot;collapse&quot; class=&quot;fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
											Accordion #3
											&lt;i class=&quot;mgc_add_line block fc-collapse-open:hidden&quot;&gt;&lt;/i&gt;
											&lt;i class=&quot;mgc_minimize_line hidden fc-collapse-open:block&quot;&gt;&lt;/i&gt;
										&lt;/button&gt;
										&lt;div class=&quot;hidden w-full overflow-hidden transition-[height] duration-300&quot;&gt;
											&lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
												Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
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
                    <h4 class="card-title">Always Open</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#alertHeadingHtml">
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
                <div>
                    <!-- Accordion item one -->
                    <button data-fc-type="collapse" class="fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                        Accordion #1
                        <i class="mgc_add_line block fc-collapse-open:hidden"></i>
                        <i class="mgc_minimize_line hidden fc-collapse-open:block"></i>
                    </button>
                    <div class="w-full overflow-hidden transition-[height] duration-300">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary
                            to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                        </p>
                    </div>

                    <!-- Accordion item two -->
                    <button data-fc-type="collapse" class="fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                        Accordion #2
                        <i class="mgc_add_line block fc-collapse-open:hidden"></i>
                        <i class="mgc_minimize_line hidden fc-collapse-open:block"></i>
                    </button>
                    <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary
                            to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                        </p>
                    </div>

                    <!-- Accordion item three -->
                    <button data-fc-type="collapse" class="fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                        Accordion #3
                        <i class="mgc_add_line block fc-collapse-open:hidden"></i>
                        <i class="mgc_minimize_line hidden fc-collapse-open:block"></i>
                    </button>
                    <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary
                            to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                        </p>
                    </div>
                </div>

                <div id="alertHeadingHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;!-- Accordion item one --&gt;
									&lt;button data-fc-type=&quot;collapse&quot; class=&quot;fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
										Accordion #1
										&lt;i class=&quot;mgc_add_line block fc-collapse-open:hidden&quot;&gt;&lt;/i&gt;
										&lt;i class=&quot;mgc_minimize_line hidden fc-collapse-open:block&quot;&gt;&lt;/i&gt;
									&lt;/button&gt;
									&lt;div class=&quot;w-full overflow-hidden transition-[height] duration-300&quot;&gt;
										&lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
											Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
										&lt;/p&gt;
									&lt;/div&gt;
	
									&lt;!-- Accordion item two --&gt;
									&lt;button data-fc-type=&quot;collapse&quot; class=&quot;fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
										Accordion #2
										&lt;i class=&quot;mgc_add_line block fc-collapse-open:hidden&quot;&gt;&lt;/i&gt;
										&lt;i class=&quot;mgc_minimize_line hidden fc-collapse-open:block&quot;&gt;&lt;/i&gt;
									&lt;/button&gt;
									&lt;div class=&quot;hidden w-full overflow-hidden transition-[height] duration-300&quot;&gt;
										&lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
											Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
										&lt;/p&gt;
									&lt;/div&gt;
	
									&lt;!-- Accordion item three --&gt;
									&lt;button data-fc-type=&quot;collapse&quot; class=&quot;fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
										Accordion #3
										&lt;i class=&quot;mgc_add_line block fc-collapse-open:hidden&quot;&gt;&lt;/i&gt;
										&lt;i class=&quot;mgc_minimize_line hidden fc-collapse-open:block&quot;&gt;&lt;/i&gt;
									&lt;/button&gt;
									&lt;div class=&quot;hidden w-full overflow-hidden transition-[height] duration-300&quot;&gt;
										&lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
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
                    <h4 class="card-title">Bordered</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#borderedAccordionHTML">
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
                <div data-fc-type="accordion" class="rounded border divide-y border-gray-200 dark:border-gray-700 divide-slate-900/10 dark:divide-white/10">
                    <!-- Accordion item one -->
                    <button data-fc-type="collapse" class="fc-collapse-open:text-primary p-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                        Accordion #1
                        <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                    </button>
                    <div class="w-full overflow-hidden transition-[height] duration-300">
                        <p class="p-3 text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary
                            to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                        </p>
                    </div>

                    <!-- Accordion item two -->
                    <button data-fc-type="collapse" class="fc-collapse-open:text-primary p-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                        Accordion #2
                        <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                    </button>
                    <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <p class="p-3 text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary
                            to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                        </p>
                    </div>

                    <!-- Accordion item three -->
                    <button data-fc-type="collapse" class="fc-collapse-open:text-primary p-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                        Accordion #3
                        <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                    </button>
                    <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <p class="p-3 text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary
                            to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                        </p>
                    </div>
                </div>

                <div id="borderedAccordionHTML" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;div data-fc-type=&quot;accordion&quot; class=&quot;rounded border divide-y border-gray-200 dark:border-gray-700 divide-slate-900/10 dark:divide-white/10&quot;&gt;
										&lt;!-- Accordion item one --&gt;
										&lt;button data-fc-type=&quot;collapse&quot; class=&quot;fc-collapse-open:text-primary p-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
											Accordion #1
											&lt;i class=&quot;mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl&quot;&gt;&lt;/i&gt;
										&lt;/button&gt;
										&lt;div class=&quot;w-full overflow-hidden transition-[height] duration-300&quot;&gt;
											&lt;p class=&quot;p-3 text-gray-800 dark:text-gray-200&quot;&gt;
												Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
											&lt;/p&gt;
										&lt;/div&gt;

										&lt;!-- Accordion item two --&gt;
										&lt;button data-fc-type=&quot;collapse&quot; class=&quot;fc-collapse-open:text-primary p-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
											Accordion #2
											&lt;i class=&quot;mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl&quot;&gt;&lt;/i&gt;
										&lt;/button&gt;
										&lt;div class=&quot;hidden w-full overflow-hidden transition-[height] duration-300&quot;&gt;
											&lt;p class=&quot;p-3 text-gray-800 dark:text-gray-200&quot;&gt;
												Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
											&lt;/p&gt;
										&lt;/div&gt;

										&lt;!-- Accordion item three --&gt;
										&lt;button data-fc-type=&quot;collapse&quot; class=&quot;fc-collapse-open:text-primary p-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
											Accordion #3
											&lt;i class=&quot;mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl&quot;&gt;&lt;/i&gt;
										&lt;/button&gt;
										&lt;div class=&quot;hidden w-full overflow-hidden transition-[height] duration-300&quot;&gt;
											&lt;p class=&quot;p-3 text-gray-800 dark:text-gray-200&quot;&gt;
												Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
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
                    <h4 class="card-title">With Icon</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="withIconAccordionHTML">
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
                <div data-fc-type="accordion" class="space-y-3">
                    <!-- Accordion item one -->
                    <div class="rounded border border-gray-200 dark:border-gray-700">
                        <button data-fc-type="collapse" class="fc-collapse-open:text-primary p-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                            <i class="mgc_store_2_line text-lg"></i>
                            Accordion #1
                            <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                        </button>
                        <div class="w-full overflow-hidden transition-[height] duration-300">
                            <div class="border-t p-3 border-gray-200 dark:border-gray-700">
                                <p class="text-gray-800 dark:text-gray-200">
                                    Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything
                                    necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Accordion item two -->
                    <div class="rounded border border-gray-200 dark:border-gray-700">
                        <button data-fc-type="collapse" class="fc-collapse-open:text-primary p-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                            <i class="mgc_safe_flash_line text-lg"></i>
                            Accordion #2
                            <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                        </button>
                        <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                            <div class="border-t p-3 border-gray-200 dark:border-gray-700">
                                <p class="text-gray-800 dark:text-gray-200">
                                    Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything
                                    necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Accordion item three -->
                    <div class="rounded border border-gray-200 dark:border-gray-700">
                        <button data-fc-type="collapse" class="fc-collapse-open:text-primary p-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                            <i class="mgc_home_3_line text-lg"></i>
                            Accordion #3
                            <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                        </button>
                        <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                            <div class="border-t p-3 border-gray-200 dark:border-gray-700">
                                <p class="text-gray-800 dark:text-gray-200">
                                    Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything
                                    necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="withIconAccordionHTML" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;div data-fc-type=&quot;accordion&quot; class=&quot;space-y-3&quot;&gt;
										&lt;!-- Accordion item one --&gt;
										&lt;div class=&quot;rounded border border-gray-200 dark:border-gray-700&quot;&gt;
											&lt;button data-fc-type=&quot;collapse&quot; class=&quot;fc-collapse-open:text-primary p-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
												&lt;i class=&quot;mgc_store_2_line text-lg&quot;&gt;&lt;/i&gt;
												Accordion #1
												&lt;i class=&quot;mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl&quot;&gt;&lt;/i&gt;
											&lt;/button&gt;
											&lt;div class=&quot;w-full overflow-hidden transition-[height] duration-300&quot;&gt;
												&lt;div class=&quot;border-t p-3 border-gray-200 dark:border-gray-700&quot;&gt;
													&lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
														Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
													&lt;/p&gt;
												&lt;/div&gt;
											&lt;/div&gt;
										&lt;/div&gt;
		
										&lt;!-- Accordion item two --&gt;
										&lt;div class=&quot;rounded border border-gray-200 dark:border-gray-700&quot;&gt;
											&lt;button data-fc-type=&quot;collapse&quot; class=&quot;fc-collapse-open:text-primary p-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
												&lt;i class=&quot;mgc_safe_flash_line text-lg&quot;&gt;&lt;/i&gt;
												Accordion #2
												&lt;i class=&quot;mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl&quot;&gt;&lt;/i&gt;
											&lt;/button&gt;
											&lt;div class=&quot;hidden w-full overflow-hidden transition-[height] duration-300&quot;&gt;
												&lt;div class=&quot;border-t p-3 border-gray-200 dark:border-gray-700&quot;&gt;
													&lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
														Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
													&lt;/p&gt;
												&lt;/div&gt;
											&lt;/div&gt;
										&lt;/div&gt;
		
										&lt;!-- Accordion item three --&gt;
										&lt;div class=&quot;rounded border border-gray-200 dark:border-gray-700&quot;&gt;
											&lt;button data-fc-type=&quot;collapse&quot; class=&quot;fc-collapse-open:text-primary p-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
												&lt;i class=&quot;mgc_home_3_line text-lg&quot;&gt;&lt;/i&gt;
												Accordion #3
												&lt;i class=&quot;mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl&quot;&gt;&lt;/i&gt;
											&lt;/button&gt;
											&lt;div class=&quot;hidden w-full overflow-hidden transition-[height] duration-300&quot;&gt;
												&lt;div class=&quot;border-t p-3 border-gray-200 dark:border-gray-700&quot;&gt;
													&lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
														Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
													&lt;/p&gt;
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
                    <h4 class="card-title">With arrow</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#withArrowAccordionHTML">
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
                <div data-fc-type="accordion" class="divide-y divide-slate-900/10 dark:divide-white/10">
                    <!-- Accordion item one -->
                    <button data-fc-type="collapse" class="fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                        Accordion #1
                        <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                    </button>
                    <div class="w-full overflow-hidden transition-[height] duration-300">
                        <p class="py-3 text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary
                            to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                        </p>
                    </div>

                    <!-- Accordion item two -->
                    <button data-fc-type="collapse" class="fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                        Accordion #2
                        <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                    </button>
                    <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <p class="py-3 text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary
                            to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                        </p>
                    </div>

                    <!-- Accordion item three -->
                    <button data-fc-type="collapse" class="fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                        Accordion #3
                        <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                    </button>
                    <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <p class="py-3 text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary
                            to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                        </p>
                    </div>
                </div>

                <div id="withArrowAccordionHTML" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;div data-fc-type=&quot;accordion&quot; class=&quot;divide-y divide-slate-900/10 dark:divide-white/10&quot;&gt;
										&lt;!-- Accordion item one --&gt;
										&lt;button data-fc-type=&quot;collapse&quot; class=&quot;fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
											Accordion #1
											&lt;i class=&quot;mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl&quot;&gt;&lt;/i&gt;
										&lt;/button&gt;
										&lt;div class=&quot;w-full overflow-hidden transition-[height] duration-300&quot;&gt;
											&lt;p class=&quot;py-3 text-gray-800 dark:text-gray-200&quot;&gt;
												Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
											&lt;/p&gt;
										&lt;/div&gt;

										&lt;!-- Accordion item two --&gt;
										&lt;button data-fc-type=&quot;collapse&quot; class=&quot;fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
											Accordion #2
											&lt;i class=&quot;mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl&quot;&gt;&lt;/i&gt;
										&lt;/button&gt;
										&lt;div class=&quot;hidden w-full overflow-hidden transition-[height] duration-300&quot;&gt;
											&lt;p class=&quot;py-3 text-gray-800 dark:text-gray-200&quot;&gt;
												Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
											&lt;/p&gt;
										&lt;/div&gt;

										&lt;!-- Accordion item three --&gt;
										&lt;button data-fc-type=&quot;collapse&quot; class=&quot;fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
											Accordion #3
											&lt;i class=&quot;mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl&quot;&gt;&lt;/i&gt;
										&lt;/button&gt;
										&lt;div class=&quot;hidden w-full overflow-hidden transition-[height] duration-300&quot;&gt;
											&lt;p class=&quot;py-3 text-gray-800 dark:text-gray-200&quot;&gt;
												Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
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
                    <h4 class="card-title">No arrow</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#noArrowAccordionHTML">
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
                <div data-fc-type="accordion">
                    <!-- Accordion item one -->
                    <button data-fc-type="collapse" class="fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                        Accordion #1
                    </button>
                    <div class="w-full overflow-hidden transition-[height] duration-300">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary
                            to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                        </p>
                    </div>

                    <!-- Accordion item two -->
                    <button data-fc-type="collapse" class="fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                        Accordion #2
                    </button>
                    <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary
                            to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                        </p>
                    </div>

                    <!-- Accordion item three -->
                    <button data-fc-type="collapse" class="fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                        Accordion #3
                    </button>
                    <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary
                            to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                        </p>
                    </div>
                </div>

                <div id="noArrowAccordionHTML" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;div data-fc-type=&quot;accordion&quot;&gt;
										&lt;!-- Accordion item one --&gt;
										&lt;button data-fc-type=&quot;collapse&quot; class=&quot;fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
											Accordion #1
										&lt;/button&gt;
										&lt;div class=&quot;w-full overflow-hidden transition-[height] duration-300&quot;&gt;
											&lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
												Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
											&lt;/p&gt;
										&lt;/div&gt;
		
										&lt;!-- Accordion item two --&gt;
										&lt;button data-fc-type=&quot;collapse&quot; class=&quot;fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
											Accordion #2
										&lt;/button&gt;
										&lt;div class=&quot;hidden w-full overflow-hidden transition-[height] duration-300&quot;&gt;
											&lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
												Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
											&lt;/p&gt;
										&lt;/div&gt;
		
										&lt;!-- Accordion item three --&gt;
										&lt;button data-fc-type=&quot;collapse&quot; class=&quot;fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
											Accordion #3
										&lt;/button&gt;
										&lt;div class=&quot;hidden w-full overflow-hidden transition-[height] duration-300&quot;&gt;
											&lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
												Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
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
                    <h4 class="card-title">Nested</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#nestedAccordionHTML">
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
                <div data-fc-type="accordion" id="parent-accordion">
                    <!-- Accordion item one -->
                    <button data-fc-type="collapse" data-fc-parent="parent-accordion" class="fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                        <i class="mgc_add_line block fc-collapse-open:hidden"></i>
                        <i class="mgc_minimize_line hidden fc-collapse-open:block"></i>
                        Accordion #1
                    </button>
                    <div class="w-full overflow-hidden transition-[height] duration-300">
                        <div data-fc-type="accordion" class="ps-6" id="child-accordion">
                            <!-- Accordion sub item one -->
                            <button data-fc-type="collapse" data-fc-parent="child-accordion" class="fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                                <i class="mgc_add_line block fc-collapse-open:hidden"></i>
                                <i class="mgc_minimize_line hidden fc-collapse-open:block"></i>
                                Sub accordion #1
                            </button>
                            <div class="w-full overflow-hidden transition-[height] duration-300">
                                <p class="text-gray-800 dark:text-gray-200">
                                    Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything
                                    necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
                                </p>
                            </div>

                            <!-- Accordion sub item two -->
                            <button data-fc-type="collapse" data-fc-parent="child-accordion" class="fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                                <i class="mgc_add_line block fc-collapse-open:hidden"></i>
                                <i class="mgc_minimize_line hidden fc-collapse-open:block"></i>
                                Sub accordion #2
                            </button>
                            <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                                <p class="text-gray-800 dark:text-gray-200">
                                    <em>This is the second item's accordion body.</em>
                                    It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions.
                                </p>
                            </div>

                            <!-- Accordion sub item three -->
                            <button data-fc-type="collapse" data-fc-parent="child-accordion" class="fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                                <i class="mgc_add_line block fc-collapse-open:hidden"></i>
                                <i class="mgc_minimize_line hidden fc-collapse-open:block"></i>
                                Sub accordion #3
                            </button>
                            <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                                <p class="text-gray-800 dark:text-gray-200">
                                    <em>This is the first item's accordion body.</em>
                                    It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Accordion item two -->
                    <button data-fc-type="collapse" data-fc-parent="parent-accordion" class="fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                        <i class="mgc_add_line block fc-collapse-open:hidden"></i>
                        <i class="mgc_minimize_line hidden fc-collapse-open:block"></i>
                        Accordion #2
                    </button>
                    <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <p class="text-gray-800 dark:text-gray-200">
                            <em>This is the second item's accordion body.</em>
                            It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions.
                        </p>
                    </div>

                    <!-- Accordion item three -->
                    <button data-fc-type="collapse" data-fc-parent="parent-accordion" class="fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                        <i class="mgc_add_line block fc-collapse-open:hidden"></i>
                        <i class="mgc_minimize_line hidden fc-collapse-open:block"></i>
                        Accordion #3
                    </button>
                    <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                        <p class="text-gray-800 dark:text-gray-200">
                            <em>This is the first item's accordion body.</em>
                            It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions.
                        </p>
                    </div>
                </div>

                <div id="nestedAccordionHTML" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;div data-fc-type=&quot;accordion&quot; id=&quot;parent-accordion&quot;&gt;
										&lt;!-- Accordion item one --&gt;
										&lt;button data-fc-type=&quot;collapse&quot; data-fc-parent=&quot;parent-accordion&quot; class=&quot;fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
											&lt;i class=&quot;mgc_add_line block fc-collapse-open:hidden&quot;&gt;&lt;/i&gt;
											&lt;i class=&quot;mgc_minimize_line hidden fc-collapse-open:block&quot;&gt;&lt;/i&gt;
											Accordion #1
										&lt;/button&gt;
										&lt;div class=&quot;w-full overflow-hidden transition-[height] duration-300&quot;&gt;
											&lt;div data-fc-type=&quot;accordion&quot; class=&quot;ps-6&quot; id=&quot;child-accordion&quot;&gt;
												&lt;!-- Accordion sub item one --&gt;
												&lt;button data-fc-type=&quot;collapse&quot; data-fc-parent=&quot;child-accordion&quot; class=&quot;fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
													&lt;i class=&quot;mgc_add_line block fc-collapse-open:hidden&quot;&gt;&lt;/i&gt;
													&lt;i class=&quot;mgc_minimize_line hidden fc-collapse-open:block&quot;&gt;&lt;/i&gt;
													Sub accordion #1
												&lt;/button&gt;
												&lt;div class=&quot;w-full overflow-hidden transition-[height] duration-300&quot;&gt;
													&lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
														Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML. The framework functions by scanning all of your HTML files, JavaScript components, and templates for class names, automatically generating corresponding styles, and writing them to a static CSS file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to design beautiful, responsive web applications. Additionally, the framework includes checkout forms, shopping carts, and product views, making it the ideal choice for developing your next e-commerce front-end.
													&lt;/p&gt;
												&lt;/div&gt;
		
												&lt;!-- Accordion sub item two --&gt;
												&lt;button data-fc-type=&quot;collapse&quot; data-fc-parent=&quot;child-accordion&quot; class=&quot;fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
													&lt;i class=&quot;mgc_add_line block fc-collapse-open:hidden&quot;&gt;&lt;/i&gt;
													&lt;i class=&quot;mgc_minimize_line hidden fc-collapse-open:block&quot;&gt;&lt;/i&gt;
													Sub accordion #2
												&lt;/button&gt;
												&lt;div class=&quot;hidden w-full overflow-hidden transition-[height] duration-300&quot;&gt;
													&lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
														&lt;em&gt;This is the second item's accordion body.&lt;/em&gt; It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions.
													&lt;/p&gt;
												&lt;/div&gt;
		
												&lt;!-- Accordion sub item three --&gt;
												&lt;button data-fc-type=&quot;collapse&quot; data-fc-parent=&quot;child-accordion&quot; class=&quot;fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
													&lt;i class=&quot;mgc_add_line block fc-collapse-open:hidden&quot;&gt;&lt;/i&gt;
													&lt;i class=&quot;mgc_minimize_line hidden fc-collapse-open:block&quot;&gt;&lt;/i&gt;
													Sub accordion #3
												&lt;/button&gt;
												&lt;div class=&quot;hidden w-full overflow-hidden transition-[height] duration-300&quot;&gt;
													&lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
														&lt;em&gt;This is the first item's accordion body.&lt;/em&gt; It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions.
													&lt;/p&gt;
												&lt;/div&gt;
											&lt;/div&gt;
										&lt;/div&gt;
		
										&lt;!-- Accordion item two --&gt;
										&lt;button data-fc-type=&quot;collapse&quot; data-fc-parent=&quot;parent-accordion&quot; class=&quot;fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot;&gt;
											&lt;i class=&quot;mgc_add_line block fc-collapse-open:hidden&quot;&gt;&lt;/i&gt;
											&lt;i class=&quot;mgc_minimize_line hidden fc-collapse-open:block&quot;&gt;&lt;/i&gt;
											Accordion #2
										&lt;/button&gt;
										&lt;div class=&quot;hidden w-full overflow-hidden transition-[height] duration-300&quot;&gt;
											&lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
												&lt;em&gt;This is the second item's accordion body.&lt;/em&gt; It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions.
											&lt;/p&gt;
										&lt;/div&gt;
		
										&lt;!-- Accordion item three --&gt;
										&lt;button data-fc-type=&quot;collapse&quot; data-fc-parent=&quot;parent-accordion&quot; class=&quot;fc-collapse-open:text-primary py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400&quot; e&quot;&gt;
											&lt;i class=&quot;mgc_add_line block fc-collapse-open:hidden&quot;&gt;&lt;/i&gt;
											&lt;i class=&quot;mgc_minimize_line hidden fc-collapse-open:block&quot;&gt;&lt;/i&gt;
											Accordion #3
										&lt;/button&gt;
										&lt;div class=&quot;hidden w-full overflow-hidden transition-[height] duration-300&quot;&gt;
											&lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
												&lt;em&gt;This is the first item's accordion body.&lt;/em&gt; It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions.
											&lt;/p&gt;
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
