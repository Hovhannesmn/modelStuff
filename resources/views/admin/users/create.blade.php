@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('admin.users.create_user') }}</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li><a href="{{ route('admin.users.index') }}">{{ Languages::trans('admin.navigation.users') }}</a></li>
  <li class="active">{{ Languages::trans('admin.users.create_user') }}</li>
@endsection

@section('content')

	@include('admin.partial.errors')
	
	{!! Form::open(['method'=>'POST', 'route'=>'admin.users.store', 'class'=>'form-horizontal']) !!}

		<div class="panel panel-default">
		
			<div class="panel-heading">
				<h4 class="panel-title">{{ Languages::trans('admin.users.create_user') }} :</h4>
			</div>

			<div class="panel-body">

				<div class="form-group">
					{!! Form::label('name', Languages::trans('admin.users.name') . ':', ['class'=>'col-sm-3 control-label']) !!}
					<div class="col-sm-6 mb15">
						{!! Form::text('name', null , ['class'=>'form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('password', Languages::trans('admin.users.password') . ':', ['class'=>'col-sm-3 control-label']) !!}
					<div class="col-sm-6 mb15">
						{!! Form::input('password', 'password', null , ['class'=>'form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('repeat_password', Languages::trans('admin.users.repeat_password') . ':', ['class'=>'col-sm-3 control-label']) !!}
					<div class="col-sm-6 mb15">
						{!! Form::input('password', 'password_confirmation', null , ['class'=>'form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('email', Languages::trans('admin.users.email') . ':', ['class'=>'col-sm-3 control-label']) !!}
					<div class="col-sm-6 mb15">
						{!! Form::text('email', null , ['class'=>'form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('role', Languages::trans('admin.users.role') . ':', ['class'=>'col-sm-3 control-label']) !!}
					<div class="col-sm-6">
						{!! Form::select('role[]', $roles, null, ['class'=>'form-control chosen-select', 'multiple'=>'true']) !!}
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
			$(".chosen-select").chosen({'width':'100%','white-space':'nowrap'}).change(function(){
				$(this).trigger('chosen:updated');
			});
		});
	</script>
@endsection