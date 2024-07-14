@extends('layouts.vertical', ['title' => 'Select', 'sub_title' => 'Forms', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
    @vite(['node_modules/nice-select2/dist/css/nice-select2.css'])
@endsection

@section('content')
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 mt-6">
        <!-- Basic -->
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Basic</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="BasicSelectHtml">
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
                <select class="selectize">
                    <option selected value="orange">Orange</option>
                    <option value="White">White</option>
                    <option value="Purple">Purple</option>
                </select>

                <div id="BasicSelectHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;select class=&quot;selectize&quot;&gt;
                            &lt;option selected value=&quot;orange&quot;&gt;Orange&lt;/option&gt;
                            &lt;option value=&quot;White&quot;&gt;White&lt;/option&gt;
                            &lt;option value=&quot;Purple&quot;&gt;Purple&lt;/option&gt;
                        &lt;/select&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <!-- Nested -->
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Nested</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="NestedSelect">
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
                <select class="selectize">
                    <option disabled>Group 1</option>
                    <option selected value="orange">Orange</option>
                    <option value="White">White</option>
                    <option value="Purple">Purple</option>
                    <option disabled>Group 2</option>
                    <option>Yellow</option>
                    <option value="Red">Red</option>
                    <option value="Green">Green</option>
                    <option disabled>Group 3</option>
                    <option>Aqua</option>
                    <option value="Black">Black</option>
                    <option value="Blue">Blue</option>
                </select>

                <div id="NestedSelect" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                    <code>
                        &lt;select class=&quot;selectize&quot;&gt;
                            &lt;option disabled&gt;Group 1&lt;/option&gt;
                            &lt;option selected value=&quot;orange&quot;&gt;Orange&lt;/option&gt;
                            &lt;option value=&quot;White&quot;&gt;White&lt;/option&gt;
                            &lt;option value=&quot;Purple&quot;&gt;Purple&lt;/option&gt;
                            &lt;option disabled&gt;Group 2&lt;/option&gt;
                            &lt;option&gt;Yellow&lt;/option&gt;
                            &lt;option value=&quot;Red&quot;&gt;Red&lt;/option&gt;
                            &lt;option value=&quot;Green&quot;&gt;Green&lt;/option&gt;
                            &lt;option disabled&gt;Group 3&lt;/option&gt;
                            &lt;option&gt;Aqua&lt;/option&gt;
                            &lt;option value=&quot;Black&quot;&gt;Black&lt;/option&gt;
                            &lt;option value=&quot;Blue&quot;&gt;Blue&lt;/option&gt;
                        &lt;/select&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <!-- Disabling options -->
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Disabling options</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="DisablingSelectHtml">
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
                <select class="selectize">
                    <option selected value="orange">Orange</option>
                    <option disabled value="White">White</option>
                    <option value="Purple">Purple</option>
                </select>

                <div id="DisablingSelectHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;select class=&quot;selectize&quot;&gt;
                            &lt;option selected value=&quot;orange&quot;&gt;Orange&lt;/option&gt;
                            &lt;option disabled value=&quot;White&quot;&gt;White&lt;/option&gt;
                            &lt;option value=&quot;Purple&quot;&gt;Purple&lt;/option&gt;
                        &lt;/select&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <!-- Placeholder -->
        <div class="card lg:row-start-3">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Placeholder</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="PlaceholderSelectHtml">
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
                <select class="selectize" placeholder="Choose...">
                    <option value="orange">Orange</option>
                    <option value="White">White</option>
                    <option value="Purple">Purple</option>
                </select>

                <div id="PlaceholderSelectHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;select class=&quot;selectize&quot; placeholder=&quot;Choose...&quot;&gt;
                            &lt;option value=&quot;orange&quot;&gt;Orange&lt;/option&gt;
                            &lt;option value=&quot;White&quot;&gt;White&lt;/option&gt;
                            &lt;option value=&quot;Purple&quot;&gt;Purple&lt;/option&gt;
                        &lt;/select&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <!-- Searchable -->
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Searchable</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="SearchableHtml">
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
                <select id="search-select" class="search-select">
                    <option value="orange">Orange</option>
                    <option value="White">White</option>
                    <option value="Purple">Purple</option>
                </select>

                <div id="SearchableHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;select id=&quot;search-select&quot; class=&quot;search-select&quot;&gt;
                            &lt;option value=&quot;orange&quot;&gt;Orange&lt;/option&gt;
                            &lt;option value=&quot;White&quot;&gt;White&lt;/option&gt;
                            &lt;option value=&quot;Purple&quot;&gt;Purple&lt;/option&gt;
                        &lt;/select&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>

        <!-- Multiple -->
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Multiple select</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="MultiSelectHtml">
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
                <select class="selectize" multiple="multiple">
                    <option value="orange">Orange</option>
                    <option value="White">White</option>
                    <option value="Purple">Purple</option>
                </select>

                <div id="MultiSelectHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                    <code>
                        &lt;select class=&quot;selectize&quot; multiple=&quot;multiple&quot;&gt;
                            &lt;option value=&quot;orange&quot;&gt;Orange&lt;/option&gt;
                            &lt;option value=&quot;White&quot;&gt;White&lt;/option&gt;
                            &lt;option value=&quot;Purple&quot;&gt;Purple&lt;/option&gt;
                        &lt;/select&gt;
                    </code>
                </pre>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite(['resources/js/pages/highlight.js', 'resources/js/pages/form-select.js'])
@endsection
