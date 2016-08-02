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

{{--	{!! Form::open(['method'=>'POST', 'route'=>'admin.users.store', 'class'=>'form-horizontal']) !!}--}}
	<form method="POST" action="/owner/profile/jobmarket/create" accept-charset="UTF-8" class="form-horizontal">
		<input name="_token" type="hidden" value="{{csrf_token()}}">

		<div class="panel panel-default">

		<div class="panel-heading">
			<h4 class="panel-title">{{ "Create job" }} :</h4>
		</div>

		<div class="panel-body">

			<div class="form-group">
				{!! Form::label('title', 'title' . ':', ['class'=>'col-sm-3 control-label']) !!}
				<div class="col-sm-6 mb15">
					{!! Form::text('title', null , ['class'=>'form-control']) !!}
				</div>
			</div>

			<div class="form-group">
				{!! Form::label('description', 'Description' . ':', ['class'=>'col-sm-3 control-label']) !!}
				<div class="col-sm-6 mb15">
					{!! Form::text('description', null , ['class'=>'form-control']) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('address', 'address' . ':', ['class'=>'col-sm-3 control-label']) !!}
				<div class="col-sm-6 mb15">
					{!! Form::text('address', null , ['class'=>'form-control']) !!}
				</div>
			</div>

			<div class="form-group">
				{!! Form::label('contact_number', 'Contuct Number' . ':', ['class'=>'col-sm-3 control-label']) !!}
				<div class="col-sm-6 mb15">
					{!! Form::text('contuct_number', null , ['class'=>'form-control']) !!}
				</div>
			</div>


			<div class="form-group">
				{!! Form::label('condotions', 'Condition' . ':', ['class'=>'col-sm-3 control-label']) !!}
				<div class="col-sm-6">
					{!! Form::select('contitions[]', $conditions, null, ['class'=>'form-control chosen-select', 'multiple'=>'true']) !!}
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