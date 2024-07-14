@extends('layouts.vertical', ['title' => 'Charts', 'sub_title' => 'Elements', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid lg:grid-cols-2 gap-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Line with Data Labels</h4>
            </div>
            <div class="p-6">

                <div id="line_chart_datalabel" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Dashed Line</h4>
            </div>
            <div class="p-6">
                <div id="line_chart_dashed" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Spline Area</h4>
            </div>
            <div class="p-6">

                <div id="spline_area" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Column Chart</h4>
            </div>
            <div class="p-6">
                <div id="column_chart" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Column with Data Labels</h4>
            </div>
            <div class="p-6">
                <div id="column_chart_datalabel" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Bar Chart</h4>
            </div>
            <div class="p-6">
                <div id="bar_chart" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Line, Column & Area Chart</h4>
            </div>
            <div class="p-6">
                <div id="mixed_chart" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Radial Chart</h4>
            </div>
            <div class="p-6">
                <div id="radial_chart" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->


        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Pie Chart</h4>
            </div>
            <div class="p-6">
                <div id="pie_chart" class="apex-charts" dir="ltr"></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title   ">Donut Chart</h4>
            </div>
            <div class="p-6">
                <div id="donut_chart" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @vite('resources/js/pages/charts-apex.js')
@endsection
