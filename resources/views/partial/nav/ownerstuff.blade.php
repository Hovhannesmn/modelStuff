
@if(Settings::get('website_type') == 'm' || (Settings::get('website_type') == 'c' && !Auth::user()->hasRole('admin')))

	<?php $step = intval(session('step')); ?>
	<?php //Session::put('step', 1); ?>
	@if($step > 0)
		<h5 class="sidebartitle">{{ Languages::trans('admin.navigation.step') }} 1:</h5>
		<ul class="nav nav-pills nav-stacked nav-bracket">
			<li class="{{ $step == 1?'active':'nav-disabled' }}">
				<a href="/owner/profile/create"><i class="fa {{ $step == 1?'fa-file':'fa-check' }}"></i> <span>{{ Languages::trans('admin.navigation.create_profile') }}</span></a></li>
		</ul>
		@if($step > 1 && Auth::user()->profile)
			<?php $pid = Auth::user()->profile->id; ?>

			<h5 class="sidebartitle">{{ Languages::trans('admin.navigation.step') }} 2:</h5>
			<ul class="nav nav-pills nav-stacked nav-bracket">
				<li class="{{ $step == 2?'active':'nav-disabled' }}"><a href="/profile/{{ $pid }}/services"><i class="fa {{ $step > 2?'fa-check':'fa-cubes' }}"></i> <span>{{ Languages::trans('admin.navigation.choose_services') }}</span></a></li>
			</ul>

			<h5 class="sidebartitle">{{ Languages::trans('admin.navigation.step') }} 3:</h5>
			<ul class="nav nav-pills nav-stacked nav-bracket">
				<li class="{{ $step == 3?'active':'nav-disabled' }}"><a href="/{{Auth::user()->roles[0]->name}}/profile/{{ $pid }}/lovehouse"><i class="fa {{ $step > 3?'fa-check':'fa-calendar' }}"></i> <span>{{ Languages::trans('admin.navigation.choose_schedule') }}</span></a></li>
			</ul>

			<h5 class="sidebartitle">{{ Languages::trans('admin.navigation.step') }} 4:</h5>
			<ul class="nav nav-pills nav-stacked nav-bracket">
				<li class="{{ $step == 2?'active':'' }}"><a href="/{{Auth::user()->roles[0]->name}}/profile/{{ $pid }}/gallery"><i class="fa fa-th"></i> <span>{{ Languages::trans('admin.navigation.upload_images') }}</span></a></li>
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
				<li class="{{ Request::is('profile') ? 'active' : '' }}"><a href="/owner/profile"><i class="fa fa-female"></i> <span>{{ Languages::trans('admin.navigation.profile') }}</span></a></li>
				<li class=""><a href="/owner/profile/{{ $pid }}/services"><i class="fa fa-cubes"></i> <span>{{ Languages::trans('admin.navigation.services') }}</span></a></li>
				<li class=""><a href="/owner/profile/{{ $pid }}/schedule"><i class="fa fa-calendar"></i> <span>{{ Languages::trans('admin.navigation.schedule') }}</span></a></li>
				<li class=""><a href="/owner/profile/{{ $pid }}/gallery"><i class="fa fa-th"></i> <span>{{ Languages::trans('admin.navigation.gallery') }}</span></a></li>
				<li class=""><a href="/owner/profile/love-house"><i class="fa fa-th"></i> <span>Love House{{ Languages::trans('Love House') }}</span></a></li>
				<li class="{{ Request::is('admin/users*') ? 'active' : '' }}"><a href="{{ route('owner.profile.users.index') }}"><i class="fa fa-user"></i> <span>{{ Languages::trans('admin.navigation.users') }}</span></a></li>
				<li class="nav-parent {{ Request::is('admin/media*') || Request::is('admin/sliders*') || Request::is('admin/galleries*') ? 'active nav-active' : '' }}">
					<a href="#"><i class="fa fa-desktop"></i> <span>{{ "Jobmarket" }}</span></a>
					<ul class="children" {!! Request::is('admin/media*') || Request::is('admin/sliders*') || Request::is('admin/galleries*') ? 'style="display: block;" ' : '' !!}>
						<li class=""><a href="/owner/profile/jobmarket/create"><i class="fa fa-th"></i> <span>create job{{ Languages::trans('Love House') }}</span></a></li>

						{{--<li {!! Request::is('admin/media*') ? 'class="active"' : '' !!} ><a href="/admin/media"><i class="fa fa-files-o"></i> {{ Languages::trans('admin.navigation.media_files') }}</a></li>--}}
						{{--<li {!! Request::is('admin/sliders*') ? 'class="active"' : '' !!} ><a href="/admin/sliders"><i class="fa fa-picture-o"></i> {{ Languages::trans('admin.navigation.sliders') }}</a></li>--}}
						{{--<li {!! Request::is('admin/galleries*') ? 'class="active"' : '' !!} ><a href="/admin/galleries"><i class="fa fa-th"></i> {{ Languages::trans('admin.navigation.galleries') }}</a></li>--}}
					</ul>
				</li>
			</ul>
		@endif

	@endif
@endif
