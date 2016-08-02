@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('admin.navigation.general_settings') }}</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li class="active">{{ Languages::trans('admin.navigation.settings') }}</li>
@endsection

@section('content')

	{!! Form::open(['method'=>'POST', 'action'=>'Admin\SettingsController@postGeneral', 'class'=>'form-horizontal']) !!}
		{!! Form::input('hidden', 'active_theme', Theme::active() , ['class'=>'form-control']) !!}
		
		@include('admin.partial.errors')

		<div class="panel panel-default">
			
			<div class="panel-heading">
				<h4 class="panel-title">{{ Languages::trans('admin.settings.website') }}</h4>
			</div>

			<div class="panel-body">

				<div class="form-group">
					{!! Form::label('website_type', Languages::trans('admin.settings.website_type') . ':', ['class'=>'col-sm-3 control-label']) !!}
					<div class="col-sm-6">
						{!! Form::select('website_type', ['m'=>Languages::trans('admin.settings.single_model'), 'c'=>Languages::trans('admin.settings.single_club')], Settings::get('website_type'), ['class'=>'form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('website_name', Languages::trans('admin.settings.website_name') . ':', ['class'=>'col-sm-3 control-label']) !!}
					<div class="col-sm-6">
						<div class="input-group mb15">
							<span class="input-group-addon">{{ strtoupper(Languages::general()) }}: </span>
							{!! Form::text('website_name['.Languages::general().']', Settings::trans('website_name', Languages::general()), ['class'=>'form-control']) !!}
							<span class="input-group-addon translations-toogle"><i class="fa fa-flag"></i></span>
						</div>
					</div>
					<div class="col-sm-6 col-sm-offset-3 translations">
						<div class="panel panel-default-alt">
							<div class="panel-heading">
								<h6 class="pane-title">{{ Languages::trans('general.labels.edit_translations') }}</h6>
							</div>
							<div class="panel-body">
								@foreach(Languages::allButGeneral() as $lang)

								<div class="input-group input-group-sm mb15">
									<span class="input-group-addon">{{ strtoupper($lang) }} :</span>
									{!! Form::text('website_name['.$lang.']', Settings::trans('website_name', $lang), ['class'=>'form-control']) !!}
								</div>

								@endforeach
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('website_description', Languages::trans('admin.settings.website_description') . ':', ['class'=>'col-sm-3 control-label']) !!}
					<div class="col-sm-6">
						<div class="input-group mb15">
							<span class="input-group-addon">{{ strtoupper(Languages::general()) }}: </span>
							{!! Form::text('website_description['.Languages::general().']', Settings::trans('website_description', Languages::general()), ['class'=>'form-control']) !!}
							<span class="input-group-addon translations-toogle"><i class="fa fa-flag"></i></span>
						</div>
					</div>
					<div class="col-sm-6 col-sm-offset-3 translations">
						<div class="panel panel-default-alt">
							<div class="panel-heading">
								<h6 class="pane-title">{{ Languages::trans('general.labels.edit_translations') }}</h6>
							</div>
							<div class="panel-body">
								@foreach(Languages::allButGeneral() as $lang)

								<div class="input-group input-group-sm mb15">
									<span class="input-group-addon">{{ strtoupper($lang) }} :</span>
									{!! Form::text('website_description['.$lang.']', Settings::trans('website_description', $lang), ['class'=>'form-control']) !!}
								</div>

								@endforeach
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('website_url', Languages::trans('admin.settings.website_url') . ':', ['class'=>'col-sm-3 control-label']) !!}
					<div class="col-sm-6 mb15">
						{!! Form::text('website_url', Settings::get('website_url'), ['class'=>'form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('system_email', Languages::trans('admin.settings.website_system_email') . ':', ['class'=>'col-sm-3 control-label']) !!}
					<div class="col-sm-6 mb15">
						{!! Form::text('system_email', Settings::get('system_email'), ['class'=>'form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('default_locale', Languages::trans('admin.settings.website_default_locale') . ':', ['class'=>'col-sm-3 control-label']) !!}
					<div class="col-sm-6">
						{!! Form::select('default_locale', Languages::all(), Settings::get('default_locale'), ['class'=>'form-control']) !!}
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