<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.shared/title-meta', ['title' => 'Error 500'])

    @include('layouts.shared/head-css')
</head>

<body>

    <div class="bg-gradient-to-r from-rose-100 to-teal-100 dark:from-gray-700 dark:via-gray-900 dark:to-black">
        <div class="h-screen w-screen flex justify-center items-center">
            <div class="flex flex-col justify-center text-center gap-6">
                <a href="/" class="flex justify-center mx-auto">
                    <img class="h-6 block dark:hidden" src="/images/logo-dark.png" alt="">
                    <img class="h-6 hidden dark:block" src="/images/logo-light.png" alt="">
                </a>
                <p class="text-3xl font-semibold text-gray-600 dark:text-gray-100">500</p>
                <h1 class="text-4xl font-bold tracking-tight dark:text-gray-100">Internal Server Error.</h1>
                <p class="text-base text-gray-600 dark:text-gray-300">Why not try refreshing your page? or you can contact Support.</p>
                <a href="/" class="text-base font-medium text-primary"> Go back home </a>
            </div>
        </div>
    </div>

</body>

</html>
