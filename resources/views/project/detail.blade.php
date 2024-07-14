@extends('layouts.vertical', ['title' => 'Project Detail', 'sub_title' => 'Project', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-3">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Project Overview</h6>
                </div>

                <div class="p-6">
                    <div class="grid lg:grid-cols-4 gap-6">
                        <!-- stat 1 -->
                        <div class="flex items-center gap-5">
                            <i data-feather="grid" class="h-10 w-10"></i>
                            <div class="">
                                <h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">210</h4>
                                <span class="text-sm">Total Tasks</span>
                            </div>
                        </div>

                        <!-- stat 2 -->
                        <div class="flex items-center gap-5">
                            <i data-feather="check-square" class="h-10 w-10"></i>
                            <div class="">
                                <h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">121</h4>
                                <span class="text-sm">Total Tasks Completed</span>
                            </div>
                        </div>

                        <!-- stat 3 -->
                        <div class="flex items-center gap-5">
                            <i data-feather="users" class="h-10 w-10"></i>
                            <div class="">
                                <h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">12</h4>
                                <span class="text-sm">Total Team Size</span>
                            </div>
                        </div>
                        <!-- stat 3 -->
                        <div class="flex items-center gap-5">
                            <i data-feather="clock" class="h-10 w-10"></i>
                            <div class="">
                                <h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">2500</h4>
                                <span class="text-sm">Total Hours Spent</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">About Project</h4>
                </div>

                <div class="p-6">
                    <div>
                        <p class="text-gray-500 mb-4 text-sm">To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth.</p>
                        <p class="text-gray-500 mb-4 text-sm">Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators. To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words. If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual languages.</p>
                        <ul class="ps-9 mb-9 list-disc">
                            <li>Quis autem vel eum iure</li>
                            <li>Ut enim ad minima veniam</li>
                            <li>Et harum quidem rerum</li>
                            <li>Nam libero cum soluta</li>
                        </ul>

                        <div class="mb-6">
                            <h6 class="font-medium my-3 text-gray-800">Tags</h6>
                            <div class="uppercase flex gap-4">
                                <a href="#" class="inline-flex items-center font-semibold py-1 px-2 rounded text-xs bg-primary/20 text-primary">Html</a>
                                <a href="#" class="inline-flex items-center font-semibold py-1 px-2 rounded text-xs bg-primary/20 text-primary">Css</a>
                                <a href="#" class="inline-flex items-center font-semibold py-1 px-2 rounded text-xs bg-primary/20 text-primary">Tailwind</a>
                                <a href="#" class="inline-flex items-center font-semibold py-1 px-2 rounded text-xs bg-primary/20 text-primary">JavaScript</a>
                            </div>
                        </div>

                        <div class="grid grid-cols-4 gap-6">
                            <div class="">
                                <div class="">
                                    <p class="mb-3 text-sm uppercase font-medium">
                                        <i class="uil-calender text-red-500 text-base"></i>
                                        Start Date
                                    </p>
                                    <h5 class="text-base text-gray-700 dark:text-gray-300 font-medium">15 July, 2019</h5>
                                </div>
                            </div>
                            <div class="">
                                <p class="mb-3 text-sm uppercase font-medium">
                                    <i class="uil-calendar-slash text-red-500 text-base"></i>
                                    Due Date
                                </p>
                                <h5 class="text-base text-gray-700 dark:text-gray-300 font-medium">21 Nov, 2020</h5>
                            </div>
                            <div class="">
                                <p class="mb-3 text-sm uppercase font-medium">
                                    <i class="uil-dollar-alt text-red-500 text-base"></i>
                                    Budget
                                </p>
                                <h5 class="text-base text-gray-700 dark:text-gray-300 font-medium">$13,250</h5>
                            </div>

                            <div class="">
                                <p class="mb-3 text-sm uppercase font-medium">
                                    <i class="uil-user text-red-500 text-base"></i>
                                    Owner
                                </p>
                                <h5 class="text-base text-gray-700 dark:text-gray-300 font-medium">Rick Perry</h5>
                            </div>
                        </div>


                        <div class="mt-6">
                            <h6 class="text-sm text-gray-800 font-medium mb-3">Assign To</h6>
                            <div class="flex flex-wrap -space-x-2">
                                <a href="javascript: void(0);">
                                    <img class="inline-block h-10 w-10 rounded-full border-2 border-white dark:border-gray-800" src="/images/users/avatar-2.jpg" alt="Image Description">
                                </a>
                                <a href="javascript: void(0);">
                                    <img class="inline-block h-10 w-10 rounded-full border-2 border-white dark:border-gray-800" src="/images/users/avatar-3.jpg" alt="Image Description">
                                </a>
                                <a href="javascript: void(0);">
                                    <img class="inline-block h-10 w-10 rounded-full border-2 border-white dark:border-gray-800" src="/images/users/avatar-9.jpg" alt="Image Description">
                                </a>
                                <a href="javascript: void(0);">
                                    <img class="inline-block h-10 w-10 rounded-full border-2 border-white dark:border-gray-800" src="/images/users/avatar-10.jpg" alt="Image Description">
                                </a>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h6 class="text-gray-800 font-medium mb-3">Attached Files</h6>

                            <div class="grid md:grid-cols-4 gap-3">
                                <div class="p-2 border border-gray-200 dark:border-gray-700 rounded mb-2">
                                    <div class="flex items-center">
                                        <div class="h-9 w-9 rounded flex justify-center items-center text-primary bg-primary/20 me-3">
                                            <i class="mgc_file_new_line text-xl"></i>
                                        </div>
                                        <div class="">
                                            <a href="#" class="text-sm font-medium">Landing 1.psd</a>
                                        </div>
                                        <div>
                                            <a href="#" class="p-2">
                                                <i class="mgc_download_line text-xl"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-2 border border-gray-200 dark:border-gray-700 rounded mb-2">
                                    <div class="flex items-center">
                                        <div class="h-9 w-9 rounded flex justify-center items-center text-primary bg-primary/20 me-3">
                                            <i class="mgc_file_new_line text-xl"></i>
                                        </div>
                                        <div class="">
                                            <a href="#" class="text-sm font-medium">Landing 2.psd</a>
                                        </div>
                                        <div>
                                            <a href="#" class="p-2">
                                                <i class="mgc_download_line text-xl"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Project Activities</h6>
                </div>
                <div class="table overflow-hidden w-full">
                    <div class="divide-y divide-gray-300 dark:divide-gray-700 overflow-auto w-full max-w-full">
                        <div class="p-3">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="/images/users/avatar-1.jpg" alt="">
                                </div>
                                <div class="flex-grow truncate">
                                    <div class="font-medium text-gray-900 dark:text-gray-300">James Walton</div>
                                    <p class="text-gray-600 dark:text-gray-400">jameswalton@gmail.com</p>
                                </div>
                                <div class="px-3 py-1 md:block hidden rounded text-xs font-medium">Wire Frame</div>
                                <div class="ms-auto">
                                    <div class=" px-3 py-1 rounded text-xs font-medium bg-primary/25 text-primary">Working</div>
                                </div>
                            </div>
                        </div>

                        <div class="p-3">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="/images/users/avatar-2.jpg" alt="">
                                </div>
                                <div class="flex-grow truncate">
                                    <div class="font-medium text-gray-900 dark:text-gray-300">Jerry Geiger</div>
                                    <p class="text-gray-600 dark:text-gray-400">jerrygeiger@gmail.com</p>
                                </div>
                                <div class="px-3 py-1 md:block hidden rounded text-xs font-medium">Figma Design</div>
                                <div class="ms-auto">
                                    <div class=" px-3 py-1 rounded text-xs font-medium bg-success/25 text-success">Completed</div>
                                </div>
                            </div>
                        </div>

                        <div class="p-3">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="/images/users/avatar-3.jpg" alt="">
                                </div>
                                <div class="flex-grow truncate">
                                    <div class="font-medium text-gray-900 dark:text-gray-300">Mark Adams</div>
                                    <p class="text-gray-600 dark:text-gray-400">markadams@gmail.com</p>
                                </div>
                                <div class="px-3 py-1 md:block hidden rounded text-xs font-medium">Frontend</div>
                                <div class="ms-auto">
                                    <div class=" px-3 py-1 rounded text-xs font-medium bg-danger/25 text-danger">Stop</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="/images/users/avatar-9.jpg" alt="">
                                </div>
                                <div class="flex-grow truncate">
                                    <div class="font-medium text-gray-900 dark:text-gray-300">Lindsay Walton</div>
                                    <p class="text-gray-600 dark:text-gray-400">lindsaywalton@gmail.com</p>
                                </div>
                                <div class="px-3 py-1 md:block hidden rounded text-xs font-medium">Backend</div>
                                <div class="ms-auto">
                                    <div class=" px-3 py-1 rounded text-xs font-medium bg-primary/25 text-primary">Working</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="/images/users/avatar-5.jpg" alt="">
                                </div>
                                <div class="flex-grow truncate">
                                    <div class="font-medium text-gray-900 dark:text-gray-300">Jhon Otto</div>
                                    <p class="text-gray-600 dark:text-gray-400">jhonotto@gmail.com</p>
                                </div>
                                <div class="px-3 py-1 md:block hidden rounded text-xs font-medium">Support</div>
                                <div class="ms-auto">
                                    <div class=" px-3 py-1 rounded text-xs font-medium bg-danger/25 text-danger">Stop</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="/images/users/avatar-6.jpg" alt="">
                                </div>
                                <div class="flex-grow truncate">
                                    <div class="font-medium text-gray-900 dark:text-gray-300">Barak Obama</div>
                                    <p class="text-gray-600 dark:text-gray-400">barakobama@gmail.com</p>
                                </div>
                                <div class="px-3 py-1 md:block hidden rounded text-xs font-medium">Testing</div>
                                <div class="ms-auto">
                                    <div class=" px-3 py-1 rounded text-xs font-medium bg-success/25 text-success">Completed</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="/images/users/avatar-7.jpg" alt="">
                                </div>
                                <div class="flex-grow truncate">
                                    <div class="font-medium text-gray-900 dark:text-gray-300">Oliver Williams</div>
                                    <p class="text-gray-600 dark:text-gray-400">oliverwilliams@gmail.com</p>
                                </div>
                                <div class="px-3 py-1 md:block hidden rounded text-xs font-medium">Marketing</div>
                                <div class="ms-auto">
                                    <div class=" px-3 py-1 rounded text-xs font-medium bg-primary/25 text-primary">Working</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
