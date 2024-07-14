@extends('layouts.vertical', ['title' => 'Material Symbols', 'sub_title' => 'Icons', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
<div class="card">
	<div class="card-header">
		<div class="flex justify-between items-center">
			<h5 class="card-title">
				All Icons
				<span class="bg-primary/20 text-primary inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium ms-2">Google Icon</span>
			</h5>

			<a href="https://fonts.google.com/icons?icon.style=Rounded" target="_blank" class="btn-code">
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
    @vite('resources/js/pages/icons-material-symbols.js')
@endsection