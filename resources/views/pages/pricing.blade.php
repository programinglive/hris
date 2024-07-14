@extends('layouts.vertical', ['title' => 'Pricing', 'sub_title' => 'Pages', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <!-- Pricing -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Title -->
        <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
            <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Find the right plan for your team</h2>
            <p class="mt-1 text-gray-600 dark:text-gray-400">Pay as you go service, cancel anytime.</p>
        </div>
        <!-- End Title -->

        <!-- Grid -->
        <div class="mt-12 relative before:absolute before:inset-0 before:-z-[1] before:bg-[radial-gradient(closest-side,#cbd5e1,transparent)] dark:before:bg-[radial-gradient(closest-side,#334155,transparent)]">
            <div class="grid gap-px sm:grid-cols-2 lg:grid-cols-4 lg:items-center">
                <!-- Card -->
                <div class="flex flex-col h-full text-center">
                    <div class="bg-white pt-8 pb-5 px-8 dark:bg-gray-800">
                        <h4 class="font-medium text-lg text-gray-800 dark:text-gray-200">Free</h4>
                    </div>

                    <div class="h-full bg-white lg:mt-px lg:py-5 px-8 dark:bg-gray-800">
                        <span class="mt-7 font-bold text-5xl text-gray-800 dark:text-gray-200">
                            Free
                        </span>
                    </div>

                    <div class="bg-white flex justify-center lg:mt-px pt-7 px-8 dark:bg-gray-800">
                        <ul class="space-y-2.5 text-center text-sm">
                            <li class="text-gray-800 dark:text-gray-400">
                                1 user
                            </li>

                            <li class="text-gray-800 dark:text-gray-400">
                                Plan features
                            </li>

                            <li class="text-gray-800 dark:text-gray-400">
                                Product support
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white py-8 px-8 dark:bg-gray-800">
                        <a class="btn btn-lg border-primary text-primary hover:bg-primary hover:text-white" href="#">
                            Sign up
                        </a>
                    </div>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div class="flex flex-col h-full text-center">
                    <div class="bg-white pt-8 pb-5 px-8 dark:bg-gray-800">
                        <h4 class="font-medium text-lg text-gray-800 dark:text-gray-200">Startup</h4>
                    </div>

                    <div class="h-full bg-white lg:mt-px lg:py-5 px-8 dark:bg-gray-800">
                        <span class="mt-7 font-bold text-5xl text-gray-800 dark:text-gray-200">
                            <span class="font-bold text-2xl -me-2">$</span>
                            39
                        </span>
                    </div>

                    <div class="bg-white flex justify-center lg:mt-px pt-7 px-8 dark:bg-gray-800">
                        <ul class="space-y-2.5 text-center text-sm">
                            <li class="text-gray-800 dark:text-gray-400">
                                2 users
                            </li>

                            <li class="text-gray-800 dark:text-gray-400">
                                Plan features
                            </li>

                            <li class="text-gray-800 dark:text-gray-400">
                                Product support
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white py-8 px-8 dark:bg-gray-800">
                        <a class="btn btn-lg border-primary text-primary hover:bg-primary hover:text-white" href="#">
                            Sign up
                        </a>
                    </div>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div class="flex flex-col h-full text-center">
                    <div class="bg-white pt-8 pb-5 px-8 dark:bg-gray-800">
                        <h4 class="font-medium text-lg text-gray-800 dark:text-gray-200">Team</h4>
                    </div>

                    <div class="h-full bg-white lg:mt-px lg:py-5 px-8 dark:bg-gray-800">
                        <span class="mt-7 font-bold text-5xl text-gray-800 dark:text-gray-200">
                            <span class="font-bold text-2xl -me-2">$</span>
                            89
                        </span>
                    </div>

                    <div class="bg-white flex justify-center lg:mt-px pt-7 px-8 dark:bg-gray-800">
                        <ul class="space-y-2.5 text-center text-sm">
                            <li class="text-gray-800 dark:text-gray-400">
                                5 users
                            </li>

                            <li class="text-gray-800 dark:text-gray-400">
                                Plan features
                            </li>

                            <li class="text-gray-800 dark:text-gray-400">
                                Product support
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white py-8 px-8 dark:bg-gray-800">
                        <a class="btn btn-lg border-primary text-primary hover:bg-primary hover:text-white" href="#">
                            Sign up
                        </a>
                    </div>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div class="flex flex-col h-full text-center">
                    <div class="bg-white pt-8 pb-5 px-8 dark:bg-gray-800">
                        <h4 class="font-medium text-lg text-gray-800 dark:text-gray-200">Enterprise</h4>
                    </div>

                    <div class="h-full bg-white lg:mt-px lg:py-5 px-8 dark:bg-gray-800">
                        <span class="mt-7 font-bold text-5xl text-gray-800 dark:text-gray-200">
                            <span class="font-bold text-2xl -me-2">$</span>
                            149
                        </span>
                    </div>

                    <div class="bg-white flex justify-center lg:mt-px pt-7 px-8 dark:bg-gray-800">
                        <ul class="space-y-2.5 text-center text-sm">
                            <li class="text-gray-800 dark:text-gray-400">
                                10 users
                            </li>

                            <li class="text-gray-800 dark:text-gray-400">
                                Plan features
                            </li>

                            <li class="text-gray-800 dark:text-gray-400">
                                Product support
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white py-8 px-8 dark:bg-gray-800">
                        <a class="btn btn-lg border-primary text-primary hover:bg-primary hover:text-white" href="#">
                            Sign up
                        </a>
                    </div>
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Grid -->
    </div>
    <!-- End Pricing -->
@endsection
