<div class="ca-link mb15">
@foreach($template->contentAreas() as $areaSlug => $areaName)
	<div class="item">
		<a href="#">{{ $areaName }}</a>
		<textarea name="content[{{ $areaSlug }}]" style="display: none;">{!! $template->content($areaSlug) !!}</textarea>
	</div>
@endforeach
</div>