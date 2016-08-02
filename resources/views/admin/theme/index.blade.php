@extends('admin')

@section('page-title')
	<span>{{ Languages::trans('admin.breadcrumbs.theme_options') }}</span>
@endsection

@section('breadcrumbs')
	<li><a href="/admin">{{ Languages::trans('admin.breadcrumbs.admin') }}</a></li>
	<li class="active">{{ Languages::trans('admin.breadcrumbs.theme_options') }}</li>
@endsection

@section('content')

	{!! Form::open(['method'=>'POST', 'action'=>'Admin\ThemeController@postIndex', 'class'=>'form-horizontal']) !!}
		
		@include('admin.partial.errors')

		<div class="panel panel-default">
	
			<div class="panel-heading">
				<h4 class="panel-title">{{ Languages::trans('admin.breadcrumbs.theme_options') }}:</h4>
			</div>

			<div class="panel-body">

				@foreach(Theme::options() as $option)
			
					@include('admin.theme.render.'.$option['type'])

				@endforeach				

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

	@include('partial.imageselect')

@endsection