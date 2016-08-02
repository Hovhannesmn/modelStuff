@include('themes.modelle.partial.header')

<section class="page">
	
	@include('themes.modelle.partial.pageheader')

	<div class="container">
		<?php 
			$date = Carbon\Carbon::now();

			$forDate = Input::get('forDate')?Carbon\Carbon::createFromFormat('d-m-y', Input::get('forDate')) : Carbon\Carbon::now();
		?>
		<div class="dates">
			@for($i = 0; $i < 7; $i++)
				<?php if($i > 0){ $date->addDays(1); } ?>
				<a {!! ($date == $forDate)?'class="active date"':'class="date"' !!} href="?forDate={{ $date->format('d-m-y') }}" >{{ $date->format('l') }}</a>
			@endfor
		</div>

		<h2 class="header">Available girls</h2>
		<div class="row">
			@foreach(App\Profile::all() as $profile)
				@if($profile->confirmed && $profile->isWorkingDate($forDate->format('Y-m-d')))
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
		<div style="margin-bottom: 15px;"></div>
	</div>

	@include('themes.modelle.partial.pagefooter')

</section>

@include('themes.modelle.partial.footer')