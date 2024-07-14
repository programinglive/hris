@extends('layouts.vertical', ['title' => 'Gallery', 'sub_title' => 'Pages', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
    @vite(['node_modules/glightbox/dist/css/glightbox.min.css'])
@endsection

@section('content')
    <div class="flex flex-col gap-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title uppercase">Filter Sort
                    <a href="https://vestride.github.io/Shuffle/" target="_blank" class="text-primary">(ShuffleJs)</a>
                </h5>
            </div>
            <div class="p-6">
                <div class="flex justify-center">
                    <div class="w-full filters-group-wrap mb-3">
                        <div class="flex justify-center mb-5">
                            <ul class="filter-options flex flex-wrap gap-4 justify-center">
                                <li class="active" data-group="all">
                                    <a href="javascript:void(0)" class="btn">All Items</a>
                                </li>
                                <li data-group="design">
                                    <a href="javascript:void(0)" class="btn">Design</a>
                                </li>
                                <li data-group="creative">
                                    <a href="javascript:void(0)" class="btn">Creative</a>
                                </li>
                                <li data-group="digital">
                                    <a href="javascript:void(0)" class="btn">Digital</a>
                                </li>
                                <li data-group="photography">
                                    <a href="javascript:void(0)" class="btn">Photography</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end /div-->
                </div>
                <!--end /div-->

                <div id="gallery-wrapper" class="flex flex-wrap justify-center">
                    <div class="xl:w-1/4 lg:w-1/3 p-3 picture-item" data-groups='["creative", "photography"]'>
                        <a class="image-popup" href="/images/small/small-1.jpg">
                            <div class="relative block overflow-hidden rounded group transition-all duration-500">
                                <img src="/images/small/small-1.jpg" class="rounded transition-all duration-500 group-hover:scale-105" alt="work-image">
                                <div class="absolute inset-3 flex items-end cursor-pointer rounded bg-white p-3 opacity-0 transition-all duration-500 group-hover:opacity-80">
                                    <div>
                                        <p class="text-sm text-gray-400">Media, Icons</p>
                                        <h6 class="text-base text-black font-medium">Open Imagination</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="xl:w-1/4 lg:w-1/3 p-3 picture-item" data-groups='["design", "digital"]'>
                        <a class="image-popup" href="/images/small/small-2.jpg">
                            <div class="relative block overflow-hidden rounded group transition-all duration-500">
                                <img src="/images/small/small-2.jpg" class="rounded transition-all duration-500 group-hover:scale-105" alt="work-image">
                                <div class="absolute inset-3 flex items-end cursor-pointer rounded bg-white p-3 opacity-0 transition-all duration-500 group-hover:opacity-80">
                                    <div>
                                        <p class="text-sm text-gray-400">Illustrations</p>
                                        <h6 class="text-base text-black font-medium">Locked Steel Gate</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="xl:w-1/4 lg:w-1/3 p-3 picture-item" data-groups='["creative", "photography"]'>
                        <a class="image-popup" href="/images/small/small-3.jpg">
                            <div class="relative block overflow-hidden rounded group transition-all duration-500">
                                <img src="/images/small/small-3.jpg" class="rounded transition-all duration-500 group-hover:scale-105" alt="work-image">
                                <div class="absolute inset-3 flex items-end cursor-pointer rounded bg-white p-3 opacity-0 transition-all duration-500 group-hover:opacity-80">
                                    <div>
                                        <p class="text-sm text-gray-400">Graphics, UI Elements</p>
                                        <h6 class="text-base text-black font-medium">Mac Sunglasses</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="xl:w-1/4 lg:w-1/3 p-3 picture-item" data-groups='["design", "photography"]'>
                        <a class="image-popup" href="/images/small/small-4.jpg">
                            <div class="relative block overflow-hidden rounded group transition-all duration-500">
                                <img src="/images/small/small-4.jpg" class="rounded transition-all duration-500 group-hover:scale-105" alt="work-image">
                                <div class="absolute inset-3 flex items-end cursor-pointer rounded bg-white p-3 opacity-0 transition-all duration-500 group-hover:opacity-80">
                                    <div>
                                        <p class="text-sm text-gray-400">Icons, Illustrations</p>
                                        <h6 class="text-base text-black font-medium">Morning Dew</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="xl:w-1/4 lg:w-1/3 p-3 picture-item" data-groups='["photography", "design"]'>
                        <a class="image-popup" href="/images/small/small-5.jpg">
                            <div class="relative block overflow-hidden rounded group transition-all duration-500">
                                <img src="/images/small/small-5.jpg" class="rounded transition-all duration-500 group-hover:scale-105" alt="work-image">
                                <div class="absolute inset-3 flex items-end cursor-pointer rounded bg-white p-3 opacity-0 transition-all duration-500 group-hover:opacity-80">
                                    <div>
                                        <p class="text-sm text-gray-400">UI Elements, Media</p>
                                        <h6 class="text-base text-black font-medium">Console Activity</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="xl:w-1/4 lg:w-1/3 p-3 picture-item" data-groups='["digital", "creative"]'>
                        <a class="image-popup" href="/images/small/small-6.jpg">
                            <div class="relative block overflow-hidden rounded group transition-all duration-500">
                                <img src="/images/small/small-6.jpg" class="rounded transition-all duration-500 group-hover:scale-105" alt="work-image">
                                <div class="absolute inset-3 flex items-end cursor-pointer rounded bg-white p-3 opacity-0 transition-all duration-500 group-hover:opacity-80">
                                    <div>
                                        <p class="text-sm text-gray-400">Graphics</p>
                                        <h6 class="text-base text-black font-medium">Sunset Bulb Glow</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="xl:w-1/4 lg:w-1/3 p-3 picture-item" data-groups='["creative", "digital"]'>
                        <a class="image-popup" href="/images/small/small-7.jpg">
                            <div class="relative block overflow-hidden rounded group transition-all duration-500">
                                <img src="/images/small/small-7.jpg" class="rounded transition-all duration-500 group-hover:scale-105" alt="work-image">
                                <div class="absolute inset-3 flex items-end cursor-pointer rounded bg-white p-3 opacity-0 transition-all duration-500 group-hover:opacity-80">
                                    <div>
                                        <p class="text-sm text-gray-400">Icons, Illustrations</p>
                                        <h6 class="text-base text-black font-medium">Morning Dew</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="xl:w-1/4 lg:w-1/3 p-3 picture-item" data-groups='["design", "digital"]'>
                        <a class="image-popup" href="/images/small/small-8.jpg">
                            <div class="relative block overflow-hidden rounded group transition-all duration-500">
                                <img src="/images/small/small-8.jpg" class="rounded transition-all duration-500 group-hover:scale-105" alt="work-image">
                                <div class="absolute inset-3 flex items-end cursor-pointer rounded bg-white p-3 opacity-0 transition-all duration-500 group-hover:opacity-80">
                                    <div>
                                        <p class="text-sm text-gray-400">Illustrations</p>
                                        <h6 class="text-base text-black font-medium">Locked Steel Gate</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Basic</h5>
            </div>
            <div class="p-6">

                <!-- Basic -->
                <div class="grid xl:grid-cols-5 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-5">
                    <img alt="gallery" class="object-cover object-center rounded" src="/images/small/plant3.jpeg">
                    <img alt="gallery" class="object-cover object-center rounded" src="/images/small/girl.jpg">
                    <img alt="gallery" class="object-cover object-center rounded" src="/images/small/plant2.jpeg">
                    <img alt="gallery" class="object-cover object-center rounded" src="/images/small/statue1.jpg">
                    <img alt="gallery" class="object-cover object-center rounded" src="/images/small/vase.jpg">
                    <img alt="gallery" class="object-cover object-center rounded" src="/images/small/flower.jpeg">
                    <img alt="gallery" class="object-cover object-center rounded" src="/images/small/flower2.jpg">
                    <img alt="gallery" class="object-cover object-center rounded" src="/images/small/vase.jpg">
                    <img alt="gallery" class="object-cover object-center rounded" src="/images/small/girl.jpg">
                    <img alt="gallery" class="object-cover object-center rounded" src="/images/small/plant.jpg">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Mix Images</h5>
            </div>
            <div class="p-6">
                <!-- Mix -->
                <div class="grid lg:grid-cols-4 md:grid-cols-3 gap-5">
                    <div>
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded" src="/images/small/statue1.jpg">
                    </div>
                    <div>
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded" src="/images/small/statue2.jpg">
                    </div>
                    <div class=" lg:col-span-2 lg:row-span-2">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded" src="/images/small/vase.jpg">
                    </div>
                    <div class=" lg:col-span-2 lg:row-span-2">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded" src="/images/small/plant.jpg">
                    </div>
                    <div>
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded" src="/images/small/plant2.jpeg">
                    </div>
                    <div>
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded" src="/images/small/plant3.jpeg">
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Captions</h5>
            </div>
            <div class="p-6">
                <!-- Caption -->
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-5">

                    <div class="flex flex-wrap w-full bg-gray-100 py-32 px-10 relative lg:col-span-2">
                        <img alt="gallery" class="w-full object-cover h-full object-center block opacity-25 absolute inset-0 rounded" src="/images/small/plant.jpg">
                        <div class="text-center relative z-10 w-full">
                            <h2 class="text-2xl text-gray-900 font-medium title-font mb-2">
                                Shooting
                                Stars</h2>
                            <p class="leading-relaxed">Skateboard +1 mustache fixie paleo
                                lumbersexual.
                            </p>
                            <a class="mt-3 text-indigo-500 inline-flex items-center">Learn
                                More
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ms-2" viewbox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-wrap w-full bg-gray-100 sm:py-24 py-16 sm:px-10 px-6 relative">
                        <img alt="gallery" class="w-full object-cover h-full object-center block opacity-25 absolute inset-0 rounded" src="/images/small/statue2.jpg">
                        <div class="text-center relative z-10 w-full">
                            <h2 class="text-xl text-gray-900 font-medium title-font mb-2">
                                Shooting Stars</h2>
                            <p class="leading-relaxed">Skateboard +1 mustache fixie paleo
                                lumbersexual.</p>
                            <a class="mt-3 text-indigo-500 inline-flex items-center">Learn
                                More
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ms-2" viewbox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-wrap w-full bg-gray-100 sm:py-24 py-16 sm:px-10 px-6 relative">
                        <img alt="gallery" class="w-full object-cover h-full object-center block opacity-25 absolute inset-0 rounded" src="/images/small/statue1.jpg">
                        <div class="text-center relative z-10 w-full">
                            <h2 class="text-xl text-gray-900 font-medium title-font mb-2">
                                Shooting Stars</h2>
                            <p class="leading-relaxed">Skateboard +1 mustache fixie paleo
                                lumbersexual.</p>
                            <a class="mt-3 text-indigo-500 inline-flex items-center">Learn
                                More
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ms-2" viewbox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Hover Effect</h5>
            </div>
            <div class="p-6">
                <!-- Hover effect -->
                <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-5">
                    <div class="flex relative">
                        <img alt="gallery" class="absolute w-full h-full object-cover object-center rounded" src="/images/small/plant.jpg">
                        <div class="px-8 py-10 relative z-10 w-full bg-white opacity-0 hover:opacity-80">
                            <h2 class="tracking-widest text-sm font-semibold text-primary mb-1">
                                THE SUBTITLE</h2>
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                                Shooting Stars</h1>
                            <p class="leading-relaxed">Photo booth fam kinfolk cold-pressed
                                sriracha leggings jianbing microdosing tousled waistcoat.</p>
                        </div>
                    </div>
                    <div class="flex relative ">
                        <img alt="gallery" class="absolute inset-0 w-full h-full object-cover object-center rounded" src="/images/small/plant3.jpeg">
                        <div class="px-8 py-10 relative z-10 w-full bg-white opacity-0 hover:opacity-80">
                            <h2 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">
                                THE SUBTITLE</h2>
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">The
                                Catalyzer</h1>
                            <p class="leading-relaxed">Photo booth fam kinfolk cold-pressed
                                sriracha leggings jianbing microdosing tousled waistcoat.</p>
                        </div>
                    </div>
                    <div class="flex relative">
                        <img alt="gallery" class="absolute inset-0 w-full h-full object-cover object-center rounded" src="/images/small/vase.jpg">
                        <div class="px-8 py-10 relative z-10 w-full bg-white opacity-0 hover:opacity-80">
                            <h2 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">
                                THE SUBTITLE</h2>
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">The
                                400 Blows</h1>
                            <p class="leading-relaxed">Photo booth fam kinfolk cold-pressed
                                sriracha leggings jianbing microdosing tousled waistcoat.</p>
                        </div>
                    </div>
                    <div class="flex relative">
                        <img alt="gallery" class="absolute inset-0 w-full h-full object-cover object-center rounded" src="/images/small/statue2.jpg">
                        <div class="px-8 py-10 relative z-10 w-full bg-white opacity-0 hover:opacity-80">
                            <h2 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">
                                THE SUBTITLE</h2>
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                                Neptune</h1>
                            <p class="leading-relaxed">Photo booth fam kinfolk cold-pressed
                                sriracha leggings jianbing microdosing tousled waistcoat.</p>
                        </div>
                    </div>
                    <div class="flex relative">
                        <img alt="gallery" class="absolute inset-0 w-full h-full object-cover object-center rounded" src="/images/small/statue1.jpg">
                        <div class="px-8 py-10 relative z-10 w-full bg-white opacity-0 hover:opacity-80">
                            <h2 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">
                                THE SUBTITLE</h2>
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">Holden
                                Caulfield</h1>
                            <p class="leading-relaxed">Photo booth fam kinfolk cold-pressed
                                sriracha leggings jianbing microdosing tousled waistcoat.</p>
                        </div>
                    </div>
                    <div class="flex relative">
                        <img alt="gallery" class="absolute inset-0 w-full h-full object-cover object-center rounded" src="/images/small/plant2.jpeg">
                        <div class="px-8 py-10 relative z-10 w-full bg-white opacity-0 hover:opacity-80">
                            <h2 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">
                                THE SUBTITLE</h2>
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">Alper
                                Kamu</h1>
                            <p class="leading-relaxed">Photo booth fam kinfolk cold-pressed
                                sriracha leggings jianbing microdosing tousled waistcoat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Filter</h5>
            </div>
            <div class="p-6">
                <!-- Filter Images -->
                <div class="grid lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-1 gap-5">
                    <img alt="gallery" class="object-cover object-center rounded filter blur-sm" src="/images/small/plant3.jpeg">
                    <img alt="gallery" class="object-cover object-center rounded filter brightness-50" src="/images/small/plant.jpg">
                    <img alt="gallery" class="object-cover object-center rounded filter contrast-50" src="/images/small/plant2.jpeg">
                    <img alt="gallery" class="object-cover object-center rounded filter drop-shadow-2xl" src="/images/small/statue1.jpg">
                    <img alt="gallery" class="object-cover object-center rounded filter grayscale" src="/images/small/vase.jpg">
                    <img alt="gallery" class="object-cover object-center rounded filter hue-rotate-60" src="/images/small/boys.jpg">
                    <img alt="gallery" class="object-cover object-center rounded filter invert" src="/images/small/plant3.jpeg">
                    <img alt="gallery" class="object-cover object-center rounded filter saturate-50" src="/images/small/vase.jpg">
                    <img alt="gallery" class="object-cover object-center rounded filter sepia" src="/images/small/plant2.jpeg">
                    <img alt="gallery" class="object-cover object-center rounded filter hue-rotate-180" src="/images/small/plant.jpg">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite('resources/js/pages/gallery.js')
@endsection
