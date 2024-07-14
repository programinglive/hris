@extends('layouts.vertical', ['title' => 'Project Create', 'sub_title' => 'Project', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid lg:grid-cols-4 gap-6">
        <div class="col-span-1 flex flex-col gap-6">
            <div class="card p-6">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="card-title">Add Avatar Images</h4>
                    <div class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                        <i class="mgc_add_line"></i>
                    </div>
                </div>

                <form action="#" class="dropzone text-gray-700 dark:text-gray-300 h-52">
                    <div class="fallback">
                        <input name="file" type="file" multiple="multiple">
                    </div>
                    <div class="dz-message needsclick w-full h-full flex items-center justify-center">
                        <i class="mgc_pic_2_line text-8xl"></i>
                    </div>
                </form>

                <div class=""></div>
            </div>

            <div class="card p-6">
                <div class="flex justify-between items-center mb-4">
                    <p class="card-title">Team Members</p>
                    <div class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                        <i class="mgc_compass_line"></i>
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <div class="">
                        <label for="select-label-catagory" class="mb-2 block">Catagory</label>
                        <select id="select-label-catagory" class="form-select">
                            <option selected>Select</option>
                            <option>Mary Scott</option>
                            <option>Holly Campbell</option>
                            <option>Mary Scott</option>
                            <option>Melinda Gills</option>
                            <option>Linda Garza</option>
                        </select>
                    </div>

                    <div class="flex gap-3">
                        <div class="flex -space-x-2">
                            <img class="inline-block h-8 w-8 rounded-full ring-2 ring-gray-200 dark:ring-gray-700" src="/images/users/user-9.jpg" alt="Image Description">
                            <img class="inline-block h-8 w-8 rounded-full ring-2 ring-gray-200 dark:ring-gray-700" src="/images/users/user-8.jpg" alt="Image Description">
                            <img class="inline-block h-8 w-8 rounded-full ring-2 ring-gray-200 dark:ring-gray-700" src="/images/users/user-7.jpg" alt="Image Description">
                            <img class="inline-block h-8 w-8 rounded-full ring-2 ring-gray-200 dark:ring-gray-700" src="/images/users/user-6.jpg" alt="Image Description">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3 space-y-6">
            <div class="card p-6">
                <div class="flex justify-between items-center mb-4">
                    <p class="card-title">Genrel Product Data</p>
                    <div class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                        <i class="mgc_transfer_line"></i>
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <div class="">
                        <label for="project-name" class="mb-2 block">Project Name</label>
                        <input type="email" id="project-name" class="form-input" placeholder="Enter Title" aria-describedby="input-helper-text">
                    </div>

                    <div class="">
                        <label for="project-description" class="mb-2 block">Project Description
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea id="project-description" class="form-input" rows="8"></textarea>
                    </div>

                    <div class="">
                        <label for="product-status" class="mb-2 block">Status
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-x-6">
                            <div class="flex">
                                <input type="radio" name="radio-group" class="form-radio" id="private" checked>
                                <label for="private" class="text-sm text-gray-500 ms-2 dark:text-gray-400">Private</label>
                            </div>

                            <div class="flex">
                                <input type="radio" name="radio-group" class="form-radio" id="team">
                                <label for="team" class="text-sm text-gray-500 ms-2 dark:text-gray-400">Team</label>
                            </div>

                            <div class="flex">
                                <input type="radio" name="radio-group" class="form-radio" id="public">
                                <label for="public" class="text-sm text-gray-500 ms-2 dark:text-gray-400">Public</label>
                            </div>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-3">
                        <div class="">
                            <label for="start-date" class="mb-2 block">Start Date</label>
                            <input type="date" id="start-date" class="form-input"></input>
                        </div>

                        <div class="">
                            <label for="due-date" class="mb-2 block">Due Date</label>
                            <input type="date" id="due-date" class="form-input"></input>
                        </div>
                    </div>

                    <div>
                        <label for="select-label" class="mb-2 block">Label</label>
                        <select id="select-label" class="form-select">
                            <option selected>Open this select menu</option>
                            <option>Medium</option>
                            <option>High</option>
                            <option>Low</option>
                        </select>
                    </div>

                    <div>
                        <label for="budget" class="mb-2 block">Budget</label>
                        <input type="text" id="budget" class="form-input" placeholder="Enter Project Budget"></input>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 mt-5">
                <div class="flex justify-end gap-3">
                    <button type="button" class="inline-flex items-center rounded-md border border-transparent bg-red-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none">
                        Cancle
                    </button>
                    <button type="button" class="inline-flex items-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite(['resources/js/pages/form-fileupload.js'])
@endsection
