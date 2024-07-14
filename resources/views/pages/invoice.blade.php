@extends('layouts.vertical', ['title' => 'Invoice', 'sub_title' => 'Pages', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="card p-6">
        <!-- Grid -->
        <div class="flex justify-between">
            <div>
                <img class="h-6" src="/images/logo-dark.png" alt="">

                <h1 class="mt-2 text-lg md:text-xl font-semibold text-primary dark:text-white">Coderthemes Inc.</h1>
            </div>
            <!-- Col -->

            <div class="text-end">
                <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 dark:text-gray-200">Invoice #</h2>
                <span class="mt-1 block text-gray-500">3682303</span>

                <address class="mt-4 not-italic text-gray-800 dark:text-gray-200">
                    45 Roker Terrace<br>
                    Latheronwheel<br>
                    KW5 8NW, London<br>
                    United Kingdom<br>
                </address>
            </div>
            <!-- Col -->
        </div>
        <!-- End Grid -->

        <!-- Grid -->
        <div class="mt-8 grid grid-cols-2 gap-3">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Bill to:</h3>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Sara Williams</h3>
                <address class="mt-2 not-italic text-gray-500">
                    280 Suzanne Throughway,<br>
                    Breannabury, OR 45801,<br>
                    United States<br>
                </address>
            </div>
            <!-- Col -->

            <div class="sm:text-end space-y-2">
                <!-- Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                    <dl class="grid sm:grid-cols-5 gap-x-3">
                        <dt class="col-span-3 font-semibold text-gray-800 dark:text-gray-200">Invoice date:</dt>
                        <dd class="col-span-2 text-gray-500">03/10/2018</dd>
                    </dl>
                    <dl class="grid sm:grid-cols-5 gap-x-3">
                        <dt class="col-span-3 font-semibold text-gray-800 dark:text-gray-200">Due date:</dt>
                        <dd class="col-span-2 text-gray-500">03/11/2018</dd>
                    </dl>
                </div>
                <!-- End Grid -->
            </div>
            <!-- Col -->
        </div>
        <!-- End Grid -->

        <!-- Table -->
        <div class="mt-6">
            <div class="border border-gray-200 p-4 rounded-lg space-y-4 dark:border-gray-700">
                <div class="grid grid-cols-5">
                    <div class="sm:col-span-2 text-xs font-medium text-gray-500 uppercase">Item</div>
                    <div class="text-left text-xs font-medium text-gray-500 uppercase">Qty</div>
                    <div class="text-left text-xs font-medium text-gray-500 uppercase">Rate</div>
                    <div class="text-end text-xs font-medium text-gray-500 uppercase">Amount</div>
                </div>

                <div class="hidden sm:block border-b border-gray-200 dark:border-gray-700"></div>

                <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                    <div class="col-span-full sm:col-span-2">
                        <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Item</h5>
                        <p class="font-medium text-gray-800 dark:text-gray-200">Design UX and UI</p>
                    </div>
                    <div>
                        <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Qty</h5>
                        <p class="text-gray-800 dark:text-gray-200">1</p>
                    </div>
                    <div>
                        <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Rate</h5>
                        <p class="text-gray-800 dark:text-gray-200">5</p>
                    </div>
                    <div>
                        <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Amount</h5>
                        <p class="sm:text-end text-gray-800 dark:text-gray-200">$500</p>
                    </div>
                </div>

                <div class="sm:hidden border-b border-gray-200 dark:border-gray-700"></div>

                <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                    <div class="col-span-full sm:col-span-2">
                        <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Item</h5>
                        <p class="font-medium text-gray-800 dark:text-gray-200">Web project</p>
                    </div>
                    <div>
                        <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Qty</h5>
                        <p class="text-gray-800 dark:text-gray-200">1</p>
                    </div>
                    <div>
                        <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Rate</h5>
                        <p class="text-gray-800 dark:text-gray-200">24</p>
                    </div>
                    <div>
                        <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Amount</h5>
                        <p class="sm:text-end text-gray-800 dark:text-gray-200">$1250</p>
                    </div>
                </div>

                <div class="sm:hidden border-b border-gray-200 dark:border-gray-700"></div>

                <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                    <div class="col-span-full sm:col-span-2">
                        <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Item</h5>
                        <p class="font-medium text-gray-800 dark:text-gray-200">SEO</p>
                    </div>
                    <div>
                        <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Qty</h5>
                        <p class="text-gray-800 dark:text-gray-200">1</p>
                    </div>
                    <div>
                        <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Rate</h5>
                        <p class="text-gray-800 dark:text-gray-200">6</p>
                    </div>
                    <div>
                        <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Amount</h5>
                        <p class="sm:text-end text-gray-800 dark:text-gray-200">$2000</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Table -->

        <!-- Flex -->
        <div class="mt-8 flex justify-end">
            <div class="w-full max-w-2xl sm:text-end space-y-2">
                <!-- Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                    <dl class="grid sm:grid-cols-5 gap-x-3">
                        <dt class="col-span-3 font-semibold text-gray-800 dark:text-gray-200">Subtotal:</dt>
                        <dd class="col-span-2 text-gray-500">$2750.00</dd>
                    </dl>

                    <dl class="grid sm:grid-cols-5 gap-x-3">
                        <dt class="col-span-3 font-semibold text-gray-800 dark:text-gray-200">Total:</dt>
                        <dd class="col-span-2 text-gray-500">$2750.00</dd>
                    </dl>

                    <dl class="grid sm:grid-cols-5 gap-x-3">
                        <dt class="col-span-3 font-semibold text-gray-800 dark:text-gray-200">Tax:</dt>
                        <dd class="col-span-2 text-gray-500">$39.00</dd>
                    </dl>

                    <dl class="grid sm:grid-cols-5 gap-x-3">
                        <dt class="col-span-3 font-semibold text-gray-800 dark:text-gray-200">Amount paid:</dt>
                        <dd class="col-span-2 text-gray-500">$2789.00</dd>
                    </dl>

                    <dl class="grid sm:grid-cols-5 gap-x-3">
                        <dt class="col-span-3 font-semibold text-gray-800 dark:text-gray-200">Due balance:</dt>
                        <dd class="col-span-2 text-gray-500">$0.00</dd>
                    </dl>
                </div>
                <!-- End Grid -->
            </div>
        </div>
        <!-- End Flex -->

        <div class="mt-8 sm:mt-12">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Thank you!</h4>
            <p class="text-gray-500">If you have any questions concerning this invoice, use the following contact information:</p>
            <div class="mt-2">
                <p class="block text-sm font-medium text-gray-800 dark:text-gray-200">example@site.com</p>
                <p class="block text-sm font-medium text-gray-800 dark:text-gray-200">+1 (062) 109-9222</p>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <p class="mt-5 text-sm text-gray-500">© 2023 Coderthemes.</p>

            <div class="flex gap-2 items-center print:hidden">
                <a href="javascript:window.print()" class="btn bg-primary text-white"><i class="mgc_print_line text-lg me-1"></i> Print</a>
                <a href="#" class="btn bg-info text-white">Submit</a>
            </div>
        </div>
    </div>
@endsection
