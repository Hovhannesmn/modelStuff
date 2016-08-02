<?php 
	$template = Theme::template('girls')->forPage($page);

	$jumboImageID = $template->optionValue('jumbo_image');
	$jumboImage = $jumboImageID?App\Media::find($jumboImageID):null;
?>
@include('themes.modelle.partial.header')

<section class="page">
	
	@include('themes.modelle.partial.pageheader')

	<div class="container">
		<div class="row girls-jumbo">
			<img src="{!! url($jumboImage->url) !!}">
			<h1 class="girls-jumbo-text">{!! $template->optionValue('jumbo_text') !!}</h1>
		</div>
		<h2 class="header">Available girls</h2>
		<div class="row">
			@foreach(App\Profile::all() as $profile)
				@if($profile->confirmed && $profile->isWorkingDate())
				<div class="col-sm-3 profile-preview">
					<a href="girl?id={{ $profile->id }}" class="image" style="background-image: url('{!! $profile->image->url !!}')">
						<div class="inner">
							<div class="name">
								{{ $profile->name }}
							</div>
						</div>
					</a>
				</div>
				@endif
			@endforeach
		</div>

		<h2 class="header">Soon with us</h2>
		<div class="row">
			@foreach(App\Profile::all() as $profile)
				@if(!$profile->isWorkingDate() && $profile->confirmed)
				<div class="col-sm-3 profile-preview">
					<a href="girl?id={{ $profile->id }}" class="image" style="background-image: url('{!! $profile->image->url !!}')">
						<div class="inner">
							<div class="name">
								{{ $profile->name }}
							</div>
						</div>
					</a>
				</div>
				@endif
			@endforeach
		</div>

		<h2 class="header">Available services</h2>
		<div class="row">
			<?php 
				$services = App\Service::all();
				$serviceCount = $services->count();
				$serviceCount =  $serviceCount < 4?4:$serviceCount;
			?>
			@foreach($services->chunk($serviceCount / 4) as $serviceArray)
				<div class="col-sm-3">
					<ul class="services">
						@foreach($serviceArray as $service)
						<li><a href="#"><i class="fa fa-thumbs-up"></i>&nbsp;&nbsp;&nbsp;{{ Languages::fromArrayOrFallback($service->name) }}</a></li>
						@endforeach
					</ul>
				</div>
			@endforeach
		</div>
		<div style="margin-bottom: 50px;"></div>
	</div>

	@include('themes.modelle.partial.pagefooter')

</section>

@include('themes.modelle.partial.footer')