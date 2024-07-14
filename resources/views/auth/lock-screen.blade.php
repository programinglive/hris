<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.shared/title-meta', ['title' => "Lock Screen"])

    @include('layouts.shared/head-css')
</head>

<body>

<div class="bg-gradient-to-r from-rose-100 to-teal-100 dark:from-gray-700 dark:via-gray-900 dark:to-black">

    <div class="h-screen w-screen flex justify-center items-center">

        <div class="2xl:w-1/4 lg:w-1/3 md:w-1/2 w-full">
            <div class="card overflow-hidden sm:rounded-md rounded-none">
                <div class="p-6">
                    <div class="flex justify-between">
                        <div class="flex flex-col gap-4 mb-6">
                            <a href="{{ route('any', 'index') }}" class="block">
                                <img class="h-6 block dark:hidden" src="/images/logo-dark.png">
                                <img class="h-6 hidden dark:block" src="/images/logo-light.png">
                            </a>
                            <h4 class="text-slate-900 dark:text-slate-200/50 font-semibold">Hi ! Adam </h4>
                        </div>

                        <img src="/images/users/avatar-1.jpg" alt="user-image" class="h-16 w-16 rounded-full shadow">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="loggingPassword">Password</label>
                        <input id="loggingPassword" class="form-input" type="password" placeholder="Enter your password" >
                    </div>

                    <div class="flex justify-center mb-6">
                        <button class="btn w-full text-white bg-primary"> Log In </button>
                    </div>

                    <div class="flex items-center my-6">
                        <div class="flex-auto mt-px border-t border-dashed border-gray-200 dark:border-slate-700"></div>
                        <div class="mx-4 text-secondary">Or</div>
                        <div class="flex-auto mt-px border-t border-dashed border-gray-200 dark:border-slate-700"></div>
                    </div>


                    <p class="text-gray-500 dark:text-gray-400 text-center">Not you ? return<a href="{{ route('second', ['auth', 'login']) }}" class="text-primary ms-1"><b>Log In</b></a></p>
                </div>
            </div>
        </div>
    </div>

</div>

</body>

</html>
