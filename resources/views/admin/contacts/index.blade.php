@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('admin.navigation.contacts') }}</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li class="active">{{ Languages::trans('admin.navigation.contacts') }}</li>
@endsection

@section('content')

	{!! Form::open(['method'=>'POST', 'action'=>'Admin\ContactsController@postIndex', 'class'=>'form-horizontal']) !!}
		
		@include('admin.partial.errors')

		<div class="panel panel-default">
	
			<div class="panel-heading">
				<h4 class="panel-title">{{ Languages::trans('admin.navigation.contacts') }}</h4>
			</div>

			<div class="panel-body">

				<div class="form-group">
					{!! Form::label('name', Languages::trans('admin.settings.business_name') . ':', ['class'=>'col-sm-3 control-label']) !!}
					<div class="col-sm-6">
						<div class="input-group mb15">
							<span class="input-group-addon">{{ strtoupper(Languages::general()) }}: </span>
							{!! Form::text('name['.Languages::general().']', Contacts::trans('name', Languages::general()), ['class'=>'form-control']) !!}
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
									{!! Form::text('name['.$lang.']', Contacts::trans('name', $lang), ['class'=>'form-control']) !!}
								</div>

								@endforeach
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('address', Languages::trans('admin.settings.business_address') . ':', ['class'=>'col-sm-3 control-label']) !!}
					<div class="col-sm-6">
						<div class="input-group mb15">
							<span class="input-group-addon">{{ strtoupper(Languages::general()) }}: </span>
							{!! Form::text('address['.Languages::general().']', Contacts::trans('address', Languages::general()), ['class'=>'form-control']) !!}
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
									{!! Form::text('address['.$lang.']', Contacts::trans('address', $lang), ['class'=>'form-control']) !!}
								</div>

								@endforeach
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('phone', Languages::trans('admin.settings.business_phone') . ':', ['class'=>'col-sm-3 control-label']) !!}
					<div class="col-sm-6 mb15">
						{!! Form::text('phone', Contacts::get('phone'), ['class'=>'form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('email', Languages::trans('admin.settings.contact_email') . ':', ['class'=>'col-sm-3 control-label']) !!}
					<div class="col-sm-6 mb15">
						{!! Form::text('email', Contacts::get('email'), ['class'=>'form-control']) !!}
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