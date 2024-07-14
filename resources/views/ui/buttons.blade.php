@extends('layouts.vertical', ['title' => 'Buttons', 'sub_title' => 'Component', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid 2xl:grid-cols-2 grid-cols-1 gap-6">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Default Buttons</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="defaultButtonsHtml">
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
                <div class="flex flex-wrap items-center gap-3">
                    <button type="button" class="btn bg-primary text-white">Primary</button>
                    <button type="button" class="btn bg-success text-white">Success</button>
                    <button type="button" class="btn bg-info text-white">Info</button>
                    <button type="button" class="btn bg-warning text-white">Warning</button>
                    <button type="button" class="btn bg-danger text-white">Danger</button>
                    <button type="button" class="btn bg-dark text-white">Dark</button>
                    <button type="button" class="btn bg-secondary text-white">Secondary</button>
                    <button type="button" class="btn bg-light text-slate-900 dark:text-slate-200">Light</button>
                </div>

                <div id="defaultButtonsHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;button type=&quot;button&quot; class=&quot;btn bg-primary text-white&quot;&gt;Primary&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-success text-white&quot;&gt;Success&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-info text-white&quot;&gt;Info&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-warning text-white&quot;&gt;Warning&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-danger text-white&quot;&gt;Danger&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-dark text-white&quot;&gt;Dark&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-secondary text-white&quot;&gt;Secondary&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-light text-slate-900 dark:text-slate-200&quot;&gt;Light&lt;/button&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Rounded Button</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="RoundedButtonsHtml">
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
                <div class="flex flex-wrap items-center gap-3">
                    <button type="button" class="btn bg-primary text-white rounded-full">Primary</button>
                    <button type="button" class="btn bg-success text-white rounded-full">Success</button>
                    <button type="button" class="btn bg-info text-white rounded-full">Info</button>
                    <button type="button" class="btn bg-warning text-white rounded-full">Warning</button>
                    <button type="button" class="btn bg-danger text-white rounded-full">Danger</button>
                    <button type="button" class="btn bg-dark text-white rounded-full">Dark</button>
                    <button type="button" class="btn bg-secondary text-white rounded-full">Secondary</button>
                    <button type="button" class="btn bg-light text-slate-900 dark:text-slate-200 rounded-full">Light</button>
                </div>
                <div id="RoundedButtonsHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
								<code>
									&lt;button type=&quot;button&quot; class=&quot;btn bg-primary text-white rounded-full&quot;&gt;Primary&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-success text-white rounded-full&quot;&gt;Success&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-info text-white rounded-full&quot;&gt;Info&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-warning text-white rounded-full&quot;&gt;Warning&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-danger text-white rounded-full&quot;&gt;Danger&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-dark text-white rounded-full&quot;&gt;Dark&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-secondary text-white rounded-full&quot;&gt;Secondary&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-light text-slate-900 dark:text-slate-200 rounded-full&quot;&gt;Light&lt;/button&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Otline Buttons</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#otlineButtonsHtml">
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
                <div class="flex flex-wrap items-center gap-3">
                    <button type="button" class="btn border-primary text-primary hover:bg-primary hover:text-white">Primary</button>
                    <button type="button" class="btn border-success text-success hover:bg-success hover:text-white">Success</button>
                    <button type="button" class="btn border-info text-info hover:bg-info hover:text-white">Info</button>
                    <button type="button" class="btn border-warning text-warning hover:bg-warning hover:text-white">Warning</button>
                    <button type="button" class="btn border-danger text-danger hover:bg-danger hover:text-white">Danger</button>
                    <button type="button" class="btn border-dark text-slate-900 dark:text-slate-200 hover:bg-dark hover:text-white">Dark</button>
                    <button type="button" class="btn border-secondary text-secondary hover:bg-secondary hover:text-white">Secondary</button>
                </div>

                <div id="otlineButtonsHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
								<code>
									&lt;button type=&quot;button&quot; class=&quot;btn border-primary text-primary hover:bg-primary hover:text-white&quot;&gt;Primary&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn border-success text-success hover:bg-success hover:text-white&quot;&gt;Success&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn border-info text-info hover:bg-info hover:text-white&quot;&gt;Info&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn border-warning text-warning hover:bg-warning hover:text-white&quot;&gt;Warning&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn border-danger text-danger hover:bg-danger hover:text-white&quot;&gt;Danger&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn border-dark text-slate-900 dark:text-slate-200 hover:bg-dark hover:text-white&quot;&gt;Dark&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn border-secondary text-secondary hover:bg-secondary hover:text-white&quot;&gt;Secondary&lt;/button&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Outline Rounded Buttons</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#otlineRoundedButtonsHtml">
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
                <div class="flex flex-wrap items-center gap-3">
                    <button type="button" class="btn rounded-full border border-primary text-primary hover:bg-primary hover:text-white">Primary</button>
                    <button type="button" class="btn rounded-full border border-success text-success hover:bg-success hover:text-white">Success</button>
                    <button type="button" class="btn rounded-full border border-info text-info hover:bg-info hover:text-white">Info</button>
                    <button type="button" class="btn rounded-full border border-warning text-warning hover:bg-warning hover:text-white">Warning</button>
                    <button type="button" class="btn rounded-full border border-danger text-danger hover:bg-danger hover:text-white">Danger</button>
                    <button type="button" class="btn rounded-full border border-dark text-slate-900 dark:text-slate-200 hover:bg-dark hover:text-white">Dark</button>
                    <button type="button" class="btn rounded-full border border-secondary text-secondary hover:bg-secondary hover:text-white">Secondary</button>
                </div>

                <div id="otlineRoundedButtonsHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
								<code>
									&lt;button type=&quot;button&quot; class=&quot;btn rounded-full border border-primary text-primary hover:bg-primary hover:text-white&quot;&gt;Primary&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn rounded-full border border-success text-success hover:bg-success hover:text-white&quot;&gt;Success&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn rounded-full border border-info text-info hover:bg-info hover:text-white&quot;&gt;Info&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn rounded-full border border-warning text-warning hover:bg-warning hover:text-white&quot;&gt;Warning&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn rounded-full border border-danger text-danger hover:bg-danger hover:text-white&quot;&gt;Danger&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn rounded-full border border-dark text-slate-900 dark:text-slate-200 hover:bg-dark hover:text-white&quot;&gt;Dark&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn rounded-full border border-secondary text-secondary hover:bg-secondary hover:text-white&quot;&gt;Secondary&lt;/button&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Soft Buttons</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#softButtonsHtml">
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
                <div class="flex flex-wrap items-center gap-3">
                    <button type="button" class="btn bg-primary/25 text-primary hover:bg-primary hover:text-white">Primary</button>
                    <button type="button" class="btn bg-success/25 text-success hover:bg-success hover:text-white">Success</button>
                    <button type="button" class="btn bg-info/25 text-info hover:bg-info hover:text-white">Info</button>
                    <button type="button" class="btn bg-warning/25 text-warning hover:bg-warning hover:text-white">Warning</button>
                    <button type="button" class="btn bg-danger/25 text-danger hover:bg-danger hover:text-white">Danger</button>
                    <button type="button" class="btn bg-dark/25 text-white hover:bg-dark">Dark</button>
                    <button type="button" class="btn bg-secondary/25 text-secondary hover:bg-secondary hover:text-white">Secondary</button>
                </div>

                <div id="softButtonsHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;button type=&quot;button&quot; class=&quot;btn bg-primary/25 text-primary hover:bg-primary hover:text-white&quot;&gt;Primary&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-success/25 text-success hover:bg-success hover:text-white&quot;&gt;Success&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-info/25 text-info hover:bg-info hover:text-white&quot;&gt;Info&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-warning/25 text-warning hover:bg-warning hover:text-white&quot;&gt;Warning&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-danger/25 text-danger hover:bg-danger hover:text-white&quot;&gt;Danger&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-dark/25 text-white hover:bg-dark&quot;&gt;Dark&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-secondary/25 text-secondary hover:bg-secondary hover:text-white&quot;&gt;Secondary&lt;/button&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Soft Rounded Buttons</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#softRoundedButtonsHtml">
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
                <div class="flex flex-wrap items-center gap-3">
                    <button type="button" class="btn rounded-full bg-primary/25 text-primary hover:bg-primary hover:text-white">Primary</button>
                    <button type="button" class="btn rounded-full bg-success/25 text-success hover:bg-success hover:text-white">Success</button>
                    <button type="button" class="btn rounded-full bg-info/25 text-info hover:bg-info hover:text-white">Info</button>
                    <button type="button" class="btn rounded-full bg-warning/25 text-warning hover:bg-warning hover:text-white">Warning</button>
                    <button type="button" class="btn rounded-full bg-danger/25 text-danger hover:bg-danger hover:text-white">Danger</button>
                    <button type="button" class="btn rounded-full bg-dark/25 text-slate-900 dark:text-slate-200 hover:bg-dark hover:text-white">Dark</button>
                    <button type="button" class="btn rounded-full bg-secondary/25 text-secondary hover:bg-secondary hover:text-white">Secondary</button>
                </div>

                <div id="softRoundedButtonsHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
								<code>
									&lt;button type=&quot;button&quot; class=&quot;btn rounded-full bg-primary/25 text-primary hover:bg-primary hover:text-white&quot;&gt;Primary&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn rounded-full bg-success/25 text-success hover:bg-success hover:text-white&quot;&gt;Success&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn rounded-full bg-info/25 text-info hover:bg-info hover:text-white&quot;&gt;Info&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn rounded-full bg-warning/25 text-warning hover:bg-warning hover:text-white&quot;&gt;Warning&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn rounded-full bg-danger/25 text-danger hover:bg-danger hover:text-white&quot;&gt;Danger&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn rounded-full bg-dark/25 text-slate-900 dark:text-slate-200 hover:bg-dark hover:text-white&quot;&gt;Dark&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn rounded-full bg-secondary/25 text-secondary hover:bg-secondary hover:text-white&quot;&gt;Secondary&lt;/button&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Buttons with Icon</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#IconButtonsHtml">
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
                <div class="flex flex-wrap items-center gap-3">
                    <button type="button" class="btn bg-primary text-white">
                        <i class="mgc_check_line text-base me-4"></i>
                        Primary</button>
                    <button type="button" class="btn bg-success text-white">
                        <i class="mgc_check_line text-base me-4"></i>
                        Success</button>
                    <button type="button" class="btn bg-info text-white">
                        <i class="mgc_alert_line text-base me-4"></i>
                        Info</button>
                    <button type="button" class="btn bg-warning text-white">
                        <i class="mgc_warning_line text-base me-4"></i>
                        Warning</button>
                    <button type="button" class="btn bg-danger text-white">
                        <i class="mgc_close_line text-base me-4"></i>
                        Danger</button>
                    <button type="button" class="btn bg-dark text-white">
                        <i class="mgc_check_line text-base me-4"></i>
                        Dark</button>
                </div>

                <div id="IconButtonsHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
								<code>
									&lt;button type=&quot;button&quot; class=&quot;btn bg-primary text-white&quot;&gt;&lt;i class=&quot;mgc_check_line text-base me-4&quot;&gt;&lt;/i&gt; Primary&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-success text-white&quot;&gt;&lt;i class=&quot;mgc_check_line text-base me-4&quot;&gt;&lt;/i&gt; Success&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-info text-white&quot;&gt;&lt;i class=&quot;mgc_alert_line text-base me-4&quot;&gt;&lt;/i&gt; Info&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-warning text-white&quot;&gt;&lt;i class=&quot;mgc_warning_line text-base me-4&quot;&gt;&lt;/i&gt; Warning&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-danger text-white&quot;&gt;&lt;i class=&quot;mgc_close_line text-base me-4&quot;&gt;&lt;/i&gt; Danger&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-dark text-white&quot;&gt;&lt;i class=&quot;mgc_check_line text-base me-4&quot;&gt;&lt;/i&gt; Dark&lt;/button&gt;
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
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#ButtonSizesHtml">
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
                <div class="flex items-center gap-2">
                    <button type="button" class="btn btn-sm bg-primary text-white">Small</button>
                    <button type="button" class="btn bg-primary text-white">Large</button>
                    <button type="button" class="btn btn-lg bg-primary text-white">Default</button>
                </div>
                <div id="ButtonSizesHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
								<code>
									&lt;button type=&quot;button&quot; class=&quot;btn btn-sm bg-primary text-white&quot;&gt;Small&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn bg-primary text-white&quot;&gt;Large&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn btn-lg bg-primary text-white&quot;&gt;Default&lt;/button&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Block Button</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#BlockButtonsHtml">
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
                    <button type="button" class="btn w-full bg-primary text-white">Default</button>
                    <button type="button" class="btn w-full border-primary text-primary">Default</button>
                </div>
                <div id="BlockButtonsHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
								<code>
									&lt;button type=&quot;button&quot; class=&quot;btn w-full bg-primary text-white&quot;&gt;Default&lt;/button&gt;
									&lt;button type=&quot;button&quot; class=&quot;btn w-full border-primary text-primary&quot;&gt;Default&lt;/button&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Disabled</h4>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#DisabledButtonHtml">
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
                <div class="flex flex-wrap gap-3">
                    <button type="button" class="btn bg-primary text-white" disabled>Disabled</button>
                    <button type="button" class="btn border-primary text-primary" disabled>Disabled</button>
                </div>
                <div id="DisabledButtonHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
                        <code>
                            &lt;button type=&quot;button&quot; class=&quot;btn bg-primary text-white&quot; disabled&gt;Disabled&lt;/button&gt;
                            &lt;button type=&quot;button&quot; class=&quot;btn border-primary text-primary&quot; disabled&gt;Disabled&lt;/button&gt;
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
