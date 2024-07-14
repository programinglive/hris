@extends('layouts.vertical', ['title' => 'Avatars', 'sub_title' => 'Component', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid 2xl:grid-cols-2 grid-cols-1 gap-6">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Sizing - Images</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#avatarSizingHtml">
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
                <div class="flex flex-wrap items-end gap-3">
                    <img src="/images/users/avatar-1.jpg" alt="image" class="h-8 w-8 rounded">
                    <img src="/images/users/avatar-2.jpg" alt="image" class="h-12 w-12 rounded">
                    <img src="/images/users/avatar-3.jpg" alt="image" class="h-16 w-16 rounded">
                    <img src="/images/users/avatar-7.jpg" alt="image" class="h-20 w-20 rounded">
                    <img src="/images/users/avatar-4.jpg" alt="image" class="h-24 w-24 rounded">
                    <img src="/images/users/avatar-5.jpg" alt="image" class="h-28 w-28 rounded">
                    <img src="/images/users/avatar-6.jpg" alt="image" class="h-32 w-32 rounded">
                </div>

                <div id="avatarSizingHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html">
								<code>
									&lt;img src=&quot;/images/users/avatar-1.jpg&quot; alt=&quot;image&quot; class=&quot;h-8 w-8 rounded&quot;&gt;
									&lt;img src=&quot;/images/users/avatar-2.jpg&quot; alt=&quot;image&quot; class=&quot;h-12 w-12 rounded&quot;&gt;
									&lt;img src=&quot;/images/users/avatar-3.jpg&quot; alt=&quot;image&quot; class=&quot;h-16 w-16 rounded&quot;&gt;
									&lt;img src=&quot;/images/users/avatar-7.jpg&quot; alt=&quot;image&quot; class=&quot;h-20 w-20 rounded&quot;&gt;
									&lt;img src=&quot;/images/users/avatar-4.jpg&quot; alt=&quot;image&quot; class=&quot;h-24 w-24 rounded&quot;&gt;
									&lt;img src=&quot;/images/users/avatar-5.jpg&quot; alt=&quot;image&quot; class=&quot;h-28 w-28 rounded&quot;&gt;
									&lt;img src=&quot;/images/users/avatar-6.jpg&quot; alt=&quot;image&quot; class=&quot;h-32 w-32 rounded&quot;&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Rounded Circle</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#avatarCircleHtml">
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
                <div class="flex flex-wrap items-end gap-3">
                    <img src="/images/users/avatar-1.jpg" alt="image" class="h-8 w-8 rounded-full">
                    <img src="/images/users/avatar-2.jpg" alt="image" class="h-12 w-12 rounded-full">
                    <img src="/images/users/avatar-3.jpg" alt="image" class="h-16 w-16 rounded-full">
                    <img src="/images/users/avatar-7.jpg" alt="image" class="h-20 w-20 rounded-full">
                    <img src="/images/users/avatar-4.jpg" alt="image" class="h-24 w-24 rounded-full">
                    <img src="/images/users/avatar-5.jpg" alt="image" class="h-28 w-28 rounded-full">
                    <img src="/images/users/avatar-6.jpg" alt="image" class="h-32 w-32 rounded-full">
                </div>
                <div id="avatarCircleHtml" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html">
								<code>
									&lt;img src=&quot;/images/users/avatar-1.jpg&quot; alt=&quot;image&quot; class=&quot;h-8 w-8 rounded-full&quot;&gt;
									&lt;img src=&quot;/images/users/avatar-2.jpg&quot; alt=&quot;image&quot; class=&quot;h-12 w-12 rounded-full&quot;&gt;
									&lt;img src=&quot;/images/users/avatar-3.jpg&quot; alt=&quot;image&quot; class=&quot;h-16 w-16 rounded-full&quot;&gt;
									&lt;img src=&quot;/images/users/avatar-7.jpg&quot; alt=&quot;image&quot; class=&quot;h-20 w-20 rounded-full&quot;&gt;
									&lt;img src=&quot;/images/users/avatar-4.jpg&quot; alt=&quot;image&quot; class=&quot;h-24 w-24 rounded-full&quot;&gt;
									&lt;img src=&quot;/images/users/avatar-5.jpg&quot; alt=&quot;image&quot; class=&quot;h-28 w-28 rounded-full&quot;&gt;
									&lt;img src=&quot;/images/users/avatar-6.jpg&quot; alt=&quot;image&quot; class=&quot;h-32 w-32 rounded-full&quot;&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Rounded Circle</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#AvatarCircle_2Html">
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
                <div class="flex flex-wrap items-end gap-3">
                    <div class="relative h-8 w-8 inline-flex">
                        <img src="/images/users/avatar-1.jpg" alt="image" class="rounded-full">
                        <div class="absolute end-0 h-2 w-2 rounded-full border border-white bg-success"></div>
                    </div>
                    <div class="relative h-12 w-12 inline-flex">
                        <img src="/images/users/avatar-2.jpg" alt="image" class="rounded-full">
                        <div class="absolute end-0 m-0.5 h-2.5 w-2.5 rounded-full border border-white bg-success"></div>
                    </div>
                    <div class="h-16 w-16 relative inline-flex">
                        <img src="/images/users/avatar-3.jpg" alt="image" class="rounded-full">
                        <div class="absolute end-0 m-1 h-2.5 w-2.5 rounded-full border border-white bg-success"></div>
                    </div>
                    <div class="h-20 w-20 relative inline-flex">
                        <img src="/images/users/avatar-4.jpg" alt="image" class="rounded-full">
                        <div class="absolute end-0 m-1.5 h-2.5 w-2.5 rounded-full border border-white bg-success"></div>
                    </div>
                    <div class="h-24 w-24 relative inline-flex">
                        <img src="/images/users/avatar-5.jpg" alt="image" class="rounded-full">
                        <div class="absolute end-0 m-2 h-3 w-3 border rounded-full border-white bg-success"></div>
                    </div>
                    <div class="h-28 w-28 relative inline-flex">
                        <img src="/images/users/avatar-6.jpg" alt="image" class="rounded-full">
                        <div class="absolute end-0 m-1.5 h-4 w-4 rounded-full border-2 border-white bg-success"></div>
                    </div>
                    <div class="relative h-32 w-32 inline-flex">
                        <img src="/images/users/avatar-7.jpg" alt="image" class="rounded-full">
                        <div class="absolute end-0 m-2  h-5 w-5 rounded-full border-[3px] border-white bg-success"></div>
                    </div>
                </div>
                <div id="AvatarCircle_2Html" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;div class=&quot;relative h-8 w-8 inline-flex&quot;&gt;
										&lt;img src=&quot;/images/users/avatar-1.jpg&quot; alt=&quot;image&quot; class=&quot;rounded-full&quot;&gt;
										&lt;div class=&quot;absolute end-0 h-2 w-2 rounded-full border border-white bg-success&quot;&gt;
										&lt;/div&gt;
									&lt;/div&gt;
									&lt;div class=&quot;relative h-12 w-12 inline-flex&quot;&gt;
										&lt;img src=&quot;/images/users/avatar-2.jpg&quot; alt=&quot;image&quot; class=&quot;rounded-full&quot;&gt;
										&lt;div
											class=&quot;absolute end-0 m-0.5 h-2.5 w-2.5 rounded-full border border-white bg-success&quot;&gt;
										&lt;/div&gt;
									&lt;/div&gt;
									&lt;div class=&quot;h-16 w-16 relative inline-flex&quot;&gt;
										&lt;img src=&quot;/images/users/avatar-3.jpg&quot; alt=&quot;image&quot; class=&quot;rounded-full&quot;&gt;
										&lt;div
											class=&quot;absolute end-0 m-1 h-2.5 w-2.5 rounded-full border border-white bg-success&quot;&gt;
										&lt;/div&gt;
									&lt;/div&gt;
									&lt;div class=&quot;h-20 w-20 relative inline-flex&quot;&gt;
										&lt;img src=&quot;/images/users/avatar-4.jpg&quot; alt=&quot;image&quot; class=&quot;rounded-full&quot;&gt;
										&lt;div
											class=&quot;absolute end-0 m-1.5 h-2.5 w-2.5 rounded-full border border-white bg-success&quot;&gt;
										&lt;/div&gt;
									&lt;/div&gt;
									&lt;div class=&quot;h-24 w-24 relative inline-flex&quot;&gt;
										&lt;img src=&quot;/images/users/avatar-5.jpg&quot; alt=&quot;image&quot; class=&quot;rounded-full&quot;&gt;
										&lt;div class=&quot;absolute end-0 m-2 h-3 w-3 border rounded-full border-white bg-success&quot;&gt;
										&lt;/div&gt;
									&lt;/div&gt;
									&lt;div class=&quot;h-28 w-28 relative inline-flex&quot;&gt;
										&lt;img src=&quot;/images/users/avatar-6.jpg&quot; alt=&quot;image&quot; class=&quot;rounded-full&quot;&gt;
										&lt;div
											class=&quot;absolute end-0 m-1.5 h-4 w-4 rounded-full border-2 border-white bg-success&quot;&gt;
										&lt;/div&gt;
									&lt;/div&gt;
									&lt;div class=&quot;relative h-32 w-32 inline-flex&quot;&gt;
										&lt;img src=&quot;/images/users/avatar-7.jpg&quot; alt=&quot;image&quot; class=&quot;rounded-full&quot;&gt;
										&lt;div
											class=&quot;absolute end-0 m-2  h-5 w-5 rounded-full border-[3px] border-white bg-success&quot;&gt;
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
                    <h4 class="card-title">Sizing - Background Color</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#Bg_Avatar_Rounded_Html">
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
                <div class="flex flex-wrap items-end gap-3">
                    <div class="w-8 h-8 justify-center items-center flex bg-primary rounded">
                        <span class="text-white">CT</span>
                    </div>

                    <div class="w-12 h-12 justify-center items-center flex bg-dark rounded">
                        <span class="text-white text-lg">CT</span>
                    </div>

                    <div class="w-16 h-16 justify-center items-center flex bg-success rounded">
                        <span class="text-white text-xl">CT</span>
                    </div>

                    <div class="w-20 h-20 justify-center items-center flex bg-info rounded">
                        <span class="text-white text-2xl">CT</span>
                    </div>

                    <div class="w-24 h-24 justify-center items-center flex bg-danger rounded">
                        <span class="text-white text-2xl">CT</span>
                    </div>

                    <div class="w-28 h-28 justify-center items-center flex bg-info/25 rounded">
                        <span class="text-info text-3xl">CT</span>
                    </div>

                    <div class="w-32 h-32 justify-center items-center flex bg-primary/25 rounded">
                        <span class="text-primary text-4xl">CT</span>
                    </div>
                </div>
                <div id="Bg_Avatar_Rounded_Html" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;div class=&quot;w-8 h-8 justify-center items-center flex bg-primary rounded&quot;&gt;
										&lt;span class=&quot;text-white&quot;&gt;CT&lt;/span&gt;
									&lt;/div&gt;
	
									&lt;div class=&quot;w-12 h-12 justify-center items-center flex bg-dark rounded&quot;&gt;
										&lt;span class=&quot;text-white text-lg&quot;&gt;CT&lt;/span&gt;
									&lt;/div&gt;
	
									&lt;div class=&quot;w-16 h-16 justify-center items-center flex bg-success rounded&quot;&gt;
										&lt;span class=&quot;text-white text-xl&quot;&gt;CT&lt;/span&gt;
									&lt;/div&gt;
	
									&lt;div class=&quot;w-20 h-20 justify-center items-center flex bg-info rounded&quot;&gt;
										&lt;span class=&quot;text-white text-2xl&quot;&gt;CT&lt;/span&gt;
									&lt;/div&gt;
	
									&lt;div class=&quot;w-24 h-24 justify-center items-center flex bg-danger rounded&quot;&gt;
										&lt;span class=&quot;text-white text-2xl&quot;&gt;CT&lt;/span&gt;
									&lt;/div&gt;
	
									&lt;div class=&quot;w-28 h-28 justify-center items-center flex bg-info/25 rounded&quot;&gt;
										&lt;span class=&quot;text-info text-3xl&quot;&gt;CT&lt;/span&gt;
									&lt;/div&gt;
	
									&lt;div class=&quot;w-32 h-32 justify-center items-center flex bg-primary/25 rounded&quot;&gt;
										&lt;span class=&quot;text-primary text-4xl&quot;&gt;CT&lt;/span&gt;
									&lt;/div&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Rounded Circle Background</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#Bg_Avatar_Circle_Html">
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
                <div class="flex flex-wrap items-end gap-3">
                    <div class="w-8 h-8 justify-center items-center flex bg-primary rounded-full">
                        <span class="text-white">CT</span>
                    </div>

                    <div class="w-12 h-12 justify-center items-center flex bg-dark rounded-full">
                        <span class="text-white text-lg">CT</span>
                    </div>

                    <div class="w-16 h-16 justify-center items-center flex bg-success rounded-full">
                        <span class="text-white text-xl">CT</span>
                    </div>

                    <div class="w-20 h-20 justify-center items-center flex bg-info rounded-full">
                        <span class="text-white text-2xl">CT</span>
                    </div>

                    <div class="w-24 h-24 justify-center items-center flex bg-danger rounded-full">
                        <span class="text-white text-2xl">CT</span>
                    </div>

                    <div class="w-28 h-28 justify-center items-center flex bg-info/25 rounded-full">
                        <span class="text-info text-3xl">CT</span>
                    </div>

                    <div class="w-32 h-32 justify-center items-center flex bg-primary/25 rounded-full">
                        <span class="text-primary text-4xl">CT</span>
                    </div>
                </div>
                <div id="Bg_Avatar_Circle_Html" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;div class=&quot;w-8 h-8 justify-center items-center flex bg-primary rounded&quot;&gt;
										&lt;span class=&quot;text-white&quot;&gt;CT&lt;/span&gt;
									&lt;/div&gt;
	
									&lt;div class=&quot;w-12 h-12 justify-center items-center flex bg-dark rounded&quot;&gt;
										&lt;span class=&quot;text-white text-lg&quot;&gt;CT&lt;/span&gt;
									&lt;/div&gt;
	
									&lt;div class=&quot;w-16 h-16 justify-center items-center flex bg-success rounded&quot;&gt;
										&lt;span class=&quot;text-white text-xl&quot;&gt;CT&lt;/span&gt;
									&lt;/div&gt;
	
									&lt;div class=&quot;w-20 h-20 justify-center items-center flex bg-info rounded&quot;&gt;
										&lt;span class=&quot;text-white text-2xl&quot;&gt;CT&lt;/span&gt;
									&lt;/div&gt;
	
									&lt;div class=&quot;w-24 h-24 justify-center items-center flex bg-danger rounded&quot;&gt;
										&lt;span class=&quot;text-white text-2xl&quot;&gt;CT&lt;/span&gt;
									&lt;/div&gt;
	
									&lt;div class=&quot;w-28 h-28 justify-center items-center flex bg-info/25 rounded&quot;&gt;
										&lt;span class=&quot;text-info text-3xl&quot;&gt;CT&lt;/span&gt;
									&lt;/div&gt;
	
									&lt;div class=&quot;w-32 h-32 justify-center items-center flex bg-primary/25 rounded&quot;&gt;
										&lt;span class=&quot;text-primary text-4xl&quot;&gt;CT&lt;/span&gt;
									&lt;/div&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Rounded Circle Background Top Status</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#Bg_Avatar_Circle_2_Html">
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
                <div class="flex flex-wrap items-end gap-3">
                    <div class="relative inline-flex">
                        <div class="w-8 h-8 justify-center items-center flex bg-primary rounded-full">
                            <span class="text-white">CT</span>
                        </div>
                        <div class="absolute end-0 h-2 w-2 rounded-full border border-white bg-success"></div>
                    </div>

                    <div class="relative inline-flex">
                        <div class="w-12 h-12 justify-center items-center flex bg-dark rounded-full">
                            <span class="text-white text-lg">CT</span>
                        </div>
                        <div class="absolute end-0 m-0.5 h-2.5 w-2.5 rounded-full border border-white bg-success"></div>
                    </div>

                    <div class="relative inline-flex">
                        <div class="w-16 h-16 justify-center items-center flex bg-success/25 rounded-full">
                            <span class="text-success text-xl">CT</span>
                        </div>
                        <div class="absolute end-0 m-1 h-3 w-3 rounded-full border border-white bg-gray-400"></div>
                    </div>

                    <div class="relative inline-flex">
                        <div class="w-20 h-20 justify-center items-center flex bg-info rounded-full">
                            <span class="text-white text-2xl">CT</span>
                        </div>
                        <div class="absolute end-0 m-1.5 h-3 w-3 rounded-full border border-white bg-danger"></div>
                    </div>

                    <div class="relative inline-flex">
                        <div class="w-24 h-24 justify-center items-center flex bg-danger rounded-full">
                            <span class="text-white text-2xl">CT</span>
                        </div>
                        <div class="absolute end-0 m-2 h-3.5 w-3.5 rounded-full border-2 border-white bg-primary"></div>
                    </div>

                    <div class="relative inline-flex">
                        <div class="w-28 h-28 justify-center items-center flex bg-info/25 rounded-full">
                            <span class="text-info text-3xl">CT</span>
                        </div>
                        <div class="absolute end-0 m-2.5 h-4 w-4 rounded-full border-2 border-white bg-primary"></div>
                    </div>

                    <div class="relative inline-flex">
                        <div class="w-32 h-32 justify-center items-center flex bg-primary/25 rounded-full">
                            <span class="text-primary text-4xl">CT</span>
                        </div>
                        <div class="absolute end-0 m-2.5 h-5 w-5 rounded-full border-4 border-white bg-success"></div>
                    </div>
                </div>
                <div id="Bg_Avatar_Circle_2_Html" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;div class=&quot;relative inline-flex&quot;&gt;
										&lt;div class=&quot;w-8 h-8 justify-center items-center flex bg-primary rounded-full&quot;&gt;
											&lt;span class=&quot;text-white&quot;&gt;CT&lt;/span&gt;
										&lt;/div&gt;
										&lt;div class=&quot;absolute end-0 h-2 w-2 rounded-full border border-white bg-success&quot;&gt;
										&lt;/div&gt;
									&lt;/div&gt;

									&lt;div class=&quot;relative inline-flex&quot;&gt;
										&lt;div class=&quot;w-12 h-12 justify-center items-center flex bg-dark rounded-full&quot;&gt;
											&lt;span class=&quot;text-white text-lg&quot;&gt;CT&lt;/span&gt;
										&lt;/div&gt;
										&lt;div
											class=&quot;absolute end-0 m-0.5 h-2.5 w-2.5 rounded-full border border-white bg-success&quot;&gt;
										&lt;/div&gt;
									&lt;/div&gt;

									&lt;div class=&quot;relative inline-flex&quot;&gt;
										&lt;div class=&quot;w-16 h-16 justify-center items-center flex bg-success/25 rounded-full&quot;&gt;
											&lt;span class=&quot;text-success text-xl&quot;&gt;CT&lt;/span&gt;
										&lt;/div&gt;
										&lt;div
											class=&quot;absolute end-0 m-1 h-3 w-3 rounded-full border border-white bg-gray-400&quot;&gt;
										&lt;/div&gt;
									&lt;/div&gt;

									&lt;div class=&quot;relative inline-flex&quot;&gt;
										&lt;div class=&quot;w-20 h-20 justify-center items-center flex bg-info rounded-full&quot;&gt;
											&lt;span class=&quot;text-white text-2xl&quot;&gt;CT&lt;/span&gt;
										&lt;/div&gt;
										&lt;div
											class=&quot;absolute end-0 m-1.5 h-3 w-3 rounded-full border border-white bg-danger&quot;&gt;
										&lt;/div&gt;
									&lt;/div&gt;

									&lt;div class=&quot;relative inline-flex&quot;&gt;
										&lt;div class=&quot;w-24 h-24 justify-center items-center flex bg-danger rounded-full&quot;&gt;
											&lt;span class=&quot;text-white text-2xl&quot;&gt;CT&lt;/span&gt;
										&lt;/div&gt;
										&lt;div
											class=&quot;absolute end-0 m-2 h-3.5 w-3.5 rounded-full border-2 border-white bg-primary&quot;&gt;
										&lt;/div&gt;
									&lt;/div&gt;

									&lt;div class=&quot;relative inline-flex&quot;&gt;
										&lt;div class=&quot;w-28 h-28 justify-center items-center flex bg-info/25 rounded-full&quot;&gt;
											&lt;span class=&quot;text-info text-3xl&quot;&gt;CT&lt;/span&gt;
										&lt;/div&gt;
										&lt;div
											class=&quot;absolute end-0 m-2.5 h-4 w-4 rounded-full border-2 border-white bg-primary&quot;&gt;
										&lt;/div&gt;
									&lt;/div&gt;

									&lt;div class=&quot;relative inline-flex&quot;&gt;
										&lt;div class=&quot;w-32 h-32 justify-center items-center flex bg-primary/25 rounded-full&quot;&gt;
											&lt;span class=&quot;text-primary text-4xl&quot;&gt;CT&lt;/span&gt;
										&lt;/div&gt;
										&lt;div
											class=&quot;absolute end-0 m-2.5 h-5 w-5 rounded-full border-4 border-white bg-success&quot;&gt;
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
                    <h4 class="card-title">Circular avatars with bottom status</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#Avatar_Circle_Bottom_Html">
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
                <div class="flex flex-wrap items-end gap-3">
                    <div class="relative inline-block">
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-1.jpg" alt="Image Description">
                        <span class="absolute bottom-0 end-0 block h-1.5 w-1.5 rounded-full ring-2 ring-white bg-gray-400"></span>
                    </div>
                    <div class="relative inline-block">
                        <img class="inline-block h-9 w-9 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-2.jpg" alt="Image Description">
                        <span class="absolute bottom-0 end-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white bg-red-400"></span>
                    </div>
                    <div class="relative inline-block">
                        <img class="inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-3.jpg" alt="Image Description">
                        <span class="absolute bottom-0 end-0 block h-3 w-3 rounded-full ring-2 ring-white bg-green-400"></span>
                    </div>
                    <div class="relative inline-block">
                        <img class="inline-block h-16 w-16 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-4.jpg" alt="Image Description">
                        <span class="absolute bottom-0 end-0 block h-3.5 w-3.5 rounded-full ring-2 ring-white bg-orange-400"></span>
                    </div>
                </div>
                <div id="Avatar_Circle_Bottom_Html" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;div class=&quot;relative inline-block&quot;&gt;
										&lt;img class=&quot;inline-block h-8 w-8 rounded-full ring-2 ring-white dark:ring-gray-800&quot; src=&quot;/images/users/avatar-1.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;span class=&quot;absolute bottom-0 end-0 block h-1.5 w-1.5 rounded-full ring-2 ring-white bg-gray-400&quot;&gt;&lt;/span&gt;
									&lt;/div&gt;
									&lt;div class=&quot;relative inline-block&quot;&gt;
										&lt;img class=&quot;inline-block h-9 w-9 rounded-full ring-2 ring-white dark:ring-gray-800&quot; src=&quot;/images/users/avatar-2.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;span class=&quot;absolute bottom-0 end-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white bg-red-400&quot;&gt;&lt;/span&gt;
									&lt;/div&gt;
									&lt;div class=&quot;relative inline-block&quot;&gt;
										&lt;img class=&quot;inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800&quot; src=&quot;/images/users/avatar-3.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;span class=&quot;absolute bottom-0 end-0 block h-3 w-3 rounded-full ring-2 ring-white bg-green-400&quot;&gt;&lt;/span&gt;
									&lt;/div&gt;
									&lt;div class=&quot;relative inline-block&quot;&gt;
										&lt;img class=&quot;inline-block h-16 w-16 rounded-full ring-2 ring-white dark:ring-gray-800&quot; src=&quot;/images/users/avatar-4.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;span class=&quot;absolute bottom-0 end-0 block h-3.5 w-3.5 rounded-full ring-2 ring-white bg-orange-400&quot;&gt;&lt;/span&gt;
									&lt;/div&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Rounded avatars with bottom status</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#Avatar_Circle_Rounded_Html">
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
                <div class="flex flex-wrap items-end gap-3">
                    <div class="relative inline-block">
                        <img class="inline-block h-8 w-8 rounded-md ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-1.jpg" alt="Image Description">
                        <span class="absolute bottom-0 end-0 block h-1.5 w-1.5 rounded-full transform translate-y-1/2 translate-x-1/2 ring-2 ring-white bg-gray-400"></span>
                    </div>
                    <div class="relative inline-block">
                        <img class="inline-block h-9 w-9 rounded-md ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-2.jpg" alt="Image Description">
                        <span class="absolute bottom-0 end-0 block h-2.5 w-2.5 rounded-full transform translate-y-1/2 translate-x-1/2 ring-2 ring-white bg-red-400"></span>
                    </div>
                    <div class="relative inline-block">
                        <img class="inline-block h-12 w-12 rounded-md ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-3.jpg" alt="Image Description">
                        <span class="absolute bottom-0 end-0 block h-3 w-3 rounded-full transform translate-y-1/2 translate-x-1/2 ring-2 ring-white bg-green-400"></span>
                    </div>
                    <div class="relative inline-block">
                        <img class="inline-block h-16 w-16 rounded-md ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-4.jpg" alt="Image Description">
                        <span class="absolute bottom-0 end-0 block h-3.5 w-3.5 rounded-full transform translate-y-1/2 translate-x-1/2 ring-2 ring-white bg-orange-400"></span>
                    </div>
                </div>
                <div id="Avatar_Circle_Rounded_Html" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;div class=&quot;relative inline-block&quot;&gt;
										&lt;img class=&quot;inline-block h-8 w-8 rounded-md ring-2 ring-white dark:ring-gray-800&quot; src=&quot;/images/users/avatar-1.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;span class=&quot;absolute bottom-0 end-0 block h-1.5 w-1.5 rounded-full transform translate-y-1/2 translate-x-1/2 ring-2 ring-white bg-gray-400&quot;&gt;&lt;/span&gt;
									&lt;/div&gt;
									&lt;div class=&quot;relative inline-block&quot;&gt;
										&lt;img class=&quot;inline-block h-9 w-9 rounded-md ring-2 ring-white dark:ring-gray-800&quot; src=&quot;/images/users/avatar-2.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;span class=&quot;absolute bottom-0 end-0 block h-2.5 w-2.5 rounded-full transform translate-y-1/2 translate-x-1/2 ring-2 ring-white bg-red-400&quot;&gt;&lt;/span&gt;
									&lt;/div&gt;
									&lt;div class=&quot;relative inline-block&quot;&gt;
										&lt;img class=&quot;inline-block h-12 w-12 rounded-md ring-2 ring-white dark:ring-gray-800&quot; src=&quot;/images/users/avatar-3.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;span class=&quot;absolute bottom-0 end-0 block h-3 w-3 rounded-full transform translate-y-1/2 translate-x-1/2 ring-2 ring-white bg-green-400&quot;&gt;&lt;/span&gt;
									&lt;/div&gt;
									&lt;div class=&quot;relative inline-block&quot;&gt;
										&lt;img class=&quot;inline-block h-16 w-16 rounded-md ring-2 ring-white dark:ring-gray-800&quot; src=&quot;/images/users/avatar-4.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;span class=&quot;absolute bottom-0 end-0 block h-3.5 w-3.5 rounded-full transform translate-y-1/2 translate-x-1/2 ring-2 ring-white bg-orange-400&quot;&gt;&lt;/span&gt;
									&lt;/div&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Media</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#Avatar_Media_Html">
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
                <div class="flex flex-wrap items-end gap-3">
                    <div class="flex-shrink-0 group block">
                        <div class="flex items-center">
                            <img class="inline-block flex-shrink-0 h-16 w-16 rounded-full" src="/images/users/avatar-5.jpg" alt="Image Description">
                            <div class="ms-3">
                                <h3 class="font-semibold text-gray-800 dark:text-white">Scote Wanner</h3>
                                <p class="text-sm font-medium text-gray-400">scote@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="Avatar_Media_Html" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-auto">
								<code>
									&lt;div class=&quot;flex items-center&quot;&gt;
										&lt;img class=&quot;inline-block flex-shrink-0 h-16 w-16 rounded-full&quot;
											src=&quot;/images/users/avatar-5.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;div class=&quot;ms-3&quot;&gt;
											&lt;h3 class=&quot;font-semibold text-gray-800 dark:text-white&quot;&gt;Scote Wanner&lt;/h3&gt;
											&lt;p class=&quot;text-sm font-medium text-gray-400&quot;&gt;scote@gmail.com&lt;/p&gt;
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
                    <h4 class="card-title">Image - Background Color</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#Avatar_Img_bg_Html">
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
                <div class="flex gap-3">
                    <div class="flex -space-x-2">
                        <img class="inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-800" src="/images/users/avatar-1.jpg" alt="Image Description">
                        <div class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-warning text-white border-2 border-white dark:border-gray-800">
                            <span class="font-medium leading-none">CT</span>
                        </div>
                        <img class="inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-800" src="/images/users/avatar-2.jpg" alt="Image Description">
                        <img class="inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-800" src="/images/users/avatar-3.jpg" alt="Image Description">
                        <div class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-info text-white border-2 border-white dark:border-gray-800">
                            <span class="font-medium leading-none">CT</span>
                        </div>
                    </div>
                </div>
                <div id="Avatar_Img_bg_Html" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;div class=&quot;flex -space-x-2&quot;&gt;
										&lt;img class=&quot;inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-800&quot; src=&quot;/images/users/avatar-1.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;div class=&quot;inline-flex items-center justify-center h-12 w-12 rounded-full bg-warning text-white border-2 border-white dark:border-gray-800&quot;&gt;
											&lt;span class=&quot;font-medium leading-none&quot;&gt;CT&lt;/span&gt;
										&lt;/div&gt;
										&lt;img class=&quot;inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-800&quot; src=&quot;/images/users/avatar-2.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;img class=&quot;inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-800&quot; src=&quot;/images/users/avatar-3.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;div class=&quot;inline-flex items-center justify-center h-12 w-12 rounded-full bg-info text-white border-2 border-white dark:border-gray-800&quot;&gt;
											&lt;span class=&quot;font-medium leading-none&quot;&gt;CT&lt;/span&gt;
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
                    <h4 class="card-title">Stack</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#Avatar_Stack_Html">
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
                <div class="flex-col space-y-2">
                    <div class="flex">
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-1.jpg" alt="Image Description">
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-2.jpg" alt="Image Description">
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-3.jpg" alt="Image Description">
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-4.jpg" alt="Image Description">
                    </div>
                    <div class="flex">
                        <img class="inline-block h-9 w-9 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-1.jpg" alt="Image Description">
                        <img class="inline-block h-9 w-9 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-2.jpg" alt="Image Description">
                        <img class="inline-block h-9 w-9 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-3.jpg" alt="Image Description">
                        <img class="inline-block h-9 w-9 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-4.jpg" alt="Image Description">
                    </div>
                    <div class="flex">
                        <img class="inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-1.jpg" alt="Image Description">
                        <img class="inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-2.jpg" alt="Image Description">
                        <img class="inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-3.jpg" alt="Image Description">
                        <img class="inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-4.jpg" alt="Image Description">
                    </div>
                    <div class="flex">
                        <img class="inline-block h-16 w-16 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-1.jpg" alt="Image Description">
                        <img class="inline-block h-16 w-16 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-2.jpg" alt="Image Description">
                        <img class="inline-block h-16 w-16 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-3.jpg" alt="Image Description">
                        <img class="inline-block h-16 w-16 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-4.jpg" alt="Image Description">
                    </div>
                </div>
                <div id="Avatar_Stack_Html" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;div class=&quot;flex&quot;&gt;
									&lt;img class=&quot;inline-block h-8 w-8 rounded-full ring-2 ring-white dark:ring-gray-800&quot;
										src=&quot;/images/users/avatar-1.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;img class=&quot;inline-block h-8 w-8 rounded-full ring-2 ring-white dark:ring-gray-800&quot;
										src=&quot;/images/users/avatar-2.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;img class=&quot;inline-block h-8 w-8 rounded-full ring-2 ring-white dark:ring-gray-800&quot;
										src=&quot;/images/users/avatar-3.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;img class=&quot;inline-block h-8 w-8 rounded-full ring-2 ring-white dark:ring-gray-800&quot;
										src=&quot;/images/users/avatar-4.jpg&quot; alt=&quot;Image Description&quot;&gt;
								&lt;/div&gt;
								&lt;div class=&quot;flex&quot;&gt;
									&lt;img class=&quot;inline-block h-9 w-9 rounded-full ring-2 ring-white dark:ring-gray-800&quot;
										src=&quot;/images/users/avatar-1.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;img class=&quot;inline-block h-9 w-9 rounded-full ring-2 ring-white dark:ring-gray-800&quot;
										src=&quot;/images/users/avatar-2.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;img class=&quot;inline-block h-9 w-9 rounded-full ring-2 ring-white dark:ring-gray-800&quot;
										src=&quot;/images/users/avatar-3.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;img class=&quot;inline-block h-9 w-9 rounded-full ring-2 ring-white dark:ring-gray-800&quot;
										src=&quot;/images/users/avatar-4.jpg&quot; alt=&quot;Image Description&quot;&gt;
								&lt;/div&gt;
								&lt;div class=&quot;flex&quot;&gt;
									&lt;img class=&quot;inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800&quot;
										src=&quot;/images/users/avatar-1.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;img class=&quot;inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800&quot;
										src=&quot;/images/users/avatar-2.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;img class=&quot;inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800&quot;
										src=&quot;/images/users/avatar-3.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;img class=&quot;inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800&quot;
										src=&quot;/images/users/avatar-4.jpg&quot; alt=&quot;Image Description&quot;&gt;
								&lt;/div&gt;
								&lt;div class=&quot;flex&quot;&gt;
									&lt;img class=&quot;inline-block h-16 w-16 rounded-full ring-2 ring-white dark:ring-gray-800&quot;
										src=&quot;/images/users/avatar-1.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;img class=&quot;inline-block h-16 w-16 rounded-full ring-2 ring-white dark:ring-gray-800&quot;
										src=&quot;/images/users/avatar-2.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;img class=&quot;inline-block h-16 w-16 rounded-full ring-2 ring-white dark:ring-gray-800&quot;
										src=&quot;/images/users/avatar-3.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;img class=&quot;inline-block h-16 w-16 rounded-full ring-2 ring-white dark:ring-gray-800&quot;
										src=&quot;/images/users/avatar-4.jpg&quot; alt=&quot;Image Description&quot;&gt;
								&lt;/div&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Border color</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#Avatar_border_Html">
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
                <div class="flex flex-col gap-3">
                    <div class="flex gap-2">
                        <img class="inline-block h-8 w-8 rounded-full border-2 border-primary" src="/images/users/avatar-1.jpg" alt="Image Description">
                        <img class="inline-block h-8 w-8 rounded-full border-2 border-primary" src="/images/users/avatar-2.jpg" alt="Image Description">
                        <img class="inline-block h-8 w-8 rounded-full border-2 border-primary" src="/images/users/avatar-3.jpg" alt="Image Description">
                        <img class="inline-block h-8 w-8 rounded-full border-2 border-primary" src="/images/users/avatar-4.jpg" alt="Image Description">
                    </div>
                    <div class="flex gap-2">
                        <img class="inline-block h-9 w-9 rounded-full border-2 border-red-300" src="/images/users/avatar-1.jpg" alt="Image Description">
                        <img class="inline-block h-9 w-9 rounded-full border-2 border-red-300" src="/images/users/avatar-2.jpg" alt="Image Description">
                        <img class="inline-block h-9 w-9 rounded-full border-2 border-red-300" src="/images/users/avatar-3.jpg" alt="Image Description">
                        <img class="inline-block h-9 w-9 rounded-full border-2 border-red-300" src="/images/users/avatar-4.jpg" alt="Image Description">
                    </div>
                    <div class="flex gap-2">
                        <img class="inline-block h-12 w-12 rounded-full border-2 border-teal-500" src="/images/users/avatar-1.jpg" alt="Image Description">
                        <img class="inline-block h-12 w-12 rounded-full border-2 border-teal-500" src="/images/users/avatar-2.jpg" alt="Image Description">
                        <img class="inline-block h-12 w-12 rounded-full border-2 border-teal-500" src="/images/users/avatar-3.jpg" alt="Image Description">
                        <img class="inline-block h-12 w-12 rounded-full border-2 border-teal-500" src="/images/users/avatar-4.jpg" alt="Image Description">
                    </div>
                    <div class="flex gap-2">
                        <img class="inline-block h-16 w-16 rounded-full border-2 border-purple-400" src="/images/users/avatar-1.jpg" alt="Image Description">
                        <img class="inline-block h-16 w-16 rounded-full border-2 border-purple-400" src="/images/users/avatar-2.jpg" alt="Image Description">
                        <img class="inline-block h-16 w-16 rounded-full border-2 border-purple-400" src="/images/users/avatar-3.jpg" alt="Image Description">
                        <img class="inline-block h-16 w-16 rounded-full border-2 border-purple-400" src="/images/users/avatar-4.jpg" alt="Image Description">
                    </div>
                </div>

                <div id="Avatar_border_Html" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;div class=&quot;flex&quot;&gt;
										&lt;img class=&quot;inline-block h-8 w-8 rounded-full border-2 border-primary&quot; src=&quot;/images/users/avatar-1.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;img class=&quot;inline-block h-8 w-8 rounded-full border-2 border-primary&quot; src=&quot;/images/users/avatar-2.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;img class=&quot;inline-block h-8 w-8 rounded-full border-2 border-primary&quot; src=&quot;/images/users/avatar-3.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;img class=&quot;inline-block h-8 w-8 rounded-full border-2 border-primary&quot; src=&quot;/images/users/avatar-4.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;/div&gt;
									&lt;div class=&quot;flex&quot;&gt;
										&lt;img class=&quot;inline-block h-9 w-9 rounded-full border-2 border-red-300&quot; src=&quot;/images/users/avatar-1.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;img class=&quot;inline-block h-9 w-9 rounded-full border-2 border-red-300&quot; src=&quot;/images/users/avatar-2.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;img class=&quot;inline-block h-9 w-9 rounded-full border-2 border-red-300&quot; src=&quot;/images/users/avatar-3.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;img class=&quot;inline-block h-9 w-9 rounded-full border-2 border-red-300&quot; src=&quot;/images/users/avatar-4.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;/div&gt;
									&lt;div class=&quot;flex&quot;&gt;
										&lt;img class=&quot;inline-block h-12 w-12 rounded-full border-2 border-teal-500&quot; src=&quot;/images/users/avatar-1.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;img class=&quot;inline-block h-12 w-12 rounded-full border-2 border-teal-500&quot; src=&quot;/images/users/avatar-2.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;img class=&quot;inline-block h-12 w-12 rounded-full border-2 border-teal-500&quot; src=&quot;/images/users/avatar-3.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;img class=&quot;inline-block h-12 w-12 rounded-full border-2 border-teal-500&quot; src=&quot;/images/users/avatar-4.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;/div&gt;
									&lt;div class=&quot;flex&quot;&gt;
										&lt;img class=&quot;inline-block h-16 w-16 rounded-full border-2 border-purple-400&quot; src=&quot;/images/users/avatar-1.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;img class=&quot;inline-block h-16 w-16 rounded-full border-2 border-purple-400&quot; src=&quot;/images/users/avatar-2.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;img class=&quot;inline-block h-16 w-16 rounded-full border-2 border-purple-400&quot; src=&quot;/images/users/avatar-3.jpg&quot; alt=&quot;Image Description&quot;&gt;
										&lt;img class=&quot;inline-block h-16 w-16 rounded-full border-2 border-purple-400&quot; src=&quot;/images/users/avatar-4.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;/div&gt;
								</code>
							</pre>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Grid</h4>

                    <div class="flex items-center gap-2">
                        <button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="#Avatar_Grid_Html">
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
                <div class="flex flex-wrap items-end gap-3">
                    <div class="grid grid-cols-3 gap-4">
                        <img class="inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-1.jpg" alt="Image Description">
                        <img class="inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-2.jpg" alt="Image Description">
                        <img class="inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-3.jpg" alt="Image Description">
                        <img class="inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-4.jpg" alt="Image Description">
                        <img class="inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-5.jpg" alt="Image Description">
                        <img class="inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-6.jpg" alt="Image Description">
                        <img class="inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-7.jpg" alt="Image Description">
                        <img class="inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800" src="/images/users/avatar-8.jpg" alt="Image Description">
                        <div
                            class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-slate-200 border-2 border-white font-medium text-gray-700 shadow-sm align-middle hover:bg-slate-300 focus:outline-none focus:bg-primary/25 focus:text-primary focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-primary transition-all text-sm dark:bg-slate-700 dark:hover:bg-slate-600 dark:border-slate-800 dark:text-gray-400 dark:hover:text-white dark:focus:bg-primary/25 dark:focus:text-primary dark:focus:ring-offset-gray-800">
                            <span class="font-medium leading-none">9+</span>
                        </div>
                    </div>
                </div>
                <div id="Avatar_Grid_Html" class="hidden w-full overflow-hidden transition-[height] duration-300">
                    <pre class="language-html h-56">
								<code>
									&lt;img class=&quot;inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800&quot; src=&quot;/images/users/avatar-1.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;img class=&quot;inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800&quot; src=&quot;/images/users/avatar-2.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;img class=&quot;inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800&quot; src=&quot;/images/users/avatar-3.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;img class=&quot;inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800&quot; src=&quot;/images/users/avatar-4.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;img class=&quot;inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800&quot; src=&quot;/images/users/avatar-5.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;img class=&quot;inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800&quot; src=&quot;/images/users/avatar-6.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;img class=&quot;inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800&quot; src=&quot;/images/users/avatar-7.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;img class=&quot;inline-block h-12 w-12 rounded-full ring-2 ring-white dark:ring-gray-800&quot; src=&quot;/images/users/avatar-8.jpg&quot; alt=&quot;Image Description&quot;&gt;
									&lt;div class=&quot;inline-flex items-center justify-center h-12 w-12 rounded-full bg-slate-200 border-2 border-white font-medium text-gray-700 shadow-sm align-middle hover:bg-slate-300 focus:outline-none focus:bg-primary/25 focus:text-primary focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-primary transition-all text-sm dark:bg-slate-700 dark:hover:bg-slate-600 dark:border-slate-800 dark:text-gray-400 dark:hover:text-white dark:focus:bg-primary/25 dark:focus:text-primary dark:focus:ring-offset-gray-800&quot;&gt;
										&lt;span class=&quot;font-medium leading-none&quot;&gt;9+&lt;/span&gt;
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
