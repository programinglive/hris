@extends('layouts.vertical', ['title' => 'Project List', 'sub_title' => 'Project', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="flex flex-auto flex-col">

        <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h5 class="card-title">Web Design</h5>
                        <div class="bg-success text-xs text-white rounded-md py-1 px-1.5 font-medium" role="alert">
                            <span>Completed</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="py-3 px-6">
                        <h5 class="my-2">
                            <a href="#" class="text-slate-900 dark:text-slate-200">Landing page Design</a>
                        </h5>
                        <p class="text-gray-500 text-sm mb-9">If several languages coalesce, the grammar of the resulting language is more regular.</p>

                        <div class="flex -space-x-2">
                            <a href="javascript: void(0);">
                                <img class="inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-700" src="/images/users/avatar-2.jpg" alt="Image Description">
                            </a>
                            <a href="javascript: void(0);">
                                <img class="inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-700" src="/images/users/avatar-3.jpg" alt="Image Description">
                            </a>
                            <a href="javascript: void(0);">
                                <div class="relative inline-flex">
                                    <button class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-gray-200 border-2 border-white font-medium text-gray-700 shadow-sm align-middle dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 transition-all text-sm">
                                        <span class="font-medium leading-none">2+</span>
                                    </button>
                                </div>
                            </a>

                        </div>
                    </div>

                    <div class="border-t p-5 border-gray-300 dark:border-gray-700">
                        <div class="grid lg:grid-cols-2 gap-4">
                            <div class="flex items-center justify-between gap-2">
                                <a href="#" class="text-sm">
                                    <i class="mgc_calendar_line text-lg me-2"></i>
                                    <span class="align-text-bottom">15 Dec</span>
                                </a>

                                <a href="#" class="text-sm">
                                    <i class="mgc_align_justify_line text-lg me-2"></i>
                                    <span class="align-text-bottom">56</span>
                                </a>

                                <a href="#" class="text-sm">
                                    <i class="mgc_comment_line text-lg me-2"></i>
                                    <span class="align-text-bottom">224</span>
                                </a>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                                    <div class="bg-success h-1.5 rounded-full dark:bg-success w-2/3"></div>
                                </div>
                                <span>66%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h5 class="card-title">Android</h5>
                        <div class="bg-warning/60 text-xs text-white rounded-md py-1 px-1.5 font-medium" role="alert">
                            <span>Pending</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="py-3 px-6">
                        <h5 class="my-2">
                            <a href="#" class="text-slate-900 dark:text-slate-200">App Design and Develop</a>
                        </h5>
                        <p class="text-gray-500 text-sm mb-9">To achieve this, it would be necessary to have uniform grammar and more common words.</p>

                        <div class="flex -space-x-2">
                            <a href="javascript: void(0);">
                                <img class="inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-700" src="/images/users/avatar-4.jpg" alt="Image Description">
                            </a>
                            <a href="javascript: void(0);">
                                <img class="inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-700" src="/images/users/avatar-5.jpg" alt="Image Description">
                            </a>
                            <a href="javascript: void(0);">
                                <img class="inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-700" src="/images/users/avatar-6.jpg" alt="Image Description">
                            </a>
                            <a href="javascript: void(0);">
                                <img class="inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-700" src="/images/users/avatar-7.jpg" alt="Image Description">
                            </a>
                            <a href="javascript: void(0);">
                                <div class="relative inline-flex">
                                    <button id="" class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-gray-200 border-2 border-white font-medium text-gray-700 shadow-sm align-middle dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 transition-all text-sm">
                                        <span class="font-medium leading-none">4+</span>
                                    </button>
                                </div>
                            </a>

                        </div>
                    </div>

                    <div class="border-t p-5 border-gray-300 dark:border-gray-700">
                        <div class="grid lg:grid-cols-2 gap-4">
                            <div class="flex items-center justify-between gap-2">
                                <a href="#" class="text-sm">
                                    <i class="mgc_calendar_line text-lg me-2"></i>
                                    <span class="align-text-bottom">28 nov</span>
                                </a>

                                <a href="#" class="text-sm">
                                    <i class="mgc_align_justify_line text-lg me-2"></i>
                                    <span class="align-text-bottom">62</span>
                                </a>

                                <a href="#" class="text-sm">
                                    <i class="mgc_comment_line text-lg me-2"></i>
                                    <span class="align-text-bottom">196</span>
                                </a>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                                    <div class="bg-warning h-1.5 rounded-full w-1/3"></div>
                                </div>
                                <span>33%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h5 class="card-title">Web Design</h5>
                        <div class="bg-success text-xs text-white rounded-md py-1 px-1.5 font-medium" role="alert">
                            <span>Frontend Complited</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="py-3 px-6">
                        <h5 class="my-2">
                            <a href="#" class="text-slate-900 dark:text-slate-200">New Admin Design</a>
                        </h5>
                        <p class="text-gray-500 text-sm mb-9">If several languages coalesce, the grammar of the resulting language is more regular.</p>

                        <div class="flex -space-x-2">
                            <a href="javascript: void(0);">
                                <img class="inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-700" src="/images/users/avatar-9.jpg" alt="Image Description">
                            </a>
                            <a href="javascript: void(0);">
                                <img class="inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-700" src="/images/users/avatar-10.jpg" alt="Image Description">
                            </a>
                            <a href="javascript: void(0);">
                                <img class="inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-700" src="/images/users/avatar-1.jpg" alt="Image Description">
                            </a>
                            <a href="javascript: void(0);">
                                <div class="relative inline-flex">
                                    <button id="" class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-gray-200 border-2 border-white font-medium text-gray-700 shadow-sm align-middle dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 transition-all text-sm">
                                        <span class="font-medium leading-none">3+</span>
                                    </button>
                                </div>
                            </a>

                        </div>
                    </div>

                    <div class="border-t p-5 border-gray-300 dark:border-gray-700">
                        <div class="grid lg:grid-cols-2 gap-4">
                            <div class="flex items-center justify-between gap-2">
                                <a href="#" class="text-sm">
                                    <i class="mgc_calendar_line text-lg me-2"></i>
                                    <span class="align-text-bottom">19 Nov</span>
                                </a>

                                <a href="#" class="text-sm">
                                    <i class="mgc_align_justify_line text-lg me-2"></i>
                                    <span class="align-text-bottom">69</span>
                                </a>

                                <a href="#" class="text-sm">
                                    <i class="mgc_comment_line text-lg me-2"></i>
                                    <span class="align-text-bottom">102</span>
                                </a>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                                    <div class="bg-success h-1.5 rounded-full w-1/2"></div>
                                </div>
                                <span>50%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h5 class="card-title">Android</h5>
                        <div class="bg-warning/60 text-xs text-white rounded-md py-1 px-1.5 font-medium" role="alert">
                            <span>Pending</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="py-3 px-6">
                        <h5 class="my-2">
                            <a href="#" class="text-slate-900 dark:text-slate-200">Custom Software Development</a>
                        </h5>
                        <p class="text-gray-500 text-sm mb-9">Their separate existence is a myth. For science, music, sport, etc uses the vocabulary.</p>

                        <div class="flex -space-x-2">
                            <a href="javascript: void(0);">
                                <img class="inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-700" src="/images/users/avatar-2.jpg" alt="Image Description">
                            </a>
                            <a href="javascript: void(0);">
                                <img class="inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-700" src="/images/users/avatar-8.jpg" alt="Image Description">
                            </a>
                            <a href="javascript: void(0);">
                                <img class="inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-700" src="/images/users/avatar-9.jpg" alt="Image Description">
                            </a>
                        </div>
                    </div>

                    <div class="border-t p-5 border-gray-300 dark:border-gray-700">
                        <div class="grid lg:grid-cols-2 gap-4">
                            <div class="flex items-center justify-between gap-2">
                                <a href="#" class="text-sm">
                                    <i class="mgc_calendar_line text-lg me-2"></i>
                                    <span class="align-text-bottom">02 Nov</span>
                                </a>

                                <a href="#" class="text-sm">
                                    <i class="mgc_align_justify_line text-lg me-2"></i>
                                    <span class="align-text-bottom">72</span>
                                </a>

                                <a href="#" class="text-sm">
                                    <i class="mgc_comment_line text-lg me-2"></i>
                                    <span class="align-text-bottom">184</span>
                                </a>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                                    <div class="bg-warning/80 h-1.5 rounded-full w-1/4"></div>
                                </div>
                                <span>25%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h5 class="card-title">Web Design</h5>
                        <div class="bg-success text-xs text-white rounded-md py-1 px-1.5 font-medium" role="alert">
                            <span>Completed</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="py-3 px-6">
                        <h5 class="my-2">
                            <a href="#" class="text-slate-900 dark:text-slate-200">Brand logo design</a>
                        </h5>
                        <p class="text-gray-500 text-sm mb-9">Everyone realizes why a new common language refuse to pay expensive translators.</p>

                        <div class="flex -space-x-2">
                            <a href="javascript: void(0);">
                                <img class="inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-700" src="/images/users/avatar-6.jpg" alt="Image Description">
                            </a>
                        </div>
                    </div>

                    <div class="border-t p-5 border-gray-300 dark:border-gray-700">
                        <div class="grid lg:grid-cols-2 gap-4">
                            <div class="flex items-center justify-between gap-2">
                                <a href="#" class="text-sm">
                                    <i class="mgc_calendar_line text-lg me-2"></i>
                                    <span class="align-text-bottom">19 Nov</span>
                                </a>

                                <a href="#" class="text-sm">
                                    <i class="mgc_align_justify_line text-lg me-2"></i>
                                    <span class="align-text-bottom">69</span>
                                </a>

                                <a href="#" class="text-sm">
                                    <i class="mgc_comment_line text-lg me-2"></i>
                                    <span class="align-text-bottom">102</span>
                                </a>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                                    <div class="bg-danger h-1.5 rounded-full w-3/4"></div>
                                </div>
                                <span>75%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h5 class="card-title">Web Design</h5>
                        <div class="bg-success text-xs text-white rounded-md py-1 px-1.5 font-medium" role="alert">
                            <span>Completed</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="py-3 px-6">
                        <h5 class="my-2">
                            <a href="#" class="text-slate-900 dark:text-slate-200">Website Redesign</a>
                        </h5>
                        <p class="text-gray-500 text-sm mb-9">The languages only differ in their grammar pronunciation and their most common words.</p>

                        <div class="flex -space-x-2">
                            <a href="javascript: void(0);">
                                <img class="inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-700" src="/images/users/avatar-3.jpg" alt="Image Description">
                            </a>
                            <a href="javascript: void(0);">
                                <img class="inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-700" src="/images/users/avatar-9.jpg" alt="Image Description">
                            </a>
                        </div>
                    </div>

                    <div class="border-t p-5 border-gray-300 dark:border-gray-700">
                        <div class="grid lg:grid-cols-2 gap-4">
                            <div class="flex items-center justify-between gap-2">
                                <a href="#" class="text-sm">
                                    <i class="mgc_calendar_line text-lg me-2"></i>
                                    <span class="align-text-bottom">19 Nov</span>
                                </a>

                                <a href="#" class="text-sm">
                                    <i class="mgc_align_justify_line text-lg me-2"></i>
                                    <span class="align-text-bottom">69</span>
                                </a>

                                <a href="#" class="text-sm">
                                    <i class="mgc_comment_line text-lg me-2"></i>
                                    <span class="align-text-bottom">102</span>
                                </a>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                                    <div class="bg-info h-1.5 rounded-full w-1/2"></div>
                                </div>
                                <span>50%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-6">
            <button type="button" class="btn bg-transparent border-gray-300 dark:border-gray-700">
                <i class="mgc_loading_4_line me-2 animate-spin"></i>
                <span>Load More</span>
            </button>
        </div>

    </div>
@endsection
