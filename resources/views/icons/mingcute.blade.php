@extends('layouts.vertical', ['title' => 'Mingcute', 'sub_title' => 'Icons', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
<div class="card">
	<div class="card-header">
		<div class="flex justify-between items-center">
			<h5 class="card-title">
				All Icons
			</h5>

			<a href="https://www.mingcute.com/" target="_blank" class="btn-code">
				<span class="me-2">Documentaion</span>
				<i class="mgc_link_2_line text-sm"></i>
			</a>
		</div>
	</div>
	<div class="p-6">
		<div class="grid lg:grid-cols-5 md:grid-cols-3 gap-6 icons-list-demo" id="icons"></div>
	</div>
</div>
<!-- end card -->
@endsection

@section('script')
    @vite('resources/js/pages/icons-mingcute.js')
@endsection