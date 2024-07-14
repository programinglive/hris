@extends('layouts.vertical', ['title' => 'Progress', 'sub_title' => 'Component', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid 2xl:grid-cols-2 grid-cols-1 gap-6">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Basic Examples</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#BasicProgress">
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
                <div class="flex w-full h-1.5 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700 ">
                    <div class="flex flex-col justify-center overflow-hidden bg-primary" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div id="BasicProgress" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;div class=&quot;flex w-full h-1.5 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700 &quot;&gt;
                            &lt;div class=&quot;flex flex-col justify-center overflow-hidden bg-primary&quot; role=&quot;progressbar&quot; style=&quot;width: 25%&quot; aria-valuenow=&quot;25&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;&lt;/div&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Labels Examples</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#LableProgress">
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
                <div class="flex w-full h-4 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
                    <div class="flex flex-col justify-center overflow-hidden bg-primary text-xs text-white text-center" role="progressbar" style="width: 57%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100">57%</div>
                </div>
                <div id="LableProgress" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;div class=&quot;flex w-full h-4 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700&quot;&gt;
                            &lt;div class=&quot;flex flex-col justify-center overflow-hidden bg-primary text-xs text-white text-center&quot; role=&quot;progressbar&quot; style=&quot;width: 57%&quot; aria-valuenow=&quot;57&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;57%&lt;/div&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Height</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#HeightProgress">
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
                <div class="flex flex-col gap-2">
                    <div class="flex w-full h-1.5 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
                        <div class="flex flex-col justify-center overflow-hidden bg-primary" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="flex w-full h-4 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
                        <div class="flex flex-col justify-center overflow-hidden bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="flex w-full h-6 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
                        <div class="flex flex-col justify-center overflow-hidden bg-primary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div id="HeightProgress" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;div class=&quot;flex w-full h-1.5 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700&quot;&gt;
                            &lt;div class=&quot;flex flex-col justify-center overflow-hidden bg-primary&quot; role=&quot;progressbar&quot; style=&quot;width: 25%&quot; aria-valuenow=&quot;25&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;&lt;/div&gt;
                        &lt;/div&gt;
                        &lt;div class=&quot;flex w-full h-4 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700&quot;&gt;
                            &lt;div class=&quot;flex flex-col justify-center overflow-hidden bg-primary&quot; role=&quot;progressbar&quot; style=&quot;width: 50%&quot; aria-valuenow=&quot;50&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;&lt;/div&gt;
                        &lt;/div&gt;
                        &lt;div class=&quot;flex w-full h-6 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700&quot;&gt;
                            &lt;div class=&quot;flex flex-col justify-center overflow-hidden bg-primary&quot; role=&quot;progressbar&quot; style=&quot;width: 75%&quot; aria-valuenow=&quot;75&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;&lt;/div&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Vertical Progress</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#VerticalProgress">
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
                <div class="flex space-x-8">
                    <div class="flex flex-col flex-nowrap justify-end w-2 h-32 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
                        <div class="bg-primary overflow-hidden" role="progressbar" style="height: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="flex flex-col flex-nowrap justify-end w-2 h-32 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
                        <div class="bg-primary overflow-hidden" role="progressbar" style="height: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="flex flex-col flex-nowrap justify-end w-2 h-32 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
                        <div class="bg-primary overflow-hidden" role="progressbar" style="height: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="flex flex-col flex-nowrap justify-end w-2 h-32 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
                        <div class="bg-primary overflow-hidden" role="progressbar" style="height: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="flex flex-col flex-nowrap justify-end w-2 h-32 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
                        <div class="bg-primary overflow-hidden" role="progressbar" style="height: 17%" aria-valuenow="17" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div id="VerticalProgress" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div class=&quot;flex space-x-8&quot;&gt;
                            &lt;div class=&quot;flex flex-col flex-nowrap justify-end w-2 h-32 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700&quot;&gt;
                                &lt;div class=&quot;bg-primary overflow-hidden&quot; role=&quot;progressbar&quot; style=&quot;height: 25%&quot; aria-valuenow=&quot;25&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;&lt;/div&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;flex flex-col flex-nowrap justify-end w-2 h-32 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700&quot;&gt;
                                &lt;div class=&quot;bg-primary overflow-hidden&quot; role=&quot;progressbar&quot; style=&quot;height: 50%&quot; aria-valuenow=&quot;50&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;&lt;/div&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;flex flex-col flex-nowrap justify-end w-2 h-32 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700&quot;&gt;
                                &lt;div class=&quot;bg-primary overflow-hidden&quot; role=&quot;progressbar&quot; style=&quot;height: 75%&quot; aria-valuenow=&quot;75&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;&lt;/div&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;flex flex-col flex-nowrap justify-end w-2 h-32 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700&quot;&gt;
                                &lt;div class=&quot;bg-primary overflow-hidden&quot; role=&quot;progressbar&quot; style=&quot;height: 90%&quot; aria-valuenow=&quot;90&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;&lt;/div&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;flex flex-col flex-nowrap justify-end w-2 h-32 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700&quot;&gt;
                                &lt;div class=&quot;bg-primary overflow-hidden&quot; role=&quot;progressbar&quot; style=&quot;height: 17%&quot; aria-valuenow=&quot;17&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;&lt;/div&gt;
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
                    <h4 class="card-title">Multiple Bars</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#MultipalProgress">
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
                <div class="flex w-full h-1.5 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
                    <div class="flex flex-col justify-center overflow-hidden bg-sky-400" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="flex flex-col justify-center overflow-hidden bg-sky-700" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="flex flex-col justify-center overflow-hidden bg-gray-800 dark:bg-white" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="flex flex-col justify-center overflow-hidden bg-orange-600" role="progressbar" style="width: 5%" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div id="MultipalProgress" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;div class=&quot;flex w-full h-1.5 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700&quot;&gt;
                            &lt;div class=&quot;flex flex-col justify-center overflow-hidden bg-sky-400&quot; role=&quot;progressbar&quot; style=&quot;width: 25%&quot; aria-valuenow=&quot;25&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;&lt;/div&gt;
                            &lt;div class=&quot;flex flex-col justify-center overflow-hidden bg-sky-700&quot; role=&quot;progressbar&quot; style=&quot;width: 15%&quot; aria-valuenow=&quot;15&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;&lt;/div&gt;
                            &lt;div class=&quot;flex flex-col justify-center overflow-hidden bg-gray-800 dark:bg-white&quot; role=&quot;progressbar&quot; style=&quot;width: 30%&quot; aria-valuenow=&quot;30&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;&lt;/div&gt;
                            &lt;div class=&quot;flex flex-col justify-center overflow-hidden bg-orange-600&quot; role=&quot;progressbar&quot; style=&quot;width: 5%&quot; aria-valuenow=&quot;5&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;&lt;/div&gt;
                        &lt;/div&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Striped Progressbar</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#StripedProgressbar">
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
                <div class="flex flex-col items-center justify-center gap-3">
                    <div class="w-full h-4 bg-black/10 rounded-full">
                        <div class="bg-indigo-600 h-4 rounded-full w-3/12 animate-strip" style="background-image:linear-gradient(45deg,hsla(0,0%,100%,.15) 25%,transparent 0,transparent 50%,hsla(0,0%,100%,.15) 0,hsla(0,0%,100%,.15) 75%,transparent 0,transparent);background-size:1rem 1rem"></div>
                    </div>
                    <div class="w-full h-4 bg-black/10 rounded-full">
                        <div class="bg-purple-600 h-4 rounded-full w-4/12 animate-strip" style="background-image:linear-gradient(45deg,hsla(0,0%,100%,.15) 25%,transparent 0,transparent 50%,hsla(0,0%,100%,.15) 0,hsla(0,0%,100%,.15) 75%,transparent 0,transparent);background-size:1rem 1rem"></div>
                    </div>
                    <div class="w-full h-4 bg-black/10 rounded-full">
                        <div class="bg-blue-600 h-4 rounded-full w-5/12 animate-strip" style="background-image:linear-gradient(45deg,hsla(0,0%,100%,.15) 25%,transparent 0,transparent 50%,hsla(0,0%,100%,.15) 0,hsla(0,0%,100%,.15) 75%,transparent 0,transparent);background-size:1rem 1rem"></div>
                    </div>
                    <div class="w-full h-4 bg-black/10 rounded-full">
                        <div class="bg-green-600 h-4 rounded-full w-6/12 animate-strip" style="background-image:linear-gradient(45deg,hsla(0,0%,100%,.15) 25%,transparent 0,transparent 50%,hsla(0,0%,100%,.15) 0,hsla(0,0%,100%,.15) 75%,transparent 0,transparent);background-size:1rem 1rem"></div>
                    </div>
                    <div class="w-full h-4 bg-black/10 rounded-full">
                        <div class="bg-yellow-600 h-4 rounded-full w-7/12 animate-strip" style="background-image:linear-gradient(45deg,hsla(0,0%,100%,.15) 25%,transparent 0,transparent 50%,hsla(0,0%,100%,.15) 0,hsla(0,0%,100%,.15) 75%,transparent 0,transparent);background-size:1rem 1rem"></div>
                    </div>
                    <div class="w-full h-4 bg-black/10 rounded-full">
                        <div class="bg-red-600 h-4 rounded-full w-8/12 animate-strip" style="background-image:linear-gradient(45deg,hsla(0,0%,100%,.15) 25%,transparent 0,transparent 50%,hsla(0,0%,100%,.15) 0,hsla(0,0%,100%,.15) 75%,transparent 0,transparent);background-size:1rem 1rem"></div>
                    </div>
                </div>
                <div id="StripedProgressbar" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;div class=&quot;w-full h-4 bg-black/10 rounded-full&quot;&gt;
                            &lt;div class=&quot;bg-indigo-600 h-4 rounded-full w-3/12 animate-strip&quot; style=&quot;background-image:linear-gradient(45deg,hsla(0,0%,100%,.15) 25%,transparent 0,transparent 50%,hsla(0,0%,100%,.15) 0,hsla(0,0%,100%,.15) 75%,transparent 0,transparent);background-size:1rem 1rem&quot;&gt;&lt;/div&gt;
                        &lt;/div&gt;
                        &lt;div class=&quot;w-full h-4 bg-black/10 rounded-full&quot;&gt;
                            &lt;div class=&quot;bg-purple-600 h-4 rounded-full w-4/12 animate-strip&quot; style=&quot;background-image:linear-gradient(45deg,hsla(0,0%,100%,.15) 25%,transparent 0,transparent 50%,hsla(0,0%,100%,.15) 0,hsla(0,0%,100%,.15) 75%,transparent 0,transparent);background-size:1rem 1rem&quot;&gt;&lt;/div&gt;
                        &lt;/div&gt;
                        &lt;div class=&quot;w-full h-4 bg-black/10 rounded-full&quot;&gt;
                            &lt;div class=&quot;bg-blue-600 h-4 rounded-full w-5/12 animate-strip&quot; style=&quot;background-image:linear-gradient(45deg,hsla(0,0%,100%,.15) 25%,transparent 0,transparent 50%,hsla(0,0%,100%,.15) 0,hsla(0,0%,100%,.15) 75%,transparent 0,transparent);background-size:1rem 1rem&quot;&gt;&lt;/div&gt;
                        &lt;/div&gt;
                        &lt;div class=&quot;w-full h-4 bg-black/10 rounded-full&quot;&gt;
                            &lt;div class=&quot;bg-green-600 h-4 rounded-full w-6/12 animate-strip&quot; style=&quot;background-image:linear-gradient(45deg,hsla(0,0%,100%,.15) 25%,transparent 0,transparent 50%,hsla(0,0%,100%,.15) 0,hsla(0,0%,100%,.15) 75%,transparent 0,transparent);background-size:1rem 1rem&quot;&gt;&lt;/div&gt;
                        &lt;/div&gt;
                        &lt;div class=&quot;w-full h-4 bg-black/10 rounded-full&quot;&gt;
                            &lt;div class=&quot;bg-yellow-600 h-4 rounded-full w-7/12 animate-strip&quot; style=&quot;background-image:linear-gradient(45deg,hsla(0,0%,100%,.15) 25%,transparent 0,transparent 50%,hsla(0,0%,100%,.15) 0,hsla(0,0%,100%,.15) 75%,transparent 0,transparent);background-size:1rem 1rem&quot;&gt;&lt;/div&gt;
                        &lt;/div&gt;
                        &lt;div class=&quot;w-full h-4 bg-black/10 rounded-full&quot;&gt;
                            &lt;div class=&quot;bg-red-600 h-4 rounded-full w-8/12 animate-strip&quot; style=&quot;background-image:linear-gradient(45deg,hsla(0,0%,100%,.15) 25%,transparent 0,transparent 50%,hsla(0,0%,100%,.15) 0,hsla(0,0%,100%,.15) 75%,transparent 0,transparent);background-size:1rem 1rem&quot;&gt;&lt;/div&gt;
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
