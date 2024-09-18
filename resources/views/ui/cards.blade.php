@extends('layouts.vertical', ['title' => 'Cards', 'sub_title' => 'Component', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid lg:grid-cols-4 gap-6">
        <div>
            <div class="card">
                <img class="w-full h-auto rounded-t-md" src="/images/small/small-1.jpg" alt="Image Description">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                        Card title
                    </h3>
                    <p class="mt-1 text-gray-800 dark:text-gray-400">
                        Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                    <a class="btn bg-primary text-white mt-2" href="#">
                        Go somewhere
                    </a>
                </div>
            </div>
        </div>

        <div>
            <div class="card">
                <img class="w-full h-auto rounded-t-md" src="/images/small/small-2.jpg" alt="Image Description">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                        Card title
                    </h3>
                    <p class="mt-1 text-gray-800 dark:text-gray-400">
                        Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                    <p class="mt-5 text-xs text-gray-500 dark:text-gray-500">
                        Last updated 5 mins ago
                    </p>
                </div>
            </div>
        </div>

        <div>
            <div class="card">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                        Card title
                    </h3>
                    <p class="mt-1 text-gray-800 dark:text-gray-400">
                        Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                    <p class="mt-5 text-xs text-gray-500 dark:text-gray-500">
                        Last updated 5 mins ago
                    </p>
                </div>
                <img class="w-full h-auto rounded-b-md" src="/images/small/small-3.jpg" alt="Image Description">
            </div>
        </div>

        <div>
            <div class="relative bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700 dark:shadow-slate-700/[.7]">
                <img class="w-full h-auto rounded-md" src="/images/small/img-7.jpg" alt="Image Description">
                <div class="absolute top-0 start-0 end-0">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-100">
                            Card title
                        </h3>
                        <p class="mt-1 text-gray-100">
                            Some quick example text to build on the card title and make up the bulk of the card's content.
                        </p>
                        <p class="mt-5 text-xs text-gray-100">
                            Last updated 5 mins ago
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card p-6">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                    Card title
                </h3>
                <p class="mt-1 text-xs font-medium uppercase text-gray-500 dark:text-gray-500">
                    Card subtitle
                </p>
                <p class="mt-2 text-gray-800 dark:text-gray-400">
                    Some quick example text to build on the card title and make up the bulk of the card's content.
                </p>
                <a class="inline-flex items-center gap-2 mt-5 text-sm font-medium text-primary hover:text-sky-700" href="#">
                    Card link
                    <svg class="w-2.5 h-auto" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    </svg>
                </a>
            </div>
        </div>

        <div>
            <div class="card">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                        Card title
                    </h3>
                    <p class="mt-2 text-gray-800 dark:text-gray-400">
                        With supporting text below as a natural lead-in to additional content.
                    </p>
                    <a class="inline-flex items-center gap-2 mt-5 text-sm font-medium text-primary hover:text-sky-700" href="#">
                        Card link
                        <svg class="w-2.5 h-auto" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div>
            <div class="card">
                <div class="p-4 md:p-7">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                        Card title
                    </h3>
                    <p class="mt-2 text-gray-800 dark:text-gray-400">
                        With supporting text below as a natural lead-in to additional content.
                    </p>
                    <a class="  inline-flex items-center gap-2 mt-5 text-sm font-medium text-primary hover:text-sky-700" href="#">
                        Card link
                        <svg class="w-2.5 h-auto" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div>
            <div class="card">
                <div class="p-4 md:p-10">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                        Card title
                    </h3>
                    <p class="mt-2 text-gray-800 dark:text-gray-400">
                        With supporting text below as a natural lead-in to additional content.
                    </p>
                    <a class="inline-flex items-center gap-2 mt-5 text-sm font-medium text-primary hover:text-sky-700" href="#">
                        Card link
                        <svg class="w-2.5 h-auto" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div>
            <div class="card p-6">
                Some quick example text to build on the card title and make up the bulk of the card's content.
            </div>
        </div>

        <div>
            <div class="card">
                <div class="card-header">
                    <p class="text-sm text-gray-500 dark:text-gray-500">
                        Featured
                    </p>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                        Card title
                    </h3>
                    <p class="mt-2 text-gray-800 dark:text-gray-400">
                        With supporting text below as a natural lead-in to additional content.
                    </p>
                    <a class="inline-flex items-center gap-2 mt-5 text-sm font-medium text-primary hover:text-sky-700" href="#">
                        Card link
                        <svg class="w-2.5 h-auto" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div>
            <div class="card">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                        Card title
                    </h3>
                    <p class="mt-2 text-gray-800 dark:text-gray-400">
                        With supporting text below as a natural lead-in to additional content.
                    </p>
                    <a class="inline-flex items-center gap-2 mt-5 text-sm font-medium text-primary hover:text-sky-700" href="#">
                        Card link
                        <svg class="w-2.5 h-auto" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        </svg>
                    </a>
                </div>
                <div class="bg-gray-100 border-t rounded-b-xl py-2.5 px-4 md:py-4 md:px-5 dark:bg-gray-800 dark:border-gray-700">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-500">
                        Last updated 5 mins ago
                    </p>
                </div>
            </div>
        </div>

        <div>
            <div class="card">
                <div class="bg-gray-100 border-b rounded-t-lg pt-3 px-4 md:pt-4 md:px-5 dark:bg-slate-800 dark:border-gray-700">
                    <nav class="flex space-x-2" aria-label="Tabs">
                        <a class="-mb-px py-2.5 px-4 bg-white text-sm font-medium text-center border border-b-transparent text-gray-500 rounded-t-lg hover:text-gray-700 focus:z-10 dark:bg-gray-800 dark:border-gray-700 dark:border-b-gray-800 dark:hover:text-gray-400" href="#">
                            Active
                        </a>

                        <a class="-mb-px py-2.5 px-4 text-sm font-medium text-center border-b text-gray-500 rounded-t-lg hover:text-gray-700 focus:z-10 dark:border-gray-700 dark:hover:text-gray-400" href="#">
                            Link
                        </a>

                        <a class="-mb-px py-2.5 px-4 text-sm font-medium text-center border-b text-gray-500 rounded-t-lg hover:text-gray-700 focus:z-10 dark:border-gray-700 dark:hover:text-gray-400" href="#">
                            Link
                        </a>
                    </nav>
                </div>
                <div class="p-4 text-center md:py-7 md:px-5">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                        Card title
                    </h3>
                    <p class="mt-2 text-gray-800 dark:text-gray-400">
                        With supporting text below as a natural lead-in to additional content.
                    </p>
                    <a class="btn bg-primary text-white mt-2" href="#">
                        Go somewhere
                    </a>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="card">
                <!-- Select (Mobile only) -->
                <div class="sm:hidden">
                    <label for="card-nav-tabs" class="sr-only">Select a nav</label>
                    <select name="card-nav-tabs" id="card-nav-tabs" class="block w-full border-t-0 border-x-0 border-gray-300 rounded-t-xl focus:ring-primary focus:border-primary">
                        <option selected>My Account</option>
                        <option>Company</option>
                        <option>Team Members</option>
                        <option>Billing</option>
                    </select>
                </div>
                <!-- End Select (Mobile only) -->

                <!-- Nav Tabs (Device only) -->
                <div class="hidden sm:block">
                    <nav class="relative z-0 flex border-b rounded-xl divide-x divide-gray-200 dark:border-gray-700 dark:divide-gray-700" aria-label="Tabs">
                        <a class="group relative min-w-0 flex-1 bg-white py-4 px-4 border-b-2 border-b-primary text-gray-900 rounded-tl-xl text-sm font-medium text-center overflow-hidden hover:bg-gray-50 focus:z-10 dark:bg-gray-800 dark:text-gray-300" aria-current="page" href="#">
                            My Account
                        </a>

                        <a class="group relative min-w-0 flex-1 bg-white py-4 px-4 text-gray-500 hover:text-gray-700 text-sm font-medium text-center overflow-hidden hover:bg-gray-50 focus:z-10 dark:bg-gray-800 dark:hover:text-gray-400" href="#">
                            Company
                        </a>

                        <a class="group relative min-w-0 flex-1 bg-white py-4 px-4 text-gray-500 hover:text-gray-700 text-sm font-medium text-center overflow-hidden hover:bg-gray-50 focus:z-10 dark:bg-gray-800 dark:hover:text-gray-400" href="#">
                            Team Members
                        </a>

                        <a class="group relative min-w-0 flex-1 bg-white py-4 px-4 text-gray-500 hover:text-gray-700 rounded-tr-xl text-sm font-medium text-center overflow-hidden hover:bg-gray-50 focus:z-10 dark:bg-gray-800 dark:hover:text-gray-400" href="#">
                            Billing
                        </a>
                    </nav>
                </div>
                <!-- End Nav Tabs (Device only) -->

                <div class="p-4 text-center md:py-7 md:px-5">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                        Card title
                    </h3>
                    <p class="mt-2 text-gray-800 dark:text-gray-400">
                        With supporting text below as a natural lead-in to additional content.
                    </p>
                    <a class="btn bg-primary text-white mt-2" href="#">
                        Go somewhere
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
