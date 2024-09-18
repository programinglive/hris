@extends('layouts.vertical', ['title' => 'Calendar', 'sub_title' => 'Apps', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid lg:grid-cols-4 gap-6">
        <div class="card">
            <div class="p-6">
                <button class="px-3 py-2 rounded bg-primary text-white text-base w-full mb-4" id="btn-new-event" type="button">
                    <i class="mgc_add_line"></i>
                    Create New Event
                </button>

                <div class="flex flex-col gap-1" id="external-events">
                    <p class="text-sm text-slate-700 dark:text-slate-400 mb-4">Drag and drop your event or click in
                        the calendar</p>
                    <button class="external-event bg-success px-3 py-2 rounded text-white text-base text-start w-full mb-2" data-class="bg-success">
                        <i class="mgc_round_fill me-3 vertical-middle"></i>New Theme Release
                    </button>
                    <button class="external-event bg-info px-3 py-2 rounded text-white text-base text-start w-full mb-2" data-class="bg-info">
                        <i class="mgc_round_fill me-3 vertical-middle"></i>My Event
                    </button>
                    <button class="external-event bg-warning px-3 py-2 rounded text-white text-base text-start w-full mb-2" data-class="bg-warning">
                        <i class="mgc_round_fill me-3 vertical-middle"></i>Meet manager
                    </button>
                    <button class="external-event bg-danger px-3 py-2 rounded text-white text-base text-start w-full mb-2" data-class="bg-danger">
                        <i class="mgc_round_fill me-3 vertical-middle"></i>Create New theme
                    </button>
                </div>

                <div class="mt-5">
                    <h5 class="text-center mb-2">How It Works ?</h5>

                    <ul class="ps-3">
                        <li class="text-sm text-slate-700 dark:text-slate-400 mb-3">
                            It has survived not only five centuries, but also the leap into electronic typesetting,
                            remaining essentially unchanged.
                        </li>
                        <li class="text-sm text-slate-700 dark:text-slate-400 mb-3">
                            Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up
                            one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage.
                        </li>
                        <li class="text-sm text-slate-700 dark:text-slate-400 mb-3">
                            It has survived not only five centuries, but also the leap into electronic typesetting,
                            remaining essentially unchanged.
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3">
            <div class="card">
                <div class="p-6">
                    <div id="calendar"></div>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection

@section('script')
    @vite('resources/js/pages/apps-calendar.js')
@endsection
