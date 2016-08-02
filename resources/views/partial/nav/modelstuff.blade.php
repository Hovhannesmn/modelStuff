
@if(Settings::get('website_type') == 'm' || (Settings::get('website_type') == 'c' && !Auth::user()->hasRole('admin')))

	<?php $step = intval(session('step')); ?>
	<?php //Session::put('step', 1); ?>
	@if($step > 0)
		<h5 class="sidebartitle">{{ Languages::trans('admin.navigation.step') }} 1:</h5>
		<ul class="nav nav-pills nav-stacked nav-bracket">
			<li class="{{ $step == 1?'active':'nav-disabled' }}"><a href="/model/profile/create"><i class="fa {{ $step == 1?'fa-file':'fa-check' }}"></i> <span>{{ Languages::trans('admin.navigation.create_profile') }}</span></a></li>
		</ul>
		@if($step > 1 && Auth::user()->profile)
			<?php $pid = Auth::user()->profile->id; ?>

			<h5 class="sidebartitle">{{ Languages::trans('admin.navigation.step') }} 2:</h5>
			<ul class="nav nav-pills nav-stacked nav-bracket">
				<li class="{{ $step == 2?'active':'nav-disabled' }}"><a href="/model/profile/{{ $pid }}/services"><i class="fa {{ $step > 2?'fa-check':'fa-cubes' }}"></i> <span>{{ Languages::trans('admin.navigation.choose_services') }}</span></a></li>
			</ul>

			<h5 class="sidebartitle">{{ Languages::trans('admin.navigation.step') }} 3:</h5>
			<ul class="nav nav-pills nav-stacked nav-bracket">
				<li class="{{ $step == 3?'active':'nav-disabled' }}"><a href="/profile/{{ $pid }}/schedule"><i class="fa {{ $step > 3?'fa-check':'fa-calendar' }}"></i> <span>{{ Languages::trans('admin.navigation.choose_schedule') }}</span></a></li>
			</ul>

			<h5 class="sidebartitle">{{ Languages::trans('admin.navigation.step') }} 4:</h5>
			<ul class="nav nav-pills nav-stacked nav-bracket">
				<li class="{{ $step == 4?'active':'' }}"><a href="/profile/{{ $pid }}/gallery"><i class="fa fa-th"></i> <span>{{ Languages::trans('admin.navigation.upload_images') }}</span></a></li>
			</ul>
		@endif
	@else
		@if(Auth::user()->profile)
			<?php $pid = Auth::user()->profile->id; ?>
			
			@if(Auth::user()->profile->image)
			<div id="model-profile">
				<h5 class="sidebartitle">{{ Languages::trans('admin.navigation.model') }}:</h5>
				<div class="leftpanel-profile">
					<div id="model-profile-img" style="background-image: url('{!! Auth::user()->profile->image->url !!}')"></div>
					<h4>{{ Auth::user()->profile->name }}</h4>
				</div>
			</div>
			@endif

			<h5 class="sidebartitle">{{ Languages::trans('general.labels.my') }}:</h5>

			<ul class="nav nav-pills nav-stacked nav-bracket">
				<li class="{{ Request::is('profile') ? 'active' : '' }}"><a href="/model/profile"><i class="fa fa-female"></i> <span>{{ Languages::trans('admin.navigation.profile') }}</span></a></li>
				<li class=""><a href="/model/profile/{{ $pid }}/services"><i class="fa fa-cubes"></i> <span>{{ Languages::trans('admin.navigation.services') }}</span></a></li>
				<li class=""><a href="/model/profile/{{ $pid }}/schedule"><i class="fa fa-calendar"></i> <span>{{ Languages::trans('admin.navigation.schedule') }}</span></a></li>
				<li class=""><a href="/model/profile/{{ $pid }}/gallery"><i class="fa fa-th"></i> <span>{{ Languages::trans('admin.navigation.gallery') }}</span></a></li>
			</ul>
		@endif

	@endif
@endif
