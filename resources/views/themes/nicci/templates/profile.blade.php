@include('themes.nicci.partial.header')

	@include('themes.nicci.partial.pageheader')
		
		<?php 
			$profile = Theme::getSetting('my_profile');
		?>
		
		@if($profile)

		<div class="row" style="margin-top: 30px;">
			
			<div class="col-sm-5 pull-right-sm pr0-sm">
				@if($profile->image)
				<div class="profile-picture" style="background-image: url('{!! $profile->image->url !!}');" data-img="{!! $profile->image->url !!}" data-w="{{ $profile->image->width }}" data-h="{{ $profile->image->height }}"></div>
				@endif
				<div class="clearfix" style="margin-bottom: 30px;">
					@foreach($profile->images as $image)
					<div class="col-xs-6 col-sm-4 profile-image" style="background-image: url('{!! $image->url !!}');" data-img="{!! $image->url !!}" data-w="{{ $image->width }}" data-h="{{ $image->height }}"></div>
					@endforeach
				</div>
			</div>

			<div class="col-sm-7">
				<h1 class="heading-l" style="margin-left: -15px;">About <span class="text-primary">me</span></h1>
				<table class="profile-table">
					<tbody>
						<tr>
							<td class="text-primary">Availability</td>
							<td>Open</td>
						</tr>
						<tr>
							<td class="text-primary">Age</td>
							<td>{{ $profile->age }}</td>
						</tr>
						<tr>
							<td class="text-primary">Height</td>
							<td>{{ $profile->height }} sm</td>
						</tr>
						<tr>
							<td class="text-primary">Weight</td>
							<td>{{ $profile->weight }} kg</td>
						</tr>
						<tr>
							<td class="text-primary">Hair color</td>
							<td>{{ $profile->haircolor }}</td>
						</tr>
						<tr>
							<td class="text-primary">Breast</td>
							<td>{{ $profile->breast_number . $profile->breast_letter }}</td>
						</tr>
						<tr>
							<td class="text-primary">Nationality</td>
							<td>{{ $profile->nationality }}</td>
						</tr>
						<tr>
							<td class="text-primary">Languages</td>
							<td class="lang-cell">
								@foreach($profile->languages as $lang)
									<span class="lang-name">{{ $lang }}</span>
									<span class="lang-comma">, </span>
								@endforeach
							</td>
						</tr>
						<tr>
							<td class="text-primary">Smoking</td>
							<td>{{ $profile->smoke }}</td>
						</tr>
						<tr>
							<td class="text-primary">Drinks</td>
							<td>{{ $profile->drink }}</td>
						</tr>
					</tbody>
				</table>
				<h2 class="heading-m">{!! html_entity_decode(strip_tags(Languages::fromArrayOrFallback($profile->about_short, App::getLocale()), '<span><br><br/>')) !!}</h2>
				{!! html_entity_decode(strip_tags(Languages::fromArrayOrFallback($profile->about_full, App::getLocale()), '<span><br><br/>')) !!}
				<div style="margin-bottom: 15px;"></div>
				{!! $page->content['general'] !!}
			</div>
		</div>

		@endif

	@include('themes.nicci.partial.pagefooter')

	<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="pswp__bg"></div>
          <div class="pswp__scroll-wrap">
              <div class="pswp__container">
                  <div class="pswp__item"></div>
                  <div class="pswp__item"></div>
                  <div class="pswp__item"></div>
              </div>
              <div class="pswp__ui pswp__ui--hidden">
                  <div class="pswp__top-bar">
                      <div class="pswp__counter"></div>
                      <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                      <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                      <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                      <div class="pswp__preloader">
                          <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                              <div class="pswp__preloader__donut"></div>
                            </div>
                          </div>
                      </div>
                  </div>
                  <!-- <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                      <div class="pswp__share-tooltip"></div> 
                  </div> -->
                  <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                  </button>
                  <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                  </button>
                  <div class="pswp__caption">
                      <div class="pswp__caption__center"></div>
                  </div>
              </div>
          </div>
      </div>

@include('themes.nicci.partial.footer')