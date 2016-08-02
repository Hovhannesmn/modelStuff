@include('themes.nicci.partial.header')

	@include('themes.nicci.partial.pageheader')


		<?php 
			$template = Theme::template('home')->forPage($page);
			
			$slider_id = $template->optionValue('homepage_slider');
			$slider = $slider_id?App\Slider::find($slider_id):null;

			$image_id = $template->optionValue('mobile_image');
			$image = $image_id?App\Media::find($image_id):null;
		?>
		
		@if($slider)
			@if(count($slider->content))
			<div class="row hidden-xs" style="max-height: 400px; overflow: hidden;">
				<ul class="slider" style="list-style: none; margin: 0; padding: 0;">
					@foreach($slider->content as $img)
						<li><a href="#"><img src="{!! $img['url'] !!}"></a></li>
					@endforeach
				</ul>
			</div>
			@endif
		@endif

		@if($image)
		<div class="row visible-xs">
			<img src="{!! url($image->url) !!}" style="max-width: 100%;">
		</div>
		@endif
		
		<div class="home-description">
			{!! $page->content['general'] !!}
		</div>

	@include('themes.nicci.partial.pagefooter')

@include('themes.nicci.partial.footer')