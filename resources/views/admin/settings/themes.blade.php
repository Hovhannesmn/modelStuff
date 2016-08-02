@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('admin.navigation.theme_options') }}</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li class="active">{{ Languages::trans('admin.navigation.theme_options') }}</li>
@endsection

@section('content')
	
	<?php $active = Theme::config(Theme::active()); ?>

	<h3>{{ Languages::trans('admin.settings.active_theme') }}:</h3>
	<div class="row">
		<div class="col-sm-6">
			<div class="panel">
				<img style="width: 100%;" src="{!! Theme::getImage($active['slug']) !!}" alt="">
			</div>
		</div>
		<div class="col-xs-6">
			<table style="width: 100%;">
				<tbody>
					<tr>
						<td><strong>{{ Languages::trans('admin.settings.name') }}</strong></td>
						<td>{{ $active['name'] }}</td>
					</tr>
					<tr>
						<td><strong>{{ Languages::trans('admin.settings.slug') }}</strong></td>
						<td>{{ $active['slug'] }}</td>
					</tr>
					<tr>
						<td><strong>{{ Languages::trans('admin.settings.version') }}</strong></td>
						<td>{{ $active['version'] }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<h3>{{ Languages::trans('admin.settings.available_themes') }}:</h3>
	<?php $available = Theme::allNotActive(); ?>
	<div class="row">

		@foreach($available as $theme)

		<?php $config = Theme::config($theme); ?>

		<div class="col-xs-6 col-sm-3">
			<div class="panel panel-default">
				{!! Form::open(['method'=>'POST', 'action'=>'Admin\SettingsController@postThemes', 'class'=>'form-horizontal']) !!}
					{!! Form::input('hidden', 'themename', $theme) !!}
					<div class="panel-body">
						<img style="width: 100%;" src="{!! Theme::getImage($theme) !!}" alt="">
						<div class="mt10"><strong>{{ $config['name'] }}</strong> v {{ $config['version'] }}</div>
					</div>
					<div class="panel-footer">
						<button type="submit" class="btn btn-xs btn-success">{{ Languages::trans('general.buttons.activate') }}</button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>

		@endforeach

	</div>

@endsection