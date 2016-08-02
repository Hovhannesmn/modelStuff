@include('themes.modelle.partial.header')

<section class="page">
	
	@include('themes.modelle.partial.pageheader')

	<div class="container">
		{!! $page->content['general'] !!}
	</div>

	@include('themes.modelle.partial.pagefooter')

</section>

@include('themes.modelle.partial.footer')