@extends('layouts.vertical', ['title' => 'Data Table', 'sub_title' => 'Forms', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
    @vite(['node_modules/gridjs/dist/theme/mermaid.min.css'])
@endsection

@section('content')
    <div class="flex flex-col gap-6">
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Basic</h4>
                </div>
            </div>
            <div class="p-6">
                <p class="text-sm text-slate-700 dark:text-slate-400 mb-4">The most basic list group is an unordered list with list items and the proper classes. Build upon it with the options that follow, or with your own CSS as needed.</p>

                <div id="table-gridjs"></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Pagination</h4>
                </div>
            </div>
            <div class="p-6">
                <p class="text-sm text-slate-700 dark:text-slate-400 mb-4">Pagination can be enabled by setting <code>pagination: true</code>:</p>

                <div id="table-pagination"></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Search</h4>
                </div>
            </div>
            <div class="p-6">
                <p class="text-sm text-slate-700 dark:text-slate-400 mb-4">Grid.js supports global search on all rows and columns. Set <code>search: true</code> to enable the search plugin:</p>

                <div id="table-search"></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Sorting</h4>
                </div>
            </div>
            <div class="p-6">
                <p class="text-sm text-slate-700 dark:text-slate-400 mb-4">To enable sorting, simply add <code>sort: true</code> to your config:</p>

                <div id="table-sorting"></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Loading State</h4>
                </div>
            </div>
            <div class="p-6">
                <p class="text-sm text-slate-700 dark:text-slate-400 mb-4">Grid.js renders a loading bar automatically while it waits for the data to be fetched. Here we are using an async
                    function to demonstrate this behaviour (e.g. an async function can be a XHR call to a server backend)</p>

                <div id="table-loading-state"></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Fixed Header</h4>
                </div>
            </div>
            <div class="p-6">
                <p class="text-sm text-slate-700 dark:text-slate-400 mb-4">The most basic list group is an unordered list with list items and the proper classes. Build upon it with the options that follow, or with your own CSS as needed.</p>

                <div id="table-fixed-header"></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Hidden Columns</h4>
                </div>
            </div>
            <div class="p-6">
                <p class="text-sm text-slate-700 dark:text-slate-400 mb-4">Add <code>hidden: true</code> to the columns definition to hide them. </p>

                <div id="table-hidden-column"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite(['resources/js/pages/table-gridjs.js'])
@endsection
