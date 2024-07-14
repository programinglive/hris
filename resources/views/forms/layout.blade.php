@extends('layouts.vertical', ['title' => 'Layout', 'sub_title' => 'Forms', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
<div class="grid lg:grid-cols-2 grid-cols-1 gap-6">
    <div class="card">
        <div class="card-header">
            <div class="flex justify-between items-center">
                <h4 class="card-title">Basic Example</h4>
                <div class="flex items-center gap-2">
                    <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="BasicHtml">
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
            <form>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="text-gray-800 text-sm font-medium inline-block mb-2">Email address</label>
                    <input type="email" class="form-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-sm text-slate-700 dark:text-slate-400">We'll never share your email
                        with anyone else.</small>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="text-gray-800 text-sm font-medium inline-block mb-2">Password</label>
                    <input type="password" class="form-input" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="flex items-center gap-2 mb-3">
                    <input type="checkbox" class="form-checkbox rounded border border-gray-200" id="checkmeout0">
                    <label class="text-gray-800 text-sm font-medium inline-block" for="checkmeout0">Check me out !</label>
                </div>
                <button type="submit" class="btn bg-primary text-white">Submit</button>
            </form>
            <div id="BasicHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                <pre class="language-html h-56">
                    <code>
                        &lt;form&gt;
                            &lt;div class=&quot;mb-3&quot;&gt;
                                &lt;label for=&quot;exampleInputEmail1&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Email address&lt;/label&gt;
                                &lt;input type=&quot;email&quot; class=&quot;form-input&quot; id=&quot;exampleInputEmail1&quot; aria-describedby=&quot;emailHelp&quot; placeholder=&quot;Enter email&quot;&gt;
                                &lt;small id=&quot;emailHelp&quot; class=&quot;form-text text-sm text-slate-700 dark:text-slate-400&quot;&gt;We'll never share your email
                                    with anyone else.&lt;/small&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;mb-3&quot;&gt;
                                &lt;label for=&quot;exampleInputPassword1&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Password&lt;/label&gt;
                                &lt;input type=&quot;password&quot; class=&quot;form-input&quot; id=&quot;exampleInputPassword1&quot; placeholder=&quot;Password&quot;&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;flex items-center gap-2 mb-3&quot;&gt;
                                &lt;input type=&quot;checkbox&quot; class=&quot;form-checkbox rounded border border-gray-200&quot; id=&quot;checkmeout0&quot;&gt;
                                &lt;label class=&quot;text-gray-800 text-sm font-medium inline-block&quot; for=&quot;checkmeout0&quot;&gt;Check me out !&lt;/label&gt;
                            &lt;/div&gt;
                            &lt;button type=&quot;submit&quot; class=&quot;btn bg-primary text-white&quot;&gt;Submit&lt;/button&gt;
                        &lt;/form&gt;
                    </code>
                </pre>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="flex justify-between items-center">
                <h4 class="card-title">Horizontal form</h4>
                <div class="flex items-center gap-2">
                    <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="HorizontalFormHtml">
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
            <form class="flex flex-col gap-3">
                <div class="grid grid-cols-4 items-center gap-6">
                    <label for="inputEmail3" class="text-gray-800 text-sm font-medium inline-block mb-2">Email</label>
                    <div class="md:col-span-3">
                        <input type="email" class="form-input" id="inputEmail3" placeholder="Email">
                    </div>
                </div>
                <div class="grid grid-cols-4 items-center gap-6">
                    <label for="inputPassword3" class="text-gray-800 text-sm font-medium inline-block mb-2">Password</label>
                    <div class="md:col-span-3">
                        <input type="password" class="form-input" id="inputPassword3" placeholder="Password">
                    </div>
                </div>
                <div class="grid grid-cols-4 items-center gap-6">
                    <label for="inputPassword5" class="text-gray-800 text-sm font-medium inline-block mb-2">Re Password</label>
                    <div class="md:col-span-3">
                        <input type="password" class="form-input" id="inputPassword5" placeholder="Retype Password">
                    </div>
                </div>
                <div class="grid grid-cols-4 items-center gap-6">
                    <div class="md:col-start-2">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" class="form-checkbox rounded border border-gray-200" id="checkmeout">
                            <label class="text-gray-800 text-sm font-medium inline-block" for="checkmeout">Check me out !</label>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-4 items-center gap-6">
                    <div class="md:col-start-2">
                        <button type="submit" class="btn bg-info text-white">Sign in</button>
                    </div>
                </div>
            </form>
            <div id="HorizontalFormHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                <pre class="language-html h-56">
                    <code>
                        &lt;form class=&quot;flex flex-col gap-3&quot;&gt;
                            &lt;div class=&quot;grid grid-cols-4 items-center gap-6&quot;&gt;
                                &lt;label for=&quot;inputEmail3&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Email&lt;/label&gt;
                                &lt;div class=&quot;md:col-span-3&quot;&gt;
                                    &lt;input type=&quot;email&quot; class=&quot;form-input&quot; id=&quot;inputEmail3&quot; placeholder=&quot;Email&quot;&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;grid grid-cols-4 items-center gap-6&quot;&gt;
                                &lt;label for=&quot;inputPassword3&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Password&lt;/label&gt;
                                &lt;div class=&quot;md:col-span-3&quot;&gt;
                                    &lt;input type=&quot;password&quot; class=&quot;form-input&quot; id=&quot;inputPassword3&quot; placeholder=&quot;Password&quot;&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;grid grid-cols-4 items-center gap-6&quot;&gt;
                                &lt;label for=&quot;inputPassword5&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Re Password&lt;/label&gt;
                                &lt;div class=&quot;md:col-span-3&quot;&gt;
                                    &lt;input type=&quot;password&quot; class=&quot;form-input&quot; id=&quot;inputPassword5&quot; placeholder=&quot;Retype Password&quot;&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;grid grid-cols-4 items-center gap-6&quot;&gt;
                                &lt;div class=&quot;md:col-start-2&quot;&gt;
                                    &lt;div class=&quot;flex items-center gap-2&quot;&gt;
                                        &lt;input type=&quot;checkbox&quot; class=&quot;form-checkbox rounded border border-gray-200&quot; id=&quot;checkmeout&quot;&gt;
                                        &lt;label class=&quot;text-gray-800 text-sm font-medium inline-block&quot; for=&quot;checkmeout&quot;&gt;Check me out !&lt;/label&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                            &lt;div class=&quot;grid grid-cols-4 items-center gap-6&quot;&gt;
                                &lt;div class=&quot;md:col-start-2&quot;&gt;
                                    &lt;button type=&quot;submit&quot; class=&quot;btn bg-info text-white&quot;&gt;Sign in&lt;/button&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/form&gt;
                    </code>
                </pre>
            </div>
        </div>
    </div> <!-- end card -->

    <div class="col-span-2">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Sizing</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="SizingFormHtml">
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
                <p class="text-sm text-slate-700 dark:text-slate-400 mb-4">
                    As shown in the previous examples, our grid system allows you to place any number of a <code class="text-primary">.grid-cols-*</code> and <code class="text-primary">.flex</code>
                </p>

                <form class="grid grid-cols-4 gap-4 mb-6">
                    <div>
                        <label for="staticEmail2" class="sr-only">Email</label>
                        <input type="text" readonly class="form-input" id="staticEmail2" value="email@example.com">
                    </div>
                    <div>
                        <label for="inputPassword2" class="sr-only">Password</label>
                        <input type="password" class="form-input" id="inputPassword2" placeholder="Password">
                    </div>
                    <div>
                        <button type="submit" class="btn bg-primary text-white">Confirm identity</button>
                    </div>
                </form>

                <form>
                    <div class="flex flex-wrap items-center gap-4">
                        <div>
                            <label class="sr-only" for="inlineFormInput">Name</label>
                            <input type="text" class="form-input" id="inlineFormInput" placeholder="Jane Doe">
                        </div>
                        <div>
                            <label class="sr-only" for="inlineFormInputGroup">Username</label>
                            <div class="flex">
                                <span class="px-4 inline-flex items-center min-w-fit rounded-l border border-r-0 border-gray-200 bg-gray-50 text-sm text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400">@</span>
                                <input type="text" class="form-input rounded-l-none" placeholder="Username">
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn bg-primary text-white">Submit</button>
                        </div>
                    </div>
                </form>
                <div id="SizingFormHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                        <code>
                            &lt;form class=&quot;grid grid-cols-4 gap-4 mb-6&quot;&gt;
                                &lt;div&gt;
                                    &lt;label for=&quot;staticEmail2&quot; class=&quot;sr-only&quot;&gt;Email&lt;/label&gt;
                                    &lt;input type=&quot;text&quot; readonly class=&quot;form-input&quot; id=&quot;staticEmail2&quot; value=&quot;email@example.com&quot;&gt;
                                &lt;/div&gt;
                                &lt;div&gt;
                                    &lt;label for=&quot;inputPassword2&quot; class=&quot;sr-only&quot;&gt;Password&lt;/label&gt;
                                    &lt;input type=&quot;password&quot; class=&quot;form-input&quot; id=&quot;inputPassword2&quot; placeholder=&quot;Password&quot;&gt;
                                &lt;/div&gt;
                                &lt;div&gt;
                                    &lt;button type=&quot;submit&quot; class=&quot;btn bg-primary text-white&quot;&gt;Confirm identity&lt;/button&gt;
                                &lt;/div&gt;
                            &lt;/form&gt;

                            &lt;form&gt;
                                &lt;div class=&quot;flex flex-wrap items-center gap-4&quot;&gt;
                                    &lt;div&gt;
                                        &lt;label class=&quot;sr-only&quot; for=&quot;inlineFormInput&quot;&gt;Name&lt;/label&gt;
                                        &lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;inlineFormInput&quot; placeholder=&quot;Jane Doe&quot;&gt;
                                    &lt;/div&gt;
                                    &lt;div&gt;
                                        &lt;label class=&quot;sr-only&quot; for=&quot;inlineFormInputGroup&quot;&gt;Username&lt;/label&gt;
                                        &lt;div class=&quot;flex&quot;&gt;
                                            &lt;span class=&quot;px-4 inline-flex items-center min-w-fit rounded-l border border-r-0 border-gray-200 bg-gray-50 text-sm text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400&quot;&gt;@&lt;/span&gt;
                                            &lt;input type=&quot;text&quot; class=&quot;form-input rounded-l-none&quot; placeholder=&quot;Username&quot;&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;
                                    &lt;div&gt;
                                        &lt;button type=&quot;submit&quot; class=&quot;btn bg-primary text-white&quot;&gt;Submit&lt;/button&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            &lt;/form&gt;
                        </code>
                    </pre>
                </div>
            </div>
        </div> <!-- end card -->
    </div> <!-- end col -->

    <div class="col-span-2">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Grid</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="GridFormHtml">
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
                <p class="text-sm text-slate-700 dark:text-slate-400 mb-4">More complex layouts can also be created with the grid system.</p>

                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2  gap-6">
                        <div>
                            <label for="inputEmail4" class="text-gray-800 text-sm font-medium inline-block mb-2">Email</label>
                            <input type="email" class="form-input" id="inputEmail4" placeholder="Email">
                        </div>
                        <div>
                            <label for="inputPassword4" class="text-gray-800 text-sm font-medium inline-block mb-2">Password</label>
                            <input type="password" class="form-input" id="inputPassword4" placeholder="Password">
                        </div>

                        <div class="lg:col-span-2">
                            <label for="inputAddress" class="text-gray-800 text-sm font-medium inline-block mb-2">Address</label>
                            <input type="text" class="form-input" id="inputAddress" placeholder="1234 Main St">
                        </div>

                        <div>
                            <label for="inputAddress2" class="text-gray-800 text-sm font-medium inline-block mb-2">Address 2</label>
                            <input type="text" class="form-input" id="inputAddress2" placeholder="Apartment, studio, or floor">
                        </div>

                        <div>
                            <label for="inputCity" class="text-gray-800 text-sm font-medium inline-block mb-2">City</label>
                            <input type="text" class="form-input" id="inputCity">
                        </div>
                        <div>
                            <label for="inputState" class="text-gray-800 text-sm font-medium inline-block mb-2">State</label>
                            <select id="inputState" class="form-select">
                                <option>Choose</option>
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                            </select>
                        </div>
                        <div>
                            <label for="inputZip" class="text-gray-800 text-sm font-medium inline-block mb-2">Zip</label>
                            <input type="text" class="form-input" id="inputZip">
                        </div>
                    </div>

                    <div class="flex items-center gap-2 my-3">
                        <input type="checkbox" class="form-checkbox rounded border border-gray-200" id="customCheck11">
                        <label class="text-gray-800 text-sm font-medium inline-block" for="customCheck11">Check this custom checkbox !</label>
                    </div>

                    <button type="submit" class="btn bg-primary text-white">Sign in</button>
                </form>
                <div id="GridFormHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
                        <code>
                            &lt;form&gt;
                                &lt;div class=&quot;grid grid-cols-1 md:grid-cols-2  gap-6&quot;&gt;
                                    &lt;div&gt;
                                        &lt;label for=&quot;inputEmail4&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Email&lt;/label&gt;
                                        &lt;input type=&quot;email&quot; class=&quot;form-input&quot; id=&quot;inputEmail4&quot; placeholder=&quot;Email&quot;&gt;
                                    &lt;/div&gt;
                                    &lt;div&gt;
                                        &lt;label for=&quot;inputPassword4&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Password&lt;/label&gt;
                                        &lt;input type=&quot;password&quot; class=&quot;form-input&quot; id=&quot;inputPassword4&quot; placeholder=&quot;Password&quot;&gt;
                                    &lt;/div&gt;

                                    &lt;div class=&quot;lg:col-span-2&quot;&gt;
                                        &lt;label for=&quot;inputAddress&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Address&lt;/label&gt;
                                        &lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;inputAddress&quot; placeholder=&quot;1234 Main St&quot;&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;label for=&quot;inputAddress2&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Address 2&lt;/label&gt;
                                        &lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;inputAddress2&quot; placeholder=&quot;Apartment, studio, or floor&quot;&gt;
                                    &lt;/div&gt;

                                    &lt;div&gt;
                                        &lt;label for=&quot;inputCity&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;City&lt;/label&gt;
                                        &lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;inputCity&quot;&gt;
                                    &lt;/div&gt;
                                    &lt;div&gt;
                                        &lt;label for=&quot;inputState&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;State&lt;/label&gt;
                                        &lt;select id=&quot;inputState&quot; class=&quot;form-select&quot;&gt;
                                            &lt;option&gt;Choose&lt;/option&gt;
                                            &lt;option&gt;Option 1&lt;/option&gt;
                                            &lt;option&gt;Option 2&lt;/option&gt;
                                            &lt;option&gt;Option 3&lt;/option&gt;
                                        &lt;/select&gt;
                                    &lt;/div&gt;
                                    &lt;div&gt;
                                        &lt;label for=&quot;inputZip&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Zip&lt;/label&gt;
                                        &lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;inputZip&quot;&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;

                                &lt;div class=&quot;flex items-center gap-2 my-3&quot;&gt;
                                    &lt;input type=&quot;checkbox&quot; class=&quot;form-checkbox rounded border border-gray-200&quot; id=&quot;customCheck11&quot;&gt;
                                    &lt;label class=&quot;text-gray-800 text-sm font-medium inline-block&quot; for=&quot;customCheck11&quot;&gt;Check this custom checkbox !&lt;/label&gt;
                                &lt;/div&gt;

                                &lt;button type=&quot;submit&quot; class=&quot;btn bg-primary text-white&quot;&gt;Sign in&lt;/button&gt;
                            &lt;/form&gt;
                        </code>
                    </pre>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection

@section('script')
    @vite(['resources/js/pages/highlight.js'])
@endsection