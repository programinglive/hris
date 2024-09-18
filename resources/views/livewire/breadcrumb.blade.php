<div class="flex justify-between items-center">
	<h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">{{ $moduleLabel }}</h4>
	
	<div class="md:flex hidden items-center gap-2.5 text-sm font-semibold">
		@php
			$segments = request()->segments();
			$breadcrumbs = [];
			
			foreach ($segments as $segment) {
				$breadcrumbs[] = [
					'url' => url(implode('/', array_slice($segments, 0, count($breadcrumbs) + 1))),
					'text' => ucwords(str_replace('-', ' ', $segment))
				];
			}
		@endphp
		
		@foreach ($breadcrumbs as $key => $breadcrumb)
			<div class="flex items-center gap-2">
				@if($key != 0)
				<i class="mgc_right_line text-lg flex-shrink-0 text-slate-400 rtl:rotate-180"></i>
				@endif
				<a href="#" class="text-sm font-medium text-slate-700 dark:text-slate-400">{{ $breadcrumb['text'] }}</a>
			</div>
		@endforeach
	</div>
</div>