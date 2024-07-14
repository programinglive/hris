@extends('layouts.vertical', ['title' => 'Modals', 'sub_title' => 'Component', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
<div class="grid 2xl:grid-cols-2 grid-cols-1 gap-6">
    <div class="card">
        <div class="card-header">
            <div class="flex justify-between items-center">
                <h4 class="card-title">Example</h4>

                <div class="flex items-center gap-2">
                    <button type="button" class="btn-code" data-fc-type="collapse"
                        data-fc-target="ExampalModalHtml">
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
                <button class="btn bg-primary text-white" data-fc-target="default-modal"
                    data-fc-type="modal" type="button">
                    Show Modal
                </button>

                <div id="default-modal"
                    class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
                    <div
                        class="fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
                        <div
                            class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                            <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                                Modal Title
                            </h3>
                            <button
                                class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200"
                                data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="px-4 py-8 overflow-y-auto">
                            <p class="text-gray-800 dark:text-gray-200">
                                This is a wider card with supporting text below as a natural lead-in to
                                additional
                                content.
                            </p>
                        </div>
                        <div
                            class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                            <button
                                class="btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all"
                                data-fc-dismiss type="button">Close</button>
                            <a class="btn bg-primary text-white" href="javascript:void(0)">Save</a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="ExampalModalHtml"
                class="hidden w-full overflow-hidden transition-[height] duration-300">
                <pre class="language-html h-56">
                    <code>
                        &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-target=&quot;default-modal&quot; data-fc-type=&quot;modal&quot; type=&quot;button&quot;&gt;
                            Show Modal
                        &lt;/button&gt;

                        &lt;div id=&quot;default-modal&quot; class=&quot;w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden&quot;&gt;
                            &lt;div class=&quot;fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700&quot;&gt;
                                &lt;div class=&quot;flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700&quot;&gt;
                                    &lt;h3 class=&quot;font-medium text-gray-800 dark:text-white text-lg&quot;&gt;
                                        Modal Title
                                    &lt;/h3&gt;
                                    &lt;button class=&quot;inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200&quot;
                                            data-fc-dismiss type=&quot;button&quot;&gt;
                                        &lt;span class=&quot;material-symbols-rounded&quot;&gt;close&lt;/span&gt;
                                    &lt;/button&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;px-4 py-8 overflow-y-auto&quot;&gt;
                                    &lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
                                        This is a wider card with supporting text below as a natural lead-in to additional
                                        content.
                                    &lt;/p&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700&quot;&gt;
                                    &lt;button class=&quot;btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all&quot; data-fc-dismiss type=&quot;button&quot;&gt;Close
                                    &lt;/button&gt;
                                    &lt;a class=&quot;btn bg-primary text-white&quot; href=&quot;javascript:void(0)&quot;&gt;Save&lt;/a&gt;
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
                <h4 class="card-title">Auto Targeting</h4>

                <div class="flex items-center gap-2">
                    <button type="button" class="btn-code" data-fc-type="collapse"
                        data-fc-target="Slide_Down_Animation_Modal_Html">
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
                <button class="btn bg-primary text-white" data-fc-target="default-modal"
                    data-fc-type="modal" type="button">
                    Show Modal
                </button>

                <div id="default-modal"
                    class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
                    <div
                        class="fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
                        <div
                            class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                            <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                                Modal Title
                            </h3>
                            <button
                                class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200"
                                data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="px-4 py-8 overflow-y-auto">
                            <p class="text-gray-800 dark:text-gray-200">
                                This is a wider card with supporting text below as a natural lead-in to
                                additional
                                content.
                            </p>
                        </div>
                        <div
                            class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                            <button
                                class="btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all"
                                data-fc-dismiss type="button">Close</button>
                            <a class="btn bg-primary text-white" href="javascript:void(0)">Save</a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="Slide_Down_Animation_Modal_Html"
                class="hidden w-full overflow-hidden transition-[height] duration-300">
                <pre class="language-html h-56">
                    <code>
                        &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-target=&quot;default-modal&quot; data-fc-type=&quot;modal&quot; type=&quot;button&quot;&gt;
                            Show Modal
                        &lt;/button&gt;

                        &lt;div id=&quot;default-modal&quot;
                            class=&quot;w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden&quot;&gt;
                            &lt;div class=&quot;fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700&quot;&gt;
                                &lt;div class=&quot;flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700&quot;&gt;
                                    &lt;h3 class=&quot;font-medium text-gray-800 dark:text-white text-lg&quot;&gt;
                                        Modal Title
                                    &lt;/h3&gt;
                                    &lt;button class=&quot;inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200&quot;
                                            data-fc-dismiss type=&quot;button&quot;&gt;
                                        &lt;span class=&quot;material-symbols-rounded&quot;&gt;close&lt;/span&gt;
                                    &lt;/button&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;px-4 py-8 overflow-y-auto&quot;&gt;
                                    &lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
                                        This is a wider card with supporting text below as a natural lead-in to additional
                                        content.
                                    &lt;/p&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700&quot;&gt;
                                    &lt;button class=&quot;btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all&quot; data-fc-dismiss type=&quot;button&quot;&gt;Close&lt;/button&gt;
                                    &lt;a class=&quot;btn bg-primary text-white&quot; href=&quot;javascript:void(0)&quot;&gt;Save&lt;/a&gt;
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
                <h4 class="card-title">Sizes</h4>

                <div class="flex items-center gap-2">
                    <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="SizeModalHtml">
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
            <div class="flex flex-wrap gap-4">
                <button class="btn bg-primary text-white" data-fc-type="modal" type="button">
                    Small
                </button>

                <div class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
                    <div class="sm:max-w-sm fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
                        <div class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                            <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                                Modal Title
                            </h3>
                            <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200"
                                data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="px-4 py-8 overflow-y-auto">
                            <p class="text-gray-800 dark:text-gray-200">
                                This is a wider card with supporting text below as a natural lead-in
                                to additional
                                content.
                            </p>
                        </div>
                        <div class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                            <button
                                class="btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all"
                                data-fc-dismiss type="button">Close
                            </button>
                            <a class="btn bg-primary text-white" href="javascript:void(0)">Save</a>
                        </div>
                    </div>
                </div>

                <button class="btn bg-primary text-white" data-fc-type="modal" type="button">
                    Medium
                </button>

                <div class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
                    <div class="sm:max-w-md fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
                        <div class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                            <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                                Modal Title
                            </h3>
                            <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200"
                                data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="px-4 py-8 overflow-y-auto">
                            <p class="text-gray-800 dark:text-gray-200">
                                This is a wider card with supporting text below as a natural lead-in
                                to additional
                                content.
                            </p>
                        </div>
                        <div class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                            <button class="btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all" data-fc-dismiss type="button">Close</button>
                            <a class="btn bg-primary text-white" href="javascript:void(0)">Save</a>
                        </div>
                    </div>
                </div>

                <button class="btn bg-primary text-white" data-fc-type="modal" type="button">Large</button>

                <div class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
                    <div class="sm:max-w-lg fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
                        <div class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                            <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                                Modal Title
                            </h3>
                            <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200" data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="px-4 py-8 overflow-y-auto">
                            <p class="text-gray-800 dark:text-gray-200">
                                This is a wider card with supporting text below as a natural lead-in
                                to additional
                                content.
                            </p>
                        </div>
                        <div
                            class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                            <button class="btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all" data-fc-dismiss type="button">Close</button>
                            <a class="btn bg-primary text-white" href="javascript:void(0)">Save</a>
                        </div>
                    </div>
                </div>

                <button class="btn bg-primary text-white" data-fc-type="modal" type="button">
                    2X Large
                </button>

                <div class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
                    <div class="sm:max-w-2xl fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
                        <div class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                            <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                                Modal Title
                            </h3>
                            <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200" data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="px-4 py-8 overflow-y-auto">
                            <p class="text-gray-800 dark:text-gray-200">
                                This is a wider card with supporting text below as a natural lead-in
                                to additional
                                content.
                            </p>
                        </div>
                        <div class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                            <button class="btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all" data-fc-dismiss type="button">Close
                            </button>
                            <a class="btn bg-primary text-white" href="javascript:void(0)">Save</a>
                        </div>
                    </div>
                </div>


                <button class="btn bg-primary text-white" data-fc-type="modal" type="button">
                    7X Large
                </button>

                <div class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
                    <div class="sm:max-w-7xl fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
                        <div class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                            <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                                Modal Title
                            </h3>
                            <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200" data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="px-4 py-8 overflow-y-auto">
                            <p class="text-gray-800 dark:text-gray-200">
                                This is a wider card with supporting text below as a natural lead-in
                                to additional
                                content.
                            </p>
                        </div>
                        <div class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                            <button class="btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all" data-fc-dismiss type="button">Close</button>
                            <a class="btn bg-primary text-white" href="javascript:void(0)">Save</a>
                        </div>
                    </div>
                </div>

                <button class="btn bg-primary text-white" data-fc-type="modal" type="button">
                    Full Width
                </button>

                <div class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
                    <div
                        class="fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
                        <div
                            class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                            <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                                Modal Title
                            </h3>
                            <button
                                class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200"
                                data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="px-4 py-8 overflow-y-auto">
                            <p class="text-gray-800 dark:text-gray-200">
                                This is a wider card with supporting text below as a natural lead-in
                                to additional
                                content.
                            </p>
                        </div>
                        <div class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                            <button class="btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all" data-fc-dismiss type="button">Close
                            </button>
                            <a class="btn bg-primary text-white" href="javascript:void(0)">Save</a>
                        </div>
                    </div>
                </div>

                <button class="btn bg-primary text-white" data-fc-type="modal" type="button">
                    Full Height
                </button>

                <div class="w-full h-full fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
                    <div
                        class="fc-modal-open:opacity-100 duration-500 h-screen opacity-0 ease-out transition-all sm:max-w-5xl sm:w-full sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
                        <div
                            class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                            <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                                Modal Title
                            </h3>
                            <button
                                class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200"
                                data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="px-4 py-8 overflow-y-auto">
                            <p class="text-gray-800 dark:text-gray-200">
                                This is a wider card with supporting text below as a natural lead-in
                                to additional
                                content.
                            </p>
                        </div>
                        <div
                            class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                            <button
                                class="btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all"
                                data-fc-dismiss type="button">Close
                            </button>
                            <a class="btn bg-primary text-white"
                                href="javascript:void(0)">Save</a>
                        </div>
                    </div>
                </div>

                <button
                    class="btn bg-primary text-white"
                    data-fc-type="modal" type="button">
                    Full Screen
                </button>

                <div class="w-full h-full fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
                    <div
                        class="fc-modal-open:opacity-100 duration-500 h-screen w-screen opacity-0 ease-out transition-all flex flex-col bg-white p-8 dark:bg-slate-800 dark:border-gray-700">
                        <div class="flex justify-between items-center">
                            <h3 class="font-medium text-gray-800 dark:text-white text-2xl">
                                Modal Title
                            </h3>
                            <button
                                class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200"
                                data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="overflow-y-auto mt-3">
                            <p class="text-gray-800 dark:text-gray-200 text-lg">
                                This is a wider card with supporting text below as a natural lead-in
                                to additional
                                content.
                            </p>
                        </div>
                        <div class="flex justify-end items-center gap-4 mt-auto">
                            <button
                                class="btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all"
                                data-fc-dismiss type="button">Close
                            </button>
                            <a class="btn bg-primary text-white"
                                href="javascript:void(0)">Save</a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="SizeModalHtml"
                class="hidden w-full overflow-hidden transition-[height] duration-300">
                <pre class="language-html h-56">
                    <code>
                        &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-type=&quot;modal&quot; type=&quot;button&quot;&gt;
                            Small
                        &lt;/button&gt;

                        &lt;div class=&quot;w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden&quot;&gt;
                            &lt;div class=&quot;sm:max-w-sm fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700&quot;&gt;
                                &lt;div class=&quot;flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700&quot;&gt;
                                    &lt;h3 class=&quot;font-medium text-gray-800 dark:text-white text-lg&quot;&gt;
                                        Modal Title
                                    &lt;/h3&gt;
                                    &lt;button class=&quot;inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200&quot;
                                        data-fc-dismiss type=&quot;button&quot;&gt;
                                        &lt;span class=&quot;material-symbols-rounded&quot;&gt;close&lt;/span&gt;
                                    &lt;/button&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;px-4 py-8 overflow-y-auto&quot;&gt;
                                    &lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
                                        This is a wider card with supporting text below as a natural lead-in
                                        to additional
                                        content.
                                    &lt;/p&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700&quot;&gt;
                                    &lt;button
                                        class=&quot;btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all&quot;
                                        data-fc-dismiss type=&quot;button&quot;&gt;Close
                                    &lt;/button&gt;
                                    &lt;a class=&quot;btn bg-primary text-white&quot; href=&quot;javascript:void(0)&quot;&gt;Save&lt;/a&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-type=&quot;modal&quot; type=&quot;button&quot;&gt;
                            Medium
                        &lt;/button&gt;

                        &lt;div class=&quot;w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden&quot;&gt;
                            &lt;div class=&quot;sm:max-w-md fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700&quot;&gt;
                                &lt;div class=&quot;flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700&quot;&gt;
                                    &lt;h3 class=&quot;font-medium text-gray-800 dark:text-white text-lg&quot;&gt;
                                        Modal Title
                                    &lt;/h3&gt;
                                    &lt;button class=&quot;inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200&quot;
                                        data-fc-dismiss type=&quot;button&quot;&gt;
                                        &lt;span class=&quot;material-symbols-rounded&quot;&gt;close&lt;/span&gt;
                                    &lt;/button&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;px-4 py-8 overflow-y-auto&quot;&gt;
                                    &lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
                                        This is a wider card with supporting text below as a natural lead-in
                                        to additional
                                        content.
                                    &lt;/p&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700&quot;&gt;
                                    &lt;button class=&quot;btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all&quot; data-fc-dismiss type=&quot;button&quot;&gt;Close&lt;/button&gt;
                                    &lt;a class=&quot;btn bg-primary text-white&quot; href=&quot;javascript:void(0)&quot;&gt;Save&lt;/a&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-type=&quot;modal&quot; type=&quot;button&quot;&gt;Large&lt;/button&gt;

                        &lt;div class=&quot;w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden&quot;&gt;
                            &lt;div class=&quot;sm:max-w-lg fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700&quot;&gt;
                                &lt;div class=&quot;flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700&quot;&gt;
                                    &lt;h3 class=&quot;font-medium text-gray-800 dark:text-white text-lg&quot;&gt;
                                        Modal Title
                                    &lt;/h3&gt;
                                    &lt;button class=&quot;inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200&quot; data-fc-dismiss type=&quot;button&quot;&gt;
                                        &lt;span class=&quot;material-symbols-rounded&quot;&gt;close&lt;/span&gt;
                                    &lt;/button&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;px-4 py-8 overflow-y-auto&quot;&gt;
                                    &lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
                                        This is a wider card with supporting text below as a natural lead-in
                                        to additional
                                        content.
                                    &lt;/p&gt;
                                &lt;/div&gt;
                                &lt;div
                                    class=&quot;flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700&quot;&gt;
                                    &lt;button class=&quot;btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all&quot; data-fc-dismiss type=&quot;button&quot;&gt;Close&lt;/button&gt;
                                    &lt;a class=&quot;btn bg-primary text-white&quot; href=&quot;javascript:void(0)&quot;&gt;Save&lt;/a&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-type=&quot;modal&quot; type=&quot;button&quot;&gt;
                            2X Large
                        &lt;/button&gt;

                        &lt;div class=&quot;w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden&quot;&gt;
                            &lt;div class=&quot;sm:max-w-2xl fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700&quot;&gt;
                                &lt;div class=&quot;flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700&quot;&gt;
                                    &lt;h3 class=&quot;font-medium text-gray-800 dark:text-white text-lg&quot;&gt;
                                        Modal Title
                                    &lt;/h3&gt;
                                    &lt;button class=&quot;inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200&quot; data-fc-dismiss type=&quot;button&quot;&gt;
                                        &lt;span class=&quot;material-symbols-rounded&quot;&gt;close&lt;/span&gt;
                                    &lt;/button&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;px-4 py-8 overflow-y-auto&quot;&gt;
                                    &lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
                                        This is a wider card with supporting text below as a natural lead-in
                                        to additional
                                        content.
                                    &lt;/p&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700&quot;&gt;
                                    &lt;button class=&quot;btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all&quot; data-fc-dismiss type=&quot;button&quot;&gt;Close
                                    &lt;/button&gt;
                                    &lt;a class=&quot;btn bg-primary text-white&quot; href=&quot;javascript:void(0)&quot;&gt;Save&lt;/a&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;


                        &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-type=&quot;modal&quot; type=&quot;button&quot;&gt;
                            7X Large
                        &lt;/button&gt;

                        &lt;div class=&quot;w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden&quot;&gt;
                            &lt;div class=&quot;sm:max-w-7xl fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700&quot;&gt;
                                &lt;div class=&quot;flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700&quot;&gt;
                                    &lt;h3 class=&quot;font-medium text-gray-800 dark:text-white text-lg&quot;&gt;
                                        Modal Title
                                    &lt;/h3&gt;
                                    &lt;button class=&quot;inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200&quot; data-fc-dismiss type=&quot;button&quot;&gt;
                                        &lt;span class=&quot;material-symbols-rounded&quot;&gt;close&lt;/span&gt;
                                    &lt;/button&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;px-4 py-8 overflow-y-auto&quot;&gt;
                                    &lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
                                        This is a wider card with supporting text below as a natural lead-in
                                        to additional
                                        content.
                                    &lt;/p&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700&quot;&gt;
                                    &lt;button class=&quot;btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all&quot; data-fc-dismiss type=&quot;button&quot;&gt;Close&lt;/button&gt;
                                    &lt;a class=&quot;btn bg-primary text-white&quot; href=&quot;javascript:void(0)&quot;&gt;Save&lt;/a&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;button
                            class=&quot;btn bg-primary text-white&quot;
                            data-fc-type=&quot;modal&quot; type=&quot;button&quot;&gt;
                            Full Width
                        &lt;/button&gt;

                        &lt;div class=&quot;w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden&quot;&gt;
                            &lt;div
                                class=&quot;fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700&quot;&gt;
                                &lt;div
                                    class=&quot;flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700&quot;&gt;
                                    &lt;h3 class=&quot;font-medium text-gray-800 dark:text-white text-lg&quot;&gt;
                                        Modal Title
                                    &lt;/h3&gt;
                                    &lt;button
                                        class=&quot;inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200&quot;
                                        data-fc-dismiss type=&quot;button&quot;&gt;
                                        &lt;span class=&quot;material-symbols-rounded&quot;&gt;close&lt;/span&gt;
                                    &lt;/button&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;px-4 py-8 overflow-y-auto&quot;&gt;
                                    &lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
                                        This is a wider card with supporting text below as a natural lead-in
                                        to additional
                                        content.
                                    &lt;/p&gt;
                                &lt;/div&gt;
                                &lt;div
                                    class=&quot;flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700&quot;&gt;
                                    &lt;button
                                        class=&quot;btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all&quot;
                                        data-fc-dismiss type=&quot;button&quot;&gt;Close
                                    &lt;/button&gt;
                                    &lt;a class=&quot;btn bg-primary text-white&quot;
                                        href=&quot;javascript:void(0)&quot;&gt;Save&lt;/a&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;button
                            class=&quot;btn bg-primary text-white&quot;
                            data-fc-type=&quot;modal&quot; type=&quot;button&quot;&gt;
                            Full Height
                        &lt;/button&gt;

                        &lt;div class=&quot;w-full h-full fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden&quot;&gt;
                            &lt;div
                                class=&quot;fc-modal-open:opacity-100 duration-500 h-screen opacity-0 ease-out transition-all sm:max-w-5xl sm:w-full sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700&quot;&gt;
                                &lt;div
                                    class=&quot;flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700&quot;&gt;
                                    &lt;h3 class=&quot;font-medium text-gray-800 dark:text-white text-lg&quot;&gt;
                                        Modal Title
                                    &lt;/h3&gt;
                                    &lt;button
                                        class=&quot;inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200&quot;
                                        data-fc-dismiss type=&quot;button&quot;&gt;
                                        &lt;span class=&quot;material-symbols-rounded&quot;&gt;close&lt;/span&gt;
                                    &lt;/button&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;px-4 py-8 overflow-y-auto&quot;&gt;
                                    &lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
                                        This is a wider card with supporting text below as a natural lead-in
                                        to additional
                                        content.
                                    &lt;/p&gt;
                                &lt;/div&gt;
                                &lt;div
                                    class=&quot;flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700&quot;&gt;
                                    &lt;button
                                        class=&quot;btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all&quot;
                                        data-fc-dismiss type=&quot;button&quot;&gt;Close
                                    &lt;/button&gt;
                                    &lt;a class=&quot;btn bg-primary text-white&quot;
                                        href=&quot;javascript:void(0)&quot;&gt;Save&lt;/a&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;button
                            class=&quot;btn bg-primary text-white&quot;
                            data-fc-type=&quot;modal&quot; type=&quot;button&quot;&gt;
                            Full Screen
                        &lt;/button&gt;

                        &lt;div class=&quot;w-full h-full fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden&quot;&gt;
                            &lt;div
                                class=&quot;fc-modal-open:opacity-100 duration-500 h-screen w-screen opacity-0 ease-out transition-all flex flex-col bg-white p-8 dark:bg-slate-800 dark:border-gray-700&quot;&gt;
                                &lt;div class=&quot;flex justify-between items-center&quot;&gt;
                                    &lt;h3 class=&quot;font-medium text-gray-800 dark:text-white text-2xl&quot;&gt;
                                        Modal Title
                                    &lt;/h3&gt;
                                    &lt;button
                                        class=&quot;inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200&quot;
                                        data-fc-dismiss type=&quot;button&quot;&gt;
                                        &lt;span class=&quot;material-symbols-rounded&quot;&gt;close&lt;/span&gt;
                                    &lt;/button&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;overflow-y-auto mt-3&quot;&gt;
                                    &lt;p class=&quot;text-gray-800 dark:text-gray-200 text-lg&quot;&gt;
                                        This is a wider card with supporting text below as a natural lead-in
                                        to additional
                                        content.
                                    &lt;/p&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;flex justify-end items-center gap-4 mt-auto&quot;&gt;
                                    &lt;button
                                        class=&quot;btn dark:text-gray-200 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 hover:dark:bg-slate-700 transition-all&quot;
                                        data-fc-dismiss type=&quot;button&quot;&gt;Close
                                    &lt;/button&gt;
                                    &lt;a class=&quot;btn bg-primary text-white&quot;
                                        href=&quot;javascript:void(0)&quot;&gt;Save&lt;/a&gt;
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
                <h4 class="card-title">Static Backdrop</h4>

                <div class="flex items-center gap-2">
                    <button type="button" class="btn-code" data-fc-type="collapse"
                        data-fc-target="StaticModalHtml">
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
            <div class="flex gap-2">
                <button class="btn bg-primary text-white" data-fc-behavior="static" data-fc-type="modal" type="button">
                    Show Modal
                </button>

                <div class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
                    <div class="fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
                        <div class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                            <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                                Modal Title
                            </h3>
                            <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200"
                                    data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="px-4 py-8 overflow-y-auto">
                            <p class="text-gray-800 dark:text-gray-200">
                                This is a wider card with supporting text below as a natural lead-in to additional
                                content.
                            </p>
                        </div>
                        <div class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                            <button class="py-2 px-5 inline-flex justify-center items-center gap-2 rounded dark:text-gray-200 border dark:border-slate-700 font-medium hover:bg-slate-100 hover:dark:bg-slate-700 transition-all"
                                    data-fc-dismiss type="button">Close
                            </button>
                            <a class="py-2.5 px-4 inline-flex justify-center items-center gap-2 rounded bg-primary hover:bg-primary-600 text-white"
                                href="javascript:void(0)">Save</a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="StaticModalHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                <pre class="language-html h-56">
                    <code>
                        
                    </code>
                </pre>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <div class="flex justify-between items-center">
                <h4 class="card-title">Vertically & Horizontaly Centered</h4>

                <div class="flex items-center gap-2">
                    <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="CenterdModalHtml">
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
            <div class="flex gap-2">
                <button class="btn bg-primary text-white" data-fc-type="modal" type="button">
                    Show Modal
                </button>

                <div class="fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden w-full h-full min-h-full items-center fc-modal-open:flex">
                    <div class="fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-[opacity] sm:max-w-lg sm:w-full sm:mx-auto  flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
                        <div class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                            <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                                Modal Title
                            </h3>
                            <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200"
                                    data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="px-4 py-8 overflow-y-auto">
                            <p class="text-gray-800 dark:text-gray-200">
                                This is a wider card with supporting text below as a natural lead-in to additional
                                content.
                            </p>
                        </div>
                        <div class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                            <button class="py-2 px-5 inline-flex justify-center items-center gap-2 rounded dark:text-gray-200 border dark:border-slate-700 font-medium hover:bg-slate-100 hover:dark:bg-slate-700 transition-all" data-fc-dismiss type="button">Close</button>
                            <a class="py-2.5 px-4 inline-flex justify-center items-center gap-2 rounded bg-primary hover:bg-primary-600 text-white" href="javascript:void(0)">Save</a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="CenterdModalHtml"
                class="hidden w-full overflow-hidden transition-[height] duration-300">
                <pre class="language-html h-56">
                    <code>
                        &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-type=&quot;modal&quot; type=&quot;button&quot;&gt;
                            Show Modal
                        &lt;/button&gt;

                        &lt;div class=&quot;fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden w-full h-full min-h-full items-center fc-modal-open:flex&quot;&gt;
                            &lt;div class=&quot;fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-[opacity] sm:max-w-lg sm:w-full sm:mx-auto  flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700&quot;&gt;
                                &lt;div class=&quot;flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700&quot;&gt;
                                    &lt;h3 class=&quot;font-medium text-gray-800 dark:text-white text-lg&quot;&gt;
                                        Modal Title
                                    &lt;/h3&gt;
                                    &lt;button class=&quot;inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200&quot;
                                            data-fc-dismiss type=&quot;button&quot;&gt;
                                        &lt;span class=&quot;material-symbols-rounded&quot;&gt;close&lt;/span&gt;
                                    &lt;/button&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;px-4 py-8 overflow-y-auto&quot;&gt;
                                    &lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
                                        This is a wider card with supporting text below as a natural lead-in to additional
                                        content.
                                    &lt;/p&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700&quot;&gt;
                                    &lt;button class=&quot;py-2 px-5 inline-flex justify-center items-center gap-2 rounded dark:text-gray-200 border dark:border-slate-700 font-medium hover:bg-slate-100 hover:dark:bg-slate-700 transition-all&quot; data-fc-dismiss type=&quot;button&quot;&gt;Close&lt;/button&gt;
                                    &lt;a class=&quot;py-2.5 px-4 inline-flex justify-center items-center gap-2 rounded bg-primary hover:bg-primary-600 text-white&quot; href=&quot;javascript:void(0)&quot;&gt;Save&lt;/a&gt;
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
                <h4 class="card-title">Animated</h4>

                <div class="flex items-center gap-2">
                    <button type="button" class="btn-code" data-fc-type="collapse"
                        data-fc-target="AnimatedModalHtml">
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
            <div class="flex gap-2">
                
                <button class="btn bg-primary text-white" data-fc-type="modal" type="button">
                    Scaling
                </button>

                <div class="w-full h-full fixed top-0 left-0 z-50 transition-all duration-500 hidden">
                    <div class="mt-5 fc-modal-open:scale-100 duration-300 scale-90 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto  bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
                        <div class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                            <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                                Modal Title
                            </h3>
                            <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200"
                                    data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="px-4 py-8 overflow-y-auto">
                            <p class="text-gray-800 dark:text-gray-200">
                                This is a wider card with supporting text below as a natural lead-in to additional
                                content.
                            </p>
                        </div>
                        <div class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                            <button class="py-2 px-5 inline-flex justify-center items-center gap-2 rounded dark:text-gray-200 border dark:border-slate-700 font-medium hover:bg-slate-100 hover:dark:bg-slate-700 transition-all"
                                    data-fc-dismiss type="button">Close
                            </button>
                            <a class="py-2.5 px-4 inline-flex justify-center items-center gap-2 rounded bg-primary hover:bg-primary-600 text-white"
                            href="javascript:void(0)">Save</a>
                        </div>
                    </div>
                </div>

                <button class="btn bg-primary text-white" data-fc-type="modal" type="button">
                    Slide Down
                </button>

                <div class="w-full h-full fixed top-0 left-0 z-50 transition-all duration-500 hidden">
                    <div class="fc-modal-open:mt-7 fc-modal-open:opacity-100 fc-modal-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto  bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
                        <div class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                            <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                                Modal Title
                            </h3>
                            <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200"
                                    data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="px-4 py-8 overflow-y-auto">
                            <p class="text-gray-800 dark:text-gray-200">
                                This is a wider card with supporting text below as a natural lead-in to additional
                                content.
                            </p>
                        </div>
                        <div class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                            <button class="py-2 px-5 inline-flex justify-center items-center gap-2 rounded dark:text-gray-200 border dark:border-slate-700 font-medium hover:bg-slate-100 hover:dark:bg-slate-700 transition-all"
                                    data-fc-dismiss type="button">Close
                            </button>
                            <a class="py-2.5 px-4 inline-flex justify-center items-center gap-2 rounded bg-primary hover:bg-primary-600 text-white"
                            href="javascript:void(0)">Save</a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="AnimatedModalHtml"
                class="hidden w-full overflow-hidden transition-[height] duration-300">
                <pre class="language-html h-56">
                    <code>
                        &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-type=&quot;modal&quot; type=&quot;button&quot;&gt;
                            Scaling
                        &lt;/button&gt;

                        &lt;div class=&quot;w-full h-full fixed top-0 left-0 z-50 transition-all duration-500 hidden&quot;&gt;
                            &lt;div class=&quot;mt-5 fc-modal-open:scale-100 duration-300 scale-90 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto  bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700&quot;&gt;
                                &lt;div class=&quot;flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700&quot;&gt;
                                    &lt;h3 class=&quot;font-medium text-gray-800 dark:text-white text-lg&quot;&gt;
                                        Modal Title
                                    &lt;/h3&gt;
                                    &lt;button class=&quot;inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200&quot;
                                            data-fc-dismiss type=&quot;button&quot;&gt;
                                        &lt;span class=&quot;material-symbols-rounded&quot;&gt;close&lt;/span&gt;
                                    &lt;/button&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;px-4 py-8 overflow-y-auto&quot;&gt;
                                    &lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
                                        This is a wider card with supporting text below as a natural lead-in to additional
                                        content.
                                    &lt;/p&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700&quot;&gt;
                                    &lt;button class=&quot;py-2 px-5 inline-flex justify-center items-center gap-2 rounded dark:text-gray-200 border dark:border-slate-700 font-medium hover:bg-slate-100 hover:dark:bg-slate-700 transition-all&quot;
                                            data-fc-dismiss type=&quot;button&quot;&gt;Close
                                    &lt;/button&gt;
                                    &lt;a class=&quot;py-2.5 px-4 inline-flex justify-center items-center gap-2 rounded bg-primary hover:bg-primary-600 text-white&quot;
                                    href=&quot;javascript:void(0)&quot;&gt;Save&lt;/a&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;

                        &lt;button class=&quot;btn bg-primary text-white&quot; data-fc-type=&quot;modal&quot; type=&quot;button&quot;&gt;
                            Slide Down
                        &lt;/button&gt;

                        &lt;div class=&quot;w-full h-full fixed top-0 left-0 z-50 transition-all duration-500 hidden&quot;&gt;
                            &lt;div class=&quot;fc-modal-open:mt-7 fc-modal-open:opacity-100 fc-modal-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto  bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700&quot;&gt;
                                &lt;div class=&quot;flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700&quot;&gt;
                                    &lt;h3 class=&quot;font-medium text-gray-800 dark:text-white text-lg&quot;&gt;
                                        Modal Title
                                    &lt;/h3&gt;
                                    &lt;button class=&quot;inline-flex flex-shrink-0 justify-center items-center h-8 w-8 dark:text-gray-200&quot;
                                            data-fc-dismiss type=&quot;button&quot;&gt;
                                        &lt;span class=&quot;material-symbols-rounded&quot;&gt;close&lt;/span&gt;
                                    &lt;/button&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;px-4 py-8 overflow-y-auto&quot;&gt;
                                    &lt;p class=&quot;text-gray-800 dark:text-gray-200&quot;&gt;
                                        This is a wider card with supporting text below as a natural lead-in to additional
                                        content.
                                    &lt;/p&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700&quot;&gt;
                                    &lt;button class=&quot;py-2 px-5 inline-flex justify-center items-center gap-2 rounded dark:text-gray-200 border dark:border-slate-700 font-medium hover:bg-slate-100 hover:dark:bg-slate-700 transition-all&quot;
                                            data-fc-dismiss type=&quot;button&quot;&gt;Close
                                    &lt;/button&gt;
                                    &lt;a class=&quot;py-2.5 px-4 inline-flex justify-center items-center gap-2 rounded bg-primary hover:bg-primary-600 text-white&quot;
                                    href=&quot;javascript:void(0)&quot;&gt;Save&lt;/a&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
            </div>
        </div>
    </div>

</div
>
@endsection
@section('script')
    @vite(['resources/js/pages/highlight.js'])
@endsection