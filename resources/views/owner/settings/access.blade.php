@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('admin.navigation.access') }}</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li class="active">{{ Languages::trans('admin.navigation.access') }}</li>
@endsection

@section('content')

	{!! Form::open(['method'=>'POST', 'action'=>'Admin\SettingsController@postAccess', 'class'=>'form-horizontal']) !!}
		
		@include('admin.partial.errors')

		<div class="panel panel-default">
			
			<div class="panel-heading">
				<h4 class="panel-title">{{ Languages::trans('admin.settings.access_settings') }}</h4>
			</div>
			<div class="panel-body">

				<div class="form-group">
					<label class="col-sm-3 control-label" for="checkbox">&nbsp;</label>
					<div class="col-sm-6">
						<div class="checkbox block"><label>
							<input type="checkbox" checked=""> 
							{!! Form::checkbox('need_block', '1', Settings::hasBlockAccess(), []) !!}
							{{ Languages::trans('admin.settings.enable_access_blocking') }}
						</label></div>
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('role', Languages::trans('admin.settings.blocked_countries') . ':', ['class'=>'col-sm-3 control-label']) !!}
					<div class="col-sm-6">
						{!! Form::select('country[]', $countries, Settings::getBlockedCountries(), ['class'=>'form-control chosen-select', 'multiple'=>'true']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('role', Languages::trans('admin.settings.blocked_ip') . ':', ['class'=>'col-sm-3 control-label']) !!}
					<div class="col-sm-6">
						{!! Form::textarea('ip', implode(PHP_EOL, Settings::getBlockedIp()), ['class'=>'form-control']) !!}
						<p>{{ Languages::trans('admin.settings.every_ip_start_new_line') }}</p>
					</div>
				</div>

			</div>

		</div>

		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">

					{!! Form::submit(Languages::trans('general.buttons.save_changes'), ['class'=>'btn btn-primary']) !!}

				</div>
			</div>
		</div>

	{!! Form::close() !!}

@endsection

@section('footer-scripts')
	<script>
		jQuery(function($){
			$(".chosen-select").chosen({'width':'100%'}).change(function(){
				$(this).trigger('chosen:updated');
			});
		});
	</script>
	<style>
		.chosen-container.chosen-container-multi .chosen-choices{
			height: auto !important;
		}
	</style>
@endsection