@extends('layouts.vertical', ['title' => 'Timeline', 'sub_title' => 'Pages', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="relative space-y-12 pb-6">
        <!-- Center Border Line -->
        <div class="absolute border-s-2 border border-gray-300 h-full top-0 start-10 md:start-1/2 -translate-x-1/2 rtl:translate-x-1/2 -z-10 dark:border-white/10"></div>

        <div class="h-10 w-20 flex justify-center bg-primary text-white md:mx-auto rounded items-center">
            Today
        </div>

        <!--  -->
        <div class="text-start">
            <div class="absolute start-10 md:start-1/2 -translate-x-1/2 rtl:translate-x-1/2 mt-6">
                <div class="w-5 h-5 flex justify-center items-center rounded-full bg-gray-300 dark:bg-slate-700">
                    <i class="mgc_stop_circle_line text-sm"></i>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="md:col-start-2 col-span-2">
                    <div class="relative md:ms-10 ms-20">
                        <div class="card p-5">
                            <h4 class="mb-2 text-base">1 hour ago</h4>
                            <p class="mb-2 text-gray-500 dark:text-gray-200">
                                <small>08:25 am</small>
                            </p>
                            <p class="text-gray-500 dark:text-gray-200">Dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde?
                            </p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 absolute h-4 w-4 rotate-45 rounded-sm top-7 -start-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:text-end text-start">
            <div class="absolute start-10 md:start-1/2 -translate-x-1/2 rtl:translate-x-1/2 mt-6">
                <div class="w-5 h-5 flex justify-center items-center rounded-full bg-gray-300 dark:bg-slate-700">
                    <i class="mgc_stop_circle_line text-sm"></i>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="md:col-span-1 col-span-2">
                    <div class="relative md:me-10 md:ms-0 ms-20">
                        <div class="card p-5">
                            <h4 class="mb-2 text-base">2 hours ago</h4>
                            <p class="mb-2 text-gray-500 dark:text-gray-200">
                                <small>08:25 am</small>
                            </p>
                            <p class="text-gray-500 dark:text-gray-200">consectetur adipisicing elit. Iusto, optio, dolorum
                                <a href="#">John deon</a>
                                provident rerum aut hic quasi placeat iure tempora laudantium
                            </p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 absolute h-4 w-4 rotate-45 rounded-sm top-7 md:-end-2 md:start-auto -start-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-start">
            <div class="absolute start-10 md:start-1/2 -translate-x-1/2 rtl:translate-x-1/2 mt-6">
                <div class="w-5 h-5 flex justify-center items-center rounded-full bg-gray-300 dark:bg-slate-700">
                    <i class="mgc_stop_circle_line text-sm"></i>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="md:col-start-2 col-span-2">
                    <div class="relative md:ms-10 ms-20">
                        <div class="card p-5">
                            <h4 class="mb-2 text-base">10 hours ago</h4>
                            <p class="mb-2 text-gray-500 dark:text-gray-200">
                                <small>08:25 am</small>
                            </p>
                            <p class="text-gray-500 dark:text-gray-200">3 new photo Uploaded on facebook fan page</p>
                            <div class="flex gap-2 mt-4">
                                <a href="javascript: void(0);">
                                    <img class="rounded w-14" alt="" src="/images/small/img-1.jpg">
                                </a>
                                <a href="javascript: void(0);">
                                    <img class="rounded w-14" alt="" src="/images/small/img-2.jpg">
                                </a>
                                <a href="javascript: void(0);">
                                    <img class="rounded w-14" alt="" src="/images/small/img-3.jpg">
                                </a>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 absolute h-4 w-4 rotate-45 rounded-sm top-7 -start-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:text-end text-start">
            <div class="absolute start-10 md:start-1/2 -translate-x-1/2 rtl:translate-x-1/2 mt-6">
                <div class="w-5 h-5 flex justify-center items-center rounded-full bg-gray-300 dark:bg-slate-700">
                    <i class="mgc_stop_circle_line text-sm"></i>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="md:col-span-1 col-span-2">
                    <div class="relative md:me-10 md:ms-0 ms-20">
                        <div class="card p-5">
                            <h4 class="mb-2 text-base">14 hours ago</h4>
                            <p class="mb-2 text-gray-500 dark:text-gray-200">
                                <small>08:25 am</small>
                            </p>
                            <p class="text-gray-500 dark:text-gray-200">Outdoor visit at California State Route 85 with John Boltana &
                                Harry Piterson regarding to setup a new show room.</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 absolute h-4 w-4 rotate-45 rounded-sm top-7 md:-end-2 md:start-auto -start-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-start">
            <div class="absolute start-10 md:start-1/2 -translate-x-1/2 rtl:translate-x-1/2 mt-6">
                <div class="w-5 h-5 flex justify-center items-center rounded-full bg-gray-300 dark:bg-slate-700">
                    <i class="mgc_stop_circle_line text-sm"></i>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="md:col-start-2 col-span-2">
                    <div class="relative md:ms-10 ms-20">
                        <div class="card p-5">
                            <h4 class="mb-2 text-base">19 hours ago</h4>
                            <p class="mb-2 text-gray-500 dark:text-gray-200">
                                <small>08:25 am</small>
                            </p>
                            <p class="text-gray-500 dark:text-gray-200">Jonatha Smith added new milestone
                                <span>
                                    <a href="#">Pathek</a>
                                </span>
                                Lorem ipsum dolor sit amet consiquest dio
                            </p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 absolute h-4 w-4 rotate-45 rounded-sm top-7 -start-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="h-10 w-24 flex justify-center bg-primary text-white md:mx-auto rounded items-center">
            Yesterday
        </div>

        <div class="md:text-end text-start">
            <div class="absolute start-10 md:start-1/2 -translate-x-1/2 rtl:translate-x-1/2 mt-6">
                <div class="w-5 h-5 flex justify-center items-center rounded-full bg-gray-300 dark:bg-slate-700">
                    <i class="mgc_stop_circle_line text-sm"></i>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="md:col-span-1 col-span-2">
                    <div class="relative md:me-10 md:ms-0 ms-20">
                        <div class="card p-5">
                            <h4 class="mb-2 text-base">07 January 2018</h4>
                            <p class="mb-2 text-gray-500 dark:text-gray-200">
                                <small>08:25 am</small>
                            </p>
                            <p class="text-gray-500 dark:text-gray-200">Montly Regular Medical check up at Greenland Hospital by the
                                doctor
                                <span>
                                    <a href="#">
                                        Johm meon
                                    </a>
                                </span>
                            </p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 absolute h-4 w-4 rotate-45 rounded-sm top-7 md:-end-2 md:start-auto -start-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-start">
            <div class="absolute start-10 md:start-1/2 -translate-x-1/2 rtl:translate-x-1/2 mt-6">
                <div class="w-5 h-5 flex justify-center items-center rounded-full bg-gray-300 dark:bg-slate-700">
                    <i class="mgc_stop_circle_line text-sm"></i>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="md:col-start-2 col-span-2">
                    <div class="relative md:ms-10 ms-20">
                        <div class="card p-5">
                            <h4 class="mb-2 text-base">07 January 2018</h4>
                            <p class="mb-2 text-gray-500 dark:text-gray-200">
                                <small>08:25 am</small>
                            </p>
                            <p class="text-gray-500 dark:text-gray-200">Download the new updates of Konrix admin dashboard</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 absolute h-4 w-4 rotate-45 rounded-sm top-7 -start-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="h-10 w-28 flex justify-center bg-primary text-white md:mx-auto rounded items-center">
            Last Month
        </div>

        <div class="md:text-end text-start">
            <div class="absolute start-10 md:start-1/2 -translate-x-1/2 rtl:translate-x-1/2 mt-6">
                <div class="w-5 h-5 flex justify-center items-center rounded-full bg-gray-300 dark:bg-slate-700">
                    <i class="mgc_stop_circle_line text-sm"></i>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="md:col-span-1 col-span-2">
                    <div class="relative md:me-10 md:ms-0 ms-20">
                        <div class="card p-5">
                            <h4 class="mb-2 text-base">07 January 2018</h4>
                            <p class="mb-2 text-gray-500 dark:text-gray-200">
                                <small>08:25 am</small>
                            </p>
                            <p class="text-gray-500 dark:text-gray-200">Jonatha Smith added new milestone
                                <span>
                                    <a class="blue" href="#">crishtian</a>
                                </span>
                                Lorem ipsum dolor sit amet consiquest dio
                            </p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 absolute h-4 w-4 rotate-45 rounded-sm top-7 md:-end-2 md:start-auto -start-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-start">
            <div class="absolute start-10 md:start-1/2 -translate-x-1/2 rtl:translate-x-1/2 mt-6">
                <div class="w-5 h-5 flex justify-center items-center rounded-full bg-gray-300 dark:bg-slate-700">
                    <i class="mgc_stop_circle_line text-sm"></i>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="md:col-start-2 col-span-2">
                    <div class="relative md:ms-10 ms-20">
                        <div class="card p-5">
                            <h4 class="mb-2 text-base">31 December 2017</h4>
                            <p class="mb-2 text-gray-500 dark:text-gray-200">
                                <small>08:25 am</small>
                            </p>
                            <p class="text-gray-500 dark:text-gray-200">Download the new updates of Konrix admin dashboard</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 absolute h-4 w-4 rotate-45 rounded-sm top-7 -start-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:text-end text-start">
            <div class="absolute start-10 md:start-1/2 -translate-x-1/2 rtl:translate-x-1/2 mt-6">
                <div class="w-5 h-5 flex justify-center items-center rounded-full bg-gray-300 dark:bg-slate-700">
                    <i class="mgc_stop_circle_line text-sm"></i>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="md:col-span-1 col-span-2">
                    <div class="relative md:me-10 md:ms-0 ms-20">
                        <div class="card p-5">
                            <h4 class="mb-2 text-base">16 Decembar 2017</h4>
                            <p class="mb-2 text-gray-500 dark:text-gray-200">
                                <small>08:25 am</small>
                            </p>
                            <p class="text-gray-500 dark:text-gray-200">Jonatha Smith added new milestone
                                <span>
                                    <a href="#">prank</a>
                                </span>
                                Lorem ipsum dolor sit amet consiquest dio
                            </p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 absolute h-4 w-4 rotate-45 rounded-sm top-7 md:-end-2 md:start-auto -start-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
