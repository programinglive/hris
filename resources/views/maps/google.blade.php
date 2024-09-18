@extends('layouts.vertical', ['title' => 'Google Maps', 'sub_title' => 'Maps', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid lg:grid-cols-2 grid-cols-1 gap-6">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Basic Example</h4>
            </div>
            <div class="p-6">
                <div class="mb-3">
                    <div id="gmaps-basic" class="gmaps"></div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Markers Google Map</h4>
            </div>
            <div class="p-6">
                <div class="mb-3">
                    <div id="gmaps-markers" class="gmaps"></div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Street View Panoramas Google Map</h4>
            </div>
            <div class="p-6">
                <div class="mb-3">
                    <div id="panorama" class="gmaps"></div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Google Map Types</h4>
            </div>
            <div class="p-6">
                <div class="mb-3">
                    <div id="gmaps-types" class="gmaps"></div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Ultra Light With Labels</h4>
            </div>
            <div class="p-6">
                <div class="mb-3">
                    <div id="ultra-light" class="gmaps"></div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Dark</h4>
            </div>
            <div class="p-6">
                <div class="mb-3">
                    <div id="dark" class="gmaps"></div>
                </div>
            </div>
        </div>
        <!-- end card -->

    </div>
@endsection

@section('script')
    <!-- Google Maps API -->
    <script src="http://maps.google.com/maps/api/js"></script>

    <!-- Google Map Demo Js -->
    @vite('resources/js/pages/maps-google.js')
@endsection
