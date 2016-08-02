@extends('profile')

@section('page-title')
	<span>{{ Languages::trans('admin.breadcrumbs.model_profiles') }}</span>
@endsection

@section('breadcrumbs')
	<li class="active">{{ Languages::trans('admin.breadcrumbs.model_profiles') }}</li>
@endsection

@section('content')
	
	<div class="people-list">
		
		@foreach($profiles as $profile)

			<div class="col-md-6">
				<div class="people-item">
					<div class="media">
						<a href="#" class="pull-left">
							<?php $url = $profile->image?$profile->image->url:url('no_avatar.gif'); ?>
							<div class="people-img" style="background-image: url('{!! $url !!}');"></div>
						</a>
						<div class="media-body">
							<h4 class="person-name">{{ $profile->name }}</h4>
							<div class="text-muted">&nbsp;<i class="fa fa-mobile"></i>&nbsp;&nbsp;{{ $profile->cellphone }}</div>
							<div class="text-muted"><i class="fa ">@</i> {{ $profile->contact_email }}</div>
							<div class="mb10"></div>
							<a class="btn btn-xs btn-white" href="{!! url('profile/'.$profile->id) !!}"><i class="fa fa-female"></i>&nbsp;&nbsp;&nbsp;{{ Languages::trans('model.profile.view_profile') }}</a>&nbsp;&nbsp;&nbsp;
							@if($profile->confirmed)
							<a class="btn btn-xs btn-default" href="{!! url('profile/'.$profile->id.'/off') !!}"><i class="fa fa-times"></i>&nbsp;&nbsp;&nbsp;{{ Languages::trans('general.buttons.disable') }}</a>
							@else
							<a class="btn btn-xs btn-success" href="{!! url('profile/'.$profile->id.'/on') !!}"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;{{ Languages::trans('general.buttons.confirm') }}</a>
							@endif
						</div>
					</div>
				</div>
			</div>

		@endforeach

	</div>

@endsection

@section('footer-scripts')
<style>
	.people-img{
		width: 100px;
		height: 100px;
		display: inline-block;
		border-radius: 3px;
		border: 1px solid #eee;
		background-size: cover;
		background-position: top center;
	}
</style>
@endsection