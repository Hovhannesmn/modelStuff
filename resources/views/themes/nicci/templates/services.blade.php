@include('themes.nicci.partial.header')

	@include('themes.nicci.partial.pageheader')
	
		<?php 
			$template = Theme::template('services')->forPage($page);
			$profile = Theme::getSetting('my_profile');
		?>
		<div style="padding-top: 15px;"></div>
		<div class="row">
			<div class="col-sm-6">
				{!! $page->content['left_side'] !!}
			</div>
			<div class="col-sm-6">
				<?php 
					$image_id = $template->optionValue('i_like_image');
					$image = $image_id?App\Media::find($image_id):null;
				?>
				@if($image)
				<div class="inset-img">
					<img src="{!! url($image->url) !!}" alt="">
				</div>
				@endif

				<h1 class="heading-l" style="margin-left: -15px;">{!! $template->optionValue('i_like_html') !!}</h1>
				@if($profile)
					<?php 
						$services = $profile->services;
						$serviceCount = $services->count();
						$serviceCount =  $serviceCount < 2?2:$serviceCount;
						$serviceCount % 2 == 0?:$serviceCount++;
					?>
					<div class="row">
						@foreach($services->chunk($serviceCount / 2) as $serviceArray)
							<div class="col-sm-6">
								<ul class="services">
									@foreach($serviceArray as $service)
									<li><i class="fa fa-thumbs-up text-primary"></i>&nbsp;&nbsp;&nbsp;{{ Languages::fromArrayOrFallback($service->name) }}</li>
									@endforeach
								</ul>
							</div>
						@endforeach
					</div>
				@endif
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<h1 class="heading-l" style="margin-left: -15px;">{!! $template->optionValue('i_notlike_html') !!}</h1>
				@if($profile)
					<?php 
						$services = App\Service::all()->diff($profile->services);
						$serviceCount = $services->count();
						$serviceCount =  $serviceCount < 2?2:$serviceCount;
						$serviceCount % 2 == 0?:$serviceCount++;
					?>
					<div class="row">
						@foreach($services->chunk($serviceCount / 2) as $serviceArray)
							<div class="col-sm-6">
								<ul class="services">
									@foreach($serviceArray as $service)
									<li><i class="fa fa-thumbs-down text-muted"></i>&nbsp;&nbsp;&nbsp;{{ Languages::fromArrayOrFallback($service->name) }}</li>
									@endforeach
								</ul>
							</div>
						@endforeach
					</div>
				@endif
			</div>
			<div class="col-sm-6">
				{!! $page->content['right_side'] !!}
			</div>
		</div>

	@include('themes.nicci.partial.pagefooter')

@include('themes.nicci.partial.footer')