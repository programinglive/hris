@extends('layouts.vertical', ['title' => 'FAQ', 'sub_title' => 'Pages', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid lg:grid-cols-2 gap-4">
        <div data-fc-type="accordion" class="space-y-4">
            <div class="card">
                <button data-fc-type="collapse" class="fc-collapse-open:text-primary p-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                    <i class="mgc_store_2_line text-lg"></i>
                    What is Lorem Ipsum?
                    <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                </button>
                <div class="w-full overflow-hidden transition-[height] duration-300">
                    <div class="border-t p-3 border-gray-200 dark:border-gray-700">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML.
                            The framework functions by scanning all of your HTML files, JavaScript components, and templates
                            for class names, automatically generating corresponding styles, and writing them to a static CSS
                            file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to
                            create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to
                            design beautiful, responsive web applications. Additionally, the framework includes checkout
                            forms, shopping carts, ffffand product views, making it the ideal choice for developing your next
                            e-commerce front-end.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card">
                <button data-fc-type="collapse" class="fc-collapse-open:text-primary p-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                    <i class="mgc_safe_flash_line text-lg"></i>
                    My team has credits. How do we use them?
                    <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                </button>
                <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <div class="border-t p-3 border-gray-200 dark:border-gray-700">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML.
                            The framework functions by scanning all of your HTML files, JavaScript components, and templates
                            for class names, automatically generating corresponding styles, and writing them to a static CSS
                            file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to
                            create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to
                            design beautiful, responsive web applications. Additionally, the framework includes checkout
                            forms, shopping carts, and product views, making it the ideal choice for developing your next
                            e-commerce front-end.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card">
                <button data-fc-type="collapse" class="fc-collapse-open:text-primary p-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                    <i class="mgc_home_3_line text-lg"></i>
                    How does Admin's pricing work?
                    <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                </button>
                <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <div class="border-t p-3 border-gray-200 dark:border-gray-700">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML.
                            The framework functions by scanning all of your HTML files, JavaScript components, and templates
                            for class names, automatically generating corresponding styles, and writing them to a static CSS
                            file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to
                            create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to
                            design beautiful, responsive web applications. Additionally, the framework includes checkout
                            forms, shopping carts, and product views, making it the ideal choice for developing your next
                            e-commerce front-end.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card">
                <button data-fc-type="collapse" class="fc-collapse-open:text-primary p-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                    <i class="mgc_safe_flash_line text-lg"></i>
                    How secure is FrostUI?
                    <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                </button>
                <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <div class="border-t p-3 border-gray-200 dark:border-gray-700">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML.
                            The framework functions by scanning all of your HTML files, JavaScript components, and templates
                            for class names, automatically generating corresponding styles, and writing them to a static CSS
                            file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to
                            create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to
                            design beautiful, responsive web applications. Additionally, the framework includes checkout
                            forms, shopping carts, and product views, making it the ideal choice for developing your next
                            e-commerce front-end.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card">
                <button data-fc-type="collapse" class="fc-collapse-open:text-primary p-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                    <i class="mgc_home_3_line text-lg"></i>
                    How do I get access to a theme I purchased?
                    <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                </button>
                <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <div class="border-t p-3 border-gray-200 dark:border-gray-700">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML.
                            The framework functions by scanning all of your HTML files, JavaScript components, and templates
                            for class names, automatically generating corresponding styles, and writing them to a static CSS
                            file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to
                            create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to
                            design beautiful, responsive web applications. Additionally, the framework includes checkout
                            forms, shopping carts, and product views, making it the ideal choice for developing your next
                            e-commerce front-end.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card">
                <button data-fc-type="collapse" class="fc-collapse-open:text-primary p-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                    <i class="mgc_safe_flash_line text-lg"></i>
                    Upgrade License Type
                    <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                </button>
                <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <div class="border-t p-3 border-gray-200 dark:border-gray-700">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML.
                            The framework functions by scanning all of your HTML files, JavaScript components, and templates
                            for class names, automatically generating corresponding styles, and writing them to a static CSS
                            file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to
                            create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to
                            design beautiful, responsive web applications. Additionally, the framework includes checkout
                            forms, shopping carts, and product views, making it the ideal choice for developing your next
                            e-commerce front-end.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div data-fc-type="accordion" class="space-y-4">
            <div class="card">
                <button data-fc-type="collapse" class="fc-collapse-open:text-primary p-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                    <i class="mgc_store_2_line text-lg"></i>
                    What is Lorem Ipsum?
                    <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                </button>
                <div class="w-full overflow-hidden transition-[height] duration-300">
                    <div class="border-t p-3 border-gray-200 dark:border-gray-700">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML.
                            The framework functions by scanning all of your HTML files, JavaScript components, and templates
                            for class names, automatically generating corresponding styles, and writing them to a static CSS
                            file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to
                            create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to
                            design beautiful, responsive web applications. Additionally, the framework includes checkout
                            forms, shopping carts, and product views, making it the ideal choice for developing your next
                            e-commerce front-end.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card">
                <button data-fc-type="collapse" class="fc-collapse-open:text-primary p-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                    <i class="mgc_safe_flash_line text-lg"></i>
                    My team has credits. How do we use them?
                    <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                </button>
                <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <div class="border-t p-3 border-gray-200 dark:border-gray-700">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML.
                            The framework functions by scanning all of your HTML files, JavaScript components, and templates
                            for class names, automatically generating corresponding styles, and writing them to a static CSS
                            file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to
                            create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to
                            design beautiful, responsive web applications. Additionally, the framework includes checkout
                            forms, shopping carts, and product views, making it the ideal choice for developing your next
                            e-commerce front-end.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card">
                <button data-fc-type="collapse" class="fc-collapse-open:text-primary p-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                    <i class="mgc_home_3_line text-lg"></i>
                    How does Admin's pricing work?
                    <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                </button>
                <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <div class="border-t p-3 border-gray-200 dark:border-gray-700">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML.
                            The framework functions by scanning all of your HTML files, JavaScript components, and templates
                            for class names, automatically generating corresponding styles, and writing them to a static CSS
                            file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to
                            create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to
                            design beautiful, responsive web applications. Additionally, the framework includes checkout
                            forms, shopping carts, and product views, making it the ideal choice for developing your next
                            e-commerce front-end.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card">
                <button data-fc-type="collapse" class="fc-collapse-open:text-primary p-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                    <i class="mgc_safe_flash_line text-lg"></i>
                    How secure is FrostUI?
                    <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                </button>
                <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <div class="border-t p-3 border-gray-200 dark:border-gray-700">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML.
                            The framework functions by scanning all of your HTML files, JavaScript components, and templates
                            for class names, automatically generating corresponding styles, and writing them to a static CSS
                            file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to
                            create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to
                            design beautiful, responsive web applications. Additionally, the framework includes checkout
                            forms, shopping carts, and product views, making it the ideal choice for developing your next
                            e-commerce front-end.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card">
                <button data-fc-type="collapse" class="fc-collapse-open:text-primary p-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                    <i class="mgc_home_3_line text-lg"></i>
                    How do I get access to a theme I purchased?
                    <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                </button>
                <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <div class="border-t p-3 border-gray-200 dark:border-gray-700">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML.
                            The framework functions by scanning all of your HTML files, JavaScript components, and templates
                            for class names, automatically generating corresponding styles, and writing them to a static CSS
                            file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to
                            create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to
                            design beautiful, responsive web applications. Additionally, the framework includes checkout
                            forms, shopping carts, and product views, making it the ideal choice for developing your next
                            e-commerce front-end.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card">
                <button data-fc-type="collapse" class="fc-collapse-open:text-primary p-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400">
                    <i class="mgc_safe_flash_line text-lg"></i>
                    Upgrade License Type
                    <i class="mgc_up_line fc-collapse-open:rotate-180 ms-auto transition-all text-xl"></i>
                </button>
                <div class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <div class="border-t p-3 border-gray-200 dark:border-gray-700">
                        <p class="text-gray-800 dark:text-gray-200">
                            Tailwind CSS offers a seamless way to build modern websites without having to leave your HTML.
                            The framework functions by scanning all of your HTML files, JavaScript components, and templates
                            for class names, automatically generating corresponding styles, and writing them to a static CSS
                            file. This approach is fast, flexible, and reliable, requiring zero runtime. Whether you need to
                            create form layouts, tables, or modal dialogs, Tailwind CSS provides everything necessary to
                            design beautiful, responsive web applications. Additionally, the framework includes checkout
                            forms, shopping carts, and product views, making it the ideal choice for developing your next
                            e-commerce front-end.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
