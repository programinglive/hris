<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="bg-blue-50">
        <header class="text-center bg-blue-500 text-white p-6">
            <h1 class="font-bold text-xl">Welcome to HRIS By ProgramingLive Community</h1>
        </header>
        <main class="max-w-xl mx-auto p-4 md:p-8 my-5 rounded-md bg-white shadow-2xl">
            <section class="text-center">
                <h3 class="font-bold text-2xl">Your Comprehensive HR Solution</h3>
                <p class="text-gray-600 mt-2">Manage your company's human resources efficiently with our user-friendly interface and powerful features.</p>
            </section>
            <section class="mt-5">
                <div class="flex flex-col items-center">
                    <a href="#" class="w-full px-4 py-2 rounded-md text-center text-white bg-blue-500 hover:bg-blue-700 transition-colors mb-4 max-w-xs">Log in</a>
                    <a href="#" class="w-full px-4 py-2 rounded-md text-center text-blue-500 border border-blue-500 hover:bg-blue-50 transition-colors max-w-xs">Register</a>
                </div>
            </section>
        </main>
        <footer class="text-center text-blue-600 mt-8">
            <p>&copy; 2024 ProgramingLive Community | All rights reserved.</p>
        </footer>
    </body>
</html>
