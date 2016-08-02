@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('admin.services.add_service') }}</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li><a href="{{ route('admin.services.index') }}">{{ Languages::trans('admin.navigation.services') }}</a></li>
  <li class="active">{{ Languages::trans('admin.services.add_service') }}</li>
@endsection

@section('content')

	@include('admin.partial.errors')
	
	{!! Form::open(['method'=>'POST', 'route'=>'admin.services.store', 'class'=>'form-horizontal']) !!}

		<div class="panel panel-default">
		
			<div class="panel-heading">
				<h4 class="panel-title">{{ Languages::trans('admin.services.add_service') }} :</h4>
			</div>

			<div class="panel-body">

				<div class="form-group">
					{!! Form::label('slug', Languages::trans('admin.services.slug') . ':', ['class'=>'col-sm-3 control-label']) !!}
					<div class="col-sm-6 mb15">
						{!! Form::text('slug', null , ['class'=>'form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('service_name', Languages::trans('admin.services.service_name') . ':', ['class'=>'col-sm-3 control-label']) !!}
					<div class="col-sm-6">
						<div class="input-group mb15">
							<span class="input-group-addon">{{ strtoupper(Languages::general()) }}: </span>
							{!! Form::text('name['.Languages::general().']', null, ['class'=>'form-control']) !!}
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
									{!! Form::text('name['.$lang.']', null, ['class'=>'form-control']) !!}
								</div>

								@endforeach
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">

					{!! Form::submit(Languages::trans('general.buttons.add'), ['class'=>'btn btn-primary']) !!}

				</div>
			</div>
		</div>

	{!! Form::close() !!}

@endsection