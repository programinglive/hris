<div class="container mx-auto">
	<x-markdown class="flex flex-col gap-2 p-5">
	{{ file_get_contents(base_path('README.md')) }}
	</x-markdown>
</div>

@push('styles')
	<style>
		h1, h2, h3, h4, h5, h6{
				font-weight: bold;
		}
	</style>
@endpush